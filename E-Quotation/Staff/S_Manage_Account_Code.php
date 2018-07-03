<?php
		session_start();
		require_once("../connection.php");
?>

<?php

	if(!empty($_POST['StaffID']) AND !empty($_POST['StaffName']))
	{
	
		$StaffID 	     	= $_POST['StaffID'];
		$StaffUsername 		= $_POST['StaffUsername'];
		$StaffPassword 		= hash ('md5', $_POST['StaffPassword']);
		$StaffName			= $_POST['StaffName'];
		//$StaffPosition   	= $_POST['StaffPosition'];
		//$StaffPTJ   		= $_POST['StaffPTJ'];
		$StaffOfficeNo		= $_POST['StaffOfficeNo'];
		$StaffPhoneNo	 	= $_POST['StaffPhoneNo'];
		$StaffEmail	 		= $_POST['StaffEmail'];
		
		$SQL_update			= "call updateclient ('$StaffID', '$StaffUsername', '$StaffPassword', '$StaffName', '$StaffOfficeNo', '$StaffPhoneNo', '$StaffEmail')";
		//$SQL_update		= "UPDATE staff 
							//SET StaffID = '".$StaffID."',StaffUsername = '".$StaffUsername."',StaffPassword = '".$StaffPassword."',StaffName = '".$StaffName."',StaffOfficeNo = '".$StaffOfficeNo."',StaffPhoneNo = '".$StaffPhoneNo."',StaffEmail = '".$StaffEmail."' WHERE StaffID='".$StaffID."'";

		$run		= $DBConn->query($SQL_update);

		if(!$run)
		{
		    die('Data failed to update');
		}
		
			echo "<script> alert ('Successfully update data!');</script>";
			echo'<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=S_Manage_Account.php">';
 	}
mysqli_close($DBConn);

?>

