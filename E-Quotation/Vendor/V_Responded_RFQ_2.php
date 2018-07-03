<?php
	require_once("../connection.php");
	session_start();
	if(!isset($_SESSION["VendorID"]) && empty($_SESSION["VendorID"]))
	{
		header("location:../index.php");
		exit;
	}
	else
		$VendorID = $_SESSION["VendorID"];
	
$VendorQuotation = $_GET["VendorQuotation"];	
$stmt = mysqli_query($DBConn, "DELETE FROM VENDOR_QUOTATION_DETAIL WHERE VendorQuotationNo = '$VendorQuotation'");
if($stmt) 
{
	$stmt1 = mysqli_query($DBConn, "DELETE FROM VENDOR_QUOTATION WHERE VendorQuotationNo = '$VendorQuotation'");
	if($stmt1)
	{
		mysqli_commit($DBConn);
		echo '<script type="text/javascript">';
		echo 'alert("Save Done!")';
		echo '</script>';
		echo "<meta http-equiv=\"refresh\" content=\"0; URL=V_Responded_RFQ.php\">";
	}
	else
	{
		mysqli_rollback($DBConn);
		echo '<script type="text/javascript">';
		echo 'alert("Error!")';
		echo '</script>';
		echo "<meta http-equiv=\"refresh\" content=\"0; URL=V_Responded_RFQ.php\">";
	}
}
else
{
	mysqli_rollback($DBConn);
	echo '<script type="text/javascript">';
	echo 'alert("Error!")';
	echo '</script>';
	echo "<meta http-equiv=\"refresh\" content=\"0; URL=V_Responded_RFQ.php\">";
}

mysqli_free_result($stmt);
mysqli_free_result($stmt1);

mysqli_close($DBConn);
?>