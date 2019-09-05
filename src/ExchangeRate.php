<?php
namespace Osen\Coop;

use Osen\Coop\Bank;

class ExchangeRate extends Bank
{
    public static function send($messageReference, $fromCurrencyCode = 'KES', $toCurrencyCode = 'USD', $callback = null)
    {
        $url   = parent::$host . '/Enquiry/ExchangeRate/1.0.0';
        $token = parent::token();

        $payload = array(
            "MessageReference" => $messageReference,
            "FromCurrencyCode" => $fromCurrencyCode,
            "ToCurrencyCode"   => $toCurrencyCode,
        );

        $headers  = array('Content-Type: application/json', "Authorization: Bearer {$token}");
        $response = parent::curlPostRequest($url, $headers, $payload);

        return is_null($callback)
        ? $response
        : \call_user_func_array(array($callback), array($response));
    }
}
