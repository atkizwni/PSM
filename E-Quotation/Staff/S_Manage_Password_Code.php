<?php
		session_start();
		require_once("../connection.php");


$pass =  hash ( 'md5', $_POST['old']);
$pass1 = hash ( 'md5',$_POST['new']);
$pass2 = hash ( 'md5',$_POST['confirm']);

$result = mysqli_query($DBConn,"SELECT * from staff WHERE StaffID ='" . $_SESSION["StaffID"] . "'" ) or die (mysqli_error());
$row=mysqli_fetch_array($result);

if($pass == $row["StaffPassword"])
{
	
	mysqli_query($DBConn,"UPDATE staff set StaffPassword='$pass1' WHERE StaffID='" . $_SESSION["StaffID"] . "'") or die (mysqli_error());
	
echo "<script> alert('Password has been updated');</script>";
echo'<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=S_Home.php">';
			
	
}

 else
{
	    
    
    echo "<script> alert('Make sure your old password is correct');</script>";
	echo'<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=S_Manage_Password.php">';
}

?>


