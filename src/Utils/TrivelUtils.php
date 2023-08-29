<?php

namespace Nexteam\Trivel\Utils;

class TrivelUtils
{

    public static function generateSignature(string $merchantRef, int $amount): string
    {
        return hash_hmac('sha256', config('trivel.merchant_code') . $merchantRef . $amount, config('trivel.private_key'));
    }

}
