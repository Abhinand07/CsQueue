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
		
		$a = "SELECT * FROM tbl_login WHERE email_id='$ulog'";
		$aa = mysqli_query($con,$a);
		$value = mysqli_fetch_array($aa);
		
		$uid = $value['login_id'];
		
		$b = "SELECT * FROM tbl_detail WHERE login_id='$uid'";
		$bb = mysqli_query($con,$b);
		$bbb = mysqli_fetch_array($bb);
		
		$n = $bbb['name'];
		$i = $bbb['profile_pic'];
		$dob = $bbb['dob'];
		$type= $value['type'];
		
		if(isset($_GET['id']))
		{
			$id = $_GET['id'];
			$url="change.php?id=".$id;
			$sql = "SELECT * FROM tbl_login WHERE login_id='$id'";
			$result = mysqli_query($con,$sql);
			$value = mysqli_fetch_array($result);
			
			$email = $value['email_id'];
			$oldphone = $value['phone_no'];
			
			$qry = "SELECT * FROM tbl_detail WHERE login_id='$id'";
			$result1 = mysqli_query($con,$qry);
			$value1 = mysqli_fetch_array($result1);
			
		
			$name = $value1['name'];
			$dob = $value1['dob'];
			$address = $value1['address'];
			$sql1 = "SELECT profile_pic FROM tbl_detail WHERE login_id='$id'";
		$result2 = mysqli_query($con,$sql1);
		$value2 = mysqli_fetch_array($result2);
		$def =$value2['profile_pic'];

		}
		
	else
	{
			$id = $value['login_id'];
			$url="change.php";
			$email = $value['email_id'];
			$oldphone = $value['phone_no'];
			
			$qry = "SELECT * FROM tbl_detail WHERE login_id='$id'";
			$result1 = mysqli_query($con,$qry);
			$value1 = mysqli_fetch_array($result1);
		
			$name = $value1['name'];
			$dob = $value1['dob'];
			$address = $value1['address'];
			$sql1 = "SELECT profile_pic FROM tbl_detail WHERE login_id='$id'";
		$result2 = mysqli_query($con,$sql1);
		$value2 = mysqli_fetch_array($result2);
		$def =$value2['profile_pic'];
	}	
		
?>
<?php
	
	if(isset($_POST['submit']))
	{
		
		if (!empty($_FILES['image']['name'])) 
		{
			$name = $_POST['name'];
			$newphone = $_POST['phn'];
			$address = $_POST['address'];
			$dob = $_POST['dob'];
			$email = $_POST['email'];
			$file=$_FILES['image']['tmp_name'];
			$image=addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$image_name=addslashes($_FILES['image']['name']);
			
			move_uploaded_file($_FILES["image"]["tmp_name"],"photos/".$_FILES["image"]["name"]);
				
			$location="photos/" . $_FILES["image"]["name"];
			//$updated = mysqli_query($con,"UPDATE tbl_login SET email_id='$email' WHERE login_id='$id'");
			$updated2 = mysqli_query($con,"UPDATE tbl_detail SET name='$name',profile_pic='$location',address='$address',dob='$dob' WHERE login_id='$id'");
			//$updated3 = mysqli_query($con,"UPDATE tbl_login SET phone_no='$newphone' WHERE login_id='$id'");
			
			
			if($updated2)
			{
				if(isset($_GET['id']))
				{
					header("location:manageusers.php?ep=1");
				}
				else
				{
					header("location:dashboard.php?ep=1");
				}
			}
			else
			{
					echo "<font style='color:red'>Error...</font>";
			}
		}
		else
		{
			$name = $_POST['name'];
			$newphone = $_POST['phn'];
			$address = $_POST['address'];
			$dob = $_POST['dob'];
			$email = $_POST['email'];
			//$updated = mysqli_query($con,"UPDATE tbl_login SET email_id='$email',phone_no='$newphone' WHERE login_id='$id'");
			$updated2 = mysqli_query($con,"UPDATE tbl_detail SET name='$name',address='$address',dob='$dob' WHERE login_id='$id'");
			
			
			if($updated2)
			{
				if(isset($_GET['id']))
				{
					header("location:manageusers.php?ep=1");
				}
				else
				{
					header("location:dashboard.php?ep=1");
				}			
			}
			else
			{
					echo "<font style='color:red'>Error...</font>";
			}
		}
		
	}
			
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CS Queue | Edit Profile</title>
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
  <style>
	#myDiv {
	border: 2px solid lightgray;
	height:210px;
	width:210px;
	float: left;
	}
	</style>
  
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
        Edit Profile
        <?php
if($type==0)
{
	?>
	<small>Admin Panel Control</small>
	<?php
}	
else if($type==1)
{	
		?>
        <small>Professor Panel Control</small>
		<?php
}
else if($type==2)
{
	?>
	<small>Tutor Panel Control</small>
	<?php
}
else if($type==3)
{
	?>
	<small>Student Panel Control</small>
	<?php
}
		?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Profile</li>
      </ol>
    </section>
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <!-- Main row -->
      <div class="row">
	  
	  <div class="box box-warning">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<div class="box-footer" style="float:right;"><a href="<?php echo $url; ?>">
                <button type="submit" name="change" class="btn btn-primary">Change Login Credintials</button>
              </a>
			  </div>
              <form role="form" method="post" enctype="multipart/form-data" >
                <!-- text input -->
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" placeholder="Name" required />
                </div>
				<div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Email" required readonly />
                </div>
				<div class="form-group">
                  <label>Phone Number</label>
                  <input type="text" name="phone" class="form-control" value="<?php echo $oldphone; ?>" placeholder="Phone Number" pattern="[6789][0-9]{9}" oninput="setCustomValidity('')" title='Enter 10 Digit mobile
number starting with 6 or 7 or 8 or 9' required readonly />
                </div>
				
				<div class="form-group">
                <label>Birth Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="dob"  value="<?php echo $dob; ?>" placeholder="Date of Birth" class="form-control pull-right" id="datepicker" autocomplete="off" required />
                </div>
                <!-- /.input group -->
              </div>
                
                

                <!-- textarea -->
                <div class="form-group">
                  <label>Address</label>
                  <textarea class="form-control" placeholder="Address" name="address" rows="3" required ><?php echo $address; ?></textarea>
                </div>
				<div class="form-group">
                  <label>Profile Pic</label>
                  <input type="file" id="profile-img" name="image" accept="image/png,image/jpg,image/jpeg" class="form-control" placeholder="">
					<div id="myDiv" align="center"> 
						<!--<p class="square"> -->
					  <img src="<?php echo $def; ?>" id="profile-img-tag" alt="Profile Pic" width="200px" height="200px" style="border:5px solid #ffffff; background-color: #ffffff;" />


						<script type="text/javascript">
							function readURL(input) {
								if (input.files && input.files[0]) {
									var reader = new FileReader();
									
									reader.onload = function (e) {
										$('#profile-img-tag').attr('src', e.target.result);
									}
									reader.readAsDataURL(input.files[0]);
								}
							}
							$("#profile-img").change(function(){
								readURL(this);
							});
						</script>
					</div>	
					
				</div>
				
              <div class="box-footer" style="float:right;">
                <button type="submit" name="submit" class="btn btn-primary">UPDATE</button>
              </div>
			  
			  </form>
			  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
     
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
	
  </div>
  <!-- /.content-wrapper -->
  <?php
	include("footer.php");
  ?>

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
<script>
$(document).ready(function () {
$('#datepicker').datepicker({    
    endDate: '+1d',
    autoclose: true
});  });
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