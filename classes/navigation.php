<?php
namespace bhrsujit;

class navigation {

    public $navigation = array();

    public function __construct() {
      
        $this -> MainNavigation();

    }

 Public function MainNavigation() {
    
   $this -> navigation = array([
        'Home' =>'index.php',
        'Shop' => 'shop.php',
        'Cart' => 'cart.php',
        'Login' => 'signin.php',
        'Register' => 'signup.php'
   ]);

   return $this -> navigation;
  }
}

?>

