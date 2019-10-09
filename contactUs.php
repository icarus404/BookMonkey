<?php

include('vendor/autoload.php');
//start session
use bhrsujit\Database;

if( $_SERVER['REQUEST_METHOD']=='POST' ){
  
    $name = $_POST['name'];
   $email = $_POST['email'];
    
    $message = $_POST['message'];
    //calling public database connection function
    $db = new Database();
    
    $dbconnection = $db -> getconnection();
   
    $query = "INSERT INTO messages(m_name,m_email,m_message) VALUES (?,?,?)";
    $statement = $dbconnection -> prepare ($query);
    $statement -> bind_param("sss",$name,$email,$message);
    if($statement -> execute() ) {
        $response = "thank you";
    }
    else{
        $response = "something went wrong";
    }
    
}
else{
    $response = "";
}






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
    'response' => $response,
    'navigation' => $navigation,
    'title' => 'Contact Us!'
) );






?>