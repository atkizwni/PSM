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
			<ul class =" nav navbar-top-links navbar-right">
			<div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
			<?php
			$sql_displayname = "SELECT * FROM staff WHERE StaffID='".$_SESSION['StaffID']."' ";
			$dn_displayname =mysqli_query($DBConn,$sql_displayname)or die (mysqli_error());
			$row=mysqli_fetch_assoc($dn_displayname);
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
                        <a href="S_List_Of_RFQ.php"> Request For Quotation</a>
                    </li>
					<li>
                        <a class="active-menu" href="S_Vendor_Respond.php"> Vendor Respond</a>
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
						<h2> VENDOR RESPOND </h2> 
                    </div>
                </div>
                <hr />
				<div class="row">
                    <div class="col-md-12">
						<form name='vendorrespond' action='S_Vendor_Compare1.php' method='post'>
						<table class='table table-striped table-bordered table-hover' id='dataTables-example'>
						<thead>
							<tr>
								<th></th>
								<th>RFQ No</th>
								<th>Vendor Id</th>
								<th>Vendor Name</th>
								<th>Respond Date</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						
						<?php 
							$stmt ="SELECT * FROM vendor v, vendor_quotation r WHERE r.VendorID = v.VendorID AND r.VendorQuotationStatus='Pending' ORDER BY r.RFQ_No";
							//$stmt ="SELECT *  FROM vendor v, vendor_quotation r, staff s, rfq f
									//WHERE r.VendorID = v.VendorID AND f.StaffID = s.StaffID AND s.StaffID = '$StaffID' AND r.VendorQuotationStatus='Pending' 
									//ORDER BY r.RFQ_No";
							$run	= $DBConn->query($stmt);
							$kira = 0;
							while($row = mysqli_fetch_assoc($run))
							{
								echo "<tr>";
								echo "<td><input type='checkbox' class='single-checkbox' name='compare".$kira."'  value='".$row['VendorQuotationNo']."'></td>";
								echo "<td>".$row['RFQ_No']."</td>";
								echo "<td>".$row['VendorID']."</td>";
								echo "<td>".$row['VendorName']."</td>";
								echo "<td>".$row['VendorQuotationDate']."</td>";
								echo "<td>".$row['VendorQuotationStatus']."</td>";
								echo "<td>";
								if($row["VendorQuotationStatus"] == 'Pending') {
								echo "<a href='S_Vendor_Rejected_Update.php?VendorQuotation=".$row["VendorQuotationNo"]."' data-toggle='tooltip' data-placement='bottom' title='REMOVE'><span class='glyphicon glyphicon-remove'></span></a>";
								}
								echo "</td>";
								
								/*echo '<td><a href="Code_exec_ListRFQ.php?CP='.$row['RFQ_NO'].'" data-toggle="tooltip" 		
								data-placement="bottom" title="EDIT"><span class="glyphicon glyphicon-pencil"></span></a>
								</td>';
								echo "</tr>"; */
								$kira = $kira + 1;
							}	
							
							echo "<input type='text' name='bil' value='$kira' hidden>";
							echo "</tbody>";
							echo "</table>";
							echo "* Maximum three(3) vendor respond only.";
							echo "<div align='right'>";
								echo "<input type='submit' class='btn btn-primary btn-md' id='comparebtn' value='Compare' />";
							echo "</div>";
							
						?>
						
						</thead>	
						</tbody>
						</table>
						<div align='right'>
							<!--<button class="btn btn-primary btn-md" width='100px' value="Compare"></button>-->
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
	<script type="text/javascript" src="../assets/js/dataTables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="../assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
		$(document).ready(function () {
			$('#dataTables-example').dataTable();
		});
		
		$('.single-checkbox').on('change', function() {
		   if($('.single-checkbox:checked').length > 3) {
			   this.checked = false;
		   }
		});
    </script>
    <script type="text/javascript" src="../assets/js/custom.js"></script>
    
</body>
</html>
