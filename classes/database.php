<?php
namespace bhrsujit;
class Database{
    private $user;
    private $password;
    private $host;
    private $db;
    protected $connection;
    public function __construct(){
        $this -> getConfig();
        $this -> connection = mysqli_connect(
            $this -> host,
            $this -> user,
            $this -> password,
            $this -> db
        );
    }
    private function getConfig(){
        $this -> user = getenv('dbuser');
        $this -> password = getenv('dbpass');
        $this -> host = getenv('dbhost');
        $this -> db = getenv('dbname');
    }
    //creating public function getconnection() to access DB outside of it's protected connection function(i.e protected $connection above)
    public function getconnection(){
        return $this -> connection;
    }
}



/*env vanera environment variables created so for that to work we 
creted a .htaccess file in the root project folder and set our environment variables there */

?>