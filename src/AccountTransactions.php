<?php
namespace Osen\Coop;

use Osen\Coop\Bank;

class AccountTransactions extends Bank
{
    public static function send($messageReference, $accountNumber, $NoOfTransactions = '1', $callback = null)
    {
        $url   = parent::$host . '/Enquiry/AccountTransactions/1.0.0/Account';
        $token = parent::token();

        $payload = array(
            "MessageReference" => $messageReference,
            "AccountNumber"    => $accountNumber,
            "NoOfTransactions" => $NoOfTransactions,
        );

        $headers  = array('Content-Type: application/json', "Authorization: Bearer {$token}");
        $response = parent::curlPostRequest($url, $headers, $payload);

        return is_null($callback)
        ? $response
        : \call_user_func_array(array($callback), array($response));
    }
}
