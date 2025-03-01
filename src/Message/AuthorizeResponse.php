<?php

namespace Omnipay\CardPointe\Message;

class AuthorizeResponse extends AbstractResponse
{
    /**
     * Get the card reference (token)
     *
     * @return string|null
     */
    public function getCardReference()
    {
        return $this->data['token'] ?? null;
    }
}
