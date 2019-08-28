<?php
namespace Osen\Coop;

class AccountTransactions extends Service
{
    public static function send($MessageReference, $AccountNumber, $NoOfTransactions = '1')
    {
        $url   = (parent::$env == 'live') ? 'https://developer.co-opbank.co.ke:8243/Enquiry/AccountTransactions/1.0.0/Account' : 'https://developer.co-opbank.co.ke:8243/Enquiry/AccountTransactions/1.0.0';
        $token = parent::token();

        $requestPayload = array(
            "MessageReference" => $MessageReference,
            "AccountNumber"    => $AccountNumber,
            "NoOfTransactions" => $NoOfTransactions,
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
		
        return json_decode($return, true);
    }
}
