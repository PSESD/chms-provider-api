<?php
/**
 * Clock Hour Management System - Provider Provider
 *
 * @copyright Copyright (c) 2016 Puget Sound Educational Service District
 * @license   Proprietary
 */
namespace CHMS\ProviderHub\Auth;

use Cache;
use CHMS\ProviderHub\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class ProxyAuthorizer
{
    private $request;
    private $client;
    private $config;

    public function __construct($app, $config)
    {
        $this->request = $app->make('request');
        $this->config = $config;
    }

    public function getAccessToken()
    {
        $token = $this->request->bearerToken();
        $tokenObject = $this->getTokenObject($token);
        if (empty($tokenObject)) {
            throw new \Exception("Invalid token.");
        }
        return $tokenObject;
    }

    private function getTokenObject($token)
    {
        $cacheKey = md5('token:' . $token);
        if (($tokenObject = Cache::get($cacheKey))) {
            // return unserialize($tokenObject);
        }
        $tokenObject = $this->askAuthorizer($token);
        if ($tokenObject) {
            $tokenObject->ensureObject();
            $expireDate = new \DateTime();
            $expireDate->setTimestamp($tokenObject->getExpires());
            Cache::put($cacheKey, serialize($tokenObject), $expireDate);
            return $tokenObject;
        }
        return false;
    }

    private function askAuthorizer($token)
    {
        $headers = ['Authorization' => 'Bearer ' . $token];
        $request = new GuzzleRequest('GET', $this->config['checkRoute'], $headers);
        try {
            $response = $this->getAuthorizerClient()->send($request);
        } catch (\Exception $e) {
            return false;
        }
        if (!$response || $response->getStatusCode() !== 200) {
          return false;
        }
        $resource = json_decode($response->getbody()->getContents(), true);
        return ProxyToken::generate($token, $resource);
    }

    protected function getAuthorizerClient()
    {
        if (!isset($this->client)) {
          $this->client = new GuzzleClient([
              'base_uri' => $this->config['authServer'],
              'timeout'  => 5,
              'http_errors' => false,
              'connect_timeout' => 15
          ]);
        }
        return $this->client;
    }

    /**
     * Get the resource owner ID of the current request.
     *
     * @return string
     */
    public function getResourceOwnerId()
    {
        return $this->getAccessToken()->getId();
    }

    /**
     * Get the resource owner type of the current request (client or user).
     *
     * @return string
     */
    public function getResourceOwnerType()
    {
        return $this->getAccessToken()->getType();
    }
}
