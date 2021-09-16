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

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\TransferException;
use Hyperf\Consul\SourceResponse;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Guzzle\ClientFactory;
use Hyperf\Guzzle\HandlerStackFactory;
use Hyperf\Utils\Codec\Json;
use LinkSoft\Source\Exception\ClientException;
use LinkSoft\Source\Exception\ServerException;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

abstract class Client
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ConfigInterface
     */
    private $config;

    public function __construct(ConfigInterface $config, LoggerInterface $logger = null)
    {
        $factory = new HandlerStackFactory();
        $stack = $factory->create();
        $this->client = make(Client::class, [
            'config' => [
                'handler' => $stack,
            ],
        ]);
        $this->logger = $logger ?: new NullLogger();
        $this->config = $config->get('source');
    }

    /**
     * Send a HTTP request.
     * @param string $method
     * @param string $route
     * @param array $options
     * @return SourceResponse
     */
    protected function request(string $method, string $route, array $options = []): SourceResponse
    {
        $url = $this->config['domain'] . '/' . $route;
        if (isset($options['body'])) {
            $options['body'] = array_merge($options['body'], ['appId' => $this->config['sourceId'] ?? '', 'appSecret' => $this->config['sourceKey'] ?? '']);
        } else {
            $options['body'] = ['appId' => $this->config['sourceId'] ?? '', 'appSecret' => $this->config['sourceKey'] ?? ''];
        }
        $this->logger->debug(sprintf('Request Source [%s] %s param %s', strtoupper($method), $url, Json::encode($options)));
        try {
            // Create a HTTP Client by $clientFactory closure.
            $response = $this->client->request($method, $url, $options);
        } catch (TransferException $exception) {
            $message = sprintf('Something went wrong when calling source (%s).', $exception->getMessage());
            $this->logger->error($message);
            throw new ServerException($exception->getMessage(), $exception->getCode(), $exception);
        } catch (GuzzleException $exception) {
            $message = sprintf('Something went wrong when calling source (%s).', $exception->getMessage());
            $this->logger->error($message);
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
