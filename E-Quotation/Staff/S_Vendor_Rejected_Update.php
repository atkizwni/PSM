<?php
	require_once("../connection.php");
	session_start();
	if(!isset($_SESSION["StaffID"]) && empty($_SESSION["StaffID"]))
	{
		header("location:../index.php");
		exit;
	}
	else
		$StaffID = $_SESSION["StaffID"];
	
$VendorQuotation = $_GET["VendorQuotation"];	
$stmt = mysqli_query($DBConn, "UPDATE vendor_quotation SET VendorQuotationStatus = 'Rejected' WHERE VendorQuotationNo = '$VendorQuotation'");
if($stmt) 
{
		mysqli_commit($DBConn);
		echo '<script type="text/javascript">';
		echo 'alert("Save Done!")';
		echo '</script>';
		echo "<meta http-equiv=\"refresh\" content=\"0; URL=S_Vendor_Respond.php\">";
}
else
{
	mysqli_rollback($DBConn);
	echo '<script type="text/javascript">';
	echo 'alert("Error!")';
	echo '</script>';
	echo "<meta http-equiv=\"refresh\" content=\"0; URL=S_Vendor_Respond.php\">";
}

mysqli_free_result($stmt);
mysqli_close($DBConn);
?>