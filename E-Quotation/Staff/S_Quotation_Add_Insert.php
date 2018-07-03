<?php
		session_start();
		require_once("../connection.php");
?>
	
<?php	
	if(!isset($_SESSION["StaffID"]) && empty($_SESSION["StaffID"] ))
	{
		header("location:../index.html");
		exit;
	}
 else
	$StaffID = $_SESSION["StaffID"];
	$RFQStartDate=$_POST['RFQStartDate'];
	$RFQEndDate=$_POST['RFQEndDate'];
	$RFQStatus="Pending";
	$CodeVoteID=$_POST['CodeVoteID'];
   		
	if(empty($RFQStartDate)||empty($RFQEndDate)||empty($RFQStatus)||empty($StaffID))
	{
		echo "<script>alert('Unsuccessful. Sorry, please fill form there are given')</script>";
		echo '<META HTTP-EQUIV="Refresh" CONTENT="70.01; URL=S_Quotation_Add.php">';
	}
	else
	{
		$run = mysqli_query($DBConn,"call insertquotation ('$RFQStartDate' , '$RFQEndDate' , '$RFQStatus' , '$StaffID')");
		//$run = mysqli_query($DBConn,"INSERT INTO rfq (RFQStartDate, RFQEndDate, RFQStatus, StaffID) VALUES ('$RFQStartDate' , '$RFQEndDate' , '$RFQStatus' , '$StaffID')");
		
		if ($run)
		{
			 echo "<script>alert('Register successful')</script>";
			 $stmt1 = "SELECT RFQ_No FROM rfq WHERE RFQStartDate='".$RFQStartDate."' AND RFQEndDate='".$RFQEndDate."' AND RFQStatus='".$RFQStatus."' AND StaffID='".$StaffID."' ";
	         $run1	= $DBConn->query($stmt1);
			 $data1 = mysqli_fetch_array($run1);
			 echo "<META HTTP-EQUIV='Refresh' CONTENT='0.001; URL=S_Quotation_Add1.php?RFQ_No=".$data1["RFQ_No"]."&CodeVoteID=".$CodeVoteID."'>";
		}
		else
		{
			echo "<script> alert('Unsuccessful. Please try again')</script>";
			//echo '<META HTTP-EQUIV="Refresh" CONTENT="0.01; URL=S_Quotation_Add.php">';
		}
	}
	
	mysqli_close($DBConn);
	
?>
