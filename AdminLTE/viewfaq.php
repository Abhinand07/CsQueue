<?php  
 if(isset($_POST["ch_id"]))  
 {  
		echo $_POST["ch_id"];
		echo "a";
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "", "proto_csqueue");  
      $query = "SELECT * FROM tbl_faq INNER JOIN tbl_detail ON tbl_faq.added_by=tbl_detail.login_id WHERE tbl_detail.login_id = ".$_POST["ch_id"];  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="form-group">  
           ';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '
				<div class="form-group">
				<label>Question</label>
				<hr/>
				<div class="form-group">
                  <label>"'.$row['problem'].'"</label>
                </div>
				<label>Solution</label>
				<hr/>
				<div class="form-group">
                  <label>"'.$row['solution'].'"</label>
                </div>
				<div class="form-group">
                  <label>Answered By: "'.$row['name'].'"</label>
                </div>
				<div class="form-group">
                  <label>Helpful?</label>
                </div>
           ';
      }  
      $output .= '  
           
      </div>
	  
      ';  
      echo $output;  
 }  
 ?>