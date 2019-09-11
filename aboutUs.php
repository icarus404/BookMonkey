<?php

include('vendor/autoload.php');
//start session


use bhrsujit\Navigation;
$navigation =new Navigation();

$Navigation = $navigation -> MainNavigation();



$loader = new Twig_Loader_Filesystem('templates');
//create twig environment
$twig = new Twig_Environment($loader);
//load a twig template
$template = $twig -> load('aboutUs.twig');


//pass values to twig
echo $template -> render([ 
    
    'navigation' => $navigation
   
]);
