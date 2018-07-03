
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Quotation</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/css/custom.css" rel="stylesheet" />
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
	
<script type="text/javascript">

  function checkPassword(str)
  {
    // at least one number, one lowercase and one uppercase letter
    // at least six characters
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
    return re.test(str);
  }
</script>
<script type="text/javascript">

  function checkForm(form)
  { 
    if(form.StaffPassword.value != "" ) 
	{
      if(form.StaffPassword.value.length < 6) 
	  {
        alert("Error: Password must contain at least six characters!");
        form.StaffPassword.focus();
		return false;
      }
      re = /[0-9]/;
      if(!re.test(form.StaffPassword.value)) 
	  {
        alert("Error: password must contain at least one number (0-9)!");
        form.StaffPassword.focus();
        return false;
      }
	  ree = /[a-z]/;
      if(!ree.test(form.StaffPassword.value)) 
	  {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        form.StaffPassword.focus();
        return false;
      }
      reee = /[A-Z]/;
      if(!reee.test(form.StaffPassword.value)) 
	  {
        alert("Error: password must contain at least one uppercase letter (A-Z)!");
        form.StaffPassword.focus();
        return false;
      }
    } 
	else 
	{
      alert("Error: Please check that you've entered valid password!");
	  form.StaffPassword.focus();
	  return false;
    }

    alert("You entered a valid password!");
    return true;
  }
</script>

<script type="text/javascript">
	var specialKeys = new Array();
	specialKeys.push(8); //Backspace
	function IsNumeric3(e) {
	var keyCode = e.which ? e.which : e.keyCode
	var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
	document.getElementById("error3").style.display = ret ? "none" : "inline";
	return ret;
	}
</script>

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
                <a class="navbar-brand" href="S_Home.php">e-Quotation</a> 
            </div>
			<!--<div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
			<?php
					//$sql_displaysession = "SELECT * FROM staff WHERE StaffID='".$_SESSION['StaffID']."' ";
					//$ds_displaysession =mysqli_query($DBConn,$sql_displaysession)or die (mysqli_error());
					//$row=mysqli_fetch_assoc($ds_displaysession);
			?>
			
			You are logged in as: <?php echo $row['StaffName'];?> &nbsp; <a href="../logout.php" class="btn btn-danger square-btn-adjust" onClick="return confirm ('Are you sure to logout?');">Logout</a> 
			</div>-->
        </nav>   
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <!--<ul class="nav" id="main-menu">
					<li class="text-center">
						<img src="../Image/Utem_A.png" class="user-image img-responsive"/>
					</li>
                    <li>
                        <a href="S_Home.php"> Home</a>
                    </li>
                    <li>
                        <a href="S_Manage_Account.php"> Profile</a>
                    </li>
					<li>
                        <a href="S_List_Of_RFQ.php"> Request For Quotation</a>
                    </li>
					<li>
                        <a href="S_Vendor_Respond.php"> Vendor Respond</a>
                    </li>
                    <li>
                        <a href="#"> Vendor<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="S_Register_Vendor.php"> Register Vendor</a>
                            </li>
                            <li>
                                <a href="S_List_Of_Vendors.php"> List of Vendor</a>
                            </li>
                        </ul>
                    </li>
					<li>
						<a class="active-menu" href="#"> Staff<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li>
								<a class="active-menu" href="S_Register_Staff.php">Register Staff</a>
							</li>
							<li>
								<a href="S_List_Of_Staffs.php">List of Staffs</a>
							</li>
						</ul>
						<li>
							<a class="" href="#"> Backup And Recovery<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
							<li>
								<a href="S_FullBackup.php">Full Backup</a>
							</li>
							<li>
								<a href="S_Recovery.php">Recovery</a>
						</li>
						</ul>
					</li>
					</li>
                </ul>-->
            </div>
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
				<div class="row">
                    <div class="col-md-12">
						<h2>REGISTER CLIENT</h2>   
                        <h5>You can register new client here. </h5>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-12">
						<form name="registerstaff" action="S_Register_Staff_Code.php" method="post" onsubmit="return checkForm(this);">
						
         
           <p align="center" style="color:#F00"><span  id="error3" style="colour:Red; display:none" /><br>* Please insert numbering format</b> </span></p>
						<!--<div class="form-group">
							<label>Staff ID:</label>
							<input name ="StaffID" class="form-control" placeholder="Please enter the staff ID: S01" />
						</div>-->
						<div class="form-group">
							<label>Client Username:<span class="text-danger">*</span></label>
							<input name ="StaffUsername" class="form-control" placeholder="Please enter the staff username" required="required"/>
						</div>
						<div class="form-group">
							<label>Client Password:<span class="text-danger">*</span></label>
						<input type="password" name="StaffPassword" class="form-control" placeholder="Please enter the staff password: Password must at least contain 6 characters, 1 UPPERCASE, 1 lowercase & 1 number" required="required"/>
						<!--<span id="error" style="color: Red; display: none">* Input password (6 digits)</span>-->
						
						</div>
						<div class="form-group">
							<label>Client Name:<span class="text-danger">*</span></label>
							<input name ="StaffName" class="form-control" placeholder="Please enter the staff name" required="required"/>
						</div>
						<div class="form-group">
							<label>Client Office No:</label>
							<input name ="StaffOfficeNo" class="form-control" placeholder="Please enter the staff office no" onKeyPress="return IsNumeric3(event);" ondrop="return false;" required>
						</div>
						<div class="form-group">
							<label>Client Phone No:<span class="text-danger">*</span></label>
							<input name ="StaffPhoneNo" class="form-control" placeholder="Please enter the staff phone no" onKeyPress="return IsNumeric3(event);" ondrop="return false;" required>
						</div>
						<div class="form-group">
							<label>Client Email:<span class="text-danger">*</span></label>
							<input name ="StaffEmail" class="form-control" placeholder="Please enter the staff email" required="required"/>
						</div>
						<div align='right'>
							<input type='submit' class='btn btn-default' value='Register'>
							<input type='reset' class='btn btn-default' value='Reset'>
						</div>
						<!--<div class="form-group">
							<label>Staff Position:<span class="text-danger">*</span></label>
							<input name ="StaffPosition" class="form-control" placeholder="Please enter the staff position" required="required"/>
						</div>
						<div class="form-group">
							<label>Staff PTJ:<span class="text-danger">*</span></label>
							<input name ="StaffPTJ" class="form-control" placeholder="Please enter the staff PTJ" />
							<div style="margin:5px;" class="btn-toolbar">
										<div class="btn-group">
										  <select name='StaffPTJ' class = 'form-control'> 
											<?php
													$query = "SELECT distinct(StaffPTJ) FROM staff";
													$RUN = $DBConn-> query($query);
													while($row = mysqli_fetch_assoc($RUN))
													{
											?>
													<option value="<?php echo $row["StaffPTJ"];?>"><?php echo $row["StaffPTJ"];?></option>
											<?php

													}
											?>
										  </select>
										</div>
							</div>
						</div>-->
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
	<script type="text/javascript" src="../assets/js/custom.js"></script>
	
</body>
</html>