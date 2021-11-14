<?php

namespace Gruzd\Tools\Url;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class HostChecker
 */
class HostChecker
{
    /**
     * @var Client
     */
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    /**
     * @param $url
     *
     * @return bool
     * @throws GuzzleException
     */
    public function check($url)
    {
        $checked = true;

        try {
            $statusCode = $this->getStatusCode($url);
        } catch (Exception $exception) {
            $statusCode = 500;
        }

        if ($statusCode >= 400) {
            $checked = false;
        }

        return $checked;
    }

    /**
     * @param $url
     *
     * @return int
     * @throws GuzzleException
     */
    private function getStatusCode($url)
    {
        return $this->httpClient->get($url)->getStatusCode();
    }
}
