<?php
namespace Osen\Coop;

use Osen\Coop\Bank;

class AccountTransactions extends Bank
{
    public static function send($messageReference, $accountNumber, $NoOfTransactions = '1', $callback = null)
    {
        $url   = parent::$host . '/Enquiry/AccountTransactions/1.0.0/Account';
        $token = parent::token();

        $requestPayload = array(
            "MessageReference" => $messageReference,
            "AccountNumber"    => $accountNumber,
            "NoOfTransactions" => $NoOfTransactions,
        );

        $headers = array('Content-Type: application/json', "Authorization: Bearer {$token}");

        $process = curl_init();
        curl_setopt($process, CURLOPT_URL, $url);
        curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($process, CURLOPT_POSTFIELDS, json_encode($requestPayload));
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, true);

        $return   = curl_exec($process);
        $response = json_decode($return, true);

        return is_null($callback)
        ? $response
        : \call_user_func_array(array($callback), array($response));
    }
}
