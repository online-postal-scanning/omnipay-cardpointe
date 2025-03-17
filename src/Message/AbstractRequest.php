<?php

namespace Omnipay\CardPointe\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

abstract class AbstractRequest extends BaseAbstractRequest
{
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
     * @return AbstractRequest
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
     * @return AbstractRequest
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
     * @return AbstractRequest
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     * Get the sandbox endpoint
     */
    public function getSandboxEndpoint()
    {
        return $this->getParameter('sandboxEndpoint');
    }

    /**
     * Set the sanbox endpoint
     */
    public function setSandboxEndpoint($value)
    {
        return $this->setParameter('sandboxEndpoint', $value);
    }

    /**
     * Get the production endpoint
     */
    public function getProductionEndpoint()
    {
        return $this->getParameter('productionEndpoint');
    }

    /**
     * Set the production endpoint
     */
    public function setProductionEndpoint($value)
    {
        return $this->setParameter('productionEndpoint', $value);
    }

    /**
     * Get the base API endpoint URL
     *
     * @return string
     */
    protected function getBaseEndpoint()
    {
        $endpoint = $this->getTestMode() ? $this->getSandboxEndpoint() : $this->getProductionEndpoint();
        
        return $endpoint . '/cardconnect/rest';
    }

    /**
     * Get the API endpoint URL for the request
     *
     * @return string
     */
    abstract protected function getEndpoint();

    /**
     * Get the HTTP method for the request
     *
     * @return string
     */
    abstract protected function getHttpMethod();

    /**
     * Send the request to the API
     *
     * @param mixed $data The data to send
     * @return \Omnipay\CardPointe\Message\Response
     */
    public function sendData($data)
    {
        $endpoint = $this->getEndpoint();
        $httpMethod = $this->getHttpMethod();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        // Add Authorization header for API authentication
        $auth = base64_encode($this->getUsername() . ':' . $this->getPassword());
        $headers['Authorization'] = 'Basic ' . $auth;

        // Debug request
        if ($this->getTestMode()) {
            error_log('Request URL: ' . $endpoint);
            error_log('Request Method: ' . $httpMethod);
            error_log('Request Headers: ' . json_encode($headers));
            error_log('Request Body: ' . json_encode($data));
        }

        // Send the request
        $httpResponse = $this->httpClient->request(
            $httpMethod,
            $endpoint,
            $headers,
            $httpMethod === 'GET' ? null : json_encode($data)
        );

        // Get the response body
        $body = (string) $httpResponse->getBody();
        $jsonData = !empty($body) ? json_decode($body, true) : [];

        // Debug response
        if ($this->getTestMode()) {
            error_log('Response Status: ' . $httpResponse->getStatusCode());
            error_log('Response Body: ' . $body);
        }

        // Create and return the response
        return $this->createResponse($jsonData, $httpResponse->getStatusCode());
    }

    /**
     * Create a response object from the API response
     *
     * @param array $data The response data
     * @param int $statusCode The HTTP status code
     * @return \Omnipay\CardPointe\Message\Response
     */
    abstract protected function createResponse($data, $statusCode);
}
