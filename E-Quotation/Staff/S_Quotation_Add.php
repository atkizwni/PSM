<?php
		session_start();
		require_once("../connection.php");
		
	if(!isset($_SESSION["StaffID"]) && empty($_SESSION["StaffID"]))
	{
		header("location:../index.php");
		exit;
	}
	else
		$StaffID = $_SESSION["StaffID"];
?>

<!--<?php
  if ($_SESSION['timeout'] + 10 * 60 < time()) {
	  echo '<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=../logout.php">';
     // session timed out
  } else {
     // session ok
  }
?>-->

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
                <a class="navbar-brand" href="../index.html">e-Procurement</a> 
            </div>
			<div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
			<?php
			$sql_displayname = "SELECT * FROM staff WHERE StaffID='".$_SESSION['StaffID']."' ";
			$dn_displayname =mysqli_query($DBConn,$sql_displayname)or die (mysqli_error());
			$row=mysqli_fetch_assoc($dn_displayname);
			?>
				You are logged in as: <?php echo $row['StaffName'];?>&nbsp; <a href="../index.php" class="btn btn-danger square-btn-adjust">Logout</a> 
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
						<h2> REQUEST NEW QUOTATION </h2>
					</div>
				</div>
				<hr />
				<div class="row">
                    <div class="col-md-12">
						<form action='S_Quotation_Add_Insert.php' method='post'>
						<div class='panel panel-default'>
							<div class='panel-heading'>QUOTATION DETAIL</div>
							<div class='panel-body'>
								<table class='table'>
								
								<tr>
									<th colspan ='2' width='20%'>Request By</th>
                                    <th><input type='text' style="text-transform:uppercase" class="form-control" id="StaffName" readonly value="<?php echo $row['StaffID'] .' - ' .$row['StaffName']?>"/></th>
								</tr>
								<tr>
									<th>Quotation Duration</th>
                                     <th>Start Date</th>
                                     <td><input type='date' class="form-control" id="RFQStartDate" name="RFQStartDate"></td>
								</tr>
                                <tr>
									<th></th>
                                     <th>End Date</th>
                                     <td><input type='date' class="form-control" id="RFQEndDate" name="RFQEndDate"></td>
								</tr>
                                <tr>
							        <th>Status</th>
                                     <th></th>
                                      <td><input type='text' class="form-control" id="RFQStatus" disabled value='PENDING'></td>
  		                        </tr>
								<tr>
									<th  colspan ='2' width ='20%'>Code Vote</th>
									<th><select name="CodeVoteID" class='form-control' >
									<option value=''>SELECT CODE VOTE</option>
								<?php
									$sql ="SELECT * FROM code_vote";
									$run	= $DBConn->query($sql);
									while ($data = mysqli_fetch_assoc($run))
									{
									echo "<option value='".$data["CodeVoteID"]."'>".$data["CodeVoteID"]." - ".$data["CodeVoteDesc"]."</option>";
									}
								?>
									</select>
									</th>
								</tr>
								</table>
								<div align='right'>
									<input type='submit' class="btn btn-default" value='Save'>
								</div>
							</div>
						</div>
						</form>
                    </div>
                </div>
                <hr />
				
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
