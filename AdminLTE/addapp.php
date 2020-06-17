<?php

	include "connection.php";
	
	session_start();

	if(!isset($_SESSION['log']))
	{
		header("location:index.php");
	}
	
	else
	{
		//if(isset($_GET['flag']))
	//{
		//header("refresh:2 url=adduser.php");
	//}
		$log = $_SESSION['log'];
		
		$qry = "SELECT * FROM tbl_login WHERE email_id='$log'";
		$result = mysqli_query($con,$qry);
		$value = mysqli_fetch_array($result);
		$rr=0;
		$id = $value['login_id'];
		$pass = $value['password'];
		$type = $value['type'];
		//$c_id= $value['cl_id'];
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
		$sql = "SELECT * FROM tbl_detail WHERE login_id='$id'";
		$result1 = mysqli_query($con,$sql);
		$value1 = mysqli_fetch_array($result1);
		
		$n = $value1['name'];
		$i = $value1['profile_pic'];
		//$dob = $value1['dob'];

		$sql1 = "SELECT profile_pic FROM tbl_detail WHERE login_id=0";
		$result2 = mysqli_query($con,$sql1);
		$value2 = mysqli_fetch_array($result2);
		$def =$value2['profile_pic'];
		$g="";
		$m="";
		$addr="";
		$name="";
		$j="";
		$h="";
		if(isset($_GET['sel']))
	{
		$f=$_GET['sel'];
		$sql1w = "SELECT * FROM tbl_detail WHERE login_id=".$f;
		$result2w = mysqli_query($con,$sql1w);
		$value2w = mysqli_fetch_array($result2w);
		$name =$value2w['name'];
		$addr=$value2w['address'];
	}
?>
<?php
$e1="";
							if(isset($_GET['d']))
							{
								$e1=$_GET['d'];
							}
						?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CS Queue | Book Appointment</title>
  <link rel="stylesheet" type="text/css" href="dist/bootstrap-clockpicker.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <!-- daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- Bootstrap time Picker -->
  <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    
    <link href="plugins/time/css/timepicki.css" rel="stylesheet">
  <link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
<!--<style>
				@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");



input[type="checkbox"], input[type="radio"]{
	position: absolute;
	right: 9000px;
}

/*Check box*/
input[type="checkbox"] + .label-text:before{
	content: "\f096";
	font-family: "FontAwesome";
	speak: none;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	line-height: 1;
	-webkit-font-smoothing:antialiased;
	width: 1em;
	display: inline-block;
	margin-right: 5px;
}

input[type="checkbox"]:checked + .label-text:before{
	content: "\f14a";
	color: #2980b9;
	animation: effect 250ms ease-in;
}

input[type="checkbox"]:disabled + .label-text{
	color: #aaa;
}

input[type="checkbox"]:disabled + .label-text:before{
	content: "\f0c8";
	color: #ccc;
}

/*Radio box*/

input[type="radio"] + .label-text:before{
	content: "\f10c";
	font-family: "FontAwesome";
	speak: none;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	line-height: 1;
	-webkit-font-smoothing:antialiased;
	width: 1em;
	display: inline-block;
	margin-right: 5px;
}

input[type="radio"]:checked + .label-text:before{
	content: "\f192";
	color: #8e44ad;
	animation: effect 250ms ease-in;
}

input[type="radio"]:disabled + .label-text{
	color: #aaa;
}

input[type="radio"]:disabled + .label-text:before{
	content: "\f111";
	color: #ccc;
}

/*Radio Toggle*/

.toggle input[type="radio"] + .label-text:before{
	content: "\f204";
	font-family: "FontAwesome";
	speak: none;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	line-height: 1;
	-webkit-font-smoothing:antialiased;
	width: 1em;
	display: inline-block;
	margin-right: 10px;
}

.toggle input[type="radio"]:checked + .label-text:before{
	content: "\f205";
	color: #16a085;
	animation: effect 250ms ease-in;
}

.toggle input[type="radio"]:disabled + .label-text{
	color: #aaa;
}

.toggle input[type="radio"]:disabled + .label-text:before{
	content: "\f204";
	color: #ccc;
}


@keyframes effect{
	0%{transform: scale(0);}
	25%{transform: scale(1.3);}
	75%{transform: scale(1.4);}
	100%{transform: scale(1);}
}
#hidden_div {
    display: none;
}
				</style>
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
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
        Book appointment
        <?php
if($type==0)
{
	?>
	<small>Admin Control Panel</small>
	<?php
}
if($type==1)
{
	?>
	<small>Professor Control Panel</small>
	<?php
}
if($type==2)
{
	?>
	<small>Tutor Control Panel</small>
	<?php
}
if($type==3)
{
	?>
	<small>Student Control Panel</small>
	<?php
}
		?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Book Appointment</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
       <div class="row">
	   <div class="box box-warning">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<?php
				if(isset($_GET['flag'])){
				if($_GET['flag']==1)
					{
						$dt1 = $e1;
						$dt11 = strtotime('Y-m-d',$dt1);
		$stime11 = $_POST['timepicker1'];
$etime1 = strtotime("+15 minutes", strtotime($stime11));
$etime11 = date('h:i', $etime1);
$rea11 = $_POST['reason'];
		//$day11 = date('l', strtotime($dt11));
		//echo $day11;
		$query11 = "INSERT INTO tbl_app(a_id,stu_id,f_id,c_id,a_date,s_time,e_time,reason,a_valid) VALUES('','$id','$_GET[sel]','$_GET[c]','$_GET[d]','$stime11','$etime11','$rea11','0')";
			
			if(!mysqli_query($con,$query11))
			{
				echo "<script>alert('Failed to add Appointment'); window.location.href = 'addapp.php';</script>";
			}
			
			else
			{
				echo "<script>alert('Appointment Added Successfully'); window.location.href = 'addapp.php';</script>";
				
			}
		
						//echo "<script>alert('Appointment Added Successfully'); window.location.href = 'addapp.php';</script>";
					}
				}
			?>	
		
              <form role="form" method="POST" enctype="multipart/form-data" >
                <!-- select -->
				<div class="form-group">
				<div class="form-check">
				<label>*NOTE: Search by name of professor or tutor</label>
					<label>Search Name</label>
                  <div id="search_area">
                  <input type="text" name="class_search" id="class_search" class="form-control" autocomplete="off" placeholder="Search" value="<?php echo $g; ?>" />
				  </div>
				  <br />
				  <br />
				  <div id="class_data"></div>
<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetchch2.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#class_data').html(data);
   }
  });
 }
 $('#class_search').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>
				</div>
				</div>
				
				<div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?php echo $name; ?>" disabled required />
                </div>
				<!-- textarea -->
                <div class="form-group">
                  <label>Address</label>
                  <textarea class="form-control" rows="3" name="address" placeholder="Enter Address" disabled required><?php echo $addr; ?></textarea>
                </div>
				<?php
				if(isset($_GET['sel']))
				{
				?>
				<div class="form-group" >
                <label>Appointment Date:</label>

					<div class="input-group date">
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
					<input type="text" name="cdate" class="form-control pull-right" id="datepicker" placeholder="Enter Appointment Date" onchange="day(this.value)" autocomplete="off" required value="<?php echo $e1; ?>" />
					</div>
					</div>
					<script>
					function day(val)
					{
						var r= window.location.href;
						var w;
						var y="<?php echo $e1;?>";
						var z="&d="+y;
						var t=r.search(z);
						if(t==-1)
						{
								w = window.location.href +"&d="+val;
						}
						else
						{
							var zz="&d="+val;
							w=r.replace(z,zz);
						}
						location.href = w;
					}
					</script>
					<?php
					if(isset($_GET['d']))
					{
						$unixTimestamp = strtotime($_GET['d']);
						$j=date("l",$unixTimestamp);
						$h=$_GET['sel'];
						$query11="SELECT * FROM tbl_appsche WHERE login_id = '$h' AND day='$j' AND valid=1";
						$result11 = mysqli_query($con,$query11);
					$count11= mysqli_num_rows($result11);
					if($count11>0)
						{
					while($value11 = mysqli_fetch_array($result11))
					{
						$rr=1;
					?>
				    <div class="form-group">
                  <label>Appointment Time</label>
                  
				  <div class="input-group date">
				  <div class="input-group-addon">
						<i class="fa fa-clock-o"></i>
					</div>
	    <input id="timepicker1" type="text" name="timepicker1" class="form-control pull-right" id="datepicker" placeholder="Enter Appointment Date" autocomplete="off" required />
            </div>
				  <?php
					}
						}
						else
						{
							?>
					<div class="form-group">
                  <label>Appointment Time Not Found. Select appropriate date to book particular appointment.</label>
            </div>
			<?php
				}
				}}
				?>
					<div class="form-group">
                  <label>Reason</label>
                  <textarea class="form-control" rows="3" name="reason" placeholder="Enter Reason" required></textarea>
                </div>
				<?php
				if($rr==1)
					{
						$u="http://";
						$u.= $_SERVER['HTTP_HOST'];
						$u.= $_SERVER['REQUEST_URI'];
						$u.="&flag=1";
						?>
			  <div class="box-footer" style="float:right;display: block;">
                <input type="submit" id="submit2" name="submit" value="ADD" class="btn btn-primary" formaction="<?php echo $u; ?>">
              </div>
			  
                  </div>
			  <?php
					}
					?>				
              
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      <!-- /.row (main row) -->

    </section>
  <!-- /.content-wrapper -->
  
  <!-- /.content -->
</div>
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
$(document).ready(function () {
$('#datepicker').datepicker({
	format: 'yyyy-mm-dd',
   startDate:'+0',
    endDate: '+7d',
    autoclose: true
});  });
</script>
<script src="plugins/time/js/jquery.min.js"></script>
    <script src="plugins/time/js/timepicki.js"></script>
	<?php
	$query12="SELECT * FROM tbl_appsche WHERE login_id = '$h' AND day='$j' AND valid=1";
						$result12 = mysqli_query($con,$query12);
					$count12= mysqli_num_rows($result12);
					if($count12>0)
						{
					while($value12 = mysqli_fetch_array($result12))
					{
	?>
	<script>
	$('#timepicker1').timepicki({show_meridian:false,step_size_minutes:15,min_hour_value:<?php echo json_encode((int)$value12['s_th']) ?>,max_hour_value:<?php echo json_encode((int)$value12['e_th']) ?>,overflow_minutes:true,start_time: ["<?php echo json_encode((int)$value12['s_th']) ?>", "<?php echo json_encode((int)$value12['s_tm']) ?>"],end_time: ["<?php echo json_encode((int)$value12['e_th']) ?>", "<?php echo json_encode((int)$value12['e_tm']) ?>"]});
    </script>
	<?php
					}
						}
	?>
	<script src="js/bootstrap.min.js"></script>
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
<!-- bootstrap time picker -->
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
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
