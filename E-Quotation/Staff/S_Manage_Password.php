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
<script>
function myFunction()
{
var pass=document.getElementById("new").value;
var pass2=document.getElementById("confirm").value;
var ok=true;
if(pass !=pass2)
{
	document.getElementById("new").style.borderColor="#E34234";
    document.getElementById("confirm").style.borderColor="#E34234";
	ok =false;
	alert("Password doesn't match!!!");

}
else
{
	//alert("Pendaftaran berjaya disimpan!!!");

}
return ok;

}
</script>
<script>
function mouseoverPass(obj) {
  var obj = document.getElementById('old');
  obj.type = "text";
}
function mouseoutPass(obj) {
  var obj = document.getElementById('old');
  obj.type = "password";
}
function mouseoverPass2(obj) {
  var obj = document.getElementById('new');
  obj.type = "text";
}
function mouseoutPass2(obj) {
  var obj = document.getElementById('new');
  obj.type = "password";
}
function mouseoverPass3(obj) {
  var obj = document.getElementById('confirm');
  obj.type = "text";
}
function mouseoutPass3(obj) {
  var obj = document.getElementById('confirm');
  obj.type = "password";
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
                <a class="navbar-brand" href="S_Home.php">e-Procurement</a> 
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
                        <a class="" href="S_Manage_Account.php"> Profile</a>
                    </li>
					<li>
                        <a class="active-menu" href="S_Manage_Password.php"> Change Password</a>
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
                                <a href="S_List_Of_Vendors.php"> List of Vendor</a>
                            </li>
                        </ul>
                    </li>
					
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
                </ul>
            </div>
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
						<h2> PROFILE </h2>   
                        <h5>You can manage your account here. </h5>
                    </div>
                </div>
                <hr />
				<div class="row">
                    <div class="col-md-12">
						<form role="form" method="post" action="S_Manage_Password_Code.php" onSubmit="return myFunction()">  
 <fieldset> 
          <div class="form-group">
                <label for="exampleInputOld" ><font color="#FF0000">*</font> Old password :</label>
                <input class="form-control" id="old" type="password" name="old" placeholder="Enter your old password" required>
        <font size="-1" color="#000099">Show password </font><img src="../Image/visible.png" width="20" height="18" onMouseOver="mouseoverPass();" onMouseOut="mouseoutPass();">
        </div>
          <div class="form-group">
            <label for="exampleInputNew"><font color="#FF0000">*</font> New password : *Must Have only 6 letters,and 1 big case letter </label>
            <input class="form-control" name="new" type="password"  id="new" pattern="(?=.*\d)(?=.*[A-Z]).{6}" placeholder="Enter your new password" required>
         <font size="-1" color="#000099">Show password </font><img src="../Image/visible.png" width="20" height="18" onMouseOver="mouseoverPass2();" onMouseOut="mouseoutPass2();">
          </div>
         <div class="form-group">
            <label for="exampleInputConfirm"><font color="#FF0000">*</font> Confirm password :</label>
            <label for="pass"></label>
            <input class="form-control" type="password" name="confirm" id="confirm" pattern="(?=.*\d)(?=.*[A-Z]).{6}" placeholder="Re-enter your new password" required>
     <font size="-1" color="#000099">Show password </font> <img src="../Image/visible.png" width="20" height="18" onMouseOver="mouseoverPass3();" onMouseOut="mouseoutPass3();">
          </div>
          <p><font size="-1" color="#FF0000">Required (*)</font></p>
           <p><input class="btn btn-primary btn-block" type="submit" value="Save" name="save"></a>        </p>
           </fieldset>
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
