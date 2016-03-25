<?php require('includes/config.php');

//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: memberpage.php'); }

//if form has been submitted process it
if(isset($_POST['submit'])){

	//very basic validation
	if(strlen($_POST['username']) < 3){
		$error[] = 'Username is too short.';


	} else {
		$stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
		$stmt->execute(array(':username' => $_POST['username']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['username'])){
			$error[] = 'Username provided is already in use.';
		}

	}

	if(strlen($_POST['password']) < 6){
		$error[] = 'Password is too short.';
	}

	if(strlen($_POST['passwordConfirm']) < 6){
		$error[] = 'Confirm password is too short.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Passwords do not match.';

	}

	//email validation
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	} else {
		$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['email'])){
			$error[] = 'Email provided is already in use.';
		}

	}


	//if no errors have been created carry on
	if(!isset($error)){

		//hash the password
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

		//create the activasion code
		$activasion = md5(uniqid(rand(),true));

		try {

			//insert into database with a prepared statement
			$stmt = $db->prepare('INSERT INTO members (name,username,password,email,active) VALUES (:name,:username, :password, :email, :active)');
			$stmt->execute(array(
				':name'=>$_POST['name'],
				':username' => $_POST['username'],
				':password' => $hashedpassword,
				':email' => $_POST['email'],
				':active' => $activasion
			));
			$id = $db->lastInsertId('memberID');

			//send email
				$name = $_POST['name'];
			$to = $_POST['email'];
			$subject = "Registration Confirmation";
			$body ='
     
<html><body style="width:100%; margin:0; padding:0; -webkit-text-size-adjust:none; -ms-text-size-adjust:none; background-color:#ffffff;">
       <table cellpadding="0" cellspacing="0" border="0" id="backgroundTable" style="height:auto !important; margin:0; padding:25px; background-color:#ccc; color:#333333;"> <tr>
               <td>
<div id="tablewrap" style="width:100% !important; max-width:740px !important; text-align:center; margin:0 auto;">
                       <table id="contenttable" width="740" align="center" cellpadding="0" cellspacing="0" border="0" style="background-color:#FFFFFF; margin:0 auto; text-align:center; border:none; width: 100% !important; max-width:740px !important;">
                           <tr>
    <td width="90%" valign="top">
        <div class="outlookcom">
            <table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0" width="90%" style="margin-left:auto; margin-right:auto; margin-top:25px; margin-bottom:15px;" dir="ltr" class="widthfix logo-marg pe-header">
                <tr>
                    <td width="45%" bgcolor="#ffffff" style="text-align:left;"><a href="" target="_new"><img src="https://ielanat.co/alpha/images/logo2.png" alt="" style="display:inline-block; max-width:100% !important; width:auto !important; height:auto !important;" border="0"></a></td>
                    <td width="10%" bgcolor="#ffffff"></td>
                    <td width="45%" bgcolor="#ffffff" style="text-align: right;"><a href="https://www.payoneer.com" target="_new"><img src="http://pubs.payoneer.com/EmailSender/Payoneer/img/Default/pbp.png" alt="" style="display:inline-block; max-width:100% !important; width:auto !important; height:auto !important;" border="0"></a></td>
                </tr>
            </table>
            <table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0" width="90%" style="margin:0 auto;  border-top:1px solid #cccccc; padding-top:25px;" dir="ltr" class="widthfix pe-main-con">
                <tr>
                    <td width="100%" valign="top" bgcolor="#ffffff" style="text-align:left;" class="pe-content">
                        <!-- Bold text (Dear) -->                    
   <table border="0" cellspacing="0" cellpadding="0" dir="ltr" class="pe-text">
       <tr>
           <td><p style="text-align:left; color:#333333; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; margin:0px;  padding:0; margin-top:10px; font-weight:bold;">Dear '.$name.' ,</p></td>
       </tr>
   </table>
     <!-- Paragraph -->                    
   <table border="0" cellspacing="0" cellpadding="0" dir="ltr" class="pe-text">
       <tr>
           <td><p style="text-align:left; color:#333333; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; margin:0px;  padding:0; margin-top:10px; font-weight:normal;">Thank you for choosing Ielanat! To confirm your email please click on the link
           <a href="'.DIR.'activate.php?x='.$id.'&y='.$activasion.'">'.DIR.'activate.php?x='.$id.'&y='.$activasion.'</a> 
           </p>
           </td>
       </tr>
   </table>
    <!-- paragraph with link -->                      
   <table border="0" cellspacing="0" cellpadding="0" dir="ltr" class="pe-text">
       <tr>
         <td><p style="text-align:left; color:#333333; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; margin:0px;  padding:0; margin-top:10px; font-weight:normal;">To learn more about your Ielanat  <font style="color:#ff4800;"><a href="https://ielanat.co/about" target="_new" style="color:#ff4800;">FAQs</a></font> and <font style="color:#ff4800;"><a href="https://ielanat.co/alpha/terms.html" target="_new" style="color:#ff4800;">Terms & Conditions</a></font>. Should you have any questions, please <font style="color:#ff4800;"><a href="https://ielanat.co/alpha/contact.html/" target="_new" style="color:#ff4800;">contact us</a></font>.</p></td>
       </tr>
   </table> </td> </tr>
      <tr><td>
<table width="100%" border="0" cellpadding="0" cellspacing="0" dir="ltr" class="pe-signature">
                          <tr>
      <td width="100%" valign="top" bgcolor="#ffffff" style="text-align:left;" class="pe-end-msg">

          <table style="text-align:left;" width="100%" border="0" cellpadding="0" cellspacing="0" dir="ltr" class="pe-signature">
     <tr>
         <td>&nbsp;</td>
     </tr>
     <tr>
         <td>&nbsp;</td>
     </tr>
     <tr>
         <td style="text-align:left;" dir="ltr">
             <span style=" color:#333333; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:19px; margin:0; padding:0; padding-bottom:10px; font-weight:normal;">
                  <br> <p>Thank you,<br>Ielanat Team</p>
             </span>
         </td>
     </tr>
 </table>

 <table style="margin:0 auto; text-align:left;" bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0" width="100%" dir="ltr" class="pe-social-icons">
                             <tr>
    <td width="100%" bgcolor="#ffffff" style="text-align:left; padding-top:10px;">
        <div style="display:block; max-width:100% !important; width:100% !important; height:auto !important;padding-top:5px;padding-right:0px;padding-bottom:5px;">
            <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px; padding-bottom:20px; text-align:left;">
                <tr>
        <td class="outlookcomsocial"><div style="text-align:center; margin-left:3px; margin-right:3px;">
            <a href="https://www.facebook.com/ielanatco-614907285324756" target="_new">
                <img src="https://www.iconfinder.com/icons/107175/download/png/32" border="0" alt="Facebook" /></a></div></td>
   <td class="outlookcomsocial">
       <div style="text-align:center; margin-left:3px; margin-right:3px;"><a href="https://twitter.com/ielanat" target="_new">
           <img src="https://www.iconfinder.com/icons/107170/download/png/32" border="0" alt="Twitter" /></a></div></td>
</table>   </div></td></tr></table> </td> </tr> </table> </td> </tr> </table>
                                   <table border="0" cellspacing="0" cellpadding="25" width="100%" dir="ltr" class="pe-footer">
    <tr>
        <td width="100%" bgcolor="#cccccc" class="disc-bg" style="text-align:center;">
            <p style="color:#999999; font-family:Arial, Helvetica, sans-serif; font-size:10px; line-height:14px; margin-top:0; margin-bottom:15px; padding:0; font-weight:normal;"> To Know more information please visit us at  <a style="color:#FF4900" href="https://www.ielanat.co/" target="_blank">www.ielanat.co</a></p>
            <p style="color:#999999; font-family:Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; margin-top:0; margin-bottom:15px; padding:0; font-weight:normal;">
 © 2016 Ielanat, All Rights Reserved<br></p> </td></tr></table> </div> </td></tr> </table></div> </td></tr> </table>
   </body>
   </html> 
  ';

			$mail = new Mail();
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->send();

			//redirect to index page
			header('Location: register.php?action=joined');
			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}

	}

}

//define page title
$title = 'ielanat';

//include header template

?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-select.css">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Resale Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<!--fonts-->
<link href='//fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
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
<script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
<link href="css/jquery.uls.css" rel="stylesheet"/>
<link href="css/jquery.uls.grid.css" rel="stylesheet"/>
<link href="css/jquery.uls.lcd.css" rel="stylesheet"/>
<!-- Source -->
<script src="js/jquery.uls.data.js"></script>
<script src="js/jquery.uls.data.utils.js"></script>
<script src="js/jquery.uls.lcd.js"></script>
<script src="js/jquery.uls.languagefilter.js"></script>
<script src="js/jquery.uls.regionfilter.js"></script>
<script src="js/jquery.uls.core.js"></script>
</head>

<body>
<div class="header">
		<div class="container">
			<div class="logo">
				<a href="index.html"><span>ie</span>lanat</a>
			</div>
			<div class="header-right">
			<a class="account" href="login.php">My Account</a>
			
	<!-- Large modal -->
			<div class="selectregion">
				<button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
				Select Your Region</button>
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
					aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										&times;</button>
									<h4 class="modal-title" id="myModalLabel">
										Please Choose Your Location</h4>
								</div>
								<div class="modal-body">
									 <form class="form-horizontal" role="form">
										<div class="form-group">
											<select id="basic2" class="show-tick form-control" multiple>
												<optgroup label="Popular Cities">
													<option selected style="display:none;color:#eee;">Select City</option>
													<option>Dubai</option>
													<option>Abu Dhabi</option>
													<option>Sharjah</option>
													<option>Ras Al Khaimah	 	 </option>
													<option>Fujairah</option>
													<option>Ajman</option>
													<option>Umm Al Quwain</option>
												</optgroup>
											</optgroup>
											</select>
										</div>
									  </form>    
								</div>
							</div>
						</div>
					</div>
				<script>
				$('#myModal').modal('');
				</script>
			</div>
		</div>
		</div>
	</div>


	    <section>
			<div id="page-wrapper" class="sign-in-wrapper">
				<div class="graphs">
					<div class="sign-up">
						<h1>Create an account</h1>
						<p class="creating">Enter valid email and password </p> 
				
				
				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				//if action is joined show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'joined'){
					echo "<h2 class='bg-success'>Registration successful, please check your email to activate your account.</h2>";
				}
				?>
					<form role="form" action="" method="post">
						

						<div class="sign-u">
							    <div class="sign-up1">
								<h4>NAME * :</h4>
							</div>
							<div class="sign-up2">
								
									<input type="text" name="name" placeholder="Enter your Name " required=" "/>
						</div>
							<div class="clearfix"> </div>
						</div>






					<div class="sign-u">
							<div class="sign-up1">
								<h4>UserName * </h4>
							</div>
							<div class="sign-up2">
								
							
					<input type="text" name="username" id="username" class="" placeholder="Enter your username " required=" "value="<?php if(isset($error)){ echo $_POST['username']; } ?>" >
					</div>
							<div class="clearfix"> </div>
						</div>
							<div class="sign-u">
							<div class="sign-up1">
								<h4>EMAIL Address *</h4>
							</div>
							<div class="sign-up2">
					<input type="text" name="email" required=" "id="email" placeholder="Enter your Email " value="<?php if(isset($error)){ echo $_POST['email']; } ?>" >

						</div>
							<div class="clearfix"> </div>
						</div>
				
								<div class="sign-u">
							<div class="sign-up1">
								<h4>PASSWORD * :</h4>
								 </div>
								<div class="sign-up2">
							
							<input type="password" required="" name="password" id="password" class="" placeholder="Password" >
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="sign-u">
							<div class="sign-up1">
								<h4>CONFIRM Password* </h4>
							</div>
						
						
							<div class="sign-up2">

							<input type="password" required=" "name="passwordConfirm" id="passwordConfirm" class="" placeholder="Confirm Password" />
						</div>
							<div class="clearfix"> </div>
						</div>
						<div class="sub_home">
							<div class="">
						
									<input type="submit" name="submit"value="Signup ">
							
							</div> </form>
							<br><div class="sub_home_right">
								<p>Already Registered?<a href="login.php">Login Here</a></p>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
			</div>
