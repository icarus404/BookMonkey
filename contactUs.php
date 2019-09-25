<?php

include('vendor/autoload.php');
//start session


use bhrsujit\Navigation;  //create navigation after account as navigation changes as user level

$nav = new Navigation();
$navigation = $nav -> getNavigation();




//create twig loader for templates
$loader = new Twig_Loader_Filesystem('templates');
//create twig environment and pass the loader
$twig = new Twig_Environment($loader);
//call a twig template
$template = $twig -> load('contactus.twig');
//output the template and pass the data

echo $template -> render( array(
    
    'navigation' => $navigation,
    'title' => 'Contact Us!'
) );

?>