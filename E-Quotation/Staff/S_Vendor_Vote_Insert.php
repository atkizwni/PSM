<?php
	require_once("../connection.php");
	
	$VendorID = $_POST["VendorID"];
	$CodeVoteID = $_POST["CodeVoteID"];
	
	$result ="CALL insertvendorvote ('$VendorID', '$CodeVoteID')";
    $run2	= $DBConn->query($result);
	
	if($run2)
	{
		echo "<script> alert('Update successful.')</script>";
		//mysqli_commit($DBConn);
		//header("Location:V_List_Contact.php");
		echo'<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=S_Vendor_Vote.php?VendorID='.$_POST['VendorID'].'">';
	}
	else
	{
		echo "<script> alert('Unsuccessful. Please try again')</script>";
		echo '<META HTTP-EQUIV="Refresh" CONTENT="12.01; URL=S_Vendor_Vote.php?VendorID='.$_POST['VendorID'].'">';	
	}
?>