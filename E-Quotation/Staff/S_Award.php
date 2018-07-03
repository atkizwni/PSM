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
?>

<?php
	$stmt = mysqli_query($DBConn, "Update vendor_quotation SET VendorQuotationStatus='Award' WHERE  VendorQuotationNo = '".$_POST["award"]."'");
	
	//$stmt = mysqli_query($DBConn, "Update vendor_quotation SET VendorQuotationStatus='Rejected' WHERE VendorQuotationNo != '".$_POST["award"]."' AND RFQ_No = (SELECT RFQ_No FROM vendor_quotation WHERE VendorQuotationNo = '".$_POST["award"]."' ) ");

?>

<?php
	/*$stmt = mysqli_query($DBConn, "Update RFQ SET RFQSTATUS='Award' WHERE  RFQ_No = '".$_POST["award"]."'");
	oci_execute ($stmt);*/
?>	
	
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Procurement</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/css/custom.css" rel="stylesheet" />
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<script>
	function printDiv(divName) {
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
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
                <a class="navbar-brand" href="../index.php">e-Procurement</a> 
            </div>
			<?php 
			$stmt = mysqli_query($DBConn, "SELECT * FROM staff where StaffID='$StaffID'");
			$data = mysqli_fetch_array($stmt);
			?>
			
			<div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
				<?php echo $data['StaffName']; ?> &nbsp;  <a href="../logout.php" class="btn btn-danger square-btn-adjust">Logout</a> 
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
                        <a href="S_List_Of_RFQ.php"> Request For Procurement</a>
                    </li>
					<li>
                        <a class="active-menu" href="S_Vendor_Respond.php"> Vendor Respond</a>
                    </li>
                    <li>
                        <a href="#"> Vendor<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="active-menu" href="S_List_Of_Vendors.php"> List of Vendor</a>
                            </li>
                        </ul>
                    </li>
						
					<li>
						<a href="#"> Backup And Recovery<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li>
								<a href="S_FullBackup.php">Full Backup</a>
							</li>
							<li>
								<a href="S_Recovery.php">Recovery</a>
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
						<h2> RFQ DETAIL</h2>
					</div>
				</div>
				<hr/>
				
				<div id="printableArea">
					<div class="row">
						<div class="col-md-12">
							<center><img src="../Image/user.png" class="user-image img-responsive"/></center>
							<h3> QUOTATION DETAIL</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<?php 
								$vqno = $_POST["award"];
								$stmt = mysqli_query($DBConn, "SELECT * FROM rfq R, staff S WHERE R.StaffID = S.StaffID AND R.RFQ_No = (SELECT R.RFQ_No FROM rfq R,vendor_quotation V WHERE R.RFQ_No = V.RFQ_No AND V.VendorQuotationNo = '$vqno')");
								$row = mysqli_fetch_array($stmt);
								
								echo "<table class='table table-striped table-bordered'>";
								echo "<tr>";
									echo "<th>Procurement Number</th>";
									echo "<td>".$row["RFQ_No"]."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<th>Procurement Date</th>";
									echo "<td>" .  $row["RFQStartDate"]  . " - " .  $row["RFQEndDate"]  . "</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<th>Request By</th>";
									echo "<td>".$row["StaffID"]." - ".$row["StaffName"]."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<th>Item Requested</th>";
									echo "<td>";
										$stmtt1 = mysqli_query($DBConn, "SELECT * FROM request_item WHERE RFQ_No = '".$row["RFQ_No"]."' ORDER BY ItemNo");
										while($roww1 = mysqli_fetch_array($stmtt1))
										{
											echo $roww1["CodeVoteID"] . " - " . $roww1["ItemQuantity"] . " " . $roww1["ItemDesc"] . "<br>";
										}
									"</td>";
								echo "</tr>";
								echo "</table>";
							?>
						</div>
					</div>
							
					<div class="row">
						<div class="col-md-12">
							<?php
								/*$stmt1 = mysqli_query($DBConn, "SELECT * FROM VENDOR V, vendor_Procurement Q WHERE V.VENDORID = Q.VENDORID AND Q.VendorProcurementNo = '$vqno'");
								oci_execute ($stmt1);
								$row1 = mysqli_fetch_array($stmt1);*/
								
								$vqno = $_POST["award"];
								$stmt4 = mysqli_query($DBConn, "SELECT * FROM vendor V, vendor_quotation Q WHERE V.VendorID = Q.VendorID AND Q.VendorQuotationNo = '$vqno'");				
								$row4 = mysqli_fetch_array($stmt4);
								//odbc_free_result($stmt4);
								
								echo "<form action='S_Award.php' method='post'>";
								echo "<table class='table table-striped table-bordered table-hover'>";
								echo "<tr>";
									echo "<th></th>";
										echo"<td><br> <img src = '../viewimage.php?VendorID=".$row4['VendorID']."&type=1' style='width:128px;height:128px;' /> </td>";
									//echo "<td>".$row4["vendorLOGO"]."</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<th>vendor Name</th>";
								echo "<td>".$row4["VendorName"]."</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<th>Date Respond</th>";
								echo "<td>".$row4["VendorQuotationDate"]."</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<th>Item Price</th>";
								echo "<td>";
								
								$vqno1 = $_POST["award"];
								$stmt4 = mysqli_query($DBConn, "SELECT * FROM request_item R, vendor_quotation_detail Q WHERE R.ItemNo = Q.ItemNo AND Q.VendorQuotationNo = '$vqno1'");
								$totalPrice4 = 0;
									while ($row4 = mysqli_fetch_array($stmt4))
										{
											echo $row4["CodeVoteID"] . " - " . $row4["ItemDesc"] . "(RM ". $row4["Price"] . " x " . $row4["ItemQuantity"]. " )<br>";
											$totalPrice4 = $totalPrice4 + $row4["TotalPrice"];
										}
								echo "</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<th>Total Price</th>";
								echo "<td>RM ".$totalPrice4."</td>";
								echo "</tr>";
								echo "<tr>";
								echo "</div>";
								echo "</form>";
							?>
							
							</table>
						</div>		  
					</div>	
				</div>
				<hr/>
				<div class="row">
					<div class="col-md-12">
						<center>
							<input type="button" onClick="printDiv('printableArea')" value="PRINT" />
							<button type="button" onclick=location.href='S_Vendor_Compare1.php'>BACK</button>
							<br/><br/><br/>
						</center>
					</div>
				</div>
				<hr/>
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
