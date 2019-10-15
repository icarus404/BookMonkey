<?php
namespace bhrsujit;
use bhrsujit\Database;
//class to get and update user account
use bhrsujit\Account;
class AccountDetails extends Account{
  
    private $accountId;
    private $updatePassword = false;
  
  private function getUserAuthStatus(){
    if( session_status() == PHP_SESSION_NONE ){
      session_start();
    }
    return ( isset($_SESSION['auth']) ) ? $_SESSION['auth'] : false;
  } 

 

  //public function __construct($accountId){
   // parent::__construct();
    //$this -> accountId = $accountId;
  //}
  public function getDetails(){
    $query = "SELECT email FROM account WHERE account_id = ?";
    $statement = $this -> connection -> prepare($query);
    $statement -> bind_param('i', $this -> accountId );
    try{
      if( $statement -> execute() == false ){
        throw new Exception('query error');
        return null;
      }
      else{
        $result = $statement -> get_result();
        if( $result -> num_rows > 0 ){
          $account = $result -> fetch_assoc();
          return $account;
        }
        else{
          return null;
        }
      }
    }
    catch( Exception $exc ){
      error_log( $exc -> getMessage() );
    }
  }
  public function update(  $email, $password1=null, $password2=null ){
    //validate email
    //array to store errors
    $errors = array();
    //array to send as response
    $response = array();
    
  
    $validemail = Validator::email($email);
    if( $validemail['success'] == false ){
      $errors['email'] = $validemail['errors'];
    }
    //check if user is updating password (if both passwords have value / not null )
    if( isset($password1) || isset($password2) ){
      $validpassword = Validator::twoPasswords($password1,$password2);
      //if password does not pass validation
      if( $validpassword['success'] == false ){
        $errors = $validpassword['errors'];
      }
      else{
        //set flag to update password
        $this -> updatePassword = true;
      }
    }
    //check if there are errors in validation
    if( count($errors) > 0 ){
      $response['success'] = false;
      $response['errors'] = $errors;
    }
    else{
      //update user's details in the database
      $this -> updateDetails($username,$email);
    }
  }
  protected function updateDetails($email){
    $query = 'UPDATE account SET email';
  }
  protected function updatePassword($accountId){}
}
?>