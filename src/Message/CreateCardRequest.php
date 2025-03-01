<?php

namespace Omnipay\CardPointe\Message;

class CreateCardRequest extends AbstractRequest
{
    /**
     * Get the API endpoint URL for the request
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->getBaseEndpoint() . '/profile';
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
        $this->validate('card');
        $card = $this->getCard();

        $data = [
            'merchid' => $this->getMerchantId(),
            'defaultacct' => 'Y',
            'account' => $card->getNumber(),
            'expiry' => $card->getExpiryDate('my'), // Format: MMYY
            'name' => $card->getName(),
            'profile' => '', // Empty for new profile creation
        ];

        // Add CVV if available
        if ($card->getCvv()) {
            $data['cvv2'] = $card->getCvv();
        }

        // Add billing address if available
        if ($card->getAddress1()) {
            $data['address'] = $card->getAddress1();
            if ($card->getAddress2()) {
                $data['address'] .= ' ' . $card->getAddress2();
            }
            $data['city'] = $card->getCity();
            $data['region'] = $card->getState();
            $data['country'] = $card->getCountry();
            $data['postal'] = $card->getPostcode();
            $data['phone'] = $card->getPhone();
            $data['email'] = $card->getEmail();
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
        return new CreateCardResponse($this, $data, $statusCode);
    }
}
