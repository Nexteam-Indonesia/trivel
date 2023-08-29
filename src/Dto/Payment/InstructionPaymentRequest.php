<?php

namespace Nexteam\Trivel\Dto\Payment;

class InstructionPaymentRequest
{

    public string $code;
    public ?string $payCode;
    public ?int $amount;
    public int $allowHtml = 1;

    /**
     * @param string $code
     * @param string|null $payCode
     * @param int|null $amount
     * @param int $allowHtml
     */
    public function __construct(string $code, ?string $payCode = null, ?int $amount = null, int $allowHtml = 1)
    {
        $this->code = $code;
        $this->payCode = $payCode;
        $this->amount = $amount;
        $this->allowHtml = $allowHtml;
    }

    public function toJson(): array
    {
        return [
            "code" => $this->code,
            "pay_code" => $this->payCode,
            "amount" => $this->amount,
            "allow_html" => $this->allowHtml
        ];
    }


}
