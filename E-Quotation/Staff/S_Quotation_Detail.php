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
	<style>
		.modal_content {
			margin-top: 100px;
			background-color: white;
		}
	</style>
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
                <a class="navbar-brand" href="../S_Home.php">e-Procurement</a> 
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
                        <a href="S_Manage_Account.php"> Profile</a>
                    </li>
					<li>
                        <a class="" href="S_Manage_Password.php"> Change Password</a>
                    </li>
					<li>
                        <a class="active-menu" href="S_List_Of_RFQ.php"> Request For Quotation</a>
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
						<a href="#"> Backup And Recovery<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
                            <li>
                                <a href="S_Backup.php">Backup</a>
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
						<h2> QUOTATION DETAIL </h2> 
                    </div>
                </div>
                <hr />
				<div class="row">
                    <div class="col-md-12">
						<h3> QUOTATION DETAIL </h3> 
						<table class='table table-striped table-bordered table-hover'>
							  <?php

								$sql = mysqli_query($DBConn, "SELECT * FROM staff s, rfq r WHERE r.StaffID = s.StaffID AND r.RFQ_No = '".$_GET["RFQ_No"]."'");
								$data = mysqli_fetch_array($sql);

							  ?>
											<tr>
												<th colspan ='2' width ='20%'>Quotation Number</th>
												<td><?php echo $data['RFQ_No']?></td>
											</tr>
											<tr>
												<th colspan ='2' width ='20%'>Quotation Date</th>
												<td><?php echo date('d F Y', strtotime($data['RFQStartDate']))?>  -  <?php echo date('d F Y', strtotime($data['RFQEndDate']))?> </td>
											</tr>
											<tr>
												<th colspan ='2' width ='20%'>Status</th>
												<td><?php echo $data['RFQStatus']?></td>
											</tr>
											<tr>
												<th colspan ='2' width ='20%'>Request By</th>
												<td><?php echo $data['StaffID']?> - <?php echo $data['StaffName']?></td>
											</tr>
											<tr>
												<th colspan ='2' width ='20%'>Requested Item </th>
												<td>
												<?php

												$sql2 = mysqli_query($DBConn, "SELECT * FROM request_item r, code_vote c WHERE r.CodeVoteID=c.CodeVoteID AND r.RFQ_No = '".$_GET["RFQ_No"]."'");
												while ($data2 = mysqli_fetch_array($sql2))
												{
												echo $data2["CodeVoteID"]."-".$data2["ItemDesc"]."  ".$data2["ItemQuantity"]."<br>";
												}
												?>
												</td>
											</tr>
											</table>
                    </div>
                </div>
                <hr />
		
									<?php
									if($data['RFQStatus']=='Publish')
										{
											$sql1 = mysqli_query($DBConn, "SELECT v.VendorID, v.VendorName, i.VendorQuotationDate, i.VendorQuotationStatus, r.ItemDesc, r.ItemQuantity, r.CodeVoteID, r.ItemNo, b.Price, b.TotalPrice FROM vendor v,vendor_quotation i, request_item r, vendor_quotation_detail b WHERE r.RFQ_No = '".$_GET["RFQ_No"]."'");
											$data1 = mysqli_fetch_array($sql1);
											
											//echo "Publish ";
											if($data1['VendorQuotationStatus']=='Award')
											{
											//echo "Award";
											echo "<div class='col-md-12'>";
											echo "<h3> VENDOR DETAIL </h3>"; 
											echo "<table class='table table-striped table-bordered'>";



									?>
											<tr>
												<th colspan ='2' width ='20%'>Vendor Number</th>
												<td colspan='2'><?php echo $data1['VendorID'];?></td>
											</tr>
											<tr>
												<th colspan ='2' width ='20%'>Vendor Name</th>
												<td colspan='2'><?php echo $data1['VendorName'];?></t>
											</tr>
											<tr>
												<th colspan ='2' width ='20%'>Respond Date</th>
												<td colspan='2'><?php echo date('d F Y', strtotime($data1['VendorQuotationDate']))?></td>
											</tr>
											<tr>
												<th colspan ='2' width ='20%'>Requested Item </th>
												<td>
												<?php

												$sql2 = mysqli_query($DBConn, "SELECT * FROM request_item r, code_vote c WHERE r.CodeVoteID=c.CodeVoteID AND r.RFQ_No = '".$_GET["RFQ_No"]."'");
												while ($data2 = mysqli_fetch_array($sql2))
												{
												echo $data2["CodeVoteID"]."-".$data2["ItemDesc"]."  ".$data2["ItemQuantity"]."<br>";
												}
												?>
												</td>
											</tr>
											<tr>
												<th colspan ='2' width ='20%'>Price per item</th>
												<td>RM <?php echo $data1['Price']?></td>
											</tr>
											<tr>
												<th colspan ='2' width ='20%'>Total Price</th>
												<td>RM <?php echo $data1['TotalPrice']?></td>
											</tr>
						</table>
                    </div>
					<?php
									
								}
						else
								{
								echo "";
								}
					}
			else
					{
						//echo "Pending";
					}
				
				
				?>
  	                           

					
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
