

<?php

require('dbcon.php');

$id=$_GET['id'];

$sql ="SELECT * from Student WHERE Id=$id";

echo $sql;

$res = mysqli_query($conn,$sql);

$imagepath = '';
$resumepath ='';


while($row = mysqli_fetch_assoc($res))
	{
		
		$image = $row['ProfilePic'];

		$resume = $row['Resume'];

		$imagepath="Upload/".$image;
		
		$resumepath = "Upload/".$resume;
		
		unlink($imagepath);
		unlink($resumepath);	



	}

$sql = "DELETE FROM Student WHERE Id=$id";


$res = mysqli_query($conn,$sql);

header('Location:showlist.php');

?>





	
	


