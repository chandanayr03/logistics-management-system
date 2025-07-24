<?php
require('db.php');
$a=$_SESSION['username'];
// If form submitted, insert values into the database.

$c=$_GET['id'];


$query1="DELETE from shipments where id = '$c'"; 




$result1 = mysqli_query($con,$query1); // selecting data through mysql_query()
if($result1===TRUE){
    ?>
		<script type="text/javascript">
            window.alert("successfully Shipment Deleted");
            window.location="manageshipment.php";
            </script>
			<?php 
}else{
    ?>
		<script type="text/javascript">
            window.alert(" Place Not Deleted");
            window.location="manageshipment.php";
            </script>
			<?php 
}


?>