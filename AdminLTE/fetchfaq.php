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
		
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM tbl_faq
  WHERE (tbl_faq.problem LIKE '%".$search."%' 
  OR tbl_faq.solution LIKE '%".$search."%')
   AND tbl_faq.valid = 1 ORDER BY tbl_faq.problem ASC
 ";
}
else
{
 $query = "SELECT tbl_faq.problem,tbl_faq.solution,tbl_faq.upvote,tbl_faq.date,tbl_faq.valid FROM tbl_faq WHERE tbl_faq.valid = 1 ORDER BY tbl_faq.date ASC";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table-hover">
   <tr>
    <td></td><td></td><td></td>
   </tr>
 ';
 $seq=1;
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
				<td></td>
                  <td><a><div><b><label><?php echo $value2['problem'];?></label></b><br/>
			  <label style="color:black"><?php echo $value2['solution'];?></label><br/><br/></div></a></td>
				  <td><?php echo $value2['upvote'];?></td>				
				</tr>
				<tr><td></td><td></td><td></td></tr>
    

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
    <tr><td></td><td></td><td></td></tr>
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