<?php

include('dbcon.php');

if(!empty($_POST["state_id"])){ 

   
    $stateid = $_POST['state_id'];

    $query = "SELECT * FROM city WHERE stateid = $stateid";  

   

    
                  $res = mysqli_query($conn,$query);
                 
                  print_r($res);
                
                  ?>
                  <option>Select City</option>
                  <?php
                  while($row = mysqli_fetch_assoc($res)) {
                        ?>
                        <option value="<?php echo $row['cityid']; ?>"><?php echo $row['cityname']; ?></option>

                        <?php 

                  }

} 

    
?>