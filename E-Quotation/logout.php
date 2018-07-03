<?php
session_start();
session_destroy();

echo "<script> alert('Log out')</script>";
echo '<META HTTP-EQUIV="Refresh" CONTENT="0.01; URL=index.php">';
		
	if ($_SESSION['Username'] = "")
	{
		//echo "<script> alert('Failed to log out!');</script>";
		echo'<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=index.php">';
	}
	else {}
?>

