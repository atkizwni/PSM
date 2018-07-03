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
	
	date_default_timezone_set("Asia/Kuala_Lumpur");
	
	$table = $_POST["table"];
	$tarikh = date('Ymd_H.i.s');
	$filName = "BACKUP/Backup/".$table."_".$tarikh.".csv";
	
	$file = fopen("$filName", "w");
	if ($table == 'vendor')
	{
		$export ="SELECT * FROM vendor ORDER BY VendorID";
		$run	= $DBConn->query($export);
		fwrite($file, "\"VendorID\",\"VendorUsername\",\"VendorPassword\",\"VendorName\",\"VendorAddress\"\n");
		while($Result = mysqli_fetch_array($run))
		{
			fwrite($file, "\"$Result[VendorID]\",\"$Result[VendorUsername]\",\"$Result[VendorPassword]\",\"$Result[VendorName]\",\"$Result[VendorAddress]\"\n");
		}
	}
	else if ($table == 'staff')
	{
		$export ="SELECT * FROM staff ORDER BY StaffID";
		$run		= $DBConn->query($export);
		fwrite($file, "\"StaffID\",\"StaffUsername\",\"StaffPassword\",\"StaffName\",\"StaffPosition\",\"StaffPTJ\",\"StaffOfficeNo\",\"StaffPhoneNo\"\n");
		while($Result = mysqli_fetch_array($run))
		{
			fwrite($file, "\"$Result[StaffID]\",\"$Result[StaffUsername]\",\"$Result[StaffPassword]\",\"$Result[StaffName]\",\"$Result[StaffPosition]\",\"$Result[StaffPTJ]\",\"$Result[StaffOfficeNo]\",\"$Result[StaffPhoneNo]\"\n");
		}
		echo '$table';
	}
	fclose($file);
	
	if(!$run)
	{
		
		echo '<script type="text/javascript">';
		//echo 'alert("Error!")';
		echo '$table';
		echo '</script>';	
	}
	else
	{
		$export1 ="INSERT INTO backup_log 
		(backuplogno, backuptable, backupname, backupby, backuptime, backuptype) 
		VALUES (backuplogno, '$table', '$filName', '$StaffID', SYSDATE, 'FULL')";
		
		$run	= $DBConn->query($export1);
		
		if($export1)
		{
			echo '<script type="text/javascript">';
			echo 'alert("Export Done.")';
			echo '</script>';
			echo "<meta http-equiv=\"refresh\" content=\"0; URL=S_FullBackup.php\">";
		}
		else
		{
			echo '<script type="text/javascript">';
			echo 'alert("Error!")';
			echo '</script>';
			echo "<meta http-equiv=\"refresh\" content=\"0; URL=S_FullBackup.php\">";
		}
	}
	
	mysqli_close($DBConn);
?>
	