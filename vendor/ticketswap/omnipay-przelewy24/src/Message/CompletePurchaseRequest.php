<?php

namespace Omnipay\Przelewy24\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * @todo: Reason this class exists
 */
class CompletePurchaseRequest extends AbstractRequest
{
    public function getSessionId()
    {
        return $this->getParameter('sessionId');
    }

    public function setSessionId($value)
    {
        return $this->setParameter('sessionId', $value);
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        $this->validate('sessionId', 'amount', 'currency', 'transactionId');

        $data = array(
            'p24_session_id' => $this->getSessionId(),
            'p24_amount' => $this->getAmountInteger(),
            'p24_currency' => $this->getCurrency(),
            'p24_order_id' => $this->getTransactionId(),
            'p24_sign' => $this->generateSignature(
                $this->getSessionId(),
                $this->getTransactionId(),
                $this->getAmountInteger(),
                $this->getCurrency(),
                $this->getCrc()
            ),
        );

        return $data;
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $httpResponse = $this->sendRequest('POST', 'trnVerify', $data);

        $responseData = array();
        parse_str($httpResponse->getBody(), $responseData);

        return $this->response = new CompletePurchaseResponse($this, $responseData, $this->getEndpoint());
    }

    /**
     * @param $sessionId
     * @param $transactionId
     * @param $amount
     * @param $currency
     * @param $crc
     * @return string
     */
    private function generateSignature($sessionId, $transactionId, $amount, $currency, $crc)
    {
        return md5(sprintf('%s|%s|%s|%s|%s', $sessionId, $transactionId, $amount, $currency, $crc));
    }
}
