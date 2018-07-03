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
				<?php echo $data['StaffID']."-".$data['StaffName'];?> &nbsp; <a href="../index.html"  class="btn btn-danger square-btn-adjust">Logout</a> 
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
						<h2> REQUEST NEW QUOTATION </h2>
					</div>
				</div>
				<hr />
				<div class="row">
                    <div class="col-md-12">
						<form action='S_Quotation_Edit_Update.php' method='post'>
						<div class='panel panel-default'>
							<div class='panel-heading'>QUOTATION DETAIL</div>
							<div class='panel-body'>
								<table class='table'>
									<?php
       
									$sql1 = mysqli_query($DBConn, "SELECT * FROM staff, rfq, request_item, code_vote WHERE code_vote.CodeVoteID=request_item.CodeVoteID AND rfq.StaffID=staff.StaffID AND request_item.ItemNo='".$_GET['ItemNo']."' AND rfq.RFQ_No='".$_GET['RFQ_No']."' ");
        							$data1 = mysqli_fetch_array($sql1);
        							?>
								<tr>
										<th colspan ='2' width ='20%'>Request By</th>
										<th><input type='text' style="text-transform:uppercase" class="form-control" name="StaffName" id='StaffName' readonly value="<?php echo $data1['StaffID'].' - '.$data['StaffName'];?>"/><th/>
								</tr>
								<tr>
										<th>Quotation Duration</th>
                                        <th width='10%'>Start Date</th>
										<th><input type='date' class="form-control" name="RFQStartDate" id='RFQStartDate' value="<?php echo $data1['RFQStartDate']?>" /></th>
										<script>
											var today = new Date().toISOString().split('T')[0];
											document.getElementsByName("rfqstartdate")[0].setAttribute('min', today);								
										</script>
								</tr>
                                <tr>
										<th></th>
                                        <th>End Date Date</th>
										<th><input type='date' class="form-control" name="RFQEndDate" id='RFQEndDate' value="<?php echo $data1['RFQEndDate']?>" /></th>
										<script>
											var today = new Date().toISOString().split('T')[0];
											document.getElementsByName("rfqenddate")[0].setAttribute('min', today);								
										</script>
								</tr>
                                <tr>
							    		<th colspan ='2' width ='20%'>Status</th>
                                        <th><input type='text' class="form-control" name="RFQStatus" id='RFQStatus' disabled value="<?php echo $data1['RFQStatus']?>"/></th>
  		                        </tr>
								<tr>

										<th  colspan ='2' width ='20%'>Quotation Number</th>
										<th><input type='vachar' id='RFQ_No' name="RFQ_No" class="form-control" readonly value="<?php echo $data1['RFQ_No'];?>"/></th>
								</tr>
								<tr>

										<th  colspan ='2' width ='20%'>Item Number</th>
										<th><input type='vachar' id='ItemNo' name="ItemNo" class="form-control" readonly value="<?php echo $data1['ItemNo'];?>" required/></th>								
								</tr>
								<tr>
										<th  colspan ='2' width ='20%'>Code Vote</th>
										<th><input type='vachar' id='CodeVoteID' name="CodeVoteID" class="form-control" readonly value="<?php echo $data1['CodeVoteID'].' - '.$data1['CodeVoteDesc'];?>" required/></th>	
								</tr>
								<tr>
								
										<th>Item Requested</th>
										<th width='10%'>Quantity</th>
										<th><input type="int" placeholder="Quantity" class="form-control" name="ItemQuantity" value="<?php echo $data1['ItemQuantity'];?>" required/></th>
								</tr>
										<th></th>
										<th>Item Decription</th>
										<th><input type="text" placeholder="Item Description" class="form-control" name="ItemDesc" value="<?php echo $data1['ItemDesc'];?>" required/></th>
								</tr>
								</table>
								<div align='right'>
									
									<input type='submit' name='Save' class="btn btn-default" value='Save'>
								</div>
								
							</div>
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
    <script type="text/javascript">
		$(document).ready(function () {
			$('#dataTables-example').dataTable();
		});
    </script>
    <script type="text/javascript" src="../assets/js/custom.js"></script>
    
   
</body>
</html>
