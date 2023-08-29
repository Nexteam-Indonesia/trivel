<?php

namespace Nexteam\Trivel\Exception;

use Nexteam\Trivel\Utils\JsonUtils;

class TrivelException extends \Exception
{


    public static function process(mixed $exception): TrivelException
    {
        if (JsonUtils::isValidJson($exception)) {
            $response = json_decode($exception);
            $exception = new TrivelException($response['message']);
        } else {
            $exception = new TrivelException($exception);
        }
        return $exception;
    }


}
