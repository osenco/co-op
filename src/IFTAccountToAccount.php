<?php
namespace Osen\Coop;

use Osen\Coop\Bank;

class IFTAccountToAccount extends Bank
{
    public static function send($MessageReference, $AccountNumber, $Amount, $TransactionCurrency = 'KES', $Narration = 'Payment', $Destinations = array(), $callback = null)
    {
        $url   = parent::$host . '/FundsTransfer/Internal/2.0.0/SendToAccountt';
        $token = parent::token();

        $ADestinations = array();
        foreach ($Destinations as $Destination) {
            if (!isset($Destination["ReferenceNumbenceNumber"])) { $Destination["ReferenceNumbenceNumber"] = $MessageReference;}
            if (!isset($Destination["AccountNumber"])) { $Destination["AccountNumber"] = self::$config->AccountNumber;}
            if (!isset($Destination["BankCode"])) { $Destination["BankCode"] = self::$config->BankCode;}
            if (!isset($Destination["BranchCode"])) { $Destination["BranchCode"] = self::$config->BranchCode;}
            if (!isset($Destination["Amount"])) { $Destination["Amount"] = $Amount;}
            if (!isset($Destination["TransactionCurrency"])) { $Destination["TransactionCurrency"] = self::$config->TransactionCurrency;}
            if (!isset($Destination["Narration"])) { $Destination["Narration"] = $Narration;}

            $ADestinations[] = $Destination;
        }

        $requestPayload = array(
            "MessageReference" => $MessageReference,
            "CallBackUrl"      => parent::$config->callback_url,
            "Source"           => array(
                "AccountNumber"       => self::$config->AccountNumber,
                "Amount"              => $Amount,
                "TransactionCurrency" => self::$config->TransactionCurrency,
                "Narration"           => $Narration,
            ),
            "Destinations"     => $ADestinations,
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
