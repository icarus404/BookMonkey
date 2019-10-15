<?php
namespace bhrsujit;

use bhrsujit\Database;

class ShoppingCart extends Database{
  private $response = array();
  private $errors = array();

  public function __construct(){
    parent::__construct();
  }
  private function getUserAuthStatus(){
    if( session_status() == PHP_SESSION_NONE ){
      session_start();
    }
    return ( isset($_SESSION['auth'] ) ) ? $_SESSION['auth'] : false ;
  }

  private function getUserCartId( $account_id, $createnew = false ){
    //get the user's cart id or return a new one
    $find_query = "SELECT cart_id FROM shopping_cart WHERE account_id = UNHEX( ? )";
    try{
      $statement = $this -> connection -> prepare( $find_query );
      if(!$statement){
        throw new Exception('query error');
      }
      if(!$statement -> bind_param('s', $account_id ) ){
        throw new Exception('cannot bind parameter');
      }
      if(!$statement -> execute() ){
        throw new Exception('cannot bind parameter');
      }
      $result = $statement -> get_result();
    }
    catch( Exception $exc ){
      $this -> errors['database'] = $exc -> getMessage();
      $this -> response['success'] = false;
      $this -> response['errors'] = $this -> errors;
      return false;
    }
    // check result
    if( $result -> num_rows == 0 && $createnew == true ){
      //user does not have a shopping cart so we create it
      $cart_id = $this -> createshopping_cart( $account_id );
    }
    else{
      $row = $result -> fetch_assoc();
      $wishlist_id = $row['cart_id'];
    }
    return $cart_id;
}

  // add an item to the cart
  public function setItem( $product_id, $quantity ){

  }
}
?>