<?php
		session_start();
		require_once("../connection.php");
		
	if(!isset($_SESSION["VendorID"]) && empty($_SESSION["VendorID"]))
	{
		header("location:../index.php");
		exit;
	}
	else
		$VendorID = $_SESSION["VendorID"];
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
                <a class="navbar-brand" href="V_Home.php">e-Procurement</a> 
            </div>
			<div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
			<?php
					$sql_displaysession = "SELECT * FROM vendor WHERE VendorID='".$_SESSION['VendorID']."' ";
					$ds_displaysession =mysqli_query($DBConn,$sql_displaysession)or die (mysqli_error());
					$row=mysqli_fetch_assoc($ds_displaysession);
			?>
			
			You are logged in as: <?php echo $row['VendorName'];?>&nbsp; <a href="../index.php" class="btn btn-danger square-btn-adjust">Logout</a> 
			</div>
        </nav>   
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
					<li class="text-center">
					<?php 
							if($row["VendorLogo"] == '' || empty($row["VendorLogo"])) {
								echo "<img src='../Image/vendor.jpeg' class='user-image img-responsive'/>";
							}
							else {
								echo "<img src='../viewimage.php?VendorID=".$row["VendorID"]."&type=1' class='user-image img-responsive'/>"; 
							}
						?>
					</li>
                    <li>
                        <a href="V_Home.php"> Home</a>
                    </li>
                    <li>
                        <a href="V_Manage_Account.php"> Profile</a>
                    </li>
					<li>
                        <a class="" href="V_Manage_Password.php"> Change Password</a>
                    </li>
					<li>
                        <a class="active-menu" href="#"> Contact Person<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
                            <li>
                                <a href="V_Register_Contact.php">Register Contact Person</a>
                            </li>
                            <li>
                                <a class="active-menu" href="V_List_Contact.php">Contact Person List</a>
                            </li>
                        </ul>
                    </li>
					<li>
						<a class="" href="#"> RFQ<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
                            <li>
                                <a class="" href="V_List_Of_RFQ.php">List of RFQ</a>
                            </li>
							<li>
                                <a href="V_Responded_RFQ.php">Responded RFQ</a>
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
						<h2> LIST OF QUOTATION </h2> 
                    </div>
                </div>
                <hr />
				<div class="row">
                    <div class="col-md-12">
						
					<?php 
							//$select = "select * from contact_person JOIN vendor ON contact_person.VendorID = vendor.VendorID WHERE VendorID='$VendorID'";
							//$run	= $DBConn->query($select);
							
							$stmt = mysqli_query($DBConn, "select * from contact_person JOIN vendor ON contact_person.VendorID = vendor.VendorID WHERE vendor.VendorID = '$VendorID'");
							//$row = mysqli_fetch_array($stmt);
							
								echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example' >";
								echo"<thead>";
								echo"<tr>";
								
								echo"<th>Contact Person Id</th>";
								echo"<th>Name</th>";
								echo"<th>Email</th>";
								echo"<th>Office No</th>";
								echo"<th>Phone No</th>";
								//echo"<th>Vendor ID</th>";
								//echo"<th></th>";
								echo"</thead>";
								echo"<tbody>";
								
							while($row = mysqli_fetch_assoc($stmt))
							{
								echo "<tr>";
								echo "<td>".$row['ContactPersonNo']."</td>";
								echo "<td>".$row['ContactName']."</td>";
								echo "<td>".$row['ContactEmail']."</td>";
								echo "<td>".$row['ContactOfficeNo']."</td>";
								echo "<td>".$row['ContactPhoneNo']."</td>";
								//echo "<td>".$row['VendorID']."</td>";
								echo "</tr>"; 
							}
								
					?>
						</tbody>
						</table>
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
    <script type="text/javascript" src="../assets/js/dataTables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="../assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script type="text/javascript">
		$(document).ready(function () {
			$('#dataTables-example').dataTable();
		});
    </script>
    <script type="text/javascript" src="../assets/js/custom.js"></script>
    
   
</body>
</html>
