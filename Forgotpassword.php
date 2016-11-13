<?php

?><!DOCTYPE html>
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
						<li><a href="FergusonCMOS.html" class="active"> Home</a></li>
						<li><a href="FergusonCMOS.html#about" class="scroll"> About</a></li>
						<li><a href="FergusonCMOS.html#portfolio" class="menu scroll">Customer Reviews</a></li>
							
							<script>
								$( "li a.menu" ).click(function() {
								$( "ul.nav-sub" ).slideToggle( 300, function() {
								// Animation complete.
								});
								});
							</script>
						<li><a href="#events" class="scroll"> Events</a></li>
						
					</ul>
				</nav>
			</div>
		</div>
		<div class="header-top">
			<div class="container">
				<div class="head-logo">
					<a href="index.html"><span>Ja</span>HTML<i>Customer Maintenance Service</i></a>
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
					<h3>Reset Your Password</h3>
					<p class="use">Enter your email in order to recieve a reset paassword link <br>
                        or return to <a href="login.html"> Login </a> page.</p>
					<form>
						<input type="text" value="Enter Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter Email';}" required="">
					</form>
				</div>
			</div>
			<div class="new-people">
				
				<a href=""> Send Link</a>
			</div>
		</div>
	</div>
<!-- //sign-in -->

<!-- footer -->
	<div class="footer">
		<div class="container">
			<div class="footer-left">
				<ul>
					<li><a href="FergusonCMOS.html"><i>Ja</i>HTML</a><span> |</span></li>
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