<?php

include 'setup/func.php';

session_start();

if(isset($_SESSION['role']) && $_SESSION['role'] == "technician"){
	header("Location:technician.php");
}

if(isset($_POST['submit'])){
	$date = $_POST['date'];
	$location = $_POST['location'];
	$prob_desc = $_POST['prob_desc'];
	$prob_video = null;
	$user = $_SESSION['user'];
	$uniqId = uniqid();
	$ip = $_SERVER['REMOTE_ADDR'];
	
	date_default_timezone_set('US/Eastern');
	
	$ecode=$_FILES['file']['error'];
			$size=$_FILES['file']['size'];
			$type=$_FILES['file']['type'];
			$fname=$_FILES['file']['name'];
			$actual_path="upload_pic/".$fname;

			if($ecode>=1 && $ecode<=2)
			$msg="Type Error Please Try Again";
			else if($ecode>=3 && $ecode<=5)
			$msg="Size Error try again";
			else if($ecode>=6 && $ecode<=8)
			$msg="Connection Error try again";
		

			else
			{
				if($size<=25000000)
				{
					if($type=='image/jpg' || $type=='image/jpeg' || $type=='image/png' || $type=='image/gif')
					{
						if(is_uploaded_file($_FILES['file']['tmp_name']))
						{
							if(move_uploaded_file($_FILES['file']['tmp_name'],$actual_path))
							{
								/*$SQL1="insert into imgz(src, data_large, alt, data_desc) values('images/thumbs/$fname'
								, 'images/$fname', '$fname', '$img_desc')";
								$result=mysqli_query($link, $SQL1);
								if($result>0){
									$destination_img = '../images/thumbs/'.$fname; 
									//echo $actual_path;
									//echo $destination_img;
									$d = compress($actual_path, $destination_img, 5);
								}*/
								
							}
							else
							$msg="Act File is not uploaded";
						}
						else
						$msg="Temp File is not uploaded";
					}
					else
					$msg="Extension Error";
				}
				else
				$msg="size Error Max size 25 Mb only";
			}
	
	$SQLFindTech = "select * from technician where techLocation like '%$location%' and techAvail < 3 order by techAvail asc";
	
	//echo "<br />" . $SQLFindTech;
	$resFindTech = mysqli_query($link, $SQLFindTech);
	
	if(mysqli_num_rows($resFindTech) > 0){
		$row=mysqli_fetch_array($resFindTech, MYSQLI_BOTH);
		$techId = $row['ID'];
		$availibility = $row['techAvail'];
		$availibility++;

		$now = DateTime::createFromFormat('U.u', microtime(true));
		$nowFormatted = $now->format("m-d-Y H:i:s.u");
		
		$SQLOrder = "insert into orders(desc_prob, close_branch, date, prob_picture, prob_video, user, uniqId, ip_addr, timeStamp, status, techId) values('$prob_desc', '$location', '$date', '$fname', '$prob_video', '$user', '$uniqId', '$ip', '$nowFormatted', 'Assigned', '$techId')";
		$result = mysqli_query($link, $SQLOrder);
		
		if($result){
			//Added
		}
		
		$now = DateTime::createFromFormat('U.u', microtime(true));
		$nowFormatted = $now->format("m-d-Y H:i:s.u");
		
		$SQLInsertOrderToTech = "insert into order_to_technician(orderUniqId, technicianId, status, timeStamp, ip_addr) values('$uniqId', '$techId','NEW', '$nowFormatted', '$ip') ";
		//echo "<br />" . $SQLInsertOrderToTech;
		
		$SQLUpdateTech = "update technician set techAvail = $availibility where ID = $techId";
		
		//echo $SQLUpdateTech;
		$resultUpdateTech = mysqli_query($link, $SQLUpdateTech);
		
		$resultOrderToTech = mysqli_query($link, $SQLInsertOrderToTech);
		
		if($resultOrderToTech && $resultUpdateTech){
			//Added to table order_to_technician
		}
	} else {
		$now = DateTime::createFromFormat('U.u', microtime(true));
		$nowFormatted = $now->format("m-d-Y H:i:s.u");
		
		$now = DateTime::createFromFormat('U.u', microtime(true));
		$nowFormatted = $now->format("m-d-Y H:i:s.u");		
		
		$SQL = "insert into orders(desc_prob, close_branch, date, prob_picture, prob_video, user, uniqId, ip_addr, timeStamp, status, techId) values('$prob_desc', '$location', '$date', '$fname', '$prob_video', '$user', '$uniqId', '$ip', '$nowFormatted', 'NEW', '')";
		//echo $SQL;
		$result = mysqli_query($link, $SQL);
		
		if($result){
			//Added
		}		
		$SQLInsertOrderToNoTech = "insert into no_tech_order(orderUniqId, timeStamp, ipaddr, active) values('$uniqId', '$nowFormatted', '$ip', 1) ";
		//echo "<br />" . $SQLInsertOrderToNoTech;
		
		$resultInsertOrderToNoTech = mysqli_query($link, $SQLInsertOrderToNoTech);
		
		if($resultInsertOrderToNoTech){
			//Added to table No_Tech_Order
		}
	}
	
	/*$result = mysqli_query($link, $SQL);
	if($result){
		echo "Result added";
	}*/
}
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
		<div class="banner-info">
			<div class="container">
				<h1> Maintenance Order System</h1>
				<div class="sap_tabs">	
					<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
					<?php if(isset($_SESSION['user'])){
						?>
						  <ul class="resp-tabs-list">
							  <li class="resp-tab-item grid1" aria-controls="tab_item-0" role="tab"><span><i class="glyphicon glyphicon-search" aria-hidden="true"></i>Service </span></li>
							  <!-- <li class="resp-tab-item grid2" aria-controls="tab_item-1" role="tab"><span><i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>Choose Products</span></li> -->
							  <li class="resp-tab-item grid3" aria-controls="tab_item-2" role="tab"><span><i class="glyphicon glyphicon-home" aria-hidden="true"></i>Track Order</span></li>
							  <div class="clear"></div>
						  </ul>				  	 
					<?php
					}
					?>
							<div class="resp-tabs-container">
								
								<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
									<div class="facts">
										<div class="booking-form">
											<div class="online_reservation">
													<div class="b_room">
														<div class="booking_room">
														<?php if(isset($_SESSION['user'])) {
														?>
															<form name="myForm" method="post" action="index.php" enctype="multipart/form-data">
															
															<div class="reservation">
																<ul>
                                                                    <li  class="span1_of_1 desti">
                                                                        <h5>Choose the Closest Branch</h5>
                                                                            <div class="ui-widget">
                                                                                <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                                                                                <input type="text" name="location" placeholder="Ferguson Branch Location" class="typeahead1 input-md form-control tt-input" required="">
                                                                             </div>					
																	 </li>
																</ul>
															</div>
															<div class="reservation">
																<ul>
                                                                    <li  class="span1_of_1 desti">
                                                                        <h5>Maintenance Descrition</h5>
                                                                            <div class="ui-widget">
                                                                                <!--<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>-->
                                                                                <input type="text" name="prob_desc" placeholder="Mainetance Request Description" class="typeahead1 input-md form-control tt-input" required="">
                                                                             </div>					
																	 </li>
																</ul>
															</div>
															<div class="reservation">
																<ul>
                                                                    <li  class="span1_of_1 desti">
																		<h5>Upload Picture</h5>
																		<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
                                                                            <div class="ui-widget">
                                                                                <input type="file" name="file" accept="image/*" onchange="loadFile(event)">
                                                                             </div>					
																	 </li>
																</ul>
															</div>
															<!--<div class="reservation">
																<ul>
                                                                    <li  class="span1_of_1 desti">
																		<h5>Upload Video</h5>
																		<span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span>
                                                                            <div class="ui-widget">
                                                                                <input type="file" name="file" accept="video/*" onchange="loadFile(event)">
                                                                             </div>					
																	 </li>
																</ul>
															</div> -->
															<div class="reservation">
																<ul>	
																	 <li  class="span1_of_1">
																		 <h5>Desired Service Date</h5>
																		 <div class="book_date">
																		<div class="book_date">
																				<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
																				<input class="date" name="date" id="datepicker" type="text" value="11/16/2016" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '11/16/2016';}" required="">
																		</div>	

																		 </div>		
																	 </li>
																	 
																	 <br>
                                                                    
																	<br>
                                                                
																	<br>
                                                                    
																	 <div class="clearfix"></div>
																</ul>
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
																<ul>	
																	 <li class="span1_of_3">
																			<div class="date_btn">
																				<br>
																				<?php if(isset($_SESSION['user'])) { ?> <input type="submit" name="submit" value="Submit Request" /> <?php } ?>
																			</div>
																	 </li>
																	 <div class="clearfix"></div>
																</ul>
																</form>
															</div>
															<?php
															}
															?>
														</div>
														<div class="clearfix"></div>
													</div>
											</div>
											<!---->
										</div>	
									</div>
								</div>
								<!--<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-1">
									<div class="facts">
										<div class="flights">
										<div class="reservation">
												<ul>
                        
 <div class="col-xs-5">
        <select name="from[]" class="js-multiselect form-control" size="8" multiple="multiple">
            <option value="1">Item 1</option>
            <option value="2">Item 5</option>
            <option value="2">Item 2</option>
            <option value="2">Item 4</option>
            <option value="3">Item 3</option>
        </select>
    </div>
    
    <div class="col-xs-2">
        <button type="button" id="js_right_All_1" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
        <button type="button" id="js_right_Selected_1" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
        <button type="button" id="js_left_Selected_1" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
        <button type="button" id="js_left_All_1" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
    </div>
    
    <div class="col-xs-5">
        <select name="to[]" id="js_multiselect_to_1" class="form-control" size="8" multiple="multiple"></select>
    </div>
                                                   


													 <div class="clearfix"> </div>
												</ul>
											</div>
											
											<div class="reservation">
												<ul>	<br>
													 <li class="span1_of_3">
															<div class="date_btn">
																<form>
																	<input type="submit" value="Choose Product" />
																</form>
															</div>
													 </li>
													 <div class="clearfix"></div>
												</ul>
											</div>
										</div>
									</div>
								</div>-->
								<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-2">
									<div class="facts">
										<div class="cars">
			<form name="myForm1" action="index.php" method="post">
    
            <table cellspacing='100'> 
	<thead>
	<?php
	if(isset($_SESSION['user']))
	{
	?>
		<tr>
			<th>Order #</th>
            <th>Technician</th>
			<th>Status</th>
		</tr>
	</thead><!-- Table Header -->
 
	<tbody  data-link="row" class="rowlink" ><!--id = "selectable">-->
		<?php
		if($_SESSION['role'] == "admin"){
			$getTrackOrder = "select * from orders";
		} else {
			$getTrackOrder = "select * from orders where user='$_SESSION[user]'";
		}
		//echo $getTrackOrder;
		$resGetTrackOrder = mysqli_query($link, $getTrackOrder);
		//echo "<li><a href='#'><img src='images/thumbs/1.jpg' data-large='images/1.jpg' alt='image01' data-description='From off a hill whose concave womb reworded' /></a></li>";
			/*$row=mysqli_fetch_array($result, MYSQLI_BOTH);
			echo "Let's see ".$row["data_desc"];
		*/
		while($row=mysqli_fetch_array($resGetTrackOrder, MYSQLI_BOTH))
		{
			$orderId = $row["orderId"];
			$technician = $row["techId"];
			$status = $row["status"];
		?>
		<tr class="ui-widget-content">
			<td><a href="<?php echo "order.php?orderId=$orderId"; ?>"><?php echo $orderId; ?></a></td>
			<td><a href="<?php echo "order.php?orderId=$orderId"; ?>"><?php echo $technician; ?></a></td>
			<td><a href="<?php echo "order.php?orderId=$orderId"; ?>"><?php echo $status; ?></a></td>
		</tr><!-- Table Row -->
		<?php
	}}
		?>
	</tbody>
</table>                        
			
    <div class="row">
    
                                            
   
                                            
                                            
											<div class="reservation">
												<ul>	
													 <li class="span1_of_3">
															<div class="date_btn date_car">
																
															</div>
													 </li>
													 <div class="clearfix"></div>
												</ul>
											</div>
										</div>
										</form>
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
				<?php if(!isset($_SESSION['user'])) { ?>
				<div class="new-people">
				
				<a href="sign-up.php"> Register</a>
				</div>
				<div class="new-people">
				
				<a href="login.php"> Login</a>
				</div>
				<?php } else if(isset($_SESSION['role']) && $_SESSION['role'] == "admin") {?>
				<div class="new-people">
				
				<a href="sign-up.php"> Register</a>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	</div>
<!-- //banner -->
<!-- about-us -->
	<div id="about" class="about">
		<div class="container">
			<h3>About Us</h3>
			<p class="ever">Ferguson Enterprises IT: Make IT Happen!</p>
			<div class="about-grids">
				<div class="col-md-6 about-grid">
					<div class="about-grid1">
						<div class="itis">
							<h4>Customer Maintenace System</h4>
						</div>
						<div class="hji">
							<p>Our Customer Maintenance System makes it easier for you to track your service order! </p>
						</div>
						<div class="about-grid1-pos">
							<img src="images/1.jpg" alt=" " class="img-responsive" />
						</div>
					</div>
				</div>
				<div class="col-md-6 about-grid">
					<div class="about-grid2">
						<div class="col-xs-2 about-grid2-left">
							<p>01.</p>
						</div>
						<div class="col-xs-10 about-grid2-right">
							<p>First, set up your maintenance order. Do so by picking your closest Ferguson branch then 
                                choosing your desired day of service.</p>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="about-grids">
				<div class="col-md-6 about-grid">
					<div class="about-grid2">
						<div class="col-xs-2 about-grid2-left">
							<p>02.</p>
						</div>
						<div class="col-xs-10 about-grid2-right">
							<p>Next, select the items that you would like maintenanced. Items with a warranty will have a green checkmark while items without proper warranty will have a red X. </p>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="col-md-6 about-grid">
					<div class="about-grid1 about-grd1">
						<div class="itis">
							<h4>We Make it Easy for You</h4>
						</div>
						<div class="hji">
							<p>Through the CMS app, we make your service order quicker and faster</p>
						</div>
						<div class="about-grid1-pos1">
							<img src="images/2.jpg" alt=" " class="img-responsive" />
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
<!-- //about-us -->
<!-- about-bottom -->
	<div class="about-bottom">
		<div class="container">
			<section class="slider">
				<div class="flexslider">
					<ul class="slides">
						<li>
							<div class="about-bottom-grids">
								<div class="col-md-4 about-bottom-grid-left">
									<h3>Meet The Technicians</h3>
									<p>The people that make it happen<span>JaHTML</span></p>
								</div>
								<div class="col-md-8 about-bottom-grid-right">
									<div class="col-md-4 about-bottom-grid-right-grid">
										<div class="about-bottom-grid-right-grid1">
											<img src="images/4.jpg" alt=" " class="img-responsive" />
											<div class="about-bottom-pos">
												<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
											</div>
											<p> Carrington Smith</p>
										</div>
									</div>
									<div class="col-md-4 about-bottom-grid-right-grid">
										<div class="about-bottom-grid-right-grid1">
											<img src="images/5.jpg" alt=" " class="img-responsive" />
											<div class="about-bottom-pos">
												<span class="glyphicon glyphicon-random" aria-hidden="true"></span>
											</div>
											<p>Jeff Siffert</p>
										</div>
									</div>
									<div class="col-md-4 about-bottom-grid-right-grid">
										<div class="about-bottom-grid-right-grid1">
											<img src="images/6.jpg" alt=" " class="img-responsive" />
											<div class="about-bottom-pos">
												<span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
											</div>
											<p>Karen Overstreet</p>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="clearfix"></div>
							</div>
						</li>
						<li>
							<div class="about-bottom-grids">
								<div class="col-md-4 about-bottom-grid-left">
									<h3>Meet the Technicians</h3>
									<p>Customer Maintenance Service<span>JaHTML</span></p>
								</div>
								<div class="col-md-8 about-bottom-grid-right">
									<div class="col-md-4 about-bottom-grid-right-grid">
										<div class="about-bottom-grid-right-grid1">
											<img src="images/8.jpg" alt=" " class="img-responsive" />
											<div class="about-bottom-pos">
												<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
											</div>
											<p>Michele Owen</p>
										</div>
									</div>
									<div class="col-md-4 about-bottom-grid-right-grid">
										<div class="about-bottom-grid-right-grid1">
											<img src="images/9.jpg" alt=" " class="img-responsive" />
											<div class="about-bottom-pos">
												<span class="glyphicon glyphicon-random" aria-hidden="true"></span>
											</div>
											<p>Randy Wimbush</p>
										</div>
									</div>
									<div class="col-md-4 about-bottom-grid-right-grid">
										<div class="about-bottom-grid-right-grid1">
											<img src="images/7.jpg" alt=" " class="img-responsive" />
											<div class="about-bottom-pos">
												<span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
											</div>
											<p>Eric Sydnor</p>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="clearfix"></div>
							</div>
						</li>
					</ul>
				</div>
			</section>
		</div>
	</div>
<!-- Customer Reviews -->
	<div id="portfolio" class="portfolio">
		<div class="container">
			<h3>Customer Reviews</h3>
			<p class="ever">See what some of our Customers are talking about!</p>
			<div class="main">
                <div class="view view-seventh">
					<!--<a href="" rel="title" class="b-link-stripe b-animate-go  thickbox">-->
						<img src="images/11-.jpg" />
						<div class="mask">
							<h2>Aamir Khan</h2>
                            <h3>Tulsa, OK</h3>
							<p> The new CMS app is great! It definitely increased the quality of my service. I have no problem with doing business with Ferguson again. 
                            </p>
                        </div>
					<!--</a>-->
                </div>
                <div class="view view-seventh">
                    <!--<a href="" rel="title" class="b-link-stripe b-animate-go  thickbox">-->
						<img src="images/12-.jpg" />
						<div class="mask">
							<h2>Luke Cage</h2>
                            <h3>Hell's Kitchen</h3>
							<p>The CMS app make repair orders quick and efficient. That leaves me with more time to clean up Hell's Kitchen.</p>
						</div>
					<!--</a>-->
                </div>
                <div class="view view-seventh">
                    <!--<a href="" rel="title" class="b-link-stripe b-animate-go  thickbox">-->
						<img src="images/13-.jpg" />
						<div class="mask">
							<h2>Timmy Turner</h2>
                            <h3>Dimmsdale</h3>
							<p>My Fairy Godparents were on vacation the same week my fridge broke! Using the CMS app, I was able to quickly request a technician to my house. </p>
						</div>
					<!--</a>-->
                </div>
                <div class="view view-seventh">
                    <!--<a href="" rel="title" class="b-link-stripe b-animate-go  thickbox">-->
						<img src="images/14-.jpg" />
						<div class="mask">
							<h2>Nia Long</h2>
                            <h3>Secaucus, NJ</h3>
                            <h3></h3>
							<p>I love this app! its clean, user-friendly,and very helpful!  Definitely improvess the user experience.</p>
						</div>
					<!--</a>-->
                </div>
            </div>
			
			
		</div>
	</div>
<!-- //portfolio -->
<!-- twitter-text -->
	<div id="dfg" class="twitter-text">
		<div class="container">
			<div class="twitter-txt">
				<h3><a href="mailto:info@example.com">info@example.com</a> Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero.</h3>
				<p>about 13 hours,12 minutes ago</p>
			</div>
		</div>
	</div>
<!-- //twitter-text -->
<!-- events -->
	<div id="events" class="events">
		<div class="container">
			<h3>News & <span>Events</span></h3>
			<p class="ever">Ferguson has some great things planned for November!.</p>
			<div class="events-grids">
				<div class="col-md-4 events-grid">
					<div class="cal">
						<img src="images/3.png" alt=" " class="img-responsive" />
						<div class="cal-info">
							<h4>Ferguson acquires Hawaii distributor</h4>
							<p>Ferguson Enterprisees recently announcd it has acquired The Plubing Source in a stock transaction completed October 24th. The Plumbing Source is a single-location plumbing supplier serving Honolulu, Hawaii and has 19 associates. </p>
						</div>
					</div>
				</div>
				<div class="col-md-4 events-grid">
					<div class="cal">
						<img src="images/3.png" alt=" " class="img-responsive" />
						<div class="cal-info">
							<h4>Ferguson Truck recovered from Sarasota Bay</h4>
							<p>A box truk that plunged off the Coon Key Bridgee about 10 a.m. Monday, snarling traffic for hours along John Ringling Causeway, was pulled out of Sarasota Bay about 5 p.m., according to Sarasota police.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 events-grid">
					<div class="cal">
						<img src="images/3.png" alt=" " class="img-responsive" />
						<div class="cal-info">
							<h4>Ferguson Makes Top 300 of B2B E-Commerce Companies</h4>
							<p>Ferguson Enterprises is a long-standing supplier of plumbing, HVAC, and industrial products. They recently ranked in th Top 300 of B2B E-Commerce Companies as stated by Internet Retailer Magazine. Their success liess on their long-standing customer base paired with their aggressive pricing. </p>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="events-grids1">
				<div class="col-md-4 events-grid1">
					<div class="events-grid11">
						<span>01.</span>
						<div class="events-grid11-info">
							<h4><i class="glyphicon glyphicon-calendar" aria-hidden="true"></i><label>8 November 2016</label>Election Day Gathering</h4>
							<p>Come Join the Ferguson family as we watch the results for the next election</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 events-grid1">
					<div class="events-grid11">
						<span>02.</span>
						<div class="events-grid11-info">
							<h4><i class="glyphicon glyphicon-calendar" aria-hidden="true"></i><label>11 November 2016</label>Ferguson "Up to Code" Hackathon</h4>
							<p>Ferguson's first Hackathon is an event to inspire innovation and attract designers and developers from the Hampton Roads area to collaborate and create new tech produts. Free food, prizes, and oppurtunity to interact with other devlopers!</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 events-grid1">
					<div class="events-grid11">
						<span>03.</span>
						<div class="events-grid11-info">
							<h4><i class="glyphicon glyphicon-calendar" aria-hidden="true"></i><label>19 December 2016</label>Winter Collection</h4>
							<p>Visit our website and check out our new Spring Collection.Including products from our Kohler, American Standard, Delta, and Moen lines.</p>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>


	<div class="map">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3181.05318928251!2d-76.51227498422784!3d37.12764957988251!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89b07ed0dce11ba3%3A0x98cf8a6c4b4b3aca!2s12500+Jefferson+Ave%2C+Newport+News%2C+VA+23602!5e0!3m2!1sen!2sus!4v1479046155770" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>

	<div class="footer">
		<div class="container">
			<div class="footer-left">
				<ul>
					<li><a href="index.php"><i>Ja</i>HTML</a><span> |</span></li>
					<li><p>CMS <span>12500 Jefferson Avenue, Newport News, VA, 23602</span></p></li>
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