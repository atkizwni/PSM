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
					$stmt = mysqli_query($DBConn, "SELECT * FROM staff where StaffID='$StaffID'");
					$data = mysqli_fetch_array($stmt);
				?>
			
			<div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
				<?php echo $data['StaffName']; ?> &nbsp; <a href="../logout.php" class="btn btn-danger square-btn-adjust">Logout</a> 
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
                        <a href="S_vendor_Respond.php"> Vendor Respond</a>
                    </li>
                    <li>
                        <a class="active-menu" href="#"> Vendor<span class="fa arrow"></span></a>
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
						<h2> VENDOR VOTE </h2>
                    </div>
                </div> 
                <hr />
				<div class='panel panel-default'>
					<div class='panel-heading'>VENDOR VOTE DETAIL</div>
					<div class='panel-body'>
						<form action= 'S_Vendor_Vote_Insert.php' method="post" enctype="multipart/form-data">
						<?php 
							$stmt = mysqli_query($DBConn, "SELECT * FROM vendor WHERE VendorID='".$_GET['VendorID']."'");
							$row = mysqli_fetch_array($stmt);
						?>
						
							<table class='table'>
							<tr>
								<th colspan ='2' width='20%'>Vendor ID</th>
								<td><input type='text' name='VendorID' class="form-control" value="<?php echo $row ['VendorID'];?>" readonly />
							</tr>
							<tr>
								<th>Vendor Name</th>
								 <th></th>
								 <td><input type='text' name='VendorName' class="form-control" value="<?php echo $row ['VendorName'];?>" readonly />
							</tr>
							<tr>
								<th  colspan ='2' width ='20%'>Code Vote</th>
								<td><select name="CodeVoteID" class='form-control'>
								<option value=''>SELECT CODE VOTE</option>
							<?php							
								$sql = mysqli_query($DBConn, "SELECT * FROM code_vote WHERE CodeVoteID NOT IN (SELECT CodeVoteID FROM vendor_vote WHERE VendorID = '".$_GET["VendorID"]."' )");
								while ($data = mysqli_fetch_array($sql))
								{
								echo "<option value='".$data["CodeVoteID"]."'>".$data["CodeVoteID"]." - ".$data["CodeVoteDesc"]."</option>";
								}
							?>
								</select>
								</td>
							</tr>
							<tr>
								<th  colspan ='2' width ='20%'></th>
								<td align='right'>
									<input type='submit' class='btn btn-primary btn-md' id='Submitbtn' value='Submit' />
								</td>
							</tr>
							</table>
							<div align='right'>
								<!--<input type='submit' class="btn btn-default" value='Save'>-->
							</div>
						</form>
					</div>
				</div>
				<hr/>
                <div class="row">
                    <div class="col-md-12">
						<div class='panel panel-default'>
							<div class='panel-heading'>VENDOR VOTE DETAIL</div>
							<div class='panel-body'>
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<tr>
										<th>Vendor ID</th>
										<th>Vendor Name</th>
										<th>Code Vote</th>
										
									</tr>
								</thead>
								<tbody>
									<?php 
										$stmt = mysqli_query($DBConn,"SELECT * FROM vendor v, vendor_vote e , code_vote c WHERE v.VendorID = e.VendorID AND c.CodeVoteID = e.CodeVoteID AND  v.VendorID='".$_GET['VendorID']."'");
										while($row = mysqli_fetch_array($stmt))
										{
											echo "<tr>";
												echo "<td>".$row['VendorID']."</td>";
												echo "<td>".$row['VendorName']."</td>";
												echo "<td>".$row['CodeVoteID']." - ".$row['CodeVoteDesc']."</td>";
												
												/*echo "<td>";
													echo "<a href='' data-toggle='tooltip' data-placement='tooltip' title='EDIT'><span class='glyphicon glyphicon-pencil'></span></a>";
													echo "<a href='S_vendor_Detail.php?VendorID=".$row["VendorID"]."' data-toggle='tooltip' data-placement='bottom' title='VIEW'><span class='glyphicon glyphicon-file'></span></a>";
												echo "</td>";
											echo "</tr>"; 
											/*echo '<td><a href="" data-toggle="tooltip" data-placement="bottom" title="EDIT"><span class="glyphicon glyphicon-pencil"></span></a></td>';
											echo "</tr>"; */
										}
									?>
									</tbody>
									</table>
							</div>
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