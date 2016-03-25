<?php
include ('includes/db.php');
//include 'index.php';


$name = $_GET['name'];

$email = $_GET['email'];

 $phone =$_GET['phone'];
 $message = $_GET['message'];
  

  //$now = new DateTime();
 //$now->format('Y-m-d H:i:s'); 
 
$sql = "INSERT INTO feedback (name, email,phone,message) VALUES ( '$name', '$email','$phone','$message')";

    //$result = mysql_query($sql);


if ($con->query($sql) === TRUE) {

echo '<script type="text/javascript">'; 
echo 'alert("Thanks for giving Feedbacks !");'; 
echo 'window.location = "feedback.html";';
echo '</script>';

   // include 'index.php';
//header('Location:index.php');
} else {
    echo "Error: " ;
}  
$conn->close();


?>








<!DOCTYPE html>
<html>
<head>
<title>Feedback </title>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script> 
$(function(){
  $("#header").load("header.html"); 
  $("#footer").load("footer.html"); 
});
</script> 
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<!--fonts-->

<!--//fonts-->	
<!-- js -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- js -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-select.js"></script>
<script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script>
</head>
<body>
	<div id="header"></div>
	<!-- Feedback -->
	<div class="feedback main-grid-border">
		<div class="container">
			<h2 class="head">Feedback</h2>
			<div class="feed-back">
				<h3>Tell us what you think of us</h3><br>
				<p></p>
				<div class="feed-back-form">
					<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
					<span>User Details</span>
							<input type="text" value=" Name" onfocus="this.value = '';" name="name"onblur="if (this.value == '') {this.value = 'First Name';}">
						
							<input type="text" name="email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}">
							<input type="text" name="phone" value="Phone No" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Phone No';}">
							<span>Is there anything you would like to tell us?</span>
							<textarea name="message" type="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message...';}" required="">Message...</textarea>
							<input type="submit" value="submit">
						</form>
				</div>
			
		</div>	
	</div>
	<!-- // Feedback -->
	<!--footer section start-->		
		<div id="footer"></div>

        <!--footer section end-->
</body>
</html>