<?php

namespace Omnipay\CardPointe\Message;

class CaptureResponse extends AbstractResponse
{
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

        // Check if the settlement status is successful
        $settleSuccess = isset($this->data['setlstat']) && $this->data['setlstat'] === 'Pending';

        return $httpSuccess && !$hasError && $settleSuccess;
    }
}
