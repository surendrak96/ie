<?php
 
$con=mysqli_connect("localhost","root","1234","ielanat");

$cat   =$_POST['cat'];
$subcat=$_POST['subcat'];
$title =$_POST['title'];
$mobile=$_POST['mobile'];
$price =$_POST['price'];
$city  =$_POST['city'];
$address=$_POST['address'];
$locality=$_POST['locality'];

$filetmp =$_FILES["file_img"]["tmp_name"];
$filename =$_FILES["file_img"]["name"];
$filetype = $_FILES["file_img"]["type"];

$description=$_POST['description'];
  
 
$filepath = 'uploads/'.time().'.jpeg';
$imagelink = "http://192.168.1.100/ielanat/".$filepath;
 move_uploaded_file ($filetmp, $filepath);
 move_uploaded_file($filename, $filepath);
 

$sql = "INSERT INTO allads (category, subcategory, title,price ,description,city,address,locality,images,mobile) VALUES ( '$cat', '$subcat', '$title', '$price', '$description', '$city', '$address', 
	'$locality', '$imagelink' ,'$mobile') ";

    //$result = mysql_query($sql);


if ($con->query($sql) === TRUE) {

echo '<script type="text/javascript">'; 
echo 'alert("Successful !");'; 
echo 'window.location = "post-ad.html";';
echo '</script>';

   // include 'index.php';
//header('Location:index.php');
} else {
    echo "Error: " ;
}  
$con->close();


?>