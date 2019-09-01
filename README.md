# Co-operative Bank Kenya PHP SDK
Intuitive PHP SDK Co-operative Bank Kenya API

## Pre-requisites
### Create test application
Login into your account at https://developer.co-opbank.co.ke:9443/store/

On the left panel, you can see a list of menus. Click on Applications to access the list of available applications in which case you can choose to use the default ones or create your own.

### Subscribe to API(s)
* Once you are logged in, you will be presented to the following page:
* Select the application from the drop down list. Application is a way of grouping related APIs.
* You can equally create your own application using steps described earlier.
* Click “Subscribe”. A pop up message appears as shown:

### Generate Keys
* Click on “Applications” on the left panel.
* Choose the application for which you want to generate keys
* Choose the appropriate environment from the tabs(production or sandbox ). In this manual, we have chosen Sandbox.
* Specify Callback URL and then click “Generate keys”. Leave other fields have default values;

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
Account Balance Enquiry API will enable you to enquire about your own Co-operative Bank accounts' balance as at now for the specified account number 

```php
    $response = coopAccountBalance(
        $MessageReference, 
        $AccountNumber = null, 
        $callback = null
    );

```

### Check AccountTransactions
Account Transactions Enquiry API will enable you to enquire about your own Co-operative Bank accounts' latest transactions for the specified account number and number of transactions to be returned 

```php
    $response = coopAccountTransactions(
        $MessageReference, 
        $AccountNumber, 
        $NoOfTransactions = '1', 
        $callback = null
    );
```

### Get Exchange Rate
Exchange Rate Enquiry API will enable you to enquire about the current SPOT exchange rate for the specified currencies

```php
    $response = coopExchangeRate(
        $MessageReference, 
        $FromCurrencyCode = 'KES', 
        $ToCurrencyCode = 'USD', 
        $callback = null
    );
```

### IFT Account To Account Transfer
Internal Funds Transfer Account to Account API will enable you to transfer funds from your own Co-operative Bank account to other Co-operative Bank account(s) 

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
PesaLink Send to Account Funds Transfer API will enable you to transfer funds from your own Co-operative Bank account to Bank account(s) in IPSL participating banks

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
This is a Transaction Status Enquiry Request interface called by an API consumer to APIM to enquire the status of an earlier requested transaction.

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
## Test Cases

As a developer, the test cases will be available to you for download as you are creating the sandbox app.

The test cases are in place to ensure that you have well understood the API structure for requests and responses for our different APIs. These test cases are in an excel spreadsheet that you should fill in with the results from each of the test scenarios that you want to consume.

As the Test cases will cover all the APIs available, you will only be required to carry out the test cases for the APIs you had initially selected.

## Go - Live

Once you have already tried out the APIs on our platform and have tested these against our test cases provided, you can make a formal request to go to production.

You will need to have the test cases duly filled, then send an email request, together with these filled in test cases, to our support team who will guide you on the next steps to enable you to get to production.

Send the email request and the test cases to digitalbanking@co-opbank.co.ke
