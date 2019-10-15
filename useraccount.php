<?php

require('vendor/autoload.php');




//get account details

use bhrsujit\AccountDetails;

$accountdtl = new AccountDetails();
$user_account = $accountdtl -> getDetails();




//generate navigation
use bhrsujit\Navigation;

$nav = new Navigation();
$navigation = $nav -> getNavigation();



$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
  //'cache' => 'cache'
  ));
$template = $twig -> load('useraccount.twig');

echo $template -> render( array(
    'accountdtl' => $user_account,
    
    'navigation' => $navigation,
    'title' => 'Account details!'
      )
    );
?>