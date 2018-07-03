<?php
	require_once("../connection.php");
	session_start();
	if(!isset($_SESSION["VendorID"]) && empty($_SESSION["VendorID"] ))
	{
		header("location:../index.html");
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
                <a class="navbar-brand" href="../V_Home.php">e-Procurement</a> 
            </div>
			<?php
       
				$sql = mysqli_query($DBConn, "SELECT * FROM vendor WHERE VendorID='$VendorID'");
				$data = mysqli_fetch_array($sql);
			?>
			<div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
				<?php echo $data['VendorID']."-".$data['VendorName'];?>  &nbsp; <a href="index.html"class="btn btn-danger square-btn-adjust">Logout</a> 
			</div>
        </nav>   
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
					<li class="text-center">
						<img src="../Image/vendor.jpeg" class="user-image img-responsive"/>
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
						<h2> QUOTATION DETAIL </h2> 
                    </div>
                </div>
                <hr />
				<div class="row">
                    <div class="col-md-12">
						<h3> QUOTATION DETAIL </h3> 
						<table class='table table-striped table-bordered table-hover'>
							  <?php

								$sql = mysqli_query($DBConn, "SELECT * FROM staff s, rfq r, request_item i WHERE r.RFQ_No = i.RFQ_No AND r.StaffID = s.StaffID AND i.RFQ_No = '".$_GET["RFQ_No"]."'");
								$data = mysqli_fetch_array($sql);

							  ?>
											<tr>
												<th colspan ='2' width ='20%'>Quotation Number</th>
												<th><?php echo $data['RFQ_No']?></th>
											</tr>
											<tr>
												<th colspan ='2' width ='20%'>Quotation Date</th>
												<th><?php echo date('d F Y', strtotime($data['RFQStartDate']))?>  -  <?php echo date('d F Y', strtotime($data['RFQEndDate']))?> </th>
											</tr>
											<tr>
												<th colspan ='2' width ='20%'>Request By</th>
												<th><?php echo $data['StaffID']?> - <?php echo $data['StaffName']?></th>
											</tr>
											<tr>
												<th colspan ='2' width ='20%'>Item Requested</th>
												<th><?php echo $data['ItemQuantity']?> - <?php echo$data['ItemDesc']?> <br>
											</th>
											</tr>
											</table>
                    </div>
                </div>
                <hr />
									<?php
									if($data['RFQStatus']=='Publish')
										{
											$sql = mysqli_query($DBConn, "SELECT v.VendorID, v.VendorName, i.VendorQuotationDate, i.VendorQuotationStatus, r.ItemDesc, r.ItemQuantity, r.CodeVoteID, r.ItemNo, b.Price, b.TotalPrice FROM vendor v,vendor_quotation i, request_item r, vendor_quotation_detail b WHERE r.RFQ_No = '".$_GET["RFQ_No"]."'");
											$data = mysqli_fetch_array($sql);
											
											//echo "Publish ";
											if($data['VendorQuotationStatus']=='Award')
											{
											//echo "Award";
											echo "<div class='col-md-12'>";
											echo "<h3> VENDOR DETAIL </h3>"; 
											echo "<table class='table table-striped table-bordered'>";
									?>
				
											<tr>
												<th colspan ='2' width ='20%'>Vendor Number</th>
												<th colspan='2'><?php echo $data['VendorID'];?></th>
											</tr>
											<tr>
												<th colspan ='2' width ='20%'>Vendor Name</th>
												<th colspan='2'><?php echo $data['VendorName'];?></th>
											</tr>
											<tr>
												<th colspan ='2' width ='20%'>Respond Date</th>
												<th colspan='2'><?php echo date('d F Y', strtotime($data['VendorQuotationDate']))?></th>
											</tr>
											<tr>
												<th colspan ='2' width ='20%'>Requested Item </th>
												<th>
												<?php

												$sql2 = mysqli_query($DBConn, "SELECT * FROM request_item r, code_vote c WHERE r.CodeVoteID=c.CodeVoteID AND r.RFQ_No = '".$_GET["RFQ_No"]."'");
												while ($data2 = mysqli_fetch_array($sql2))
												{
												echo $data2["ItemDesc"]." - ".$data2["ItemQuantity"]."<br>";
												}
												?>
												</th>
											</tr>
											<tr>
												<th colspan ='2' width ='20%'>Price per item</th>
												<th>RM <?php echo $data['Price']?></th>
											</tr>
											<tr>
												<th colspan ='2' width ='20%'>Total Price</th>
												<th>RM <?php echo $data['TotalPrice']?></th>
											</tr>
						</table>
                    </div>
					<?php
									
								}
						else
								{
								//echo "";
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
    <script type="text/javascript" src="../assets/js/custom.js"></script>
    
   
</body>
</html>
