<?php

use Illuminate\Http\Request;
function responseData($data, $message = "",$status=true)
{
    return [
        "success" => $status,
        "message" => $message,
        "data" => $data
    ];
}