<?php

namespace Nexteam\Trivel\Utils;

class JsonUtils
{

    public static function isValidJson($string)
    {

        $result = json_decode($string);

        $error = match (json_last_error()) {
            JSON_ERROR_NONE => '',
            JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded.',
            JSON_ERROR_STATE_MISMATCH => 'Invalid or malformed JSON.',
            JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded.',
            JSON_ERROR_SYNTAX => 'Syntax error, malformed JSON.',
            JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded.',
            JSON_ERROR_RECURSION => 'One or more recursive references in the value to be encoded.',
            JSON_ERROR_INF_OR_NAN => 'One or more NAN or INF values in the value to be encoded.',
            JSON_ERROR_UNSUPPORTED_TYPE => 'A value of a type that cannot be encoded was given.',
            default => 'Unknown JSON error occurred.',
        };

        return $error === '';
    }

}
