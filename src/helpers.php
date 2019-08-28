<?php

if (!function_exists('setup_coop')) {
    function setup_coop($config)
    {
        Osen\Coop\AccountBalance::init($config);
        Osen\Coop\AccountTransactions::init($config);
        Osen\Coop\ExchangeRate::init($config);
        Osen\Coop\IFTAccountToAccount::init($config);
        Osen\Coop\PesaLinkSendToAccount::init($config);
        Osen\Coop\TransactionStatus::init($config);
    }
}

if (!function_exists('CoopAccountBalance')) {
    function CoopAccountBalance($MessageReference, $AccountNumber = null, $callback = null)
    {
        return Osen\Coop\AccountBalance::send($MessageReference, $AccountNumber, $callback);
    }
}

if (!function_exists('CoopAccountTransactions')) {
    function CoopAccountTransactions($MessageReference, $AccountNumber, $NoOfTransactions = '1', $callback = null)
    {
        return Osen\Coop\AccountTransactions::send($MessageReference, $AccountNumber, $NoOfTransactions, $callback);
    }
}

if (!function_exists('CoopExchangeRate')) {
    function CoopExchangeRate($MessageReference, $FromCurrencyCode = 'KES', $ToCurrencyCode = 'USD', $callback = null)
    {
        return Osen\Coop\ExchangeRate::send($MessageReference, $FromCurrencyCode, $ToCurrencyCode, $callback);
    }
}

if (!function_exists('CoopIFTAccountToAccount')) {
    function CoopIFTAccountToAccount($MessageReference, $AccountNumber, $Amount, $TransactionCurrency = 'KES', $Narration = 'Payment', $Destinations = array(), $callback = null)
    {
        return Osen\Coop\IFTAccountToAccount::send($MessageReference, $AccountNumber, $Amount, $TransactionCurrency, $Narration, $Destinations, $callback);
    }
}

if (!function_exists('CoopPesaLinkSendToAccount')) {
    function CoopPesaLinkSendToAccount($MessageReference, $AccountNumber, $Amount, $TransactionCurrency = 'KES', $Narration = 'Payment', $Destinations = array(), $callback = null)
    {
        return Osen\Coop\PesaLinkSendToAccount::send($MessageReference, $AccountNumber, $Amount, $TransactionCurrency, $Narration, $Destinations, $callback);
    }
}

if (!function_exists('CoopTransactionStatus')) {
    function CoopTransactionStatus($MessageReference, $callback = null)
    {
        return Osen\Coop\TransactionStatus::send($MessageReference, $callback);
    }
}
