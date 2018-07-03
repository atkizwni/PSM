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
	
	$RFQStartDate = $_POST['RFQStartDate'];
	$RFQEndDate = $_POST['RFQEndDate'];
	$CodeVoteID = $_POST['CodeVoteID'];
	$ItemQuantity = $_POST['ItemQuantity'];
	$ItemDesc = $_POST['ItemDesc'];
	$RFQ_No = $_POST['RFQ_No'];
	$ItemNo = $_POST['ItemNo'];

	if(!empty($RFQStartDate)||!empty($RFQEndDate)||!empty($CodeVoteID)||!empty($ItemQuantity)||!empty($ItemDesc))
	{
		//$sql1 = mysqli_query($DBConn, "call updatequotation_rfq ('$RFQ_No', '$RFQStartDate', '$RFQEndDate')");
		$sql1 = mysqli_query($DBConn, "UPDATE rfq SET RFQStartDate='$RFQStartDate', RFQEndDate='$RFQEndDate' WHERE RFQ_No='$RFQ_No' ");
		
		if ($sql1) 
		{
			$sql2 = mysqli_query($DBConn, "UPDATE request_item SET CodeVoteID='$CodeVoteID', ItemQuantity='$ItemQuantity', ItemDesc='$ItemDesc' 
											WHERE RFQ_No='$RFQ_No' AND ItemNo='$ItemNo'");
			
			if ($sql2)
		  	{
				echo "<script>alert('Register successful')</script>";
				mysqli_commit($DBConn);
				echo'<META HTTP-EQUIV="Refresh" CONTENT="0.0 URL=S_Quotation_Edit.php?RFQ_No='.$RFQ_No.'">';
			}
			else
			{
				//echo TIKA;
				echo "<script> alert('Unsuccessful. Please try again LATER')</script>";
				echo '<META HTTP-EQUIV="Refresh" CONTENT="0.01; URL=S_Quotation_Edit2.php?RFQ_No='.$RFQ_No.'&ItemNo='.$ItemNo.'">';
				//mysqli_free_result($sql2);
				mysqli_rollback($DBConn);
			}
			
		}
		else
		{
			echo "<script> alert('Unsuccessful. Please try again')</script>";
			echo '<META HTTP-EQUIV="Refresh" CONTENT="0.01; URL=S_Quotation_Edit2.php?RFQ_No='.$RFQ_No.'&ItemNo='.$ItemNo.'">';
			//mysqli_free_result($sql1);
		}
		
		
	}
	else
	{
		echo "<script>alert('Unsuccessful. Sorry, please fill form there are given')</script>";
		echo '<META HTTP-EQUIV="Refresh" CONTENT="70.01; URL=S_Quotation_Edit2.php?RFQ_No='.$RFQ_No.'&ItemNo='.$ItemNo.'">';
	}
?>
