<?php

namespace Rhmt\Verihubs\Requests;

use ReflectionClass;
use Rhmt\Verihubs\Exceptions\VerihubsException;

class Config
{
    private $sandboxUrl;
    private $productionUrl;
    private $appID;
    private $apiKey;
    private $isDevelopment = true;

    public function __construct($sandboxUrl = null, $productionUrl = null)
    {
        $this->sandboxUrl = is_null($sandboxUrl) ? 'https://api.verihubs.com/v1' : rtrim($sandboxUrl, '/');
        $this->productionUrl = is_null($productionUrl) ? 'https://api.verihubs.com/v1' : rtrim($productionUrl, '/');
    }

    /**
     * Setters
     */

    public function setAppId($appID)
    {
        $this->appID = $appID;
        return $this;
    }

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    public function setDevelopment($state = true)
    {
        $this->isDevelopment = boolval($state);
        return $this;
    }

    /**
     * Getters
     */

    public function getAppId()
    {
        return $this->appID;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function isDevelopment()
    {
        return $this->isDevelopment;
    }

    public function getBaseUrl()
    {
        return $this->isDevelopment() ? $this->sandboxUrl : $this->productionUrl;
    }

    public function toArray()
    {
        $this->validate();

        return [
            'sandboxUrl' => $this->sandboxUrl,
            'productionUrl' => $this->productionUrl,
            'appId' => $this->appID,
            'apiKey' => $this->apiKey,
            'isDevelopment' => $this->isDevelopment,
        ];
    }

    public function toObject()
    {
        return (object) $this->toArray();
    }

    public function toJson($jsonOptions = 0)
    {
        return json_encode($this->toArray(), $jsonOptions);
    }

    /**
     * Validation
     */

    private function validate()
    {
        $properties = (new ReflectionClass(__CLASS__))->getProperties();

        foreach ($properties as $property) {
            if (null === $this->{$property->name}) {
                throw new VerihubsException(sprintf('The %s config needs to be set before using this library', $property->name));
            }
        }
    }
}
