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

use Hyperf\Utils\Codec\Json;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @method int getStatusCode()
 * @method string getReasonPhrase()
 * @method StreamInterface getBody()
 */
class SourceResponse
{
    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function __call($name, $arguments)
    {
        return $this->response->{$name}(...$arguments);
    }

    public function getResult():array
    {
        return Json::decode($this->getBody()->getContents());
    }

    public function getData():array
    {
        $result = $this->getResult();
        return $result['data'];
    }
}
