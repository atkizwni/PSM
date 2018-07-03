<?php
		session_start();
		require_once("../connection.php");
?>

<?php

	if(!empty($_POST['VendorID']) AND !empty($_POST['VendorName']))
	{
	
		$VendorID 	     	= $_POST['VendorID'];
		$VendorUsername 	= $_POST['VendorUsername'];
		$VendorPassword 	= hash ('md5', $_POST['VendorPassword']);
		$VendorName			= $_POST['VendorName'];
		$VendorAddress   	= $_POST['VendorAddress'];
		
		$sql= "Select * from vendor";
		$run =mysqli_query($DBConn,$sql)or die (mysqli_error());
		$row=mysqli_fetch_assoc($run);
		
		$VendorLogo= $row['VendorLogo'];
		$VendorSignature = $row['VendorSignature'];
		$VendorStamp = $row['VendorStamp'];
		
		if(isset($_FILES['VendorLogo']))
		{ //this is just to check if isset($_FILE). Not required.
			//*** Read file BINARY ***'
			$fp = fopen($_FILES["VendorLogo"]["tmp_name"],"r");
			$ReadBinary = fread($fp,filesize($_FILES["VendorLogo"]["tmp_name"]));
			fclose($fp);
			$VendorLogo = addslashes($ReadBinary);
			//echo "asddd";
		}
		
		if(isset($_FILES['VendorSignature']))
		{ //this is just to check if isset($_FILE). Not required.
			//*** Read file BINARY ***'
			$fp = fopen($_FILES["VendorSignature"]["tmp_name"],"r");
			$ReadBinary = fread($fp,filesize($_FILES["VendorSignature"]["tmp_name"]));
			fclose($fp);
			$VendorSignature = addslashes($ReadBinary);
			//echo "asddd";
		}
		
		if(isset($_FILES['VendorStamp']))
		{ //this is just to check if isset($_FILE). Not required.
			//*** Read file BINARY ***'
			$fp = fopen($_FILES["VendorStamp"]["tmp_name"],"r");
			$ReadBinary = fread($fp,filesize($_FILES["VendorStamp"]["tmp_name"]));
			fclose($fp);
			$VendorStamp = addslashes($ReadBinary);
			//echo "asddd";
		}
		
		//$SQL_update		= "CALL updatevendor ('$VendorID', '$VendorUsername', '$VendorPassword', '$VendorName', '$VendorAddress', '$VendorLogo', '$VendorSignature', '$VendorStamp')";
		$SQL_update		= "UPDATE vendor 
		SET VendorID = '".$VendorID."',VendorUsername = '".$VendorUsername."',VendorPassword = '".$VendorPassword."',VendorName = '".$VendorName."',VendorAddress = '".$VendorAddress."',VendorLogo = '".$VendorLogo."',VendorSignature = '".$VendorSignature."',VendorStamp = '".$VendorStamp."' WHERE VendorID='".$VendorID."'";

		$run		= $DBConn->query($SQL_update);

		if(!$run)
		{

		    echo "<script> alert ('Data failed to update!');</script>";
			echo'<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=V_Manage_Account.php">';
		}
		else
		{
			echo "<script> alert ('Successfully update data!');</script>";
			echo'<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=V_Manage_Account.php">';
		}
 	}
mysqli_close($DBConn);

?>

