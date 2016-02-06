<?php
define("DB_HOST", "localhost");
define("DB_USER", "webclient");
define("DB_PASS", "12345678");
define("DB_NAME", "bookstore");
/*Google Cloud Messaging API Key */
//define("GOOGLE_API_KEY", "AIzaSyB2sWxlhLVRC-UGZIvSlMJfBb_HsxxznVE"); // Place your Google API Key
error_reporting(E_ALL ^ E_DEPRECATED);
//Create Connection Class
class connection
{
    private $host      = DB_HOST; //host Name 
    private $user      = DB_USER; // db user
    private $pass      = DB_PASS; // ds password
    private $dbname    = DB_NAME; // database name
    var $myconn;
	
	//constructor to eastablishment connection with database
	public function __construct()
	{
		$conn= mysql_connect($this->host,$this->user,$this->pass);
        if(!$conn)
        {
			die ("Cannot connect to the database");
        }
        else
        {
			$this->myconn = $conn;
			//$this->myconn -> selectdatbase();
			mysql_select_db($this->dbname);
        }
		return $this->myconn; 
    } 
}


