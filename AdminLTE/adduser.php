<?php

	include "connection.php";
	
	session_start();

	if(!isset($_SESSION['log']))
	{
		header("location:index.php");
	}
	
	else
	{
		if(isset($_GET['flag']))
	{
		header("refresh:2 url=adduser.php");
	}
		$log = $_SESSION['log'];
		
		$qry = "SELECT * FROM tbl_login WHERE email_id='$log'";
		$result = mysqli_query($con,$qry);
		$value = mysqli_fetch_array($result);
		
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

$queryDe = "SELECT d_no,d_name FROM tbl_dept ORDER BY d_name";
$resultde = mysqli_query($con,$queryDe);
		?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CS Queue | Add User</title>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  
  
  <!-- Tell the browser to be responsive to screen width -->
 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
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
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
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
        Add User
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
        <li class="active">Add User</li>
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
						$name11 = $_POST['name'];
		$phone11 = $_POST['phone'];
		$email11 = $_POST['email'];
		$address11 = $_POST['address'];
		
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];
		
		$dob11 = $_POST['dob1'];
		
		$gender11 = $_POST['gender'];
	
		$user_type11 = $_POST['user_type'];
		$s_t11 = $_POST['s_t'];
		if($user_type11==3)
		{
			if($s_t11=="Tutor")
			{
				$user_type11=2;
			}
			else
			{
				$user_type11=3;
			}
		}
		$dept11 = $_POST['categories'];	
		
		if (!empty($_FILES['image']['name'])) 
		{
			$file = $_FILES['image']['tmp_name'];
			$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$image_name = addslashes($_FILES['image']['name']);
		
			move_uploaded_file($_FILES["image"]["tmp_name"],"photos/" . $_FILES["image"]["name"]);
			
			$location11="photos/" . $_FILES["image"]["name"];
			//$location="assignment/" . $_FILES["image"]["name"];
			touch("photos/" .$image_name);
			$rnd = mt_rand(100000, 999999);
			$rnd1 = mt_rand(1000, 99999);
			$dat = date("d-m-Y");
			$dat= str_replace("-", "", $dat);
			$dt=mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));
			$rnd.="_".$dt;
			$rnd.=$dat;
			$rnd.="_".$rnd1;
			$re=explode(".", $image_name);
			$ext = end($re);
			rename("photos/" .$image_name,"photos/".$rnd.".".$ext);
			$location11="photos/".$rnd.".".$ext;
		}
		else
		{
			$location11="photos/Default.png";
		}
		$query11 = "INSERT INTO tbl_login(login_id,email_id,phone_no,password,type,active) VALUES('','$email11','$phone11','$pass1','$user_type11','1')";
		$result = mysqli_query($con,$query11);
		
		$rowsql11 = mysqli_query($con,"SELECT login_id FROM tbl_login WHERE email_id='$email11'");
			
		$row11 = mysqli_fetch_array($rowsql11);
		$id11 = $row11['login_id'];
		
			
			$sql11 = "INSERT INTO tbl_detail(detail_id,login_id,name,dob,gender,address,profile_pic) 
				VALUES('','$id11','$name11','$dob11','$gender11','$address11','$location11')";	
			if(!mysqli_query($con,$sql11))
			{
				echo "<script>alert('Failed to add User'); window.location.href = 'adduser.php';</script>";
			}
			
			else
			{
				echo "<script>alert('User Added Successfully'); window.location.href = 'adduser.php';</script>";
				
			}
		}
						//echo "<script>alert('User Added Successfully'); window.location.href = 'adduser.php';</script>";
					
				}
			?>	
		
              <form role="form" method="POST" enctype="multipart/form-data" >
                <!-- select -->
                
				<div class="form-group">
                  <label>User Type</label>
                  <select class="form-control" name="user_type" id="u_t" title="Please Select the Item from the List" onchange="showDiv('hidden_div', this)" required>
                    <option selected hidden value="">Select Type</option>
					<option value="0">Admin</option>
					<option value="1">Professor</option>
					<option value="3">Student</option>
                  </select>
				  </div>
				 <script>
function showDiv(divId, element)
{
    document.getElementById(divId).style.display = element.value == 3 ? 'block' : 'none';
}
</script>
				<div id="hidden_div"><div class="form-group">
                <label>Student Type</label>
				<div class="form-check">
					<label>
						<input type="radio" name="s_t" id="u_op1" value="Student" checked> <span class="label-text">Student</span>
					</label>
				</div>
				<div class="form-check">
					<label>
						<input type="radio" name="s_t" id="u_op2" value="Tutor" > <span class="label-text">Tutor</span>
					</label>
				</div>
				</div></div>
				
				<div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter Name" required />
                </div>
				<!-- radio -->
				<div class="form-group">
                <label>Gender</label>
				<div class="form-check">
					<label>
						<input type="radio" name="gender" id="g_op1" value="Male" checked> <span class="label-text">Male</span>
					</label>
				</div>
				<div class="form-check">
					<label>
						<input type="radio" name="gender" id="g_op2" value="Female" > <span class="label-text">Female</span>
					</label>
				</div>
				<div class="form-check">
					<label>
						<input type="radio" name="gender" id="g_op3" value="Not Described" > <span class="label-text">Not Described</span>
					</label>
				</div>
				</div>
               
				<div class="form-group" >
                <label>Birth Date:</label>

					<div class="input-group date">
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
					<input type="text" name="dob1" class="form-control pull-right" placeholder="Enter Date of Birth" id="datepicker" autocomplete="off" required />
					</div>
					<!-- /.input group -->
				</div>
				<div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Enter Email" required />
                </div>
				<div class="form-group">
                  <label>Phone No</label>
                  <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" pattern="[2456789][0-9]{9}" oninput="setCustomValidity('')" title='Enter 10 Digit mobile
number starting with 2 or 4 or 5 or 6 or 7 or 8 or 9' maxlength="10" required />
                </div>
				<div class="form-group">
                  <label>Password</label>
                  <input type="password" name="pass1" id ="pass1" class="form-control" placeholder="Enter Password" required />
                </div>
				<div class="form-group">
                  <label>Re-Enter Password</label>
                  <input type="password" name="pass2" id="pass2" class="form-control" placeholder="Re Enter Password" oninput="check(this)" required />
					<script language='javascript' type='text/javascript'>
						function check(input) {
							if (input.value != document.getElementById('pass1').value) {
								input.setCustomValidity('Password Must be Matching.');
							} else {
								// input is valid -- reset the error message
								input.setCustomValidity('');
							}
						}
					</script>
                </div>
				<?php
				$sqldept = "SELECT d_no,d_name FROM tbl_dept ORDER BY d_name";
		$resultdept = mysqli_query($con,$sqldept);
		
				?>
				<div class="form-group">
                  <label>Select Department</label>
                  
                  <select name="categories" class="form-control" required>
				  <option selected hidden value="">Select Department</option>
<?php 
while ($valuedept = mysqli_fetch_array($resultdept))
{
    echo "<option value='".$valuedept['d_no']."'>".$valuedept['d_name']."</option>";
}
?>
</select>
                </div>
				<!-- textarea -->
                <div class="form-group">
                  <label>Address</label>
                  <textarea class="form-control" rows="3" name="address" placeholder="Enter Address" required></textarea>
                </div>    
				<div class="form-group">
                  <label>Add Profile Pic</label>
				  
                  <input type="file" id="profile-img" name="image" accept="image/png,image/jpg,image/jpeg" class="form-control" placeholder="">
					<div align="center"> 
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
                
			  <div class="box-footer" style="float:right;display: block;">
                <input type="submit" id="submit2" name="submit" value="ADD" class="btn btn-primary" formaction="adduser.php?flag=1">
              </div>
                  </div>				
              
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      <!-- /.row (main row) -->

    </section>
    
  
  
 
  <!-- /.content-wrapper -->
  <?php
	include("footer.php");
  ?>
  <!-- /.content -->
</div>
  <!-- Control Sidebar -->
   <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script>
$(document).ready(function () {
$('#datepicker').datepicker({  
	format: 'yyyy-mm-dd',
    endDate: '+1d',
    autoclose: true
});  });
//iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
</script>
<!-- jQuery 3 --><!--
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
