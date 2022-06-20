<?php

namespace Omnipay\Przelewy24\Message;

use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;
use Omnipay\Common\Message\RequestInterface;

abstract class AbstractResponse extends BaseAbstractResponse
{
    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @param RequestInterface $request
     * @param array $data
     * @param string $endpoint
     */
    public function __construct(RequestInterface $request, $data, $endpoint)
    {
        parent::__construct($request, $data);
        $this->endpoint = $endpoint;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }
}
