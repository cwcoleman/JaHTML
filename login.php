<?php
//Place Holder
include 'setup/func.php';
session_start();
$error = "";

if(isset($_POST['login'])){
	
$uname = $_POST['uname'];
$pass = $_POST['pass'];

	$SQL="select * from userz where uname = '$uname' and pass = '$pass'";
	$result = mysqli_query($link, $SQL);
	if(mysqli_num_rows($result)>0){
		$row=mysqli_fetch_array($result, MYSQLI_BOTH);
		$_SESSION["user"] = $uname;
		$_SESSION["role"] = $row["level"];
		if($row["level"] == "technician"){
			header("Location:technician.php");
		} else{
			header("Location:index.php");
		}
	} else{
		$error = "Please Check your username/password";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>JaHTML CMS  </title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="JaHTML Hackathon Website, Bootstrap, Android Compatible, 
Smartphone Compatible," />
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
						<li><a href="index.php#about" class="scroll"> About</a></li>
						<li><a href="index.php#portfolio" class="menu scroll">Customer Reviews</a></li>
							
							<script>
								$( "li a.menu" ).click(function() {
								$( "ul.nav-sub" ).slideToggle( 300, function() {
								// Animation complete.
								});
								});
							</script>
						<li><a href="#events" class="scroll"> Events</a></li>
						<?php if(isset($_SESSION['user'])) { ?><li><a href="logout.php"> Log Out</a></li><?php } ?>
						
					</ul>
				</nav>
			</div>
		</div>
		<div class="header-top">
			<div class="container">
				<div class="head-logo">
					<a href="index.php"><span>Ja</span>HTML<i>Customer Maintenance Service</i></a>
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
			<div class="sign-in-form">
				<div class="in-form">
					<h3>Sign in your Account</h3>
					<p class="use">Log in or <a href="sign-up.php"> Register </a> to use JaHTML CMS app</p>
					<?php if($error!="") echo $error; ?>
					<form name="myForm" method="post" action="login.php">
						<input type="text" name="uname" value="User Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'User Name';}" required="">
						<input type="password" name="pass" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
					<div class="ckeck-bg">
						<div class="checkbox-form">
							<div class="check-left">
								<div class="check">
									<label class="checkbox"><input type="checkbox" name="checkbox" unchecked=""><i> </i>Keep me Logged in</label>
								</div>
								<div class="check">
									<label class="checkbox"><input type="checkbox" name="checkbox" unchecked=""><i> </i>Remember my Password</label>
								</div>
							</div>
							<div class="check-right">
									<input type="submit" name="login" value="Login">
								</form>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
					<p class="forget"><a href="#" class="pass">Forgot your Password?</a> <span>No problem! <a href="Forgotpassword.html">
							Click here</a> to get a New Password</span></p>
				</div>
			</div>
			<div class="new-people">
				<h4>For New People</h4>
				<p>The CMS app makes creating Service order so much Easier! Register with your Ferguson Online account</p>
				<a href="sign-up.php">Register Here</a>
			</div>
		</div>
	</div>
<!-- //sign-in -->

<!-- footer -->
	<div class="footer">
		<div class="container">
			<div class="footer-left">
				<ul>
					<li><a href="index.php"><i>Ja</i>HTML</a><span> |</span></li>
					<li><p>CMS <span>12500 Jefferson Highway, Newport News, VA, 23602</span></p></li>
				</ul>
			</div>
			<div class="footer-right">
				<p>© 2016 Ferguson Enterprises. All rights reserved | Design by JaHTML</p>
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