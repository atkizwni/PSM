<?php
		session_start();
		require_once("../connection.php");
		
	if(!isset($_SESSION["StaffID"]) && empty($_SESSION["StaffID"]))
	{
		header("location:../index.php");
		exit;
	}
	else
		$StaffID = $_SESSION["StaffID"];
?>

<?php
  if ($_SESSION['timeout'] + 10 * 60 < time()) {
	  echo '<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=../logout.php">';
     // session timed out
  } else {
     // session ok
  }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>e-Procurement</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/css/custom.css" rel="stylesheet" />
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<script type="text/javascript">
	var specialKeys = new Array();
	specialKeys.push(8); //Backspace
	function IsNumeric3(e) {
	var keyCode = e.which ? e.which : e.keyCode
	var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
	document.getElementById("error3").style.display = ret ? "none" : "inline";
	return ret;
	}
</script>
<body>

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="S_Home.php">e-Procurement</a> 
            </div>
			<div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
				
				<?php
					$sql_displaysession = "SELECT * FROM staff WHERE StaffID='".$_SESSION['StaffID']."' ";
					$ds_displaysession =mysqli_query($DBConn,$sql_displaysession)or die (mysqli_error());
					$row=mysqli_fetch_assoc($ds_displaysession);
				?>
			
				 You are logged in as: <?php echo $row['StaffName'];?> &nbsp; <a href="../logout.php" class="btn btn-danger square-btn-adjust" onClick="return confirm ('Are you sure to logout?');">Logout</a> 
			</div>
        </nav>   
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
					<li class="text-center">
						<img src="../Image/user.png" class="user-image img-responsive"/>
					</li>
                    <li>
                        <a href="S_Home.php"> Home</a>
                    </li>
                    <li>
                        <a class="active-menu" href="S_Manage_Account.php"> Profile</a>
                    </li>
					<li>
                        <a class="" href="S_Manage_Password.php"> Change Password</a>
                    </li>
					<li>
                        <a href="S_List_Of_RFQ.php"> Request For Quotation</a>
                    </li>
					<li>
                        <a href="S_Vendor_Respond.php"> Vendor Respond</a>
                    </li>
                    <li>
                        <a href="#"> Vendor<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                           <li>
                                <a href="S_List_Of_Vendors.php"> List of Vendor</a>
                            </li>
                        </ul>
                    </li>
					
						<li>
							<a class="" href="#"> Backup And Recovery<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
							<li>
								<a href="S_FullBackup.php">Full Backup</a>
							</li>
							<li>
								<a href="S_Recovery.php">Recovery</a>
						</li>
						</ul>
					</li>
					</li>					
                </ul>
            </div>
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
						<h2> PROFILE </h2>   
                        <h5>You can manage your account here. </h5>
                    </div>
                </div>
                <hr />
				<div class="row">
                    <div class="col-md-12">
						<form  name ="S_Manage_Account.html" action= "S_Manage_Account_Code.php" method = "post" role="form" onsubmit="return checkForm(this);">
						<p align="center" style="color:#F00"><span  id="error3" style="colour:Red; display:none" /><br>* Please insert numbering format</b> </span></p>

							<div class="form-group">
							
							
							
								<label>Staff ID:</label>
								<input type='text' name='StaffID' class="form-control" value="<?php echo $row['StaffID'];?>" readonly="readonly" />
							</div>
								<div class="form-group">
								<label>Staff Username:</label>
								<input type='text' name='StaffUsername' class="form-control" value="<?php echo $row['StaffUsername'];?>" />
							</div>
								<div class="form-group">
								<label>Staff Password:</label>
								<input type='password' name='StaffPassword' class="form-control" value="<?php echo $row['StaffPassword'];?>" readonly="readonly" />
							</div>
								<div class="form-group">
								<label>Staff Name:</label>
								<input type='text' name='StaffName' class="form-control" value="<?php echo $row['StaffName'];?>" />
							</div>
								<div class="form-group">
								<label>Staff Office No:</label>
								<input type='text' name='StaffOfficeNo' class="form-control" onKeyPress="return IsNumeric3(event);" ondrop="return false;" value="<?php echo $row['StaffOfficeNo'];?>" />
							</div>
							<div class="form-group">
								<label>Staff Phone No:</label>
								<input type='text' name='StaffPhoneNo' class="form-control" onKeyPress="return IsNumeric3(event);" ondrop="return false;" value="<?php echo $row['StaffPhoneNo'];?>" />
							</div>
							<div class="form-group">
								<label>Staff Email:</label>
								<input type='text' name='StaffEmail' class="form-control" value="<?php echo $row['StaffEmail'];?>" />
							</div>
							<div align='right'>
								<button name = "submit" type="submit" id = "submit" class="btn btn-default" value="Update Information" onClick="return confirm ('Are you sure to UPDATE this information?');">Update Information</button>
							</div>
						</form>
                    </div>
                </div>
                <hr />
			</div>
        </div>
    </div>
	
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
	<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.metisMenu.js"></script>
    <script type="text/javascript" src="../assets/js/custom.js"></script>
    
   
</body>
</html>
