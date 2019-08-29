# Co-operative Bank Kenya PHP SDK
Intuitive PHP SDK Co-operative Bank Kenya API

## Installation
Install via composer by typing in your terminal

```cmd
composer require osenco/co-op
```

If you dont use composer you can just download this library from the releases, unzip it in your project and include the autoload.php file in your project.

```php
require_once('path/to/autoload.php');
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
### Usage
We recommend using the following helper functions
### Check Account Balance
```php
    $response = CoopAccountBalance($MessageReference, $AccountNumber = null, $callback = null);

```

### Check AccountTransactions
```php
    $response = CoopAccountTransactions($MessageReference, $AccountNumber, $NoOfTransactions = '1', $callback = null);
```

### Get Exchange Rate
```php
    $response = CoopExchangeRate($MessageReference, $FromCurrencyCode = 'KES', $ToCurrencyCode = 'USD', $callback = null);
```

### IFT Account To Account Transfer
```php
    $response = CoopIFTAccountToAccount($MessageReference, $AccountNumber, $Amount, $TransactionCurrency = 'KES', $Narration = 'Payment', $Destinations = array(), $callback = null);
```

### PesaLinkSendToAccount
```php
    $response = CoopPesaLinkSendToAccount($MessageReference, $AccountNumber, $Amount, $TransactionCurrency = 'KES', $Narration = 'Payment', $Destinations = array(), $callback = null);
```

### Check TransactionStatus
```php
    $response = CoopTransactionStatus($MessageReference, $callback = null);
```

## Callback functions
The last OPTIONAL argument in the functions above (`$callback`) allows you to add a callable function to process the API responses. You can either pass a defined function or a closure

### Using A Defined Function
```php
    function process_coop_transaction_status($response) {
        // Do something with $response
    }
    $response = CoopTransactionStatus($MessageReference, 'process_coop_transaction_status');
```

### Using A Closure
```php
    $response = CoopTransactionStatus($MessageReference, function ($response) {
        // Do something with $response
    });
```
