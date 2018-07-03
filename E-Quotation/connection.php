<?php
	$servername  = "localhost";
	$username	= "Atika";
	$password	= "1234";
	$databasename	= "e-quotation";
 
try {
   
    $DBConn = mysqli_connect($servername, $username, $password, $databasename);
     //echo "Connected successfully"; 
    }
catch(exception $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    return $DBConn;

?>