<?php
namespace Osen\Coop;

use Osen\Coop\Bank;

class TransactionStatus extends Bank
{
    public static function send($messageReference, $callback = null)
    {
        $url   = parent::$host . '/QueryStatus/v1.0.0/query';
        $token = parent::token();

        $payload = array(
            "MessageReference" => $messageReference,
        );

        $headers  = array('Content-Type: application/json', "Authorization: Bearer {$token}");
        $response = parent::curlPostRequest($url, $headers, $payload);

        return is_null($callback)
        ? $response
        : \call_user_func_array(array($callback), array($response));
    }
}
