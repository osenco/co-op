<?php
namespace Osen\Coop;

class Bank
{
    public static $config;
    public static $host;

    public static function init($configs = array())
    {
        $defaults = array(
            "env"                 => "sandbox",
            "consumerKey"         => "ss0sD2ANhjvhx_rHU0a6Xf8ROdYa",
            "consumerSecret"      => "zOfReXCIwn1TfnEYJJJGNP6l3Tka",
            "accountNumber"       => "54321987654321",
            "bankCode"            => "011",
            "branchCode"          => "00011001",
            "callbackURL"         => "/coop/callback",
            "transactionCurrency" => "KES",
        );

        $parsed       = array_merge($defaults, $configs);
        self::$config = (object) $parsed;

        self::$host = ($parsed['env'] == 'sandbox')
        ? 'https://developer.co-opbank.co.ke:8243'
        : 'https://developer.co-opbank.co.ke:8280';
    }

    public function curlRequest($url, $headers, $payload, $post = false)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => $url,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => $post,
            CURLOPT_POSTFIELDS     => json_encode($payload),
        ));

        $response = curl_exec($curl);

        return ($response === false)
        ? curl_error($curl)
        : json_decode($response, true);
    }

    public function curlPostRequest($url, $headers, $payload)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);

        return ($response === false)
        ? curl_error($curl)
        : json_decode($response, true);
    }

    public static function token()
    {
        $url           = self::$host . '/token';
        $authorization = base64_encode(self::$config->consumerKey . ':' . self::$config->consumerSecret);
        $headers       = array("Authorization: Basic {$authorization}");
        $payload       = "grant_type=client_credentials";

        $response = self::curlRequest($url, $headers, $payload, true);

        return json_decode($response)->access_token;
    }

    public static function reconcile($callback = null)
    {
        $input    = file_get_contents('php://input');
        $response = json_decode($input, true);
        $response = !is_array($response) ? array() : $response;

        return is_null($callback)
        ? $response
        : \call_user_func_array(array($callback), array($response));
    }
}
