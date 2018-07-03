<?php
	require_once("../connection.php");
	session_start();
	
	if(!isset($_SESSION["StaffID"]) && empty($_SESSION["StaffID"]))
	{
		header("location:../index.php");
		exit;
	}
	else
		$staffid = $_SESSION["StaffID"];
	
	date_default_timezone_set("Asia/Kuala_Lumpur");
	//if ($_FILES['csv']) 
	if(file_exists($_FILES['csv']['tmp_name']) || is_uploaded_file($_FILES['csv']['tmp_name']))
	{
		$table = $_POST["table"];
		$fail = $_FILES['csv'];
		$fail_nama = $fail['name'];
		$tmp_fail = $fail['tmp_name'];
		$valid_formats = array("csv");
		$ext = pathinfo($fail_nama, PATHINFO_EXTENSION);
		
		if(in_array($ext,$valid_formats) ) 
		{
			$i = 0;
			$total = 0;
			move_uploaded_file($_FILES["csv"]["tmp_name"],"BACKUP/Recovery/".$_FILES["csv"]["name"]); // Copy/Upload CSV
			$file = fopen("BACKUP/Recovery/".$_FILES["csv"]["name"], "r");
			
			if($table == 'vendor')
			{
				while (($getData = fgetcsv($file, 1000, ",")) !== FALSE) 
				{
					if($getData[0] !== 'VendorID')
					{
						$sql ="INSERT INTO vendor (VendorID,VendorUsername,VendorPassword, VendorName, VendorAddress) VALUES ('$getData[0]','$getData[1]','$getData[2]','$getData[3]','$getData[4]')";
						$run = $DBConn->query($sql);
						if($run) {
							$i = $i + 1;
						}
						$total = $total + 1;
					}
				}
			}
			else if($table == 'staff')
			{
				while (($getData = fgetcsv($file, 1000, ",")) !== FALSE) 
				{
					if($getData[0] !== 'StaffID')
					{
						$sql ="INSERT INTO staff (StaffID,StaffUsername,StaffPassword,StaffName,StaffPosition,StaffPTJ,StaffOfficeNo,StaffPhoneNo) VALUES ('$getData[0]','$getData[1]','$getData[2]','$getData[3]','$getData[4]','$getData[5]','$getData[6]','$getData[7]')";
						$run = $DBConn->query($sql);
						if($run) {
							$i = $i + 1;
						}
						$total = $total + 1;
					}
				}
			}
			else if($table == 'code_vote')
			{
				while (($getData = fgetcsv($file, 1000, ",")) !== FALSE) 
				{
					if($getData[0] !== 'CodeVoteID')
					{
						$sql ="INSERT INTO code_vote (CodeVoteID, CodeVoteDesc) VALUES ('$getData[0]','$getData[1]')";
						$run = $DBConn->query($sql);
						if($run) {
							$i = $i + 1;
						}
						$total = $total + 1;
					}
				}
			}
			
			fclose($file);
			echo '<script type="text/javascript">';
			echo "alert('Upload & Import Done. ".$i."/".$total." data uploaded.')";
			echo '</script>';
			echo "<meta http-equiv=\"refresh\" content=\"0; URL=S_Recovery.php\">";
		}
		else 
		{
			echo '<script type="text/javascript">';
			echo 'alert("Please upload file with csv format only.")';
			echo '</script>';
			echo "<meta http-equiv=\"refresh\" content=\"0; URL=S_Recovery.php\">";
		}
	}
	mysqli_close($DBConn);

?>