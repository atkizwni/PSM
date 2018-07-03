 <?php
 
	require_once("../connection.php");

	if(!empty($_POST['VendorName']) AND !empty($_POST['VendorUsername']))
	{
		//$VendorID 	     	= $_POST['VendorID'];
		$VendorUsername 	= $_POST['VendorUsername'];
		$VendorPassword		= hash ('md5', $_POST['VendorPassword']);
		$VendorName			= $_POST['VendorName'];
		$VendorAddress   	= $_POST['VendorAddress'];	
		
		if(isset($_FILES['VendorLogo']) && count($_FILES['VendorLogo']['error']) == 1 && $_FILES['VendorLogo']['error'][0] > 0)
		{
			$VendorLogo = NULL;
			echo "asd";
		} 
		else if(isset($_FILES['VendorLogo']))
		{ //this is just to check if isset($_FILE). Not required.
			//*** Read file BINARY ***'
			$fp = fopen($_FILES["VendorLogo"]["tmp_name"],"r");
			$ReadBinary = fread($fp,filesize($_FILES["VendorLogo"]["tmp_name"]));
			fclose($fp);
			$VendorLogo = addslashes($ReadBinary);
			//echo "asddd";
		}
	
		if(isset($_FILES['VendorSignature']) && count($_FILES['VendorSignature']['error']) == 1 && $_FILES['VendorSignature']['error'][0] > 0)
		{
			$VendorSignature = NULL;
			echo "asd";
		} 
		else if(isset($_FILES['VendorSignature']))
		{ //this is just to check if isset($_FILE). Not required.
			//*** Read file BINARY ***'
			$fp = fopen($_FILES["VendorSignature"]["tmp_name"],"r");
			$ReadBinary = fread($fp,filesize($_FILES["VendorSignature"]["tmp_name"]));
			fclose($fp);
			$VendorSignature = addslashes($ReadBinary);
			//echo "asddd";
		}
	
		if(isset($_FILES['VendorStamp']) && count($_FILES['VendorStamp']['error']) == 1 && $_FILES['VendorStamp']['error'][0] > 0)
		{
			$VendorStamp = NULL;
			echo "asd";
		} 
		else if(isset($_FILES['VendorStamp']))
		{ //this is just to check if isset($_FILE). Not required.
			//*** Read file BINARY ***'
			$fp = fopen($_FILES["VendorStamp"]["tmp_name"],"r");
			$ReadBinary = fread($fp,filesize($_FILES["VendorStamp"]["tmp_name"]));
			fclose($fp);
			$VendorStamp = addslashes($ReadBinary);
			//echo "asddd";
		}
	
		$SQL		= "INSERT INTO vendor
				(VendorUsername, VendorPassword, VendorName, VendorAddress,VendorLogo,VendorSignature,VendorStamp) 
		VALUES ('$VendorUsername','$VendorPassword','$VendorName','$VendorAddress','$VendorLogo','$VendorSignature','$VendorStamp')";
		//$SQL		= "CALL insertvendor ('$VendorUsername','$VendorPassword','$VendorName','$VendorAddress','$VendorLogo','$VendorSignature','$VendorStamp')";
		
		$run		= $DBConn->query($SQL);
	

		if($run)
		{
			echo "asd";
		    echo "<script> alert ('Successfully registered vendor: ".$VendorUsername."');</script>";
			echo'<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=../index.php">';
			mysqli_commit($DBConn);
		}
		
		else
			die('Data unsuccessfully registered');
			mysqli_rollback($DBConn);
 	}
	
	mysqli_close($DBConn);
   ?>
 
