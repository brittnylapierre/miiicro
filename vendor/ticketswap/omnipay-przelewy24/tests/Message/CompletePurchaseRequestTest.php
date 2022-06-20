<?php

namespace Omnipay\Przelewy24\Message;

use Omnipay\Tests\TestCase;

class CompletePurchaseRequestTest extends TestCase
{
    /**
     * @var CompletePurchaseRequest
     */
    private $request;

    public function setUp()
    {
        $this->request = new CompletePurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(array(
            'merchantId'     => '144354',
            'posId'          => '144354',
            'crc'            => '1287875353948',
            'sessionId'      => '42',
            'amount'         => '12.00',
            'currency'       => 'PLN',
            'transaction_id' => '10273987',
        ));
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('42', $data['p24_session_id']);
        $this->assertSame(1200, $data['p24_amount']);
        $this->assertSame('PLN', $data['p24_currency']);
        $this->assertSame('10273987', $data['p24_order_id']);
        $this->assertSame('ea9a8160f8b66cdd14e8c8915697b5ca', $data['p24_sign']);
        $this->assertCount(5, $data);
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CompletePurchaseSuccess.txt');
        $response = $this->request->send();

        $this->assertInstanceOf('Omnipay\Przelewy24\Message\CompletePurchaseResponse', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('CompletePurchaseFailure.txt');
        $response = $this->request->send();

        $this->assertInstanceOf('Omnipay\Przelewy24\Message\CompletePurchaseResponse', $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertSame('err00', $response->getCode());
        $this->assertSame('Invalid CRC', $response->getMessage());
    }
}
