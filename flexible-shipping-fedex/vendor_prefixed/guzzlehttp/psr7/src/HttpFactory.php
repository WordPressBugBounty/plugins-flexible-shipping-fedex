<?php

declare (strict_types=1);
namespace FedExVendor\GuzzleHttp\Psr7;

use FedExVendor\Psr\Http\Message\RequestFactoryInterface;
use FedExVendor\Psr\Http\Message\RequestInterface;
use FedExVendor\Psr\Http\Message\ResponseFactoryInterface;
use FedExVendor\Psr\Http\Message\ResponseInterface;
use FedExVendor\Psr\Http\Message\ServerRequestFactoryInterface;
use FedExVendor\Psr\Http\Message\ServerRequestInterface;
use FedExVendor\Psr\Http\Message\StreamFactoryInterface;
use FedExVendor\Psr\Http\Message\StreamInterface;
use FedExVendor\Psr\Http\Message\UploadedFileFactoryInterface;
use FedExVendor\Psr\Http\Message\UploadedFileInterface;
use FedExVendor\Psr\Http\Message\UriFactoryInterface;
use FedExVendor\Psr\Http\Message\UriInterface;
/**
 * Implements all of the PSR-17 interfaces.
 *
 * Note: in consuming code it is recommended to require the implemented interfaces
 * and inject the instance of this class multiple times.
 */
final class HttpFactory implements \FedExVendor\Psr\Http\Message\RequestFactoryInterface, \FedExVendor\Psr\Http\Message\ResponseFactoryInterface, \FedExVendor\Psr\Http\Message\ServerRequestFactoryInterface, \FedExVendor\Psr\Http\Message\StreamFactoryInterface, \FedExVendor\Psr\Http\Message\UploadedFileFactoryInterface, \FedExVendor\Psr\Http\Message\UriFactoryInterface
{
    public function createUploadedFile(\FedExVendor\Psr\Http\Message\StreamInterface $stream, int $size = null, int $error = \UPLOAD_ERR_OK, string $clientFilename = null, string $clientMediaType = null) : \FedExVendor\Psr\Http\Message\UploadedFileInterface
    {
        if ($size === null) {
            $size = $stream->getSize();
        }
        return new \FedExVendor\GuzzleHttp\Psr7\UploadedFile($stream, $size, $error, $clientFilename, $clientMediaType);
    }
    public function createStream(string $content = '') : \FedExVendor\Psr\Http\Message\StreamInterface
    {
        return \FedExVendor\GuzzleHttp\Psr7\Utils::streamFor($content);
    }
    public function createStreamFromFile(string $file, string $mode = 'r') : \FedExVendor\Psr\Http\Message\StreamInterface
    {
        try {
            $resource = \FedExVendor\GuzzleHttp\Psr7\Utils::tryFopen($file, $mode);
        } catch (\RuntimeException $e) {
            if ('' === $mode || \false === \in_array($mode[0], ['r', 'w', 'a', 'x', 'c'], \true)) {
                throw new \InvalidArgumentException(\sprintf('Invalid file opening mode "%s"', $mode), 0, $e);
            }
            throw $e;
        }
        return \FedExVendor\GuzzleHttp\Psr7\Utils::streamFor($resource);
    }
    public function createStreamFromResource($resource) : \FedExVendor\Psr\Http\Message\StreamInterface
    {
        return \FedExVendor\GuzzleHttp\Psr7\Utils::streamFor($resource);
    }
    public function createServerRequest(string $method, $uri, array $serverParams = []) : \FedExVendor\Psr\Http\Message\ServerRequestInterface
    {
        if (empty($method)) {
            if (!empty($serverParams['REQUEST_METHOD'])) {
                $method = $serverParams['REQUEST_METHOD'];
            } else {
                throw new \InvalidArgumentException('Cannot determine HTTP method');
            }
        }
        return new \FedExVendor\GuzzleHttp\Psr7\ServerRequest($method, $uri, [], null, '1.1', $serverParams);
    }
    public function createResponse(int $code = 200, string $reasonPhrase = '') : \FedExVendor\Psr\Http\Message\ResponseInterface
    {
        return new \FedExVendor\GuzzleHttp\Psr7\Response($code, [], null, '1.1', $reasonPhrase);
    }
    public function createRequest(string $method, $uri) : \FedExVendor\Psr\Http\Message\RequestInterface
    {
        return new \FedExVendor\GuzzleHttp\Psr7\Request($method, $uri);
    }
    public function createUri(string $uri = '') : \FedExVendor\Psr\Http\Message\UriInterface
    {
        return new \FedExVendor\GuzzleHttp\Psr7\Uri($uri);
    }
}
