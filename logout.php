<?php
require('vendor/autoload.php');

use bhrsujit\Account;
$account = new Account();
$account -> logout();

header('location: index.php');
?>