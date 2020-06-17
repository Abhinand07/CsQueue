<?php

	include "connection.php";
		
	session_start();
	
	if(!isset($_SESSION['log']))
	{
		header("location:index.php");
	}
	
	else
	{
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];
		
		$dob = $_POST['dob1'];
		
		$gender = $_POST['gender'];
	
		$user_type = $_POST['user_type'];
		$cl_id = $_POST['class_search'];	
		
		if (!empty($_FILES['image']['name'])) 
		{
			$file = $_FILES['image']['tmp_name'];
			$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$image_name = addslashes($_FILES['image']['name']);
		
			move_uploaded_file($_FILES["image"]["tmp_name"],"photos/" . $_FILES["image"]["name"]);
			
			$location="photos/" . $_FILES["image"]["name"];
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
			$location="photos/".$rnd.".".$ext;
		}
		else
		{
			$location="photos/Default.png";
		}
		
		if($user_type=="0" || $user_type=="1" || $user_type=="2" || $user_type=="3")
		{
			
		$query = "INSERT INTO tbl_login(login_id,email_id,phone_no,password,status,type,active) VALUES('','$email','$phone','$pass1','0','$user_type','1')";
		
		$result = mysqli_query($con,$query);
		
		$rowsql = mysqli_query($con,"SELECT login_id FROM tbl_login WHERE email_id='$email'");
			
		$row = mysqli_fetch_array($rowsql);
		$id = $row['login_id'];
		
			
			$sql = "INSERT INTO tbl_detail(detail_id,login_id,name,dob,gender,address,profile_pic) 
				VALUES('','$id','$name','$dob','$gender','$address','$location')";
				
			if(!mysqli_query($con,$sql))
			{
				echo "Not inserted...";
			}
			
			else
			{
				echo "inserted successfully....";
				
				header("refresh:0; url=adduser.php?flag=1");
				
			}
		}
		else
		{
			echo "Not inserted... 1";
		}
	}
?>