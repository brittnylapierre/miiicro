<?php

namespace Omnipay\Przelewy24\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return '0' === $this->getCode();
    }

    public function getCode()
    {
        return trim($this->data['error']);
    }

    public function getMessage()
    {
        if (true === $this->isSuccessful()) {
            return null;
        }

        return trim($this->data['errorMessage']);
    }

    public function getToken()
    {
        return trim($this->data['token']);
    }

    /**
     * {@inheritdoc}
     */
    public function isRedirect()
    {
        return $this->isSuccessful() && null !== $this->getToken();
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectUrl()
    {
        return $this->getEndpoint() . 'trnRequest/' . $this->getToken();
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectData()
    {
        return null;
    }
}
