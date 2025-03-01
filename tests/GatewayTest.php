<?php

namespace Tests;

use Omnipay\CardPointe\Gateway;
use Omnipay\CardPointe\Message\AuthorizeRequest;
use Omnipay\CardPointe\Message\CaptureRequest;
use Omnipay\CardPointe\Message\CreateCardRequest;
use Omnipay\CardPointe\Message\PurchaseRequest;
use Omnipay\CardPointe\Message\RefundRequest;
use Omnipay\CardPointe\Message\VoidRequest;
use Omnipay\Tests\GatewayTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Gateway::class)]
class GatewayTest extends GatewayTestCase
{
    protected $gateway;

    protected function setUp(): void
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setMerchantId('TestMerchant');
        $this->gateway->setUsername('TestUser');
        $this->gateway->setPassword('TestPassword');
    }

    public function testAuthorize(): void
    {
        $request = $this->gateway->authorize([
            'amount' => '10.00',
            'card' => $this->getValidCard(),
        ]);

        self::assertInstanceOf(AuthorizeRequest::class, $request);
        self::assertSame('TestMerchant', $request->getMerchantId());
        self::assertSame('TestUser', $request->getUsername());
        self::assertSame('TestPassword', $request->getPassword());
        self::assertSame('10.00', $request->getAmount());
    }

    public function testCapture(): void
    {
        $request = $this->gateway->capture([
            'amount' => '10.00',
            'transactionReference' => 'abc123',
        ]);

        self::assertInstanceOf(CaptureRequest::class, $request);
        self::assertSame('TestMerchant', $request->getMerchantId());
        self::assertSame('TestUser', $request->getUsername());
        self::assertSame('TestPassword', $request->getPassword());
        self::assertSame('10.00', $request->getAmount());
        self::assertSame('abc123', $request->getTransactionReference());
    }

    public function testPurchase(): void
    {
        $request = $this->gateway->purchase([
            'amount' => '10.00',
            'card' => $this->getValidCard(),
        ]);

        self::assertInstanceOf(PurchaseRequest::class, $request);
        self::assertSame('TestMerchant', $request->getMerchantId());
        self::assertSame('TestUser', $request->getUsername());
        self::assertSame('TestPassword', $request->getPassword());
        self::assertSame('10.00', $request->getAmount());
    }

    public function testRefund(): void
    {
        $request = $this->gateway->refund([
            'amount' => '10.00',
            'transactionReference' => 'abc123',
        ]);

        self::assertInstanceOf(RefundRequest::class, $request);
        self::assertSame('TestMerchant', $request->getMerchantId());
        self::assertSame('TestUser', $request->getUsername());
        self::assertSame('TestPassword', $request->getPassword());
        self::assertSame('10.00', $request->getAmount());
        self::assertSame('abc123', $request->getTransactionReference());
    }

    public function testVoid(): void
    {
        $request = $this->gateway->void([
            'transactionReference' => 'abc123',
        ]);

        self::assertInstanceOf(VoidRequest::class, $request);
        self::assertSame('TestMerchant', $request->getMerchantId());
        self::assertSame('TestUser', $request->getUsername());
        self::assertSame('TestPassword', $request->getPassword());
        self::assertSame('abc123', $request->getTransactionReference());
    }

    public function testCreateCard(): void
    {
        $request = $this->gateway->createCard([
            'card' => $this->getValidCard(),
        ]);

        self::assertInstanceOf(CreateCardRequest::class, $request);
        self::assertSame('TestMerchant', $request->getMerchantId());
        self::assertSame('TestUser', $request->getUsername());
        self::assertSame('TestPassword', $request->getPassword());
    }
}
