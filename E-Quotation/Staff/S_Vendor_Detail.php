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
			
			You are logged in as: <?php echo $row['StaffName'];?> &nbsp; <a href="../logout.php" class="btn btn-danger square-btn-adjust">Logout</a> 
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
                        <a href="S_Manage_Account.php"> Profile</a>
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
                        <a class="active-menu" href="#"> Vendor<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="" href="S_List_Of_Vendors.php"> List of Vendor</a>
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
								<a class="" href="S_Recovery.php">Recovery</a>
						</li>
						</ul>
					</li>
				</ul>
            </div>
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
				<div class="row">
                    <div class="col-md-12">
						<h2> VENDOR DETAILS </h2>
						<hr />
						<div class="panel panel-default">
								<div class="panel-heading"> DETAILS </div>
                        <div class="panel-body">
							<div class='col-md-10 col-md-offset-1'>
								<table class='table'>
						<?php
								
								$VendorID=$_GET["VendorID"];
								
								$select = "select * from vendor where VendorID = '$VendorID'";
								$run	= $DBConn->query($select);
								
								$row = mysqli_fetch_assoc($run);
						?>	
								
								<tr>
									<th width="30%" >Vendor ID:</th>
									<td width="70%" ><?php echo$row['VendorID'];  ?> </td>
								</tr>
								<tr>
									<th>Vendor UserName:</th>
									<td><?php echo$row['VendorUsername']; ?> </td>
                                    
								</tr>
								<tr>
									<th>Vendor Name:</th>
									<td> <?php echo$row['VendorName']; ?> </td>
								</tr>
								<tr>
									<th>Vendor Address:</th>
									<td> <?php echo$row['VendorAddress']; ?> </td>
								</tr>
								<tr>
									<th>Vendor Logo:</th>
									
									<td> <img src = "../viewimage.php?VendorID=<?php echo $row['VendorID'];?>&type=1" style="width:128px;height:128px;" /> </td>
								</tr>
								<tr>
									<th>Vendor Signature:</th>
									<td> <img src = "../viewimage.php?VendorID=<?php echo$row['VendorID'];?>&type=2" style="width:128px;height:128px;" /> </td>
								</tr>
								<tr>
									<th>Vendor Stamp:</th>
									<td> <img src = "../viewimage.php?VendorID=<?php echo$row['VendorID'];?>&type=3" style="width:128px;height:128px;" /> </td>
								</tr>
								</table>
						
						<br></br>
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