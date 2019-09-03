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
    function coopAccountBalance($messageReference, $accountNumber = null, $callback = null)
    {
        return Osen\Coop\AccountBalance::send($messageReference, $accountNumber, $callback);
    }
}

if (!function_exists('coopAccountTransactions')) {
    function coopAccountTransactions($messageReference, $accountNumber, $NoOfTransactions = '1', $callback = null)
    {
        return Osen\Coop\AccountTransactions::send($messageReference, $accountNumber, $NoOfTransactions, $callback);
    }
}

if (!function_exists('coopExchangeRate')) {
    function coopExchangeRate($messageReference, $fromCurrencyCode = 'KES', $toCurrencyCode = 'USD', $callback = null)
    {
        return Osen\Coop\ExchangeRate::send($messageReference, $fromCurrencyCode, $toCurrencyCode, $callback);
    }
}

if (!function_exists('coopIFTAccountToAccount')) {
    function coopIFTAccountToAccount($messageReference, $accountNumber, $amount, $transactionCurrency = 'KES', $narration = 'Payment', $destinations = array(), $callback = null)
    {
        return Osen\Coop\IFTAccountToAccount::send($messageReference, $accountNumber, $amount, $transactionCurrency, $narration, $destinations, $callback);
    }
}

if (!function_exists('coopPesaLinkSendToAccount')) {
    function coopPesaLinkSendToAccount($messageReference, $accountNumber, $amount, $transactionCurrency = 'KES', $narration = 'Payment', $destinations = array(), $callback = null)
    {
        return Osen\Coop\PesaLinkSendToAccount::send($messageReference, $accountNumber, $amount, $transactionCurrency, $narration, $destinations, $callback);
    }
}

if (!function_exists('coopTransactionStatus')) {
    function coopTransactionStatus($messageReference, $callback = null)
    {
        return Osen\Coop\TransactionStatus::send($messageReference, $callback);
    }
}

if (!function_exists('coopReconcile')) {
    function coopReconcile($callback = null)
    {
        return Osen\Coop\Bank::reconcile($callback);
    }
}
