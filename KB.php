<?php
include 'setup/func.php';

session_start();

$orderId = $_REQUEST['orderId'];

if(isset($_POST['submit'])){
	$comment = htmlentities($_POST['comment']);

	$ip = $_SERVER['REMOTE_ADDR'];
	$now = DateTime::createFromFormat('U.u', microtime(true));
	$nowFormatted = $now->format("m-d-Y H:i:s.u");
	
	if($comment != " "){
	$SQLcmntInsert = "insert into comments(comment, cmtBy, timeStamp, orderId, ip_addr) values('$comment', '$_SESSION[user]', '$nowFormatted', '$orderId', '$ip')";
	//echo $SQLcmntInsert;
	$resInsertcmnt = mysqli_query($link, $SQLcmntInsert);
	if($resInsertcmnt){
		//comment Inserted
	}
	}
	
	$desc_prob = $_POST['desc_prob'];
	$close_branch = $_POST['close_branch'];
	$techId = $_POST['techId'];
	$status = $_POST['status'];
	
	
	$SQLorderDet="select * from orders where orderId=$orderId";
	//echo $SQL;
	$resultorderDet = mysqli_query($link, $SQLorderDet);
	$row=mysqli_fetch_array($resultorderDet, MYSQLI_BOTH);
	if($row['status'] != $status){
		$SQLUpdateStatus = "update orders set status = '$status' where orderId = $orderId";
		$SQLUpdateOrderToTech = "update order_to_technician set status = '$status' where orderUniqId = '$row[uniqId]'";
		
		$resUpdateStatus = mysqli_query($link, $SQLUpdateStatus);
		$resUpdateOrderToTech = mysqli_query($link, $SQLUpdateOrderToTech);
		
		if($status == "Completed"){
			$techId = $row['techId'];
			$SQLselectTech = "select * from technician where ID = $techId";
			$resSelectTech = mysqli_query($link, $SQLselectTech);
			$row = mysqli_fetch_array($resSelectTech, MYSQLI_BOTH);
			$avail = $row['techAvail'];
			$avail--;
			
			$SQLUpdateTechTbl = "update technician set techAvail = $avail where ID = $techId";
			//echo $SQLUpdateTechTbl;
			$resUpdateTechTbl = mysqli_query($link, $SQLUpdateTechTbl);
			if($resUpdateTechTbl){
				
			}
		}
		if($resUpdateStatus && $resUpdateOrderToTech){}
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
						<li><a href="logout.php"> LogOut</a></li>
						
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
			<form name="myForm" method="post" action="order.php?orderId=<?php echo $orderId; ?>">
				<div class="in-form">
					<h3>Order Details</h3>
					
					<!--<p class="use">Enter your order details below:</p>-->
					
					Knowledge Base related to orderId: <?php echo $orderId; ?>
						</table>
						<br>
						<br>
                        <textarea name="comment" rows="4" cols="50" onfocus="this.value = '';"  required="" class="typeahead1 input-md form-control tt-input">  </textarea>
                        <br>
				</div>
                
			</div>
			<div class="new-people">
				
				<input type="submit" name="submit" value="submit">
			</form>
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