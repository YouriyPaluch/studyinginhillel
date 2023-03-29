<?php

namespace Homework\PhpPro\Models;

use GuzzleHttp\Exception\GuzzleException;
use Homework\PhpPro\Interfaces\IMyLogger;
use InvalidArgumentException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;

class UrlValidator {

    /**
     * @param ClientInterface $client
     * @param IMyLogger $logger
     */
    public function __construct(protected ClientInterface $client, protected IMyLogger $logger) {
    }

    /**
     * @param string $url
     * @return bool
     */
    public function isUrl(string $url): bool
    {
        if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
            $this->logger->log('data was not valid url', 'warning');
            throw new InvalidArgumentException('Url is not valid');
        }
        return true;
    }

    /**
     * @param string $url
     * @return bool
     * @throws GuzzleException
     */
    public function isWorking(string $url): bool
    {
        $allowCodes = [
            200, 201, 301, 302
        ];

        try {
            $response = $this->client->request('GET', $url);
            return (!empty($response->getStatusCode()) && in_array($response->getStatusCode(), $allowCodes));
        } catch (ConnectException $e) {
            $this->logger->log('Url was not have working connection' . $e->getMessage(), 'error');
        }
    }
}