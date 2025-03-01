<?php

namespace Omnipay\CardPointe\Message;

class PurchaseRequest extends AuthorizeRequest
{
    /**
     * Get the data for the request
     *
     * @return array
     */
    public function getData()
    {
        $data = parent::getData();

        // Set capture flag to Y for immediate capture
        $data['capture'] = 'Y';

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
        return new PurchaseResponse($this, $data, $statusCode);
    }
}
