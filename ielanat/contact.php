<?php
include ('includes/db.php');
//include 'index.php';


$name = $_GET['name'];

$email = $_GET['email'];
 $adid = $_GET['adid'];
 $phone =$_GET['phone'];
 $message = $_GET['message'];
  

 
$sql = "INSERT INTO contacts (name, email, adid,phone,message) VALUES ( '$name', '$email', '$adid', 
	'$phone','$message')";

    //$result = mysql_query($sql);


if ($con->query($sql) === TRUE) {

echo '<script type="text/javascript">'; 
echo 'alert("Successful !");'; 
echo 'window.location = "contact.html";';
echo '</script>';

   // include 'index.php';
//header('Location:index.php');
} else {
    echo "Error: " ;
}  
$conn->close();


?>