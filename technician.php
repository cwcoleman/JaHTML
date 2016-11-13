<?php
include 'setup/func.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>JaHTML Hackathon Website </title>
<!-- mobile app compatible -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="JaHTML Hackathon Template, Bootstrap, Android Compatible, 
Smartphone Compatible" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/styles.css?v=1.6" rel="stylesheet">
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
   <script>   $( document ).ready(function() {
        $('#myTable').on('click', 'tbody tr', function(event) {
            //  console.log("test ");                   
        });

$('#myTable').on('click', '.clickable-row', function(event) {
  if($(this).hasClass('active')){
    $(this).removeClass('active'); 
  } else {
    $(this).addClass('active').siblings().removeClass('active');
  }
})
    </script>
    <style>
  #feedback { font-size: 1.4em; }
  #selectable .ui-selecting { background: #FECA40; }
  #selectable .ui-selected { background: #F39814; color: white; }
  #selectable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #selectable li { margin: 3px; padding: 0.4em; font-size: 1.4em; height: 18px; }
  </style>
    <script>
  $( function() {
    $( "#selectable" ).selectable();
  } );
  </script>
    <script>
  $(function() {
    function log( message ) {
      $( "<div>" ).text( message ).prependTo( "#log" );
      $( "#log" ).scrollTop( 0 );
    }

    $( "#city" ).autocomplete({
      source: function( request, response ) {
        $.ajax({
          url: "http://gd.geobytes.com/AutoCompleteCity",
          dataType: "jsonp",
          data: {
            q: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 3,
      select: function( event, ui ) {
        log( ui.item ?
          "Selected: " + ui.item.label :
          "Nothing selected, input was " + this.value);
      },
      open: function() {
        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
      },
      close: function() {
        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
      }
    });
  });
</script>
    <script>
function myFunction() {
    document.getElementById("demo").style.color = "red";
}
</script>
<script src="js/scripts.js?v=1.7"></script>
<!-- //js -->
<!--FlexSlider-->
		<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
		<script defer src="js/jquery.flexslider.js"></script>
		<script type="text/javascript">
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	  </script>
<!--End-slider-script-->
<!-- pop-up-script -->
<script src="js/jquery.chocolat.js"></script>
		<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen" charset="utf-8">
		<!--light-box-files -->
		<script type="text/javascript" charset="utf-8">
		$(function() {
			$('.view-seventh a').Chocolat();
		});
		</script>
<!-- //pop-up-script -->
<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
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
	<div class="banner">
		<div class="navigation">
			<div class="container-fluid">
				<nav class="pull">
					<ul class="nav">
						<li><a href="index.php" class="active"> Home</a></li>
						<li><a href="#about" class="scroll"> About</a></li>
						<li><a href="#portfolio" class="menu scroll">Customer Reviews</a></li>
							
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
		<div class="banner-info">
			<div class="container">
				<h1> Maintenance Order System</h1>
				<div class="sap_tabs">	
					<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
						  <ul class="resp-tabs-list">
							 <div> <li class="resp-tab-item grid1" aria-controls="tab_item-0" role="tab"><span><i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>Service Information</span></li>
                            </div>
							  
							  <div class="clear"></div>
						  </ul>				  	 
							<div class="resp-tabs-container">
								
								<div class="tab-1 resp-tab-content" aria-by="tab_item-0">
									<div class="facts">
										<div class="booking-form">
											<div class="online_reservation">
													<div class="b_room">
														<div class="booking_room">
															<div class="reservation">
<table cellspacing='100'> <!-- cellspacing='0' is important, must stay -->
	<thead>
		<tr>
			<th>Order #</th>
            <th>Location</th>
            <th>Status</th>
			<th>TimeStamp</th>
		</tr>
	</thead><!-- Table Header -->
 
	<tbody data-link="row" class="rowlink" >
	<?php
	$SQLOrderTrack = "Select * from orders o, technician t where t.ID = o.techId and t.techId = '$_SESSION[user]'";
	$resGetTrackOrder = mysqli_query($link, $SQLOrderTrack);
	while($row=mysqli_fetch_array($resGetTrackOrder, MYSQLI_BOTH)) {
		$orderId = $row['orderId'];
		$location = $row['close_branch'];
		$status = $row['status'];
		$timeStamp = $row['timeStamp'];
	?>
		<tr class="ui-widget-content">
			<td><a href="<?php echo "order.php?orderId=$orderId"; ?>"><?php echo $orderId; ?></a></td>
			<td><a href="<?php echo "order.php?orderId=$orderId"; ?>"><?php echo $location; ?></a></td>
			<td><a href="<?php echo "order.php?orderId=$orderId"; ?>"><?php echo $status; ?></a></td>
			<td><a href="<?php echo "order.php?orderId=$orderId"; ?>"><?php echo $timeStamp; ?></a></td>
		</tr>
	<?php
	}
	?>
	</tbody>
</table>                    
																	<!---strat-date-piker---->
																		<link rel="stylesheet" href="css/jquery-ui.css" />
																		<script src="js/jquery-ui.js"></script>
																		  <script>
																				  $(function() {
																					$( "#datepicker,#datepicker1" ).datepicker();
																				  });
																		  </script>
																	<!---/End-date-piker---->
															</div>
															<div class="reservation">
												<ul>	<br>
													 <li class="span1_of_3">
															<div class="date_btn">
																<form>
																	<div class="new-people">
				
				<!--<a href="order.html"> View Order</a> -->
			</div>
																</form>
															</div>
													 </li>
													 <div class="clearfix"></div>
												</ul>
											</div>
														</div>
														<div class="clearfix"></div>
													</div>
											</div>
											<!---->
										</div>	
									</div>
								</div>

								<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-2">
									<div class="facts">
										<div class="cars">
											

    
     
 
									</div>
								</div>
								<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-3">
									<div class="facts">
										<div class="destination">
											
											
										</div>
									</div>
								</div>
							</div>
					</div>
                        
				</div>
				<script type="text/javascript">
							$(document).ready(function () {
								$('#horizontalTab').easyResponsiveTabs({
									type: 'default', //Types: default, vertical, accordion           
									width: 'auto', //auto or any width like 600px
									fit: true   // 100% fit in a container
								});
							});
						</script>
							</div>
		</div>
	</div>
<!-- //banner -->

<!-- Customer Reviews -->

<!-- twitter-text -->
	
<!-- //twitter-text -->
<!-- events -->





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