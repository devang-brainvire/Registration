 



<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="style.css">
  
  <title>Show List</title>

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>


<body>


<form class="searchform" action="" method="post">

  <input type="text" name="search" placeholder="Search Record"  >

  <input type="submit" name="submit" value="Search" class="btn btn-primary" >

</form>




<table class="table" id="dtBasicExample">
  

  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">FirstName</th>
      <th scope="col">LastName</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Profilepic</th>
      <th scope="col">Resume</th>
      <th scope="col">Birthdate</th>
      <th scope="col">Gender</th>
      <th scope="col">Address</th>
      <th scope="col">State</th>
      <th scope="col">City</th>
      <th scope="col">Category</th>
      <th scope="col">Action</th>


    </tr>
  </thead>

  <?php

  require('dbcon.php');

  $searchvalue  = "";

  $searchvalue=$_POST["search"];



  if($searchvalue == "")
  {
  
    if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 1;

        $offset = ($pageno-1) * $no_of_records_per_page;


        $total_pages_sql = "SELECT COUNT(*) FROM Student";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM Student LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($res_data)){
          ?>
          <tbody>
        <tr>

          <td><?php echo $row['Id'];  ?></td>
          <td><?php echo $row['FirstName'];?></td>
          <td><?php echo $row['LastName'];?></td>
          <td><?php echo $row['Email'];?></td>
          <td><?php echo $row['Phone'];?></td>
          <td><img height=100 width="100" src="<?php echo "Upload/".$row['ProfilePic']; ?>"></td>
          <td><a href="<?php echo "Upload/".$row['Resume']; ?>"><?php echo $row['Resume']; ?></a></td>  

          <td><?php echo $row['Birthdate'];?></td>

          <td><?php echo $row['Gender'];?></td>
          <td><?php echo $row['Address'];?></td>
          <td><?php echo $row['State'];?></td>
          <td><?php echo $row['City'];?></td>
          <td><?php echo $row['Category'];?></td>
          <td><button style="padding:3px;background: red;"><a style="color:#ffffff;" href="delete.php?id=<?php echo $row['Id']; ?>">Delete</a></button>
          <button style="padding:3px;background:green;margin-top: 5px;width:55px;"><a style="color:white;" href="update.php?id=<?php echo $row['Id']; ?>">Edit</a></button></td>    

        </tr>
         <?php

        }
        mysqli_close($conn);
        ?>



  </tbody>
</table>
<?php
  }
    else{





     $sql="select * from Student where FirstName like '%$searchvalue%'";

     $res=mysqli_query($conn,$sql);



     while($row = mysqli_fetch_array($res)) {
      ?>
      <tbody>
        <tr>

          <td><?php echo $row['Id'];?></td>
          <td><?php echo $row['FirstName'];?></td>
          <td><?php echo $row['LastName'];?></td>
          <td><?php echo $row['Email'];?></td>
          <td><?php echo $row['Phone'];?></td>
          <td><img height=100 width="100" src="<?php echo "Upload/".$row['ProfilePic']; ?>"></td>
          <td><a href="<?php echo "Upload/".$row['Resume']; ?>"><?php echo $row['Resume']; ?></a></td>  

          <td><?php echo $row['Birthdate'];?></td>

          <td><?php echo $row['Gender'];?></td>
          <td><?php echo $row['Address'];?></td>
          <td><?php echo $row['State'];?></td>
          <td><?php echo $row['City'];?></td>
          <td><?php echo $row['Category'];?></td>


        </tr>
        <?php

      }       

    }

    ?>




<ul class="pagination">
        <li><a href="?pageno=1"></a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><?php echo $total_pages - 1; ?></a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"><?php echo $total_pages; ?></a>
        </li>
        <?php

        $i=1;
        while($i <= $total_pages )
        {
          ?>
            <li><a href="?pageno=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    
        <?php
        }
        ?>
    </ul>
</body>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
$.noConflict();
jQuery( document ).ready(function( $ ) {
    $('#dtBasicExample').DataTable({
      "pagingType": "simple"
    });

});
// Code that uses other library's $ can follow here.
</script>

</body>
</html>