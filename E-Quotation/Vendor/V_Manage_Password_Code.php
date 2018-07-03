<?php
		session_start();
		require_once("../connection.php");


$pass =  hash ( 'md5', $_POST['old']);
$pass1 = hash ( 'md5',$_POST['new']);
$pass2 = hash ( 'md5',$_POST['confirm']);

$result = mysqli_query($DBConn,"SELECT * from vendor WHERE VendorID ='" . $_SESSION["VendorID"] . "'" ) or die (mysqli_error());
$row=mysqli_fetch_array($result);

if($pass == $row["VendorPassword"])
{
	
	mysqli_query($DBConn,"UPDATE vendor set VendorPassword='$pass1' WHERE VendorID='" . $_SESSION["VendorID"] . "'") or die (mysqli_error());
	
echo "<script> alert('Password has been updated');</script>";
echo'<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=V_Home.php">';
			
	
}

 else
{
	    
    
    echo "<script> alert('Make sure your old password is correct');</script>";
	echo'<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=V_Manage_Password.php">';
}

?>


