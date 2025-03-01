<?php

namespace Tests\Message;

use Omnipay\CardPointe\Message\AuthorizeRequest;
use Omnipay\Common\CreditCard;
use Omnipay\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(AuthorizeRequest::class)]
class AuthorizeRequestTest extends TestCase
{
    protected $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new AuthorizeRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setMerchantId('TestMerchant');
        $this->request->setUsername('TestUser');
        $this->request->setPassword('TestPassword');
        $this->request->setAmount('10.00');
        $this->request->setCurrency('USD');
        $this->request->setTransactionId('TX123');
    }

    public function testGetData(): void
    {
        $card = new CreditCard([
            'number' => '4111111111111111',
            'expiryMonth' => '12',
            'expiryYear' => '2025',
            'cvv' => '123',
            'firstName' => 'John',
            'lastName' => 'Smith',
            'address1' => '123 Main St',
            'address2' => 'Apt 1',
            'city' => 'Anytown',
            'state' => 'CA',
            'postcode' => '12345',
            'country' => 'US',
            'phone' => '555-123-4567',
            'email' => 'john.smith@example.com',
        ]);
        $this->request->setCard($card);

        $data = $this->request->getData();

        self::assertSame('TestMerchant', $data['merchid']);
        self::assertSame('10.00', $data['amount']);
        self::assertSame('USD', $data['currency']);
        self::assertSame('TX123', $data['orderid']);
        self::assertSame('E', $data['ecomind']);
        self::assertSame('N', $data['capture']);
        self::assertSame('John Smith', $data['name']);
        self::assertSame('4111111111111111', $data['account']);
        self::assertSame('1225', $data['expiry']);
        self::assertSame('123', $data['cvv2']);
        self::assertSame('123 Main St Apt 1', $data['address']);
        self::assertSame('Anytown', $data['city']);
        self::assertSame('CA', $data['region']);
        self::assertSame('US', $data['country']);
        self::assertSame('12345', $data['postal']);
    }

    public function testGetDataWithCardReference(): void
    {
        $this->request->setCardReference('TOKEN123');

        $data = $this->request->getData();

        self::assertSame('TestMerchant', $data['merchid']);
        self::assertSame('10.00', $data['amount']);
        self::assertSame('USD', $data['currency']);
        self::assertSame('TX123', $data['orderid']);
        self::assertSame('E', $data['ecomind']);
        self::assertSame('N', $data['capture']);
        self::assertSame('Y', $data['profile']['defaultacct']);
        self::assertSame('TOKEN123', $data['profile']['acctid']);
    }
}
