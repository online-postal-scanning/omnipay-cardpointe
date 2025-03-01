<?php

namespace Omnipay\CardPointe\Message;

class VoidRequest extends AbstractRequest
{
    /**
     * Get the API endpoint URL for the request
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->getBaseEndpoint() . '/void';
    }

    /**
     * Get the HTTP method for the request
     *
     * @return string
     */
    protected function getHttpMethod()
    {
        return 'PUT';
    }

    /**
     * Get the data for the request
     *
     * @return array
     */
    public function getData()
    {
        $this->validate('transactionReference');

        return [
            'merchid' => $this->getMerchantId(),
            'retref' => $this->getTransactionReference(),
        ];
    }

    /**
     * Create a response object from the API response
     *
     * @param array $data The response data
     * @param int $statusCode The HTTP status code
     * @return \Omnipay\CardPointe\Message\Response
     */
    protected function createResponse($data, $statusCode)
    {
        return new VoidResponse($this, $data, $statusCode);
    }
}
