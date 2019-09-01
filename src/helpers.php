<?php

if (!function_exists('coopSetup')) {
    function coopSetup($config)
    {
        Osen\Coop\AccountBalance::init($config);
        Osen\Coop\AccountTransactions::init($config);
        Osen\Coop\ExchangeRate::init($config);
        Osen\Coop\IFTAccountToAccount::init($config);
        Osen\Coop\PesaLinkSendToAccount::init($config);
        Osen\Coop\TransactionStatus::init($config);
    }
}

if (!function_exists('coopAccountBalance')) {
    function coopAccountBalance($MessageReference, $AccountNumber = null, $callback = null)
    {
        return Osen\Coop\AccountBalance::send($MessageReference, $AccountNumber, $callback);
    }
}

if (!function_exists('coopAccountTransactions')) {
    function coopAccountTransactions($MessageReference, $AccountNumber, $NoOfTransactions = '1', $callback = null)
    {
        return Osen\Coop\AccountTransactions::send($MessageReference, $AccountNumber, $NoOfTransactions, $callback);
    }
}

if (!function_exists('coopExchangeRate')) {
    function coopExchangeRate($MessageReference, $FromCurrencyCode = 'KES', $ToCurrencyCode = 'USD', $callback = null)
    {
        return Osen\Coop\ExchangeRate::send($MessageReference, $FromCurrencyCode, $ToCurrencyCode, $callback);
    }
}

if (!function_exists('coopIFTAccountToAccount')) {
    function coopIFTAccountToAccount($MessageReference, $AccountNumber, $Amount, $TransactionCurrency = 'KES', $Narration = 'Payment', $Destinations = array(), $callback = null)
    {
        return Osen\Coop\IFTAccountToAccount::send($MessageReference, $AccountNumber, $Amount, $TransactionCurrency, $Narration, $Destinations, $callback);
    }
}

if (!function_exists('coopPesaLinkSendToAccount')) {
    function coopPesaLinkSendToAccount($MessageReference, $AccountNumber, $Amount, $TransactionCurrency = 'KES', $Narration = 'Payment', $Destinations = array(), $callback = null)
    {
        return Osen\Coop\PesaLinkSendToAccount::send($MessageReference, $AccountNumber, $Amount, $TransactionCurrency, $Narration, $Destinations, $callback);
    }
}

if (!function_exists('coopTransactionStatus')) {
    function coopTransactionStatus($MessageReference, $callback = null)
    {
        return Osen\Coop\TransactionStatus::send($MessageReference, $callback);
    }
}
