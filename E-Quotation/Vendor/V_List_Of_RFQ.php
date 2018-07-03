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
                        <a href="V_Manage_Account.php"> Profile</a>
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
                                <a class="active-menu" href="V_List_Of_RFQ.php">List of RFQ</a>
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
							$stmt = mysqli_query($DBConn, "SELECT COUNT(*) AS A FROM rfq WHERE RFQStatus = 'Publish'");
							$row = mysqli_fetch_array($stmt);
							$kira = $row["A"];
							
							if($kira > 0)
							{
								//$stmt = mysqli_query($DBConn, "SELECT * FROM rfq ORDER BY rfq_NO");
								//$stmt = mysqli_query($DBConn, "SELECT * FROM rfq R, REQUEST_ITEM I WHERE R.rfq_No = I.rfq_No AND R.RFQStatus = 'Publish' AND R.rfqEndDate > GETDATE() AND I.CodeVoteID IN (SELECT CodeVoteID FROM vendor_VOTE WHERE VendorID = '$VendorID')");
								//$stmt = mysqli_query($DBConn, "SELECT DISTINCT R.RFQ_No, R.RFQStartDate, R.RFQEndDate, R.StaffID FROM rfq R, request_item I WHERE R.RFQ_No = I.RFQ_No AND R.RFQStatus = 'Publish' AND R.RFQEndDate > CURDATE()");
								$stmt = mysqli_query($DBConn, "SELECT DISTINCT R.RFQ_No, R.RFQStartDate, R.RFQEndDate, R.StaffID FROM rfq R, request_item I WHERE R.RFQ_No = I.RFQ_No 
										AND R.RFQStatus = 'Publish' AND R.RFQEndDate > CURDATE()
										AND I.CodeVoteID IN (SELECT CodeVoteID FROM vendor_vote WHERE VendorID = '$VendorID')");
								echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'>";
								echo "<thead>";
									echo "<tr>";
										echo "<th>Quotation No</th>";
										echo "<th>RFQ Duration</th>";
										echo "<th>Request By</th>";
										echo "<th></th>";
									echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
									while($row = mysqli_fetch_array($stmt))
									{
										$stmt1 = mysqli_query($DBConn, "SELECT COUNT(*) AS A FROM vendor_quotation WHERE RFQ_No = '".$row["RFQ_No"]."' AND VendorID = '$VendorID'");
										$row1 = mysqli_fetch_array($stmt1);
										$available = $row1["A"];
										
										echo "<tr>";
											echo "<td>" . $row["RFQ_No"] . "</td>";
											echo "<td>" . date('d F Y', strtotime( $row["RFQStartDate"] )) . " - " .  date('d F Y', strtotime( $row["RFQEndDate"] )) . "</td>";
											echo "<td>" . $row["StaffID"] . "</td>";
											echo "<td>";
												echo "<a target='_blank' href='V_Quotation_Detail.php?RFQ_No=".$row["RFQ_No"]."' data-toggle='tooltip' data-placement='bottom' title='VIEW'><span class='glyphicon glyphicon-file'></span></a>";
												if($available == 0) {
													echo "<a target='_blank' href='V_Respond_RFQ.php?RFQ_No=".$row["RFQ_No"]."' data-toggle='tooltip' data-placement='bottom' title='RESPOND'><span class='glyphicon glyphicon-ok'></span></a>";
												}
											echo "</td>";
										echo "</tr>";
									}
									
								echo "</tbody>";
								echo "</table>";
							}
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
