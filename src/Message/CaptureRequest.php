<?php

namespace Omnipay\CardPointe\Message;

class CaptureRequest extends AbstractRequest
{
    /**
     * Get the API endpoint URL for the request
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->getBaseEndpoint() . '/capture';
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
        $this->validate('transactionReference', 'amount');

        return [
            'merchid' => $this->getMerchantId(),
            'retref' => $this->getTransactionReference(),
            'amount' => $this->getAmount(),
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
        return new CaptureResponse($this, $data, $statusCode);
    }
}
