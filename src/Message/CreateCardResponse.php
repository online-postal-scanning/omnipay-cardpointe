<?php

namespace Omnipay\CardPointe\Message;

class CreateCardResponse extends AbstractResponse
{
    /**
     * Get the card reference (token)
     *
     * @return string|null
     */
    public function getCardReference()
    {
        return $this->data['profileid'] ?? null;
    }

    /**
     * Get the masked card number
     *
     * @return string|null
     */
    public function getMaskedCardNumber()
    {
        return $this->data['acctid'] ?? null;
    }

    /**
     * Get the card type
     *
     * @return string|null
     */
    public function getCardType()
    {
        return $this->data['accttype'] ?? null;
    }

    /**
     * Get the card expiry date
     *
     * @return string|null
     */
    public function getExpiryDate()
    {
        return $this->data['expiry'] ?? null;
    }
}
