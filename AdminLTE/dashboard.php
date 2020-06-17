<?php

	include "connection.php";
	
	session_start();
	
	if(!isset($_SESSION['log']))
	{
		header("location:index.php");
	}
	
	else
	{
		if(isset($_GET['ep']))
		{
			header("refresh:2 url=dashboard.php");
		}
		$log = $_SESSION['log'];
		
		$sql = "SELECT login_id,type FROM tbl_login WHERE email_id='$log'";
		$result = mysqli_query($con,$sql);
		$value = mysqli_fetch_array($result);
		
		$id = $value['login_id'];
		//$c_id = $value['cl_id'];
		$type = $value['type'];
		if($type==0)
		{
			$role="Admin";
		}
	if($type==1)
	{
		$role="Professor";
	}
	if($type==2)
	{
		$role="Tutor";
	}
	if($type==3)
	{
		$role="Student";
	}
			
		$qry = "SELECT * FROM tbl_detail WHERE login_id='$id'";
		$result1 = mysqli_query($con,$qry);
		$value1 = mysqli_fetch_array($result1);
		$n = $value1['name'];
		$i = $value1['profile_pic'];
		//$dob = $value1['dob'];
		
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CS Queue | Dashboard</title>
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
</head>
<body id="mid" class="hold-transition skin-purple-light sidebar-mini" onload="myFunction()">
<div class="wrapper">
	<?php
		if($type==1 || $type==0 || $type==3)
		{
		include("head.php");
		}
		else
		{
		include("head2.php");
		?>
		
		
	<?php
			
		}
	?>
    <?php
		include("menu.php");
	  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
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
        <li><a href="dashboard.php" class="active"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	  
	  <br/>
        <?php
		
			$count1 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(login_id) FROM tbl_login WHERE type=0 AND active=1 AND login_id != '$id'"));
		$count2 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(login_id) FROM tbl_login WHERE type=1 AND active=1 AND login_id != '$id'"));
		$count3 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(login_id) FROM tbl_login WHERE type=2 AND active=1 AND login_id != '$id'"));
		$count4 = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(login_id) FROM tbl_login WHERE type=3 AND active=1 AND login_id != '$id'"));
		?>
		<?php
		if($type==0 || $type==1 || $type==2 || $type==3)
		?>
		<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <a id="us1" href="manageusers.php?show=professor&a=1">
		  <div class="small-box bg-aqua">
           <div class="inner">
              <h3><?php echo $count2[0];  ?></h3>

              <p>Total Professor</p>
            </div>
            <div class="icon">
              <i class="ion ion-user"></i>
            </div>
          </div></a>
        </div>
		<?php
		}
		if($type==0 || $type==1 || $type==3 || $type==2)
		{
		?>
		<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <a id="us2" href="manageusers.php?show=tutor&a=1">
		  <div class="small-box bg-red">
           <div class="inner">
              <h3><?php echo $count3[0];  ?></h3>

              <p>Total Tutors</p>
            </div>
            <div class="icon">
              <i class="ion ion-user"></i>
            </div>
          </div></a>
        </div>
        <!-- ./col -->
		<?php
		}
		if($type==0 || $type==1 || $type==2)
		{
		?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
		  <a id="us3" href="manageusers.php?show=student&a=1">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $count4[0];  ?></h3>

              <p>Total Student</p>
            </div>
            <div class="icon">
              <i class="ion ion-user"></i>
            </div>
          </div></a>
        </div>
        <!-- ./col -->
		<?php
		}
			if($type==0 || $type==1 || $type==2 || $type==3)
			{
		?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
		  <a id="us4" href="manageusers.php?show=admin&a=1">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $count1[0];  ?></h3>

              <p>Total Admin</p>
            </div>
            <div class="icon">
              <i class="ion ion-user"></i>
            </div>
            </div></a>
        </div>
		<?php
		}
		?>
        <!-- ./col -->
        
        <!-- ./col -->
      </div>
	  
		<?php
					
	
		?>
		 
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        </div>
      <!-- /.row (main row) -->
	<section class="content">
      <!-- Small boxes (Stat box) -->
       <div class="row">
	   <div class="box box-warning">
            <div class="box-header with-border">
			<label>Appoitment Notification</label>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<?php
				if(isset($_GET['flag'])){
				if($_GET['flag']==1)
					{
						echo "<center><font style='color:green; text-align:center'>User Added Successfully</font></center><br/>";
					
					}
				}
			?>	
		
              <form role="form" method="POST" enctype="multipart/form-data" >
                <!-- select -->
				<div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="tab">
			  <tr>
				  <th>course</th>
				  <th>Date</th>
                  <th>Start Time</th>
				  <th>End Time</th>
				  <th>Status</th>
                </tr>
                <tr>
                  <td></td><td></td><td></td><td></td><td></td>
                </tr>
				
				<?php
				if($type==3)
				{
					$query="SELECT * FROM tbl_app INNER JOIN tbl_detail ON tbl_app.stu_id=tbl_detail.login_id INNER JOIN tbl_login ON tbl_detail.login_id=tbl_login.login_id WHERE tbl_app.stu_id='$id' ORDER BY tbl_app.a_date DESC";
				}
				else
				{
					$query="SELECT * FROM tbl_app INNER JOIN tbl_detail ON tbl_app.stu_id=tbl_detail.login_id INNER JOIN tbl_login ON tbl_detail.login_id=tbl_login.login_id WHERE tbl_app.f_id='$id' OR tbl_app.stu_id='$id' ORDER BY tbl_app.a_date DESC";
				}	
					$result2 = mysqli_query($con,$query);
					$count= mysqli_num_rows($result2);
					$seq=1;
					if($count>0)
						{
					while($value2 = mysqli_fetch_array($result2))
					{
						$query10="SELECT * FROM tbl_course WHERE c_id=".$value2['c_id']."";
						$result10 = mysqli_query($con,$query10);
						$count10= mysqli_num_rows($result10);
						$value10 = mysqli_fetch_array($result10);
						$u=$value2['a_valid'];
	 if($u==1)
	 {
	 $u1="Completed";
	 }
	 else
	 {
	 $u1="Upcoming";
	 }
				?>
                <tr>
				  <td><?php echo $value10['c_name'];?></td>
				  <td><?php echo $value2['a_date'];?></td>
				  <td><?php echo $value2['s_time'];?></td>
				  <td><?php echo $value2['e_time'];?></td>
				  <td><?php echo $u1;?></td>				
				</tr>
				<tr>
				<td></td><td></td><td></td><td></td><td></td>
				</tr>
				<?php
					$seq++;
					}
					}
						else
					{
						?>
						<td colspan="8"><center><label>No Records</label></center></td>
						<?php
					}
					?>
					

              </table>
            </div>				
								
              
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      <!-- /.row (main row) -->

    </section>
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

	if(isset($_GET['ep']))
	{
	if($_GET['ep']==1)
	{
		echo "<script> alert('Profile Updated successfully'); </script>";
	}
	if($_GET['ep']==2)
	{
		echo "<script> alert('Classes Updated successfully'); </script>";
	}
	
	}
	
?>