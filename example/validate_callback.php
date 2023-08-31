<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Nexteam\Trivel\Callback\TrivelCallback;

Route::post('callback', function (Request $request) {

    $validate = TrivelCallback::validate($request);

    return response()->json([
        "is_signature_valid" => $validate
    ]);

});
