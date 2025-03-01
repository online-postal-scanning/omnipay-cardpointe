<?php

namespace Omnipay\CardPointe\Message;

class RefundRequest extends AbstractRequest
{
    /**
     * Get the API endpoint URL for the request
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->getBaseEndpoint() . '/refund';
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

        $data = [
            'merchid' => $this->getMerchantId(),
            'retref' => $this->getTransactionReference(),
        ];

        // Amount is optional for full refunds
        if ($this->getAmount() > 0) {
            $data['amount'] = $this->getAmount();
        }

        return $data;
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
        return new RefundResponse($this, $data, $statusCode);
    }
}
