 <?php
	
	require_once("../connection.php");

	if(!empty($_POST['StaffName']) AND !empty($_POST['StaffUsername']))
	{
	
		//$StaffID 	     	= $_POST['StaffID'];
		$StaffUsername		= $_POST['StaffUsername'];
		$StaffPassword 		= hash ('md5', $_POST['StaffPassword']);
		$StaffName			= $_POST['StaffName'];
		//$StaffPosition 	    = $_POST['StaffPosition'];
		//$StaffPTJ			= $_POST['StaffPTJ'];
		$StaffOfficeNo 	    = $_POST['StaffOfficeNo'];
		$StaffPhoneNo		= $_POST['StaffPhoneNo'];
		$StaffEmail		= $_POST['StaffEmail'];

		
		$SQL		= "call insertclient ('$StaffUsername','$StaffPassword','$StaffName','$StaffOfficeNo','$StaffPhoneNo','$StaffEmail')";

		$run		= $DBConn->query($SQL);

		if($run)
		{
		    echo "<script> alert ('Successfully registered Staff: ".$StaffUsername."');</script>";
			echo'<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=../index.php">';
			mysqli_commit($DBConn);
		}
		
		else
			die('Data unsuccessfully registered');
			mysqli_rollback($DBConn);
 	}
	

mysqli_close($DBConn);
   ?>
 
