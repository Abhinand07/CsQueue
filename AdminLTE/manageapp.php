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
			header("refresh:0 url=manageusers.php?show=all");
		}
		$log = $_SESSION['log'];
		
		$sql = "SELECT * FROM tbl_login WHERE email_id='$log'";
		$result = mysqli_query($con,$sql);
		$value = mysqli_fetch_array($result);
		
		$id = $value['login_id'];
		$email = $value['email_id'];
		$phone = $value['phone_no'];
		$type = $value['type'];
		
		$qry = "SELECT * FROM tbl_detail WHERE login_id='$id'";
		$result1 = mysqli_query($con,$qry);
		$value1 = mysqli_fetch_array($result1);
		
		$n = $value1['name'];
		$i = $value1['profile_pic'];
		$dob = $value1['dob'];
		$m="";
		
	
	
		
?>
<?php
				
	if(isset($_GET['show']))
	{
		
		$show=$_GET['show'];
	}
?>				
<?php
				
	if(isset($_GET['del']))
	{
		
		$sql1="UPDATE tbl_app SET active_a=0 WHERE a_id=".$_GET['del']."";
		$result=mysqli_query($con,$sql1);
		header("location:manageapp.php?show=thisw");
	}
?>
<?php
				
	if(isset($_GET['u']))
	{
		
		$sql1="UPDATE tbl_app SET a_valid=".$_GET['u']." WHERE a_id=".$_GET['g']."";
		$result=mysqli_query($con,$sql1);
		header("location:manageapp.php?show=thisw");
	}
?>
             

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CS Queue | Appointments</title>
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
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />-->

  
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
        Manage Appointments
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
        <li class="active">Manage Appointments</li>
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
		  <script>
			var q;
			function onchangea()
			{
				q="manageapp.php?show=thisw";
				location.href = q;
			}
			function onchangeb()
			{
				q="manageapp.php?show=all";
				location.href = q;
			}
			function onchangef()
			{
				var r= window.location.href;
				var w;
				var t=r.search("&a=0");
				var y=r.search("&a=1");
				if(t==-1)
				{
					if(y==-1)
					{
						w = window.location.href +"&a=1";
					}
					else
					{
						w = window.location.href;
					}
				}
				else
				{
					w=r.replace('&a=0','&a=1');
				}
				location.href = w;
			}
			
			function onchangeg()
			{
				var r= window.location.href;
				var w;
				var t=r.search("&a=1");
				var y=r.search("&a=0");
				if(t==-1)
				{
					if(y==-1)
					{
						w = window.location.href +"&a=0";
					}
					else
					{
						w = window.location.href;
					}
				}
				else
				{
					w=r.replace('&a=1','&a=0');
					
					
				}
				location.href = w;
			}
		  </script>
			<form role="form" method="POST" enctype="multipart/form-data" >
			
			<div class="box-header">
			<div class="form-group">
			<div style="float:left" class="input-group col-xs-5">
			<!--<div class="col-xs-2">-->
			
                  <span class="input-group-addon" id ="cs"><span class="glyphicon glyphicon-search"></span></span>
				  
                  <input type="text" name="class_search" id="class_search" class="form-control" autocomplete="off" placeholder="Search" value="<?php echo $m; ?>" onkeydown="a()" />
			
	
            </div>
				<div style="float:right" class="col-xs-7">
				<span style=" margin:1.25em;"><label>Type</label></span>
			  <div class="btn-group">
    <a class="btn btn-primary" id ="thisw" href="javascript:onchangea()">This Week</a>
	<a class="btn btn-primary" id ="all" href="javascript:onchangeb()">All</a>
  </div>
  <span style=" margin:1.25em;"><label>status</label></span>
	<div class="btn-group">
    <a class="btn btn-primary" id ="act" href="javascript:onchangef()">Completed</a>
	<a class="btn btn-primary" id ="nact" href="javascript:onchangeg()">Upcoming</a>
  </div>
  </div>
  </div>
            </div>
			<!--<div class="box-header">
				<div style="float:right">
			           
  </div>
  
            </div>
            <!-- /.box-header -->
			
			<div id="div2" style="display:block">
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="tab">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
				  <th>Email</th>
				  <th>course</th>
				  <th>Date</th>
                  <th>Start Time</th>
				  <th>End Time</th>
				  <th>Reason</th>
				  <th>Status</th>
                  <th>Action</th>
                </tr>
				
				<?php
					if($show == "thisw")
					{
						$cd =date("yy-m-d");
						$pd=date("yy-m-d",strtotime("+7 Days"));
						if(isset($_GET['a']))
						{
							$p=$_GET['a'];
							if($p==1)
							{
								echo "
									<script type=\"text/javascript\">
									document.getElementById('thisw').className = 'btn btn-primary active';
									document.getElementById('act').className = 'btn btn-primary active';
									</script>
								";
								$query="SELECT * FROM tbl_app INNER JOIN tbl_detail ON tbl_app.stu_id=tbl_detail.login_id INNER JOIN tbl_login ON tbl_detail.login_id=tbl_login.login_id WHERE tbl_app.a_date BETWEEN '$cd' AND '$pd' AND tbl_app.f_id='$id' AND tbl_app.a_valid=1 ORDER BY tbl_app.a_valid ASC";
							}
							else
							{
								echo "
									<script type=\"text/javascript\">
									document.getElementById('thisw').className = 'btn btn-primary active';
									document.getElementById('nact').className = 'btn btn-primary active';
									</script>
								";
								$query="SELECT * FROM tbl_app INNER JOIN tbl_detail ON tbl_app.stu_id=tbl_detail.login_id INNER JOIN tbl_login ON tbl_detail.login_id=tbl_login.login_id WHERE tbl_app.a_date BETWEEN '$cd' AND '$pd' AND tbl_app.f_id='$id' AND tbl_app.a_valid=0 ORDER BY tbl_app.a_valid ASC";
							}
						}
						else
						{
							echo "
									<script type=\"text/javascript\">
									document.getElementById('thisw').className = 'btn btn-primary active';
									</script>
								";
							$cd =date("yy-m-d");
							$pd=date("yy-m-d",strtotime("+7 Days"));
							$query="SELECT * FROM tbl_app INNER JOIN tbl_detail ON tbl_app.stu_id=tbl_detail.login_id INNER JOIN tbl_login ON tbl_detail.login_id=tbl_login.login_id WHERE tbl_app.a_date BETWEEN '$cd' AND '$pd' AND tbl_app.f_id='$id'  ORDER BY tbl_app.a_valid ASC";
						}
					}
					else
					{	
						if(isset($_GET['a']))
						{
							$p=$_GET['a'];
							if($p==1)
							{
								echo "
									<script type=\"text/javascript\">
									document.getElementById('all').className = 'btn btn-primary active';
									document.getElementById('act').className = 'btn btn-primary active';
									</script>
								";
								$query="SELECT * FROM tbl_app INNER JOIN tbl_detail ON tbl_app.stu_id=tbl_detail.login_id INNER JOIN tbl_login ON tbl_detail.login_id=tbl_login.login_id WHERE tbl_app.a_valid=1 AND tbl_app.f_id='$id' ORDER BY tbl_app.a_valid ASC";
							}
							else
							{
								echo "
									<script type=\"text/javascript\">
									document.getElementById('all').className = 'btn btn-primary active';
									document.getElementById('nact').className = 'btn btn-primary active';
									</script>
								";
								$query="SELECT * FROM tbl_app INNER JOIN tbl_detail ON tbl_app.stu_id=tbl_detail.login_id INNER JOIN tbl_login ON tbl_detail.login_id=tbl_login.login_id WHERE tbl_app.a_valid=0 AND tbl_app.f_id='$id' ORDER BY tbl_app.a_valid ASC";
							}
						}
						else
						{
							echo "
								<script type=\"text/javascript\">
								document.getElementById('all').className = 'btn btn-primary active';
								</script>
							";
							$query="SELECT * FROM tbl_app INNER JOIN tbl_detail ON tbl_app.stu_id=tbl_detail.login_id INNER JOIN tbl_login ON tbl_detail.login_id=tbl_login.login_id WHERE tbl_app.f_id='$id' ORDER BY tbl_app.a_valid ASC";
						}
					}
					$result2 = mysqli_query($con,$query); 
					$count= mysqli_num_rows($result2);
					$seq=1;
					if($count>0)
						{
					while($value2 = mysqli_fetch_array($result2))
					{
						$query10="SELECT * FROM tbl_course WHERE c_id=".$value2['c_id'];
						$result10 = mysqli_query($con,$query10);
						$count10= mysqli_num_rows($result10);
						$value10 = mysqli_fetch_array($result10);
						$u=$value2['a_valid'];
						$u2=$value2['active_a'];
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
                  <td><?php echo $seq;?></td>
                  <td><?php echo $value2['name'];?></td>
                  <td><?php echo $value2['email_id'];?></td>
				  <td><?php echo $value10['c_name'];?></td>
				  <td><?php echo $value2['a_date'];?></td>
				  <td><?php echo $value2['s_time'];?></td>
				  <td><?php echo $value2['e_time'];?></td>
				  <td><?php echo $value2['reason'];?></td>
				  <td><?php echo $u1;?></td>
				  <td>
				  <?php
				  if($u2==1)
				  {
				  ?>
				  <a class="btn btn-success btn-xs" data-toggle="modal" class="anc" data-target="#dataModal" id="<?php echo $value2['a_id'];?>">EDIT</a> &nbsp;&nbsp;
				  
				  <a class="btn btn-danger btn-xs" href="?del=<?php echo $value2['a_id'];?>" 
					onclick="return confirm('sure to delete?');">DELETE</a>
					<?php
					}
					?>
					</td>
					
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
			
			<div id="dataModal" class="modal fade" role="dialog">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Update</h4>  
                </div>  
                <div class="modal-body" id="ch_detail"> 
				<div class="form-group">
                  <label>Meeting Status</label>
                  <select class="form-control" name="user_type" id="aa_t" required>
                    <option selected hidden value="">Select Type</option>
					<option value="0">Pending</option>
					<option value="1">Complete</option>
                  </select>
				  </div>
                </div> 
<script>
 function up(val)
 {
	 var fd=document.getElementsByClassName("btn btn-success btn-xs")[0].id;
	 w = window.location.href +"&u="+val+"&g="+fd;
	 location.href = w;
 }
 </script>				
                <div class="modal-footer">
<button type="button" class="btn btn-warning" onclick="up(aa_t.value)">Update</button>&nbsp; &nbsp;				
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>
 
			</div></form>
            <!-- /.box-body -->
          <!-- /.box -->
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

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 --><!--
<script src="bower_components/jquery/dist/jquery.min.js"></script>-->  
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
				echo "<script> alert('Profile Updated successfullyyy...'); </script>";
			}
		}
	
	}
	
?>