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
Use the `coopSetup` helper function to configure and instantiate our object

```php
    $config = array(
        "Env"                 => "sandbox",
        "ConsumerKey"         => "ss0sD2ANhjvhx_rHU0a6Xf8ROdYa",
        "ConsumerSecret"      => "zOfReXCIwn1TfnEYJJJGNP6l3Tka",
        "AccountNumber"       => "54321987654321",
        "BankCode"            => "011",
        "BranchCode"          => "00011001",
        "CallbackURL"         => "/coop/callback",
        "TransactionCurrency" => "KES",
    );
    coopSetup($config);
```
### Usage
We recommend using the following helper functions
### Check Account Balance
```php
    $response = coopAccountBalance(
        $MessageReference, 
        $AccountNumber = null, 
        $callback = null
    );

```

### Check AccountTransactions
```php
    $response = coopAccountTransactions(
        $MessageReference, 
        $AccountNumber, 
        $NoOfTransactions = '1', 
        $callback = null
    );
```

### Get Exchange Rate
```php
    $response = coopExchangeRate(
        $MessageReference, 
        $FromCurrencyCode = 'KES', 
        $ToCurrencyCode = 'USD', 
        $callback = null
    );
```

### IFT Account To Account Transfer
```php
    $response = coopIFTAccountToAccount(
        $MessageReference, 
        $AccountNumber, 
        $Amount, 
        $TransactionCurrency = 'KES', 
        $Narration = 'Payment', 
        $Destinations = array(), 
        $callback = null
    );
```

### PesaLinkSendToAccount
```php
    $response = coopPesaLinkSendToAccount(
        $MessageReference, 
        $AccountNumber, 
        $Amount, 
        $TransactionCurrency = 'KES', 
        $Narration = 'Payment', 
        $Destinations = array(), 
        $callback = null
    );
```

### Check TransactionStatus
```php
    $response = coopTransactionStatus(
        $MessageReference, 
        $callback = null
    );
```

## Callback functions
The last OPTIONAL argument in the functions above (`$callback`) allows you to add a callable function to process the API responses. You can either pass a defined function or a closure

### Using A Defined Function
```php
    function processCoopTransactionStatus($response) {
        // Do something with $response
    }
    $response = coopTransactionStatus($MessageReference, 'processCoopTransactionStatus');
```

### Using A Closure
```php
    $response = coopTransactionStatus($MessageReference, function ($response) {
        // Do something with $response
    });
```
