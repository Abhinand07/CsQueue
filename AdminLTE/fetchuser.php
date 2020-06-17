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
 $query = "
  SELECT tbl_login.active,tbl_login.email_id,tbl_login.login_id,tbl_login.type,tbl_login.phone_no,tbl_detail.name,tbl_detail.profile_pic FROM tbl_login INNER JOIN tbl_detail ON tbl_login.login_id=tbl_detail.login_id
  WHERE (tbl_login.email_id LIKE '%".$search."%' 
  OR tbl_login.phone_no LIKE '%".$search."%'
  OR tbl_detail.name LIKE '%".$search."%')
  AND tbl_detail.login_id != ".$id." ORDER BY tbl_detail.name ASC
 ";
}
else
{
 $query = "
  SELECT * FROM tbl_login INNER JOIN tbl_detail ON tbl_login.login_id=tbl_detail.login_id WHERE tbl_detail.login_id != ".$id." AND tbl_detail.login_id != ".$id." ORDER BY tbl_detail.name ASC
 ";
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
				  <th>Email</th>
				  <th>Phone</th>
                  <th>Profie Pic</th>
                  <th>Type</th>
				  <th>Status</th>
                  <th>Action</th>
   </tr>
 ';
 $seq=1;
 while($row = mysqli_fetch_array($result))
 {
	 $type="";
	 $ph="";
   if($row['type']==0)
	{
		$type="Admin";
	}
	if($row['type']==1)
	{
		$type="Professor";
	}
	if($row['type']==2)
	{
		$type="Tutor";
	}
	if($row['type']==3)
	{
		$type="Student";
	}
	if($row['phone_no']==0)
	{
		$ph="-";
	}
	else
	{
		$ph=$row['phone_no'];
	}
	$u=$row['active'];
	 if($u==1)
	 {
	 $u1="Active";
	 }
	 else
	 {
	 $u1="Non-Active";
	 }
  $output .= '
   <tr>
   <td>'.$seq.'</td>
    <td>'.$row["name"].'</td>
	<td>'.$row["email_id"].'</td>
	<td>'.$ph.'</td>
    <td><img src="'.$row['profile_pic'].'" height="50" width="50" border="1px" alt="profile pic"></img></td>
    <td>'.$type.'</td>
	<td>'.$u1.'</td>
	<td>
	<button type="button" class="btn btn-info btn-xs view_data1" data-toggle="modal" id="'.$row['login_id'].'">VIEW</button>&nbsp;&nbsp;
	<a class="btn btn-success btn-xs" href="editprofile.php?id='.$row["login_id"].'" 
					onclick="return confirm("sure to edit?");">EDIT</a> &nbsp;&nbsp;
				  <a class="btn btn-danger btn-xs" href="?del='.$row["login_id"].'" 
					onclick="return confirm("sure to delete?");">DELETE</a></td>
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
 <div class="table-responsive">
   <table class="table table-hover">
   <tr>
    <th>ID</th>
                  <th>Name</th>
				  <th>Email</th>
				  <th>Phone</th>
                  <th>Profie Pic</th>
                  <th>Type</th>
				  <th>Status</th>
                  <th>Action</th>
   </tr>
   <tr>
   <td colspan="7"><center><label>No Records</label></center></td>
   </tr>
   </table>
</div>
';
echo $output;
}
	}
?>