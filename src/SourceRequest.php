<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace LinkSoft\Source;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Guzzle\ClientFactory;
use Hyperf\Utils\Codec\Json;
use LinkSoft\Source\Exception\ServerException;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class SourceRequest
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(ContainerInterface $container)
    {
        $config = $container->get(ConfigInterface::class);
        if (!$config->has('source')) {
            throw new \InvalidArgumentException(sprintf('config[%s] is not exist!', 'source'));
        }
        $this->logger = $container->get(StdoutLoggerInterface::class);
        $this->config = $config->get('source');
        $this->client = $container->get(ClientFactory::class)->create();
    }

    /**
     * Send a HTTP request.
     * @param string $method
     * @param string $route
     * @param array $options
     * @return SourceResponse
     */
    public function request(string $method, string $route, array $options = []): SourceResponse
    {
        $startTime = microtime(true) * 1000;
        $url = $this->config['domain'] . '/' . $route;
        $param = [];
        $param['form_params'] = array_merge(['appId' => $this->config['sourceId'] ?? '', 'appSecret' => $this->config['sourceKey'] ?? ''], $options);
        try {
            $response = $this->client->request($method, $url, $param);
        } catch (ClientException $exception) {
            $this->logger->error(sprintf('Request Source [%s] %s param %s Something went wrong when calling source (%s).', strtoupper($method), $url, Json::encode($options), $exception->getMessage()));
            throw new ServerException($exception->getMessage(), $exception->getCode(), $exception);
        } catch (GuzzleException $exception) {
            $this->logger->error(sprintf('Request Source [%s] %s param %s Something went wrong when calling source (%s).', strtoupper($method), $url, Json::encode($options), $exception->getMessage()));
            throw new ServerException($exception->getMessage(), $exception->getCode(), $exception);
        }
        $this->logger->info(sprintf('[%s ms]Request Source [%s] %s param %s', intval(microtime(true) * 1000 - $startTime), strtoupper($method), $url, Json::encode($options)));
        return new SourceResponse($response);
    }
}
