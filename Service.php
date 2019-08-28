<?php
namespace Osen\Coop;

class Service
{
    public static $config;

    public static function init($configs = array())
    {
        $defaults = array(
            "CK"                  => "",
            "SK"                  => "",
            "AccountNumber"       => "54321987654321",
            "BankCode"            => "011",
            "BranchCode"          => "00011001",
            "CallbackURL"         => "/coop/callback",
            "TransactionCurrency" => "KES",
        );
        
        $parsed       = array_merge($defaults, $configs);
        self::$config = (object) $parsed;
    }

    public static function token()
    {
        $authorization = base64_encode(self::$config->CK . ':' . self::$config->SK);
        $header        = array("Authorization: Basic {$authorization}");
        $content       = "grant_type=client_credentials";
        $curl          = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => $url,
            CURLOPT_HTTPHEADER     => $header,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $content,
        ));

        $response = curl_exec($curl);
        if ($response === false) {
            return curl_error($curl);
        }

        return json_decode($response)->access_token;
    }
}
