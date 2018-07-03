<?php
	include 'connection.php';
	session_start();
	$_SESSION['timeout'] = time();

	$Username = $_POST['StaffUsername'];
	$Password = hash ('md5', $_POST['StaffPassword']);
	//$Password = $_POST['StaffPassword'];
	$role  	= $_POST['role'];
	//echo $Password;
	
	//$encrypted_mypassword=md5($Password);
	//$sql="SELECT * FROM staff WHERE StaffID='$Username' and StaffPassword='$encrypted_mypassword'";
	//$result=mysql_query($sql);
	
	
	$query = "SELECT COUNT(*) AS A FROM logs WHERE username = '$Username'";
	$ru = $DBConn->query($query);
	$row = mysqli_fetch_assoc($ru);
	$logs_attemp = $row["A"];
	
	if($logs_attemp < 3)
	{
		$query1 = "INSERT into logs(username, logid, logdate) VALUES('".$Username."', NULL, NOW())";
		$run = $DBConn->query($query1);
		
		if($role == "Client" ) 
		{ 
			
			$sql_logStaff = "SELECT * FROM staff LEFT JOIN role ON staff.roleID = role.roleID WHERE StaffUsername='$Username' 
			and StaffPassword='$Password' and roleName='".$role."'";
			$eq_select = mysqli_query($DBConn,$sql_logStaff)or die (mysqli_error());
			$row1 = mysqli_fetch_assoc($eq_select);
			$kira = mysqli_num_rows($eq_select);
			
			if($kira == 1)
			{
				$_SESSION['StaffID']=$row1['StaffID'];
				
				$query="DELETE FROM logs WHERE username = '$Username'";
				$run	= $DBConn->query($query);
				
				echo "<script> alert('Succesfully login!');</script>";
				echo '<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=Staff/S_Home.php">';
			}
			else
			{
				echo "<script> alert('Your username or password incorrect!');</script>";
				echo'<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=index.php">';
			}
		}
		else if($role == "Vendor" ) 
		{
			$sql_logVendor = "SELECT * FROM vendor LEFT JOIN role ON vendor.roleID = role.roleID  WHERE VendorUsername='$Username' and VendorPassword='$Password' and roleName='".$role."'";

			$eq_select2 =mysqli_query($DBConn,$sql_logVendor)or die (mysqli_error());
			$row2=mysqli_fetch_assoc($eq_select2);
			$kira2 = mysqli_num_rows($eq_select2);
			
			if($kira2 == 1)
			{
				$_SESSION['VendorID']=$row2['VendorID'];
				
				$queryyy="DELETE FROM logs WHERE username = '$Username'";
				$ruN	= $DBConn->query($queryyy);
			
				echo "<script> alert('Succesfully login!');</script>";
				echo '<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=Vendor/V_Home.php">';
			}
			else
			{
				echo "<script> alert('Your username or password incorrect!');</script>";
				echo'<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=index.php">';
			}
		}
	}
	else
	{
		$last_logon = "SELECT MAX(logdate) as a FROM logs WHERE username = '$Username'";
		$run_logon = $DBConn->query($last_logon);
		$maxlogdate = mysqli_fetch_assoc($run_logon);
		$roww = $maxlogdate["a"];
		//echo $roww . "<br>";
		$addtime = "SELECT TIMEDIFF ( NOW() ,'".$roww."') as b";
		$run_addtime = $DBConn->query($addtime);
		$unlock = mysqli_fetch_assoc($run_addtime);
		$rowww = $unlock["b"];
		//echo $rowww . "<br>";
		
		if ($rowww > '00:10:00.000000' )
		{
			$queryy="DELETE FROM logs WHERE username = '$Username'";
			$runnn	= $DBConn->query($queryy);
			echo "<script> alert('Account unlocked! Please log in again.');</script>";
			echo'<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=index.php">';
		}	
		else 
		{	
			echo "<script> alert('Account locked! Your account will be unlock in 10 minutes.');</script>";
			echo'<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=index.php">';
		}
		
	}
?>