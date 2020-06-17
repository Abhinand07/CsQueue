<?php  
 if(isset($_POST["ch_id"]))  
 {  
		
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "", "proto_csqueue");  
      $query = "SELECT * FROM tbl_login INNER JOIN tbl_detail ON tbl_login.login_id=tbl_detail.login_id WHERE tbl_detail.login_id = ".$_POST["ch_id"];  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="form-group">  
           ';  
      while($row = mysqli_fetch_array($result))  
      {  
			$t=$row['type'];
						if($t==0)
						{
							$type="Admin";
						}
						if($t==1)
						{
							$type="Professor";
						}
						if($t==2)
						{
							$type="Tutor";
						}
						if($t==3)
						{
							$type="Student";
						}
           $output .= '
				<div class="form-group">
					<div align="center"> 
					  <img src="'.$row['profile_pic'].'" id="profile-img-tag" alt="Profile Pic" width="200px" height="200px" style="border:5px solid #ffffff; background-color: #ffffff;" />
					  </div>
					  </div>
				<div class="form-group">
                  <label>Name</label>
                  <input type="text" name="m_name" id="m_name" class="form-control" autocomplete="off" placeholder="Enter Parent name ..." value="'.$row['name'].'" disabled />
                </div>
				<div class="form-group">
                  <label>Email ID</label>
                  <input type="text" name="m_ei" id="m_ei" class="form-control" autocomplete="off" placeholder="Enter Parent name ..." value="'.$row['email_id'].'" disabled />
                </div>
				<div class="form-group">
                  <label>Phone Number</label>
                  <input type="text" name="m_ph" id="m_ph" class="form-control" autocomplete="off" placeholder="Enter Parent name ..." value="'.$row['phone_no'].'" disabled />
                </div>
				<div class="form-group">
                  <label>Address</label>
                  <textarea class="form-control" rows="3" name="m_desc" placeholder="Enter Address..." disabled>'.$row['address'].'</textarea>
                </div>
				<div class="form-group">
                  <label>Date-of-Birth</label>
                  <input type="text" name="m_dob" id="m_dob" class="form-control" autocomplete="off" placeholder="Enter Parent name ..." value="'.$row['dob'].'" disabled />
                </div>
				<div class="form-group">
                  <label>Gender</label>
                  <input type="text" name="m_gen" id="m_gen" class="form-control" autocomplete="off" placeholder="Enter Parent name ..." value="'.$row['gender'].'" disabled />
                </div>
				<div class="form-group">
                  <label>User Type</label>
                  <input type="text" name="m_ut" id="m_ut" class="form-control" autocomplete="off" placeholder="Enter Parent name ..." value="'.$type.'" disabled />
                </div>
           ';
      }  
      $output .= '  
           
      </div>
	  
      ';  
      echo $output;  
 }  
 ?>