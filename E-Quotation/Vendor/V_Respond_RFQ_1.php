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
	error_reporting(0);
	
$rfqno = $_POST["rfqno"];
$tarikh = date('Y-m-d');

//Vendor Quotation
$sql = "INSERT INTO vendor_quotation (VendorQuotationDate, VendorQuotationStatus, VendorID, RFQ_No) VALUES ";
$sql.= "('$tarikh', 'Pending', '$VendorID', '$rfqno')";
$stmt = mysqli_query($DBConn, $sql);
mysqli_free_result($stmt);
//$stmt = odbc_prepare($objConnect, '{CALL vendor_quotation_insert(?,?,?)}');
//$objExecute = mysqli_query($stmt, array($tarikh, $VendorID, $rfqno));
mysqli_free_result($stmt);

if($stmt)
{
	//Vendor Quotation No
	$stmt1 = mysqli_query($DBConn, "SELECT * FROM vendor_quotation WHERE VendorQuotationDate = '$tarikh' AND VendorQuotationStatus = 'Pending' AND VendorID = '$VendorID' AND RFQ_No = '$rfqno'");
	$row1 = mysqli_fetch_array($stmt1);
	mysqli_free_result($stmt1);
	$vqno = $row1["VendorQuotationNo"];

	$stmt2 = mysqli_query($DBConn, "SELECT COUNT(*) AS A FROM request_item WHERE RFQ_No = '$rfqno'");
	$row2 = mysqli_fetch_array($stmt2);
	mysqli_free_result($stmt2);
	$kira = $row2["A"];

	$kira1 = 0;
	$stmt3 = mysqli_query($DBConn, "SELECT * FROM request_item WHERE RFQ_No = '$rfqno' ORDER BY ItemNo");
	while ($row3 = mysqli_fetch_array($stmt3))
	{
		$item = $row3["ItemNo"];
		$price = $_POST["itemno".$row3["ItemNo"]];
		$tprice = $row3["ItemQuantity"] * $price;
		$stmt4 = mysqli_query($DBConn, "INSERT INTO vendor_quotation_detail (Price, TotalPrice, VendorQuotationNo, ItemNo) VALUES ('$price', '$tprice', '$vqno', '$item')");
		mysqli_free_result($stmt4);
		echo $_POST["itemno".$row3["ItemNo"]] . "<br>";
		//$stmt4 = odbc_prepare($objConnect, '{CALL vendor_quotation_detail_insert(?,?,?,?)}');
		//$objExecute4 = odbc_execute($stmt4, array($price, $tprice, $vqno, $item));
		//odbc_free_result($stmt4);
		$kira1 = $kira1 + 1;
	}
	mysqli_free_result($stmt3);

	if($kira1 == $kira)
	{
		odbc_commit($DBConn);
		echo '<script type="text/javascript">';
		echo 'alert("Save Done!")';
		echo '</script>';
		echo "<meta http-equiv=\"refresh\" content=\"0; URL=V_List_Of_RFQ.php\">";
	}
	else
	{
		odbc_rollback($DBConn);
		echo '<script type="text/javascript">';
		echo 'alert("Error huu!")';
		echo '</script>';
		echo "<meta http-equiv=\"refresh\" content=\"0; URL=V_Responded_RFQ.php?RFQ_NO=".$rfqno."\">";
	}
}
else
{
	odbc_rollback($DBConn);
	echo '<script type="text/javascript">';
	echo 'alert("Error!")';
	echo '</script>';
	echo "<meta http-equiv=\"refresh\" content=\"0; URL=V_Responded_RFQ.php?RFQ_NO=".$rfqno."\">";
}

mysqli_close($DBConn);
?>