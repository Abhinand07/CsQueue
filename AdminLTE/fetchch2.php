<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "proto_csqueue");
$output = '';
session_start();

	if(!isset($_SESSION['log']))
	{
		header("location:index.php");
	}
	else
	{
		$log = $_SESSION['log'];
		
		$qry = "SELECT * FROM tbl_login WHERE email_id='$log'";
		$result = mysqli_query($connect,$qry);
		$value = mysqli_fetch_array($result);
		
		$id = $value['login_id'];
		
if(isset($_POST["query"]))
{
	
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 //$cor = $_GET['sel'];
 $query = "SELECT * FROM tbl_login INNER JOIN tbl_detail ON tbl_login.login_id = tbl_detail.login_id INNER JOIN tbl_dept ON tbl_detail.dept = tbl_dept.d_no INNER JOIN tbl_course ON tbl_dept.d_no = tbl_course.dept INNER JOIN tbl_c_list ON tbl_course.c_id = tbl_c_list.c_id WHERE (tbl_login.type=1 OR tbl_login.type=2) AND tbl_c_list.p_id=tbl_detail.login_id AND tbl_c_list.c_id = tbl_course.c_id AND tbl_detail.name LIKE '%".$search."%' AND (tbl_login.type=1 OR tbl_login.type=2) AND tbl_detail.login_id != ".$id." GROUP BY tbl_detail.name ORDER BY tbl_detail.name ASC";
}
else
{
	//$cor = $_GET['sel'];
 $query = "SELECT * FROM tbl_login INNER JOIN tbl_detail ON tbl_login.login_id = tbl_detail.login_id INNER JOIN tbl_dept ON tbl_detail.dept = tbl_dept.d_no INNER JOIN tbl_course ON tbl_dept.d_no = tbl_course.dept INNER JOIN tbl_c_list ON tbl_course.c_id = tbl_c_list.c_id WHERE (tbl_login.type=1 OR tbl_login.type=2) AND tbl_c_list.p_id=tbl_detail.login_id AND tbl_c_list.c_id = tbl_course.c_id AND tbl_detail.login_id != ".$id." GROUP BY tbl_detail.name ORDER BY tbl_detail.name ASC";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table-hover">
   <tr>
    <th>ID</th>
				  <th>Name</th>
				  <th>User Type</th>
				  <th>Course</th>
				  <th>Department</th>
				  <th>Level</th>
				  <th>Action</th>
   </tr>
 ';
	$seq=1;
	$r=0;
 while($row = mysqli_fetch_array($result))
 {
	 if($row['type']==1)
	 {
		 $p="Professor";
	 }
	 else
	 {
		 $p="Tutor";
	 }
  $output .= '
   <tr>
    <td>'.$seq.'</td>
    <td>'.$row['name'].'</td>
	<td>'.$p.'</td>
	<td>'.$row['c_name'].'</td>	
	<td>'.$row['d_name'].'</td>	
	<td>'.$row['level'].'</td>	
				  <td><a class="btn btn-success btn-xs" href="?sel='.$row["login_id"].'&c='.$row["c_id"].'" onclick="return confirm("sure to SELECT? '.$row["login_id"].'");">SELECT</a></td>
					</td>
   </tr>
    

  ';
  $seq++;
 }
 
 echo $output;
 $output.='
 </table>
 </div>
 ';
}
else
{
$output.='
<div class="table-responsive" >
   <table class="table table-hover">
   <tr>
    <th>ID</th>
	<th>Number</th>
				  <th>Name</th>
				  <th>User Type</th>
				  <th>Department</th>
				  <th>Action</th>
   </tr>
<tr>
<td colspan="6"><center><label>No Records</label></center></td>
</tr>
</table>
</div>
';
echo $output;
}
	}
?>