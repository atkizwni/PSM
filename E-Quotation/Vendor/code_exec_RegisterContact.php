<?php
		session_start();
		require_once("../connection.php");
?>
	
<?php	
	if(!isset($_SESSION["VendorID"]) && empty($_SESSION["VendorID"] ))
	{
		header("location:../index.html");
		exit;
	}
	
	else
	
    //$ContactPersonNo=$_POST['ContactPersonNo'];
    $ContactName=$_POST['ContactName'];
	$ContactEmail=$_POST['ContactEmail'];
	$ContactOfficeNo=$_POST['ContactOfficeNo'];
	$ContactPhoneNo=$_POST['ContactPhoneNo'];
	$VendorID = $_SESSION["VendorID"];
	
	if(empty($ContactName)||empty($ContactEmail)||empty($ContactOfficeNo)|| empty($ContactPhoneNo))
	{
		echo "<script>alert('Unsuccessful. Sorry, please fill form there are given')</script>";
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0.01; URL=V_Register_Contact.html">';
	}
	else
	{
		$stid = mysqli_query($DBConn, "CALL insertcontactperson('$ContactName' , '$ContactEmail' , '$ContactOfficeNo' , '$ContactPhoneNo' , '$VendorID')");
		//$stid = mysqli_query($DBConn, "INSERT INTO contact_person (ContactName, ContactEmail, ContactOfficeNo, ContactPhoneNo, VendorID)
		//VALUES ('$ContactName' , '$ContactEmail' , '$ContactOfficeNo' , '$ContactPhoneNo' , '$VendorID')");
		
		if ($stid) 
		{
			echo "<script>alert('Register successful')</script>";
			mysqli_commit($DBConn);
			echo'<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=V_List_Contact.php">';
		}
		else
		{
			echo "<script> alert('Unsuccessful. Please try again')</script>";
			echo '<META HTTP-EQUIV="Refresh" CONTENT="12.01; URL=V_Register_Contact.php">';
		}
	}
		mysqli_close($DBConn);
?>