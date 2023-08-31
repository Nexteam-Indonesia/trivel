<?php

namespace Nexteam\Trivel\Callback;

use Illuminate\Http\Request;

class TrivelCallback
{

    public static function validate(Request $request): bool
    {
        $expected = $request->header('x-callback-signature');
        $computed = hash_hmac('sha256', json_encode($request->all()), config('trivel.private_key'));
        return $expected === $computed;
    }

}
