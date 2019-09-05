<?php
namespace Osen\Coop;

use Osen\Coop\Bank;

class AccountBalance extends Bank
{
    public static function send($messageReference, $accountNumber = null, $callback = null)
    {
        $url           = parent::$host . '/Enquiry/AccountBalance/1.0.0/Account';
        $token         = parent::token();
        $accountNumber = is_null($accountNumber) ? parent::$config->accountNumber : $accountNumber;

        $payload = array(
            "MessageReference" => $messageReference,
            "AccountNumber"    => $accountNumber,
        );

        $headers  = array('Content-Type: application/json', "Authorization: Bearer {$token}");
        $response = parent::curlPostRequest($url, $headers, $payload);

        return is_null($callback)
        ? $response
        : \call_user_func_array(array($callback), array($response));
    }
}
