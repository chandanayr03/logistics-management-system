<?php
require('db.php');
$a=$_SESSION['username'];
// If form submitted, insert values into the database.

$c=$_GET['id'];


$query1="DELETE from users where id = '$c'"; 




$result1 = mysqli_query($con,$query1); // selecting data through mysql_query()
if($result1===TRUE){
    ?>
		<script type="text/javascript">
            window.alert("successfully User Deleted");
            window.location="college.php";
            </script>
			<?php 
}else{
    ?>
		<script type="text/javascript">
            window.alert(" User Not Deleted");
            window.location="college.php";
            </script>
			<?php 
}


?>