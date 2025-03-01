<?php

namespace Omnipay\CardPointe\Message;

class AuthorizeRequest extends AbstractRequest
{
    /**
     * Get the API endpoint URL for the request
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->getBaseEndpoint() . '/auth';
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
        $this->validate('amount');

        $data = [
            'merchid' => $this->getMerchantId(),
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency() ?: 'USD',
            'orderid' => $this->getTransactionId(),
            'ecomind' => 'E', // E-commerce transaction
            'capture' => 'N', // Authorize only, don't capture
        ];

        // Add card data or token
        if ($this->getCardReference()) {
            $data['profile'] = [
                'defaultacct' => 'Y',
                'acctid' => $this->getCardReference(),
            ];
        } elseif ($this->getCard()) {
            $this->validate('card');
            $card = $this->getCard();

            $data['name'] = $card->getName();
            $data['account'] = $card->getNumber();
            $data['expiry'] = $card->getExpiryDate('my'); // Format: MMYY
            $data['cvv2'] = $card->getCvv();

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
            }
        } else {
            $this->validate('card');
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
        return new AuthorizeResponse($this, $data, $statusCode);
    }
}
