# Co-operative Bank Kenya PHP SDK
Intuitive PHP SDK Co-operative Bank Kenya API

## Installation
```cmd
composer require osenco/co-op
```
## Setup
Use the `setup_coop` helper function to configure and instantiate our object

```php
    $config = array(
        "Env"                 => "sandbox",
        "CK"                  => "",
        "SK"                  => "",
        "AccountNumber"       => "54321987654321",
        "BankCode"            => "011",
        "BranchCode"          => "00011001",
        "CallbackURL"         => "/coop/callback",
        "TransactionCurrency" => "KES",
    );
    setup_coop($config);
```
## Usage
We recommend using the following helper functions

### Check Account Balance
```php
    CoopAccountBalance($MessageReference, $AccountNumber = null, $callback = null);
```

### Check AccountTransactions
```php
    CoopAccountTransactions($MessageReference, $AccountNumber, $NoOfTransactions = '1', $callback = null);
```

### Get Exchange Rate
```php
    CoopExchangeRate($MessageReference, $FromCurrencyCode = 'KES', $ToCurrencyCode = 'USD', $callback = null);
```

### IFT Account To Account Transfer
```php
    CoopIFTAccountToAccount($MessageReference, $AccountNumber, $Amount, $TransactionCurrency = 'KES', $Narration = 'Payment', $Destinations = array(), $callback = null);
```

### PesaLinkSendToAccount
```php
    CoopPesaLinkSendToAccount($MessageReference, $AccountNumber, $Amount, $TransactionCurrency = 'KES', $Narration = 'Payment', $Destinations = array(), $callback = null);
```

### Check TransactionStatus
```php
    CoopTransactionStatus($MessageReference, $callback = null);
```

## Callback functions
The last argument in the functions above (`$callback`) allows you to add a callable function to process the API responses. You can either pass a defined function or a closure

### Using A Defined Function
```php
    function process_coop_transaction_status($response) {
        // Do something with $response
    }
    CoopTransactionStatus($MessageReference, 'process_coop_transaction_status');
```

### Using A Closure
```php
    CoopTransactionStatus($MessageReference, function ($response) {
        // Do something with $response
    });
```
