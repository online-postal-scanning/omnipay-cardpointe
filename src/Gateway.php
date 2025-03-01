<?php

namespace Omnipay\CardPointe;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'CardPointe';
    }

    public function getDefaultParameters()
    {
        return [
            'merchantId' => '',
            'username' => '',
            'password' => '',
            'testMode' => false,
        ];
    }

    /**
     * Authorize a payment
     *
     * @param array $options
     * @return \Omnipay\CardPointe\Message\AuthorizeRequest
     */
    public function authorize(array $options = [])
    {
        return $this->createRequest('\Omnipay\CardPointe\Message\AuthorizeRequest', $options);
    }

    /**
     * Capture a previously authorized payment
     *
     * @param array $options
     * @return \Omnipay\CardPointe\Message\CaptureRequest
     */
    public function capture(array $options = [])
    {
        return $this->createRequest('\Omnipay\CardPointe\Message\CaptureRequest', $options);
    }

    /**
     * Authorize and immediately capture a payment
     *
     * @param array $options
     * @return \Omnipay\CardPointe\Message\PurchaseRequest
     */
    public function purchase(array $options = [])
    {
        return $this->createRequest('\Omnipay\CardPointe\Message\PurchaseRequest', $options);
    }

    /**
     * Refund a previously captured payment
     *
     * @param array $options
     * @return \Omnipay\CardPointe\Message\RefundRequest
     */
    public function refund(array $options = [])
    {
        return $this->createRequest('\Omnipay\CardPointe\Message\RefundRequest', $options);
    }

    /**
     * Void a previously authorized payment
     *
     * @param array $options
     * @return \Omnipay\CardPointe\Message\VoidRequest
     */
    public function void(array $options = [])
    {
        return $this->createRequest('\Omnipay\CardPointe\Message\VoidRequest', $options);
    }

    /**
     * Create a new card in the CardPointe vault
     *
     * @param array $options
     * @return \Omnipay\CardPointe\Message\CreateCardRequest
     */
    public function createCard(array $options = [])
    {
        return $this->createRequest('\Omnipay\CardPointe\Message\CreateCardRequest', $options);
    }

    /**
     * Get the merchant ID
     *
     * @return string
     */
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    /**
     * Set the merchant ID
     *
     * @param string $value
     * @return Gateway
     */
    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    /**
     * Get the API username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->getParameter('username');
    }

    /**
     * Set the API username
     *
     * @param string $value
     * @return Gateway
     */
    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    /**
     * Get the API password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * Set the API password
     *
     * @param string $value
     * @return Gateway
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }
}
