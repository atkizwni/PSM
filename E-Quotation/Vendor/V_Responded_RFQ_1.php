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
			<?php
				$stmt = mysqli_query($DBConn, "SELECT * FROM vendor WHERE VendorID = '$VendorID'");
				$row = mysqli_fetch_array($stmt);
			?>
			
			<div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
				<?php echo $row["VendorName"];?> &nbsp; <a href="../logout.php" class="btn btn-danger square-btn-adjust">Logout</a> 
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
						<!--<img src="../Image/Utem_A.png" class="user-image img-responsive"/>-->
					</li>
                    <li>
                        <a href="V_Home.php"> Home</a>
                    </li>
                    <li>
                        <a href="#"> Profile</a>
                    </li>
					<li>
                        <a class="" href="V_Manage_Password.php"> Change Password</a>
                    </li>
					<li>
                        <a href="#"> Contact Person<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
                            <li>
                                <a href="V_Register_Contact.php">Register Contact Person</a>
                            </li>
                            <li>
                                <a href="V_List_Contact.php">Contact Person List</a>
                            </li>
                        </ul>
                    </li>
					<li>
                        <a class="active-menu" href="#"> RFQ<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
                            <li>
                                <a href="V_List_Of_RFQ.php">List of RFQ</a>
                            </li>
                            <li>
                                <a class="active-menu" href="V_Responded_RFQ.php">Responded RFQ</a>
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
						<h2> RESPOND RFQ</h2> 
                    </div>
                </div>
                <hr />
				<div class="row">
                    <div class="col-md-12">
						<h3> QUOTATION DETAIL</h3> 
						<?php
							$VendorQuotationNo = $_GET["VendorQuotation"];
							$stmt = mysqli_query($DBConn, "SELECT * FROM rfq R, staff S, vendor_quotation V WHERE R.StaffID = S.StaffID AND R.RFQ_No = V.RFQ_No AND V.VendorQuotationNo = '$VendorQuotationNo'");
							$row = mysqli_fetch_array($stmt);
							
							echo "<table class='table table-striped table-bordered table-hover'>";
							echo "<tr>";
								echo "<th>Quotation Number</th>";
								echo "<td>".$row["RFQ_No"]."</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<th>Quotation Date</th>";
								echo "<td>" . date('d F Y', strtotime( $row["RFQStartDate"] )) . " - " .  date('d F Y', strtotime( $row["RFQEndDate"] )) . "</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<th>Request By</th>";
								echo "<td>".$row["StaffID"]." - ".$row["StaffName"]."</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<th>Item Requested</th>";
								echo "<td>";
									$stmt1 = mysqli_query($DBConn, "SELECT * FROM request_item WHERE RFQ_No = '".$row["RFQ_No"]."' ORDER BY ItemNo");
									while($row1 = mysqli_fetch_array($stmt1))
									{
										echo $row1["CodeVoteID"] . " - " . $row1["ItemQuantity"] . " " . $row1["ItemDesc"] . "<br>";
									}
									
								"</td>";
							echo "</tr>";
							echo "</table>";
						?>
                    </div>
                </div>
				<br>
				<div class="row">
                    <div class="col-md-12">
						<h3> VENDOR RESPOND</h3> 
						<?php
							$stmt2 = mysqli_query($DBConn, "SELECT * FROM request_item R, vendor_quotation_detail V WHERE R.ItemNo = V.ItemNo AND V.VendorQuotationNo = '$VendorQuotationNo'");
							echo "<table class='table table-striped table-bordered'>";
							echo "<tr>";
								echo "<th>Quotation Number</th>";
								echo "<td colspan='2'>".$row["RFQ_No"]."</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<th>Respond Date</th>";
								echo "<td colspan='2'>".date('d F Y', strtotime( $row["VendorQuotationDate"] ))."</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<th>Item Requested</th>";
								echo "<th colspan='2'>Price per item (RM)</th>";
							echo "</tr>";
							while($row2 = mysqli_fetch_array($stmt2))
							{
								echo "<tr>";
									echo "<td>".$row2["CodeVoteID"]." - ".$row2["ItemDesc"]."</td>";
									echo "<td>".$row2["Price"]."</td>";
								echo "</tr>";
							}
						
							echo "</table>";
						?>
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
