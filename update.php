
<link rel="stylesheet" type="text/css" href="style.css">
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script
src="https://code.jquery.com/jquery-3.5.1.min.js"
integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
crossorigin="anonymous"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<title>Update</title>




<?php

require('dbcon.php');

$id =$_GET['id'];

echo $id;

if(isset($_POST['submit']))
{

  $fname=$_POST['first_name'];

  $lname=$_POST['last_name'];             

  $email=$_POST['email'];

  $phone=$_POST['phone'];

  $password=$POST['password'];

  $hash =password_hash($password,  
    PASSWORD_DEFAULT); 

  


      //profile pic

  $profile_name = $_FILES['profilepic']['name'];

  $profile_size = $_FILES['profilepic']['size'];

  $profile_tmp = $_FILES['profilepic']['tmp_name'];

  $profile_type = $_FILES['profilepic']['type'];

  $profilepic= $profile_name;

  $timestamp=date("mdYHis");

  
   move_uploaded_file($profile_tmp,"Upload/".$timestamp.''.$profilepic);

  $propic = $timestamp.''.$profilepic;
      //resume 

  $Resume_name = $_FILES['resume']['name'];

  $Resume_size = $_FILES['resume']['size'];

  $Resume_tmp = $_FILES['resume']['tmp_name'];

  $Resume_type = $_FILES['resume']['type'];





  $resume=$Resume_name;
  
  move_uploaded_file($Resume_tmp,"Upload/".$resume);

  $birthdate=$_POST['birthday'];

  $gender=$_POST['gender'];

  $address = $_POST['address'];

  $city = $_POST['city'];
  
  $category = $_POST['category']; 

  $state = $_POST['statevalue'];

  $city = $_POST['cityvalue'];

  $select="SELECT * from `Student` where Email ='$email'";

  $res=mysqli_query($conn,$select);


  if (mysqli_num_rows($res) > 0) 
  {

    $row = mysqli_fetch_assoc($res);

        if($email == isset($row['Email'])) //check email apc_exists(keys)
        {
         echo "email already exists";
       } 

     }
     else{

     $update = "UPDATE Student SET FirstName = '$fname' , LastName ='$lname' , Email = '$email' , Phone = '$phone', Password = '$hash' ,ProfilePic = '$propic' , Resume = '$resume',Birthdate = '$birthdate',Gender ='$gender', Address = '$address' , City = '$city' , State ='$state', City='$city' WHERE ID = $id ";


      $result = mysqli_query($conn,$update);

      header('Location:showlist.php');



    }
  }
  else{

  	echo "hi";

  	$sql = "Select * from Student where id=$id";


  	$res = mysqli_query($conn,$sql);

  	while ($row = mysqli_fetch_assoc($res)) {
  	 	
  	 	$fn = $row['FirstName'];
  	 	$ln = $row['LastName'];
  	 	$email = $row['Email'];
  	 	$phone = $row['Phone'];
  	 	$birthdate = $row['Birthdate'];
  	 	$gender = $row['Gender'];
  	 	$address = $row['Address'];
  	 	$state = $row['State'];
  	 	$city = $row['City'];
  	 	$category = $row['Category'];

  	 	echo $address;
  	 	echo $category;

  	 	  	 	
  	 } 

  }
  
  ?>


  <div class="maincontainer">
    <div class="row centered-form">
      <div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><b>Update</b></h3>
          </div>
          <div class="panel-body">
            <form  role="form" method="post" name="RegisterForm" onsubmit="return validateForm()" enctype="multipart/form-data" >
              <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                  <div class="form-group">
                    <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name" value="<?php 
                    if($fn != null)
                    {
                    	echo $fn;
                    }
					?>" required="">
                  </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                  <div class="form-group">
                    <input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name" required=""
                    value="<?php 
                    if($ln != null)
                    {
                    	echo $ln;
                    }
					?>">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" required=""
                value="<?php 
                    if($email != null)
                    {
                    	echo $email;
                    }
					?>">
              </div>

              <div class="form-group">
                <input type="number" name="phone" id="phone" class="form-control input-sm" placeholder="Phone" required="" value="<?php 
                    if($phone != null)
                    {
                    	echo $phone;
                    }
					?>">
              </div>



              <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                  <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" required="">
                  </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                  <div class="form-group">
                    <input type="password" name="confirmPassword" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password" required="">
                  </div>
                </div>
              </div>


                <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                  <div class="form-group">
                    <div class="aboveatar"><label> Select profile pic: </label><input type="file"  name="profilepic"  id="profilepic" class="form-control input-sm" required="" accept="image/*" /></div>
                    <img id = "myid"  src = "#" alt = "new image" />
                  </div>
                </div>





              

              <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                <div class="avatar"><label>Upload Resume: </label><input type="file" name="resume" accept="application/pdf" required="" class="form-control input-sm" /></div>
              </div>  
              </div>
              </div>              

              <div class="row">

              <div class="col-xs-6 col-sm-6 col-md-6">

              <div class="form-group">
               <label for="birthday">Birthday:</label><br>
               <input type="date" id="birthday" name="birthday" class="form-control input-sm" required=""
               value="<?php 
                    if($birthdate != null)
                    {
                    	echo $birthdate;
                    }
					?>">
             </div>
              </div>

              <div class="col-xs-6 col-sm-6 col-md-6">

             <div class="form-group" >
              <div class="gender">
              <label>Gender:</label>


              <input type="radio" name="gender"
              <?php if (isset($gender) && $gender=="male") echo "checked";?>
              value="male"  required="">Male

              <input type="radio" name="gender"   
              <?php if (isset($gender) && $gender=="female") echo "checked";?>
              value="female">Female

              <input type="radio" name="gender"
              <?php if (isset($gender) && $gender=="other") echo "checked";?>
              value="other">Other
            </div>
          </div>
            </div>
          </div>

            <div class="form-group">
              <label for="exampleFormControlTextarea1">Address</label>
              <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="3" required="" value="<?php 
                    if($address != null)
                    {
                    	echo $address;
                    }
					?>"></textarea >
            </div>



            <div class="row">
              <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                  <label>State <span style="color:red">*</span></label>
                  <select class="form-control" name="state" id="state"     required="">
                   <option selected>Select State</option>
                   <?php 
                  // Include the database config file 

                  // Fetch all the country data 
                   $query = "SELECT * FROM state";
                   $res = mysqli_query($conn,$query);
                   while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row['stateid']; ?>"><?php echo $row['statename']; ?></option>
                    <?php

                  }   

                  ?>

                </select>
              </div>
            </div>







            <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                <label>City <span style="color:red">*</span></label>
                <select class="form-control" name="city" id="city" required="">
                  <option selected>Select City</option>

                </select>
              </div>
            </div>

          </div>

          <div class="form-group">
            <label>Category</label><br>
            <select class="form-select" name="category" aria-label="Default select example" required="">
              <option selected>Select Category</option>
              <option value="Open">Open</option>
              <option value="SEBC">SEBC</option>
              <option value="SC">SC</option>
              <option value="IT">IT</option>
            </select>
          </div>

          <input type="hidden" id="statevalue" name="statevalue" value="" />
          
          <input type="hidden" id="cityvalue" name="cityvalue" value="" />



          <input type="submit" name="submit" value="submit" class="btn btn-info btn-block">

        </form>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">

  function validateForm() {
    var confirmPassword = document.forms["RegisterForm"]["confirmPassword"].value;
    var password = document.forms["RegisterForm"]["password"].value;

    if(password != confirmPassword)
    {
      alert('password should be match');
      return false;
    }
    return true;


  }


</script>
<script type="text/javascript">

  $('#state').on('change', function(){
    var stateID=$(this).val();
    
    document.getElementById("statevalue").value = $(this).find('option:selected').text();


    if(stateID){
      $.ajax({
        type:'POST',
        url:'ajaxData.php',
        data:'state_id='+stateID,
        success:function(html){
          $('#city').html(html);
        }
      }); 
    }else{
      $('#city').html('<option value="">Select state first</option>'); 
    }
  });

  $('#city').on('change', function(){

    
    document.getElementById("cityvalue").value = $(this).find('option:selected').text();

  });

</script>
<script type="text/javascript">
function display(input) {

   if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(event) {
         $('#myid').attr('src', event.target.result);
      }
      reader.readAsDataURL(input.files[0]);
   }
}

$("#profilepic").change(function() {
   display(this);
});
</script>


