<?php

namespace Track123\OpenApi\Contracts;

class Config
{
    /**
     * @var string uri地址
     */
    protected string $baseUri = 'https://api.track123.com/gateway/open-api';

    /**
     * @var string token
     */
    protected string $token = 'YOUR TOKEN';

    public function __construct(string $token = null)
    {
        if (!empty(trim($token ?? ''))) {
            $this->token = trim($token);
        }
    }

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * @param string $baseUri
     * @return $this
     */
    public function setBaseUri(string $baseUri): self
    {
        $this->baseUri = $baseUri;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }
}