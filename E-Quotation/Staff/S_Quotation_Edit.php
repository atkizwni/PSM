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
			<?php
       
				$sql = mysqli_query($DBConn, "SELECT * FROM staff WHERE StaffID='$StaffID'");
				$data = mysqli_fetch_array($sql);
			?>
			<div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
				<?php echo $data['StaffID']."-".$data['StaffName'];?> &nbsp; <a href="../index.html" class="btn btn-danger square-btn-adjust">Logout</a> 
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
						<a href="#"> Backup<span class="fa arrow"></span></a>
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
						<h2> QUOTATION </h2>
					</div>
				</div>
				<hr />
				<hr />
				<div class="row">
                    <div class="col-md-12">
						<form action="" method="post">
						<div class='panel panel-default'>
							<div class='panel-heading'>ITEM DETAIL</div>
							<div class='panel-body'>
								<table class='table'>
								<?php
       
									$sql1 = mysqli_query($DBConn, "SELECT * FROM staff, rfq WHERE rfq.StaffID=staff.StaffID AND rfq.RFQ_No='".$_GET['RFQ_No']."' ");
        							$data1 = mysqli_fetch_array($sql1);
        						?>
								<tr>
								 	<th colspan ='2' width ='20%'>Request By</th>
									<th><input type='text' style="text-transform:uppercase" class="form-control" name="StaffName" id="StaffID" readonly value="<?php echo $data['StaffID'].' - '.$data['StaffName'];?>"/></th>
								</tr>
								<tr>

									<th  colspan ='2' width ='20%'>Quotation Number</th>
									<td><input type='vachar' id='RFQ_No' name="RFQ_No" class="form-control" readonly value="<?php echo $data1['RFQ_No'];?>"/></td>
								</tr>
								
								</table>
							</div>
						</div>
						</form>
                    </div>
                </div>
                <hr/>
					<?php
									$sql2 = mysqli_query($DBConn, "SELECT COUNT(*) AS A FROM request_item WHERE RFQ_No='".$_GET['RFQ_No']."'");
									$data2 = mysqli_fetch_array($sql2);
									//echo $data2['A'];
									
							
									if($data2['A'] > 0)
									{
										
									echo "<div class='row'>";
									echo "<div class='col-md-12'>";
									echo "<form action='' method='post'>";
									echo "<div class='panel panel-default'>";
									echo "<div class='panel-heading'>QUOTATION DETAIL</div>";
									echo "<div class='panel-body'>";
									echo "<table class='table'>";
									echo "<thead>";
									echo "<tr>";
										echo "<th>Item Number</th>";
										echo "<th>Request Start Date</th>";
										echo "<th>Request End Date</th>";
										echo "<th>Item Description</th>";
										echo "<th>Quantity</th>";
										echo "<th></th>";
									echo "</tr>";
									echo "</thead>";
									echo "<tbody>";

									$sql3 = mysqli_query($DBConn, "SELECT * FROM staff s, rfq r, request_item i WHERE r.RFQ_No = i.RFQ_No AND r.StaffID = s.StaffID AND i.RFQ_No = '".$_GET["RFQ_No"]."'");
									while ($data3 = mysqli_fetch_array($sql3))
										{
											echo "<tr>";						
											echo "<td>".$data3['ItemNo']."</td>";
											echo "<td>".date('d F Y', strtotime($data3['RFQStartDate']))."</td>";
											echo "<td>".date('d F Y', strtotime($data3['RFQEndDate']))."</td>";
											echo "<td>".$data3['ItemDesc']."</td>";
											echo "<td>".$data3['ItemQuantity']."</td>";
											echo "<td>";
											echo"<a href='S_Quotation_Edit2.php?RFQ_No=".$data1['RFQ_No']."&ItemNo=".$data3['ItemNo']."' data-toggle='tooltip' data-placement='bottom' title='UPDATE'><span class='glyphicon glyphicon-pencil'></span></a>";
										}
											echo "</tr>";
											echo "</tbody>";
											echo "</table>";
											echo "</div>";
											echo "</div>";
											echo "</div>";
											echo "</div>";
									}
					?>
			</div>
        </div>
    </div>
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
