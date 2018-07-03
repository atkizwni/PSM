<?php
$objConnect = mysql_connect("localhost","Atika","1234") or die("Error Connect to Database");
$objDB = mysql_select_db("e-quotation");

if(isset($_GET["VendorID"]) && !empty($_GET["VendorID"]))
{
	$strSQL = "SELECT * FROM vendor WHERE VendorID = '".$_GET['VendorID']."' ";
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	$objResult = mysql_fetch_array($objQuery);
	//echo $objResult["VendorLogo"];
	if($_GET['type'] == 1) {
		echo $objResult["VendorLogo"];
	}
	if($_GET['type'] == 2) {
		echo $objResult["VendorSignature"];
	}
	if($_GET['type'] == 3) {
		echo $objResult["VendorStamp"];
	}
}
?>