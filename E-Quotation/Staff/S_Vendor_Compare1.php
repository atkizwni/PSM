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
			<?php 
			$stmt = mysqli_query($DBConn, "SELECT * FROM STAFF where StaffID='$StaffID'");
			$data = mysqli_fetch_array($stmt);
			?>
			
			<div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
				<?php echo $data['StaffName']; ?> &nbsp; <a href="../index.php" class="btn btn-danger square-btn-adjust">Logout</a> 
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
						<h2> VENDOR RESPOND</h2> 
                    </div>
                </div>
                <hr />
				<div class="row">
                    <div class="col-md-12">
						
							<h3> QUOTATION DETAIL</h3> 
						<?php
							
							$bil = $_POST["bil"];
							$k = 0;
							for($i=0; $i<$bil; $i++)
							{
								if(isset($_POST['compare'.$i]))
								{
									$k = $k + 1;
									${'compare' . $k} = $_POST['compare'.$i];
									${'stmt' . $k} = mysqli_query($DBConn, "SELECT * FROM vendor_quotation V, rfq R WHERE V.RFQ_No = R.RFQ_No AND V.VendorQuotationNo  ='".$_POST['compare'.$i]."'");
									${'row' . $k} = mysqli_fetch_array(${'stmt' . $k});
									
								}
							}
							
							if($k == 0)
							{
								echo '<script type="text/javascript">';
									echo 'alert("Please select at least one(1) vendor respond.")';
								echo '</script>';
								echo "<meta http-equiv=\"refresh\" content=\"0; URL=S_Vendor_Respond.php\">";
							}
							else if($k == 1) 
							{
								$rfqno = $row1["RFQ_No"];
								$stmt = mysqli_query($DBConn, "SELECT * FROM rfq R, staff S WHERE R.StaffID = S.StaffID AND R.RFQ_No = '$rfqno'");
								$row = mysqli_fetch_array($stmt);
								
								echo "<table class='table table-striped table-bordered'>";
								echo "<tr>";
									echo "<th>Quotation Number</th>";
									echo "<td>".$rfqno."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<th>Quotation Date</th>";
									echo "<td>" .  $row["RFQStartDate"]  . " - " .  $row["RFQEndDate"]  . "</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<th>Request By</th>";
									echo "<td>".$row["StaffID"]." - ".$row["StaffName"]."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<th>Item Requested</th>";
									echo "<td>";
										$stmtt1 = mysqli_query($DBConn, "SELECT * FROM request_item WHERE RFQ_No = '$rfqno' ORDER BY ItemNo");
										while($roww1 = mysqli_fetch_array($stmtt1))
										{
											echo $roww1["CodeVoteID"] . " - " . $roww1["ItemQuantity"] . " " . $roww1["ItemDesc"] . "<br>";
										}
									"</td>";
								echo "</tr>";
								echo "</table>";
							}
							else if($k == 2) 
							{
								if($row1["RFQ_No"] == $row2["RFQ_No"])
								{
									$rfqno = $row1["RFQ_No"];
									$stmt = mysqli_query($DBConn, "SELECT * FROM rfq R, staff S WHERE R.StaffID=S.StaffID and R.RFQ_No = '$rfqno'");
									$row = mysqli_fetch_array($stmt);
									//odbc_free_result($stmt);
									
									echo "<table class='table table-striped table-bordered'>";
									echo "<tr>";
										echo "<th>Quotation Number</th>";
										echo "<td>".$rfqno."</td>";
									echo "</tr>";
									echo "<tr>";
										echo "<th>Quotation Date</th>";
										echo "<td>" . $row["RFQStartDate"] . " - " .  $row["RFQEndDate"]  . "</td>";
									echo "</tr>";
									echo "<tr>";
										echo "<th>Request By</th>";
										echo "<td>".$row["StaffID"]." - ".$row["StaffName"]."</td>";
									echo "</tr>";
									echo "<tr>";
										echo "<th>Item Requested</th>";
										echo "<td>";
											$stmtt1 = mysqli_query($DBConn, "SELECT * FROM request_item WHERE RFQ_No = '$rfqno' ORDER BY ItemNo");
											while($roww1 = mysqli_fetch_array($stmtt1))
											{
												echo $roww1["CodeVoteID"] . " - " . $roww1["ItemQuantity"] . " " . $roww1["ItemDesc"] . "<br>";
											}
										"</td>";
									echo "</tr>";
									echo "</table>";
								}
								else
								{
									echo '<script type="text/javascript">';
									echo 'alert("Please select vendor respond with same rfq number.")';
									echo '</script>';
									echo "<meta http-equiv=\"refresh\" content=\"0; URL=S_Vendor_Respond.php\">";
								}
							}
							else if($k == 3) 
							{
								if($row1["RFQ_No"] == $row2["RFQ_No"] && $row1["RFQ_No"] == $row3["RFQ_No"])
								{
									$rfqno = $row1["RFQ_No"];
									$stmt = mysqli_query($DBConn, "SELECT * FROM rfq R, staff S WHERE R.StaffID = S.StaffID AND R.RFQ_No = '$rfqno'");
									$row = mysqli_fetch_array($stmt);
									
									echo "<table class='table table-striped table-bordered'>";
									echo "<tr>";
										echo "<th>Quotation Number</th>";
										echo "<td>".$rfqno."</td>";
									echo "</tr>";
									echo "<tr>";
										echo "<th>Quotation Date</th>";
										echo "<td>" .  $row["RFQStartDate"]  . " - " .  $row["RFQEndDate"]  . "</td>";
									echo "</tr>";
									echo "<tr>";
										echo "<th>Request By</th>";
										echo "<td>".$row["StaffID"]." - ".$row["StaffName"]."</td>";
									echo "</tr>";
									echo "<tr>";
										echo "<th>Item Requested</th>";
										echo "<td>";
											$stmtt1 = mysqli_query($DBConn, "SELECT * FROM request_item WHERE RFQ_No = '$rfqno' ORDER BY ItemNo");
											while($roww1 = mysqli_fetch_array($stmtt1))
											{
											echo $roww1["CodeVoteID"] . " - " . $roww1["ItemQuantity"] . " " . $roww1["ItemDesc"] . "<br>";
											}
										"</td>";
									echo "</tr>";
									echo "</table>";
								}
								else
								{
									echo '<script type="text/javascript">';
									echo 'alert("Please select vendor respond with same rfq number.")';
									echo '</script>';
									echo "<meta http-equiv=\"refresh\" content=\"0; URL=S_Vendor_Respond.php\">";
								}
							}
						?>
                    </div>
                </div>
				<div class="row">
                    <div class="col-md-12">
						<?php
							if($k == 1) 
							{
								$stmt4 = mysqli_query($DBConn, "SELECT * FROM vendor V, vendor_quotation Q WHERE V.VendorID = Q.VendorID AND Q.VendorQuotationNo = '$compare1'");				
								$row4 = mysqli_fetch_array($stmt4);
								
								echo "<form action='S_Award.php' method='post'>";
								echo "<table class='table table-striped table-bordered table-hover'>";
								echo "<tr>";
									echo "<th>Vendor Name</th>";
									echo "<td>".$row4["VendorName"]."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<th>Date Respond</th>";
										echo "<td>".$row4["VendorQuotationDate"]."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<th>Item Price</th>";
									echo "<td>";
										$stmt4 = mysqli_query($DBConn, "SELECT * FROM request_item R, vendor_quotation_DETAIL Q WHERE R.ItemNo = Q.ItemNo AND Q.VendorQuotationNo = '$compare1'");
										$totalPrice4 = 0;
										while ($row4 = mysqli_fetch_array($stmt4))
										{
											echo $row4["CodeVoteID"] . " - " . $row4["ItemDesc"] . "(RM ". $row4["Price"] . " x " . $row4["ItemQuantity"] . " )<br>";
											$totalPrice4 = $totalPrice4 + $row4["TotalPrice"];
										}
									echo "</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<th>Total Price</th>";
									echo "<td>RM ".$totalPrice4."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<th>Award</th>";
									echo "<td align='center'><input type='radio' name='award' value='".$compare1."'></td>";
								echo "</tr>";
								echo "</table>";
								echo "<div align='right'>";
									echo "<input type='submit' class='btn btn-primary btn-md' value='Award'>";
								echo "</div>";
								echo "</form>";
							}
							else if($k == 2) 
							{
								$stmt4 = mysqli_query($DBConn, "SELECT * FROM vendor V, vendor_quotation Q WHERE V.VendorID = Q.VendorID AND Q.VendorQuotationNo = '$compare1'");
								$row4 = mysqli_fetch_array($stmt4);
								
								$stmt5 = mysqli_query($DBConn, "SELECT * FROM vendor V, vendor_quotation Q WHERE V.VendorID = Q.VendorID AND Q.VendorQuotationNo = '$compare2'");
								$row5 = mysqli_fetch_array($stmt5);
								
								echo "<form action='S_Award.php' method='post'>";
								echo "<table class='table table-striped table-bordered table-hover'>";
								echo "<tr>";
									echo "<th>Vendor Name</th>";
									echo "<td>".$row4["VendorName"]."</td>";
									echo "<td>".$row5["VendorName"]."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<th>Date Respond</th>";
									echo "<td>".$row4["VendorQuotationDate"]."</td>";
									echo "<td>".$row5["VendorQuotationDate"]."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<th>Item Price</th>";
									echo "<td>";
										$stmt4 = mysqli_query($DBConn, "SELECT * FROM request_item R, vendor_quotation_detail Q WHERE R.ItemNo = Q.ItemNo AND Q.VendorQuotationNo = '$compare1'");
										$TotalPrice4 = 0;
										while ($row4 = mysqli_fetch_array($stmt4))
										{
											echo $row4["CodeVoteID"] . " - " . $row4["ItemDesc"] . "(RM " . $row4["Price"] . " x " . $row4["ItemQuantity"] . " )<br>";
											$TotalPrice4 = $TotalPrice4 + $row4["TotalPrice"];
										}
									echo "</td>";
									echo "<td>";
										$stmt5 = mysqli_query($DBConn, "SELECT * FROM request_item R, vendor_quotation_DETAIL Q WHERE R.ItemNo = Q.ItemNo AND Q.VendorQuotationNo = '$compare2'");
										$TotalPrice5 = 0;
										while ($row5 = mysqli_fetch_array($stmt5))
										{
											echo $row5["CodeVoteID"] . " - " . $row5["ItemDesc"] . "(RM " . $row5["Price"] . " x " . $row5["ItemQuantity"] . " )<br>";
											$TotalPrice5 = $TotalPrice5 + $row5["TotalPrice"];
										}
									echo "</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<th>Total Price</th>";
									echo "<td>RM ".$TotalPrice4."</td>";
									echo "<td>RM ".$TotalPrice5."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<th>Award</th>";
									echo "<td align='center'><input type='radio' name='award' value='".$compare1."'></td>";
									echo "<td align='center'><input type='radio' name='award' value='".$compare2."'></td>";
								echo "</tr>";
								echo "</table>";
								echo "<div align='right'>";
									echo "<input type='submit' class='btn btn-primary btn-md' value='Award'>";
								echo "</div>";
								echo "</form>";
								
							}
							else if($k == 3) 
							{
								$stmt4 = mysqli_query($DBConn, "SELECT * FROM vendor V, vendor_quotation Q WHERE V.VendorID = Q.VendorID AND Q.VendorQuotationNo = '$compare1'");
								$row4 = mysqli_fetch_array($stmt4);
								
								$stmt5 = mysqli_query($DBConn, "SELECT * FROM vendor V, vendor_quotation Q WHERE V.VendorID = Q.VendorID AND Q.VendorQuotationNo = '$compare2'");
								$row5 = mysqli_fetch_array($stmt5);
								
								$stmt6 = mysqli_query($DBConn, "SELECT * FROM vendor V, vendor_quotation Q WHERE V.VendorID = Q.VendorID AND Q.VendorQuotationNo = '$compare3'");
								$row6 = mysqli_fetch_array($stmt6);
								
								echo "<form action='S_Award.php' method='post'>";
								echo "<table class='table table-striped table-bordered table-hover'>";
								
								echo "<tr>";
									echo "<th>Vendor Name</th>";
									echo "<td>".$row4["VendorName"]."</td>";
									echo "<td>".$row5["VendorName"]."</td>";
									echo "<td>".$row6["VendorName"]."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<th>Date Respond</th>";
									echo "<td>".$row4["VendorQuotationDate"]."</td>";
									echo "<td>".$row5["VendorQuotationDate"]."</td>";
									echo "<td>".$row6["VendorQuotationDate"]."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<th>Item Price</th>";
									echo "<td>";
										$stmt4 = mysqli_query($DBConn, "SELECT * FROM request_item R, vendor_quotation_DETAIL Q WHERE R.ItemNo = Q.ItemNo AND Q.VendorQuotationNo = '$compare1'");
										$TotalPrice4 = 0;
										while ($row4 = mysqli_fetch_array($stmt4))
										{
											echo $row4["CodeVoteID"] . " - " . $row4["ItemDesc"] . "(RM " . $row4["Price"] . " x " . $row4["ItemQuantity"] . " )<br>";
											$TotalPrice4 = $TotalPrice4 + $row4["TotalPrice"];
										}
									echo "</td>";
									echo "<td>";
										$stmt5 = mysqli_query($DBConn, "SELECT * FROM request_item R, vendor_quotation_detail Q WHERE R.ItemNo = Q.ItemNo AND Q.VendorQuotationNo = '$compare2'");
										$TotalPrice5 = 0;
										while ($row5 = mysqli_fetch_array($stmt5))
										{
											echo $row5["CodeVoteID"] . " - " . $row5["ItemDesc"] . "(RM " . $row5["Price"] . " x " . $row5["ItemQuantity"] . " )<br>";
											$TotalPrice5 = $TotalPrice5 + $row5["TotalPrice"];
										}
									echo "</td>";
									echo "<td>";
										$stmt6 = mysqli_query($DBConn, "SELECT * FROM request_item R, vendor_quotation_detail Q WHERE R.ItemNo = Q.ItemNo AND Q.VendorQuotationNo = '$compare3'");
										$TotalPrice6 = 0;
										while ($row6 = mysqli_fetch_array($stmt6))
										{
											echo $row6["CodeVoteID"] . " - " . $row6["ItemDesc"] . "(RM " . $row6["Price"] . " x " . $row6["ItemQuantity"] . " )<br>";
											$TotalPrice6 = $TotalPrice6 + $row6["TotalPrice"];
										}
									echo "</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<th>Total Price</th>";
									echo "<td>RM ".$TotalPrice4."</td>";
									echo "<td>RM ".$TotalPrice5."</td>";
									echo "<td>RM ".$TotalPrice6."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<th>Award</th>";
									echo "<td align='center'><input type='radio' name='award' value='".$compare1."'></td>";
									echo "<td align='center'><input type='radio' name='award' value='".$compare2."'></td>";
									echo "<td align='center'><input type='radio' name='award' value='".$compare3."'></td>";
								echo "</tr>";
								echo "</table>";
								echo "<div align='right'>";
									echo "<input type='submit' class='btn btn-primary btn-md' value='Award'>";
								echo "</div>";
								echo "</form>";
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
    <script type="text/javascript" src="../assets/js/custom.js"></script>
    
   
</body>
</html>
