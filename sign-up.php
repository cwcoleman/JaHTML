<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php

include 'setup/func.php';

session_start();

if(isset($_POST['register'])){
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];
	$cpwd = $_POST['cpwd'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$phone = $_POST['phone'];
	
	if($_POST['pwd'] == $_POST['cpwd']){
		
		$SQL = "Select * from userz where uname = '$email'";
		$res = mysqli_query($link, $SQL);
		
		if((isset($_POST["technician"])) && $_POST["technician"] == "technician"){
			$technician = $_POST['technician'];
		}
		
		if(mysqli_num_rows($res)==0){
			$now = DateTime::createFromFormat('U.u', microtime(true));
			$nowFormatted = $now->format("m-d-Y H:i:s.u");
			$SQL = "insert into userz(uname, pass, email, name, lname, timeStamp, ip_addr, level, phone) values('$email', '$pwd', '$email','$fname', '$lname', '$nowFormatted', '$ip', '$technician', '$phone')";
			if($_POST["technician"] == "technician"){
				$techLocation = $_POST['techLocation'];
				$SQLInsertTech = "insert into technician(techID, techName, techLocation, techAvail) values('$email', '$fname', '$techLocation', 0)";
				$resultInsertTech = mysqli_query($link, $SQLInsertTech);
				if($resultInsertTech){
					
				}
			}
			//echo $SQL;
			$result=mysqli_query($link, $SQL);
			if($result>0){
				echo "here";
				if($_POST['carrier'] == "tmobile"){
					$extent = "@tmomail.net";
				} else if ($_POST['att']){
					$extent = "@txt.att.net";
				} else if($_POST['verizon']){
					$extent = "@vtext.com";
				}
				
				if($phone != ""){
					$to      = $phone . $extent;
					$subject = 'the subject';
					$message = 'hello';
					$headers = 'From: r@chhura.com' . "\r\n" .
					'Reply-To: r@chhura.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
					
					mail($to, $subject, $message, $headers);
				}
				
					$toe      = $email;
					$subjecte = 'the subject';
					$messagee = 'hello';
					$headerse = 'From: r@chhura.com' . "\r\n" .
					'Reply-To: r@chhura.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
					
					

					mail($toe, $subjecte, $messagee, $headerse);


				header("Location:login.php");
			} else {
				$error = "Email needs to be unique :)";
			}
		} else {
			$error = "Email Already in use";
		}
	} else {
		echo "<script type='text/javascript'>alert('failed!')</script>";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>JaHTML Hackathon Website </title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Xtreme Travel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/styles.css?v=1.6" rel="stylesheet">
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/scripts.js?v=1.7"></script>
<!-- //js -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Comfortaa:400,300,700' rel='stylesheet' type='text/css'>
</head>
	
<body>
<!-- banner -->
	<div class="banner1">
		<div class="navigation">
			<div class="container-fluid">
				<nav class="pull">
					<ul class="nav">
						<li><a href="index.php" class="active"> Home</a></li>
						<li><a href="index.php#about"> About</a></li>
						<li><a href="index.php#portfolio" class="menu">Customer Reviews</a></li>
						<li><a href="index.php#portfolio"> Events</a></li>
				
						<?php if(isset($_SESSION['user'])) { ?><li><a href="logout.php"> Log Out</a></li><?php } ?>
					</ul>
				</nav>
			</div>
		</div>
		<div class="header-top">
			<div class="container">
				<div class="head-logo">
					<a href="index.php"><span>Ja</span>HTML<i>Customer Maintenance System</i></a>
				</div>
				<div class="top-nav">
					<div class="hero fa-navicon fa-2x nav_slide_button" id="hero">
						<a href="#"><img src="images/menu.png" alt=""></a>
					</div>	
				</div>	
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- banner -->
<!-- sign-in -->
	<div class="sign-in">
		<div class="container">
			<div class="in-form">
				<h3>Register Here</h3>
                <p class="use">Register or <a href = "login.php"> Login </a> in order to use our brand new CMS app!</p>
				<div class="sign-in-form">
					<div class="in-form Personal">
						<h4>Personal Information</h4>
						<?php if(isset($error) && $error!="") echo $error; ?>
						<form name="myform" method="post" action="sign-up.php">
						
							<input type="text" name="fname" placeholder="Firstname*" required=" ">
							<input type="text" name="lname" placeholder="Lastname*" required=" ">
							<input type="text" name="phone" placeholder="757007007" required=" "><br /><br />
							<input type="text" name="carrier" placeholder="tmobile or att or verizon" required=" "> <br /><br /><br />
							<input type="text" name="email" placeholder="Email address*" required=" ">
						<!--<h4 class="kij">Login Information</h4>-->
							<input type="password" name="pwd" placeholder="Password*" required=" ">
							<input type="password" name="cpwd" placeholder="Confirm Password*" required=" ">
							<?php if((isset($_SESSION["role"])) && $_SESSION["role"] == "admin") { ?><input type="checkbox" name="technician" value="technician">Technician
							<input type="text" name="techLocation" placeholder="Technician Location*" required=" "><?php } ?><br/>
							<input type="submit" name="register" value="submit">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- //sign-in -->

<!-- footer -->
	<div class="footer">
		<div class="container">
			<div class="footer-left">
				<ul>
					<li><a href="index.html"><i>Ja</i>HTML</a><span> |</span></li>
					<li><p>A Plumbing Company <span>12500 Jefferson Highway, Newport News, VA</span></p></li>
				</ul>
			</div>
			<div class="footer-right">
				<p>© 2016 JaHTML. All rights reserved | Design by <a href="http://chhura.com">JaHTML</a></p>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //footer -->
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
</body>
</html>