<?php
	require_once("../connection.php");
	session_start();
	if(!isset($_SESSION["StaffID"]) && empty($_SESSION["StaffID"] ))
	{
		header("location:../index.html");
		exit;
	}
 else
	 $StaffID = $_SESSION["StaffID"];

	$ItemDesc=$_POST['ItemDesc'];
	$ItemQuantity=$_POST['ItemQuantity'];
	$RFQ_No=$_GET['RFQ_No'];
    $CodeVoteID=$_GET['CodeVoteID'];
   		
    if(empty($ItemDesc)||empty($ItemQuantity)||empty($RFQ_No)||empty($CodeVoteID))
	{
		echo "<script>alert('Unsuccessful. Sorry, please fill form there are given')</script>";
		echo '<META HTTP-EQUIV="Refresh" CONTENT="70.01; URL=S_Quotation_Add1.php">';
	}
	else
	{
		$stmt = mysqli_query($DBConn, "call insertitem ('$ItemDesc' , '$ItemQuantity' , '$RFQ_No' , '$CodeVoteID')");
        //$stmt = mysqli_query($DBConn, "INSERT INTO request_item(ItemDesc, ItemQuantity, RFQ_No, CodeVoteID) 
               //VALUES ('$ItemDesc' , '$ItemQuantity' , '$RFQ_No' , '$CodeVoteID')");

        if ($stmt) 
	    {
	      	echo "<script>alert('Register successful')</script>";
			echo "<META HTTP-EQUIV='Refresh' CONTENT='0.001; URL=S_Quotation_Add1.php?RFQ_No=".$RFQ_No."&CodeVoteID=".$CodeVoteID."'>";
		}
		else
		{
			echo "<script> alert('Unsuccessful. Please try again')</script>";
			echo "<META HTTP-EQUIV='Refresh' CONTENT='0.01; URL=S_Quotation_Add1.php?RFQ_No=".$RFQ_No."&CodeVoteID=".$CodeVoteID."'>";
		}
	}
	
	mysqli_close($DBConn);
	
?>
