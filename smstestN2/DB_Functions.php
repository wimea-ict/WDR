<?php
 
/**
 * @author Ravi Tamada
 * @link https://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */
 
class DB_Functions {
 
    private $conn;
 
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
 
    // destructor
    function __destruct() {
         
    }

   
   

    public function insertData($fields,$values){
        $stmt = $this->conn->prepare("INSERT INTO observationslip($fields) VALUES($values)");
        $result = $stmt->execute();
        $stmt->close();
        if($result){
            return true;
        }
        else{
            return false;
        }


    }

    

    
	

    
 
}
 
?>