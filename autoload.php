<?php
/**
 * Register autoloader for classes under the Osen namespace
 * @param class $class Full namespaced class e.g Osen\Coop\TransactionStatus
 */
spl_autoload_register(function ($class)
{
    if (strpos($class, 'Osen\Coop')) {
        $class  = str_replace('Osen\Coop', '', $class);
        $path   = str_replace('\\', '/', $class);
        require_once __DIR__."/src/{$path}.php";
    }
});
/**
 * Load helper functions for more concise code
 */
require_once('src/helpers.php');
