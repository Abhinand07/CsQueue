<?php

	include "connection.php";
	
	session_start();
	
	if(!isset($_SESSION['log']))
	{
		header("location:index.php");
	}
	
	else
	{
		$ulog = $_SESSION['log'];
		
		$qry = "SELECT * FROM tbl_login WHERE email_id='$ulog'";
		$result = mysqli_query($con,$qry);
		$value = mysqli_fetch_array($result);
		
		$uid = $value['login_id'];
		
		$sql = "SELECT * FROM tbl_detail WHERE login_id='$uid'";
		$result1 = mysqli_query($con,$sql);
		$value1 = mysqli_fetch_array($result1);
		
		$n = $value1['name'];
		$i = $value1['profile_pic'];
		$dob = $value1['dob'];
		
		
	
?>

<?php

	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
		$qry = "SELECT * FROM tbl_login WHERE login_id='$id'";
		$result = mysqli_query($con,$qry);
		$value = mysqli_fetch_array($result);
		$em= $value['email_id'];
		$ph = $value['phone_no'];
	}
	else
	{
		$id=$uid;
		$qry = "SELECT * FROM tbl_login WHERE login_id='$id'";
		$result = mysqli_query($con,$qry);
		$value = mysqli_fetch_array($result);
		$em= $value['email_id'];
		$ph = $value['phone_no'];
	}
	if(isset($_POST['submit']))
	{
		
		$nemail = $_POST['email'];
		$nphone = $_POST['phone'];
		$g= $_POST['u_act'];
		if(isset($_GET['id']))
		{
			$update = "UPDATE tbl_login SET email_id='$nemail',phone_no='$nphone',active='$g' WHERE login_id='$id'";
				$result1 = mysqli_query($con,$update);
				//$message = "wrong answer $id";
				//echo "<script type='text/javascript'>alert('$message');</script>";
				if($result1)
				{
					header('location:manageusers.php?ep=1');
				}
			
				else
				{
					echo "Error...";
				}
		}
		else
		{
			$update = "UPDATE tbl_login SET email_id='$nemail',phone_no='$nphone',status=0 WHERE login_id='$id'";
				$result1 = mysqli_query($con,$update);
				//$message = "wrong answer $id";
				//echo "<script type='text/javascript'>alert('$message');</script>";
				if($result1)
				{
					$msg= "updated successfully and Redirecting to Verification page....";
					echo "<script type='text/javascript'>alert('$msg');</script>";
					unset($_SESSION['log']);
					session_destroy();
					session_start();
					$_SESSION['log'] = $nemail;
					header('location:dashboard.php?ep=1');
				}
			
				else
				{
					echo "Error...";
				}
		}
				
				
	}
	?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CS Queue | Change Login Credentials</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  
</head>
<body class="hold-transition skin-purple sidebar-mini sidebar-collapse">
<div class="wrapper">

  <?php
		include("head.php");
		include("menu.php");
	  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Change Login Credentials
        </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Change Login Credentials</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->

      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
	     <div class="box box-warning">
            <div class="box-header with-border">  
            </div>
            <!-- /.box-header -->
			
            <!-- form start -->
            <form role="form" method="post">
              <div class="box-body">
			  <label>*NOTE: User need to Re-verify to change Email Id or Phone Number at the time of next Login</label><br/><br/>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" value="<?php echo $em; ?>" id="exampleInputEmail1" placeholder="Enter Email" required />
                </div>
                <div class="form-group">
                  <label>Phone Number</label>
                  <input type="text" name="phone" maxlength="10" class="form-control" value="<?php echo $ph; ?>" placeholder="Enter Phone Number" pattern="[6789][0-9]{9}" oninput="setCustomValidity('')" title='Enter 10 Digit mobile
number starting with 6 or 7 or 8 or 9' required />
                </div>
              <!-- /.box-body -->
				<?php
				
	if(isset($_GET['id']))
	{
		//$g=$_GET['sel'];
		$sqlcl="SELECT type,active from tbl_login WHERE login_id=".$_GET['id']."";
		$resultcl=mysqli_query($con,$sqlcl);
		//header("location:manageclasses.php");
		$valuecl = mysqli_fetch_array($resultcl);
		$g = $valuecl['active'];
		$m = $valuecl['type'];
		?>
		<div class="form-group" id ="h1" style="display: none;">
                  <label>Status</label>
                  <select class="form-control" name="u_act" id="type" required>
                    <option selected hidden value="">Select Type</option>
					<option value="0">Inactive</option>
                    <option value="1">Active</option>
                  </select>
				  </div> 
		<script type="text/javascript">
		document.getElementById("type").value="<?php echo $g ?>";			
		var h = document.getElementById("h1");			
		h.style.display ="block";
		</script>
		<?php
		
		}
		?>
              <div class="box-footer">
                <input type="submit" name="submit" class="btn btn-primary" value="Change">
              </div>
		  	  
            </form>
          </div>
        </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
	include("footer.php");
  ?>

  <!-- Control Sidebar -->
   <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
<?php
}
?> 
