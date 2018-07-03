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

<?php
  if ($_SESSION['timeout'] + 10 * 60 < time()) {
	  echo '<META HTTP-EQUIV="Refresh" CONTENT="0.001; URL=../logout.php">';
     // session timed out
  } else {
     // session ok
  }
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
					$sql_displaysession = "SELECT * FROM staff WHERE StaffID='".$_SESSION['StaffID']."' ";
					$ds_displaysession =mysqli_query($DBConn,$sql_displaysession)or die (mysqli_error());
					$row=mysqli_fetch_assoc($ds_displaysession);
			?>
			
			<div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
				You are logged in as: <?php echo $row['StaffName']; ?> &nbsp; <a href="../logout.php" class="btn btn-danger square-btn-adjust">Logout</a> 
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
                        <a href="S_List_Of_RFQ.html"> Request For Quotation</a>
                    </li>
					<li>
                        <a href="S_Vendor_Respond.html"> Vendor Respond</a>
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
							<a class="active-menu" href="#"> Backup And Recovery<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
							<li>
								<a href="S_FullBackup.php">Full Backup</a>
							</li>
							<li>
								<a class="active-menu" href="S_Recovery.php">Recovery</a>
						</li>
						</ul>
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
                   <form action='Code_Exec_Recovery.php' method='post' enctype="multipart/form-data">
                    <div class="col-md-12">
						<h2> FULL DATA BACKUP </h2> 
                    </div>
							
							<div class='panel-body'>
								<table class='table'>
								<tr>
									<th>Data </th>
								 	<td>
								<select name='table' class='form-control'>
									<option value=''> SELECT DATA TO BE BACKUP  </option>
									<option value='code_vote'>CODE VOTE  </option>
									<option value='RFQ'>RFQ DETAIL  </option>
									<option value='request_item'>REQUEST ITEM </option>
									<option value='staff'>STAFF INFORMATION </option>
									<option value='vendor'>VENDOR INFORMATION </option>
									<option value='contact_person'> VENDOR CONTACT PERSON </option>
									<option value='vendor_vote'> VENDOR VOTE </option>
									<option value='vendor_quotation'> VENDOR RESPON</option>
									<option value='vendor_quotation_detail'> VENDOR RESPON DETAIL </option>
								</select>
									</td>
								</tr>
								<tr>
										
										<th>Backup File</th>
										<td><input type = 'file' name='csv' required/></td>
								</tr>
								<tr>
										<th></th>
										<td align ='right'><input type='submit' class'btn btn-primary btn-md' value='Import'></td>
								</tr>
								</table>
						</form>
                    </div>
                </div>
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
