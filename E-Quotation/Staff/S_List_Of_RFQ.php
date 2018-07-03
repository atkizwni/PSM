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
                   <form action='' method='post'>
                    <div class="col-md-12">
						<h2> LIST OF QUOTATION </h2> 
                    </div>
                </div>
                <hr />
				<div class="row">
                    			<div class="col-md-12">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Quotation No</th>
								<th>Request Date</th>
								<th>Employee</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
   
						 <?php
							$row = mysqli_query($DBConn,"SELECT * FROM rfq r, staff s WHERE s.StaffID=r.StaffID AND s.StaffID='$StaffID' ORDER BY RFQ_No");
       							while ($data = mysqli_fetch_array($row))
{
								echo "<tr>";						
								echo "<td>".$data['RFQ_No']."</td>";
								echo "<td>".date('d F Y', strtotime($data['RFQEndDate']))."</td>";
								echo "<td>".$data['StaffName']."</td>";
								echo "<td>".$data['RFQStatus']."</td>";
								echo "<td>";
								echo "<a href='S_Quotation_Detail.php?RFQ_No=".$data['RFQ_No']."' data-toggle='tooltip' data-placement='bottom' title='VIEW'><span class='glyphicon glyphicon-file'></span></a>";
								
								if($data['RFQStatus']=='Pending')
								{
									echo"<a href='S_Quotation_Edit.php?RFQ_No=".$data['RFQ_No']."'' data-toggle='tooltip' data-placement='bottom' title='UPDATE'><span class='glyphicon glyphicon-pencil'></span></a>";
								
									echo"<a href='S_Quotation_Publish.php?RFQ_No=".$data['RFQ_No']."'' data-toggle='tooltip' data-placement='bottom' title='PUBLISH'><span class='glyphicon glyphicon-ok'></span></a>";
								}
								echo "</td>";			
								echo "</tr>";
}
  							
						?>
							
						</tbody>
						</table>
                    </div>
                </div>
				<div class="row">
                                 <div class="col-md-12" align='center'>
						<!--<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">
							REQUEST NEW QUOTATION
						</button>-->
						<a href='S_Quotation_Add.php' class="btn btn-primary btn-md"> REQUEST NEW QUOTATION </a>
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
