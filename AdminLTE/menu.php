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
		
		?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
.sidebar-menu ul li a{
    white-space: normal;
    word-wrap: break-word;
 }
</style>
</head>
<body>

		<?php
		if($type==0 ||$type==1 ||$type==2 ||$type==3)
		{
			?>
		<aside class="main-sidebar" >
		<section class="sidebar">
			<div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $i; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><b><?php echo $n; ?></b></p>
		  <p><small><i><?php echo $role; ?></i></small></p>
          </div>
      </div>
<ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="">
          <a id="dashboard" href="dashboard.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
         
        </li>
       
       <?php
	   if($type==0)
		{
	   ?>
        <li class="treeview">
          <a id="uid" href="#">
            <i class="fa fa-user"></i>
            <span>USERS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a id="auid" href="adduser.php"><i class="fa fa-circle-o"></i>Add User</a></li>
            <li><a id="muid" href="manageusers.php?show=all"><i class="fa fa-circle-o"></i>Manage User</a></li>
           
          </ul>
        </li>
		<?php
		}
		?>
		<li class="treeview">
          <a href="#">
            <i class="fa fa-clock-o"></i> <span>Appointments</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
         <ul class="treeview-menu">
            <li><a id="aappid" href="addapp.php"><i class="fa fa-circle-o"></i>Add Appointment</a></li>
			<?php
			if($type==1 ||$type==2)
		{
			?>
            <li><a id="mappid" href="manageapp.php?show=thisw"><i class="fa fa-circle-o"></i>Manage Appointment</a></li>
			<li><a id="mappsid" href="manageschedule.php"><i class="fa fa-circle-o"></i>Schedule</a></li>
         <?php
		}
?>		 
          </ul>
        </li>
		<li class="treeview">
          <a href="#">
            <i class="fa fa-bank"></i>
            <span>Support</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		  
			<li><a id="mfaqid" href="managefaq.php"><i class="fa fa-circle-o"></i>Search FAQ</a></li>
			<li><a id="msuppid" href="addsup.php"><i class="fa fa-circle-o"></i>Report Problem</a></li>			
			<?php
		  if($type==0 ||$type==1)
		{
		  ?>
            <li><a id="afaqid" href="addfaq.php"><i class="fa fa-circle-o"></i>Add FAQ</a></li>
			<li><a href="#"><i class="fa fa-circle-o"></i>Manage FAQ</a></li>
			<?php
		}
		?>
          </ul>
        </li>
		<?php
		  if($type==0)
		{
		  ?>
		<li class="treeview">
          <a href="#">
            <i class="fa  fa-graduation-cap"></i>
            <span>Course</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		  
			<li><a href="#"><i class="fa fa-circle-o"></i>Add Course</a></li>
			<li><a href="#"><i class="fa fa-circle-o"></i>Manage Course</a></li>
			
          </ul>
        </li>
		<?php
		}
		?>
		<?php
		  if($type==0)
		{
		  ?>
		<li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i>
            <span>Department</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		  
			<li><a href="#"><i class="fa fa-circle-o"></i>Add Department</a></li>
			<li><a href="#"><i class="fa fa-circle-o"></i>Manage Department</a></li>
			
          </ul>
        </li>
		<?php
		}
		?>
       </ul>
	   </section>
  </aside>
	   <?php
		}
		?>
</body>
</html>
	<?php
	}
	
	?>
	