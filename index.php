<?php
require('vendor/autoload.php');

//create navigation
use bhrsujit\Navigation;

$nav = new Navigation();
$navigation = $nav -> getNavigation();


//create an instance of Product class
use bhrsujit\Product;

$p = new Product();
$products = $p -> getProducts();

//create categories
use bhrsujit\Category;

$cat = new Category();
$categories = $cat -> getCategories();

//create twig loader for templates
$loader = new Twig_Loader_Filesystem('templates');

//create twig environment
$twig = new Twig_Environment($loader);

//load a twig template
$template = $twig -> load('home.twig');

echo $template -> render( array(
    'categories' => $categories,
    'navigation' => $navigation,
    'products' => $products,
    'title' => 'Welcome to the shop'
) );
?>