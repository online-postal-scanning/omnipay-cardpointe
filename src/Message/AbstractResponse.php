<?php

namespace Omnipay\CardPointe\Message;

use Omnipay\Common\Message\AbstractResponse as OmnipayAbstractResponse;
use Omnipay\Common\Message\RequestInterface;

abstract class AbstractResponse extends OmnipayAbstractResponse
{
    /**
     * @var int
     */
    protected $statusCode;

    /**
     * Constructor
     *
     * @param RequestInterface $request The request
     * @param array $data The response data
     * @param int $statusCode The HTTP status code
     */
    public function __construct(RequestInterface $request, $data, $statusCode = 200)
    {
        parent::__construct($request, $data);
        $this->statusCode = $statusCode;
    }

    /**
     * Get the HTTP status code
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Is the response successful?
     *
     * @return bool
     */
    public function isSuccessful()
    {
        // Check if the HTTP status code is in the 2xx range
        $httpSuccess = $this->statusCode >= 200 && $this->statusCode < 300;

        // Check if the response contains an error message
        $hasError = isset($this->data['respstat']) && $this->data['respstat'] !== 'A';

        return $httpSuccess && !$hasError;
    }

    /**
     * Get the response message
     *
     * @return string|null
     */
    public function getMessage()
    {
        return $this->data['resptext'] ?? null;
    }

    /**
     * Get the response code
     *
     * @return string|null
     */
    public function getCode()
    {
        return $this->data['respcode'] ?? null;
    }

    /**
     * Get the transaction reference
     *
     * @return string|null
     */
    public function getTransactionReference()
    {
        return $this->data['retref'] ?? null;
    }

    /**
     * Get the authorization code
     *
     * @return string|null
     */
    public function getAuthorizationCode()
    {
        return $this->data['authcode'] ?? null;
    }

    /**
     * Get the AVS response
     *
     * @return string|null
     */
    public function getAvsResponse()
    {
        return $this->data['avsresp'] ?? null;
    }

    /**
     * Get the CVV response
     *
     * @return string|null
     */
    public function getCvvResponse()
    {
        return $this->data['cvvresp'] ?? null;
    }
}
