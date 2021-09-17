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
use GuzzleHttp\Exception\TransferException;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Guzzle\ClientFactory;
use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\Codec\Json;
use LinkSoft\Source\Exception\ClientException;
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
            throw new \InvalidArgumentException(sprintf('config[%s] is not exist!', $key));
        }
        $this->logger = $container->get(LoggerFactory::class)->get('source');
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
        $url = $this->config['domain'] . '/' . $route;
        $param = [];
        $param['form_params'] = array_merge(['appId' => $this->config['sourceId'] ?? '', 'appSecret' => $this->config['sourceKey'] ?? ''], $options);
        $this->logger->debug(sprintf('Request Source [%s] %s param %s', strtoupper($method), $url, Json::encode($options)));
        try {
            $response = $this->client->request($method, $url, $param);
        } catch (TransferException $exception) {
            $message = sprintf('Something went wrong when calling source (%s).', $exception->getMessage());
            $this->logger->error($message);
            throw new ServerException($exception->getMessage(), $exception->getCode(), $exception);
        } catch (GuzzleException $exception) {
            $message = sprintf('Something went wrong when calling source (%s).', $exception->getMessage());
            $this->logger->error($message);
            throw new ServerException($exception->getMessage(), $exception->getCode(), $exception);
        }
        if ($response->getStatusCode() >= 400) {
            $message = sprintf('Something went wrong when calling source (%s - %s).', $response->getStatusCode(), $response->getReasonPhrase());
            $this->logger->error($message);
            $message .= PHP_EOL . (string)$response->getBody();
            if ($response->getStatusCode() >= 500) {
                throw new ServerException($message, $response->getStatusCode());
            }
            throw new ClientException($message, $response->getStatusCode());
        }
        return new SourceResponse($response);
    }
}
