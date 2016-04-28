<?php require('includes/config.php'); 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 

//define page title
$title = 'Members Page';

//include header template
//require('header.html'); 
?>

<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			
				<h2>Member only page - Welcome <?php echo $_SESSION['username']; ?></h2>
				<p><a href='logout.php'>Logout</a></p>
  	<hr>
  	<form action="update.php" method="POST"/>
  	<input type="text" name="email" value="" />
  	<input type="password" name="pass" value="" />   
    <input type="password" name="conpass" value=""  />  

 	<input type="submit"  value="submit"/>

		</div>
	</div>


</div>

<?php 
//include header template
require('layout/footer.html'); 
?>
