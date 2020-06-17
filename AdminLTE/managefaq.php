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
		//$c_id= $value['cl_id'];
		
		$qry = "SELECT * FROM tbl_detail WHERE login_id='$id'";
		$result1 = mysqli_query($con,$qry);
		$value1 = mysqli_fetch_array($result1);
		
		$n = $value1['name'];
		$i = $value1['profile_pic'];
		//$dob = $value1['dob'];
		$m="";
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
	
	
		
?>
				
<?php
				
	if(isset($_GET['del']))
	{
		
		$sql1="UPDATE tbl_login SET active=0 WHERE login_id=".$_GET['del']."";
		$result=mysqli_query($con,$sql1);
		header("location:manageusers.php");
	}
?>
             

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CS Queue | View FAQ</title>
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
        FAQ
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
        <li class="active">FAQ</li>
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
			<form role="form" method="POST" enctype="multipart/form-data" >
			
			<div class="box-header">
			<div class="form-group">
			<div style="float:left" class="input-group col-xs-5">
			<!--<div class="col-xs-2">-->
			
                  <span class="input-group-addon" id ="cs"><span class="glyphicon glyphicon-search"></span></span>
				  
                  <input type="text" name="class_search" id="class_search" class="form-control" autocomplete="off" placeholder="Enter Question..." value="<?php echo $m; ?>" onkeydown="a()" />
			
	
            </div>
				
  </div>
            </div>
			<!--<div class="box-header">
				<div style="float:right">
			           
  </div>
  
            </div>
            <!-- /.box-header -->

			<script>
			function a() {
					var t = document.getElementById("class_search").value;
					//var x = document.getElementById("myDIV1");
					var y = document.getElementById("div1");
					var z = document.getElementById("div2");
					if(t.value == "")
					{
						
					  y.style.display = "none";
					  if (z.style.display == "none") {
						z.style.display = "block";
						
					  }
					}
										 					
					else {
						y.style.display = "none";
						z.style.display = "block";
					  }	
				}
				
				</script>						
			<div id="div2" style="display:block">
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="tab">
                <tr>
                  <td></td><td></td><td></td>
                </tr>
				
				<?php
				
									echo "
										<script type=\"text/javascript\">
										document.getElementById('admin').className = 'btn btn-primary active';
										document.getElementById('act').className = 'btn btn-primary active';
										</script>
									";
									$query="SELECT tbl_faq.faq_id,tbl_faq.problem,tbl_faq.solution,tbl_faq.upvote,tbl_faq.downvote,tbl_faq.date,tbl_faq.valid,tbl_faq.added_by FROM tbl_faq WHERE tbl_faq.valid = 1 ORDER BY tbl_faq.date";
									
					$result2 = mysqli_query($con,$query);
					$count= mysqli_num_rows($result2);
					$seq=1;
					if($count>0)
						{
					while($value2 = mysqli_fetch_array($result2))
					{
						$query10="SELECT name,login_id FROM tbl_detail WHERE login_id = ".$value2['added_by'];
						$result10 = mysqli_query($con,$query10);
					$count10= mysqli_num_rows($result10);
					if($count10>0)
						{
							while($value10 = mysqli_fetch_array($result10))
					{
				?>
                <tr>
				<td></td>
                  <td><a><div><b><label><?php echo $value2['problem'];?></label></b><br/>
			  <label style="color:black"><?php echo $value2['solution'];?></label><br/><br/></div><br/>
			  <div><b><label>Answered by:</label></b>&nbsp;<label><?php echo $value10['name'];?></label></div></td>
				  <td><span onclick="up()" style="color:green" class="fa fa-fw fa-thumbs-o-up"></span><label><?php echo $value2['upvote'];?></label>&nbsp;<span onclick="down()" style="color:red" class="fa fa-fw fa-thumbs-o-down"></span><label><?php echo $value2['downvote'];?></label></a></td>				
				</tr>
				<tr>
				<td></td>
					<td></td><td></td>
				</tr>
				<tr><td></td><td></td><td></td></tr>
				
				<?php
					}
						}
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
                     <h4 class="modal-title">FAQ1</h4>  
                </div>  
                <div class="modal-body" id="ch_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
			<script>  
 $(document).ready(function(){
			$(document).on('click', '.view_data', function(){  
           var ch_id = $(this).attr("id");  
           if(ch_id != '')  
           {  
                $.ajax({  
                     url:"viewfaq.php",  
                     method:"POST",  
                     data:{ch_id:ch_id},  
                     success:function(data){  
                          $('#ch_detail').html(data);  
                          $('#myModal').modal('show');  
                     }  
                });  
           }            
      });  
 });
</script>
			</div></form>
            <!-- /.box-body -->
			
			<div id="div1" style="display:none">
          <div id="class_data"></div>
		  <script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetchfaq.php",
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
<div id="dataModal1" class="modal fade" role="dialog">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">User Details</h4>  
                </div>  
                <div class="modal-body" id="ch_detail1">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
			<script>  
 $(document).ready(function(){
			$(document).on('click', '.view_data1', function(){  
           var ch_id = $(this).attr("id");  
           if(ch_id != '')  
           {  
                $.ajax({  
                     url:"viewus.php",  
                     method:"POST",  
                     data:{ch_id:ch_id},  
                     success:function(data){  
                          $('#ch_detail1').html(data);  
                          $('#dataModal1').modal('show');  
                     }  
                });  
           }            
      });  
 });
</script>	  
</div>

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