<?php
	require_once("../connection.php");
	session_start();
	if(!isset($_SESSION["StaffID"]) && empty($_SESSION["StaffID"] ))
	{
		header("location:../index.php");
		exit;
	}
 else
	 $StaffID = $_SESSION["StaffID"];

	//$sql = mysqli_query($DBConn, "CALL publishquotation ('".$_GET['RFQ_No']."', 'Publish')");
	$sql = mysqli_query($DBConn, "UPDATE rfq SET RFQStatus='Publish' WHERE RFQ_No='".$_GET['RFQ_No']."'");

	
         if ($sql) 
	        {
			echo "<script>alert('Publish successful')</script>";
			//odbc_commit($conn);
			echo'<META HTTP-EQUIV="Refresh" CONTENT="0.0; URL=S_List_Of_RFQ.php">';
		}
		else
		{
			echo "<script> alert('Publish Unsuccessful')</script>";
			//var_dump(odbc_error($stmt));
			echo '<META HTTP-EQUIV="Refresh" CONTENT="0.01; URL=S_Quotation_Publish.php">';
		}
	
	
	mysqli_close($DBConn);
	
?>
	
	
