<?php
require('vendor/autoload.php');

//get user's wishlist total
use bhrsujit\WishList;

$wish = new WishList();
$wish_total = $wish -> getWishListTotal();

use bhrsujit\Search;

if( isset($_GET['query']) ){
  $search = new Search();
  $result = $search -> getSearchResult();
}
else{
  $result = '';
}

// create navigation
use bhrsujit\Navigation;

$nav = new Navigation();
$navigation = $nav -> getNavigation();

//create twig loader for templates
$loader = new Twig_Loader_Filesystem('templates');
//create twig environment and pass the loader
$twig = new Twig_Environment($loader);
//call a twig template
$template = $twig -> load('search.twig');

//output the template and pass the data
echo $template -> render( array(
  'result' => $result,
  'navigation' => $navigation,
  'title' => "Search Result for " . $result['query']
) );

?>