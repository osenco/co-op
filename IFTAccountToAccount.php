<?php
namespace Osen\Coop;

class IFTAccountToAccount extends Service
{
    public static function send($MessageReference, $AccountNumber, $Amount, $TransactionCurrency = 'KES', $Narration = 'Payment', $callback = null)
    {
        $url   = (parent::$env == 'live') ? 'https://developer.co-opbank.co.ke:8243/FundsTransfer/Internal/2.0.0/SendToAccountt' : 'https://developer.co-opbank.co.ke:8280/FundsTransfer/Internal/2.0.0/SendToAccountt';
        $token = parent::token();

        $requestPayload = array(
            "MessageReference" => $MessageReference,
            "CallBackUrl"      => parent::$config->callback_url,
            "Source"           => array(
                "AccountNumber"       => self::$config->AccountNumber,
                "Amount"              => $Amount,
                "TransactionCurrency" => self::$config->TransactionCurrency,
                "Narration"           => $Narration,
            ),
            "Destinations"     => array(
                array(
                    "ReferenceNumbenceNumber" => "40ca18c6765086089a1_1",
                    "AccountNumber"           => "54321987654321",
                    "BankCode"                => "011",
                    "BranchCode"              => "00011001",
                    "Amount"                  => 0,
                    "TransactionCurrency"     => $TransactionCurrency,
                    "Narration"               => $Narration,
                ),
            ),
        );

        $headers = array('Content-Type: application/json', "Authorization: Bearer {$token}");

        $process = curl_init();

        curl_setopt($process, CURLOPT_URL, $url);
        curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($process, CURLOPT_POSTFIELDS, $requestPayload);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, true);

        $return = curl_exec($process);

        $return = curl_exec($process);

        $response = json_decode($return, true);

        return is_null($callback)
        ? $response
        : \call_user_func_array(array($callback), array($response));

    }
}
