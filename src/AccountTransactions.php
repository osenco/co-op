<?php
namespace Osen\Coop;

use Osen\Coop\Bank;

class AccountTransactions extends Bank
{
    public static function send($messageReference, $accountNumber, $NoOfTransactions = '1', $callback = null)
    {
        $token = parent::token();
        $url   = parent::$host . '/Enquiry/AccountTransactions/1.0.0/Account';

        $payload = array(
            "MessageReference" => $messageReference,
            "AccountNumber"    => $accountNumber,
            "NoOfTransactions" => $NoOfTransactions,
        );

        $headers  = array(
            'Content-Type: application/json', 
            "Authorization: Bearer {$token}"
        );

        $response = parent::curlPostRequest($url, $payload, $headers);

        return is_null($callback)
        ? $response
        : \call_user_func_array(array($callback), array($response));
    }
}
