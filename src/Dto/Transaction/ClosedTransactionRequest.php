<?php

namespace Nexteam\Trivel\Dto\Transaction;

use Nexteam\Trivel\Utils\TrivelUtils;

class ClosedTransactionRequest
{

    public string $merchantRef;
    public int $amount;
    public array $data;

    /**
     * @param string $merchantRef
     * @param int $amount
     * @param array $data
     */
    public function __construct(string $merchantRef, int $amount, array $data)
    {
        $this->merchantRef = $merchantRef;
        $this->amount = $amount;
        $this->data = $data;
    }

    public function toJson(): array
    {
        $this->data['signature'] = TrivelUtils::generateSignature($this->merchantRef, $this->amount);
        return $this->data;
    }

}
