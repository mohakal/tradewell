<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Hello, world!</title>
		
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		
		<link href="css/slick.css" rel="stylesheet" type="text/css">
		<link href="css/slick-theme.css" rel="stylesheet" type="text/css">
		
		
		
		<link rel="stylesheet" href="css/style.css">
		
		<link rel="stylesheet" href="css/responsive.css">
		<!-- slider menu -->
		<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
		
		<link rel="shortcut icon" href="favicon.ico"/>
		<!--<link href="slider_menu/slider-menu.jquery.css" rel="stylesheet">
		<link href="slider_menu/slider-menu.theme.jquery.css" rel="stylesheet"> -->
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,600" rel="stylesheet">
		<!-- slider menu -->
		<script>
			function startTime() {
				var today = new Date();
				var h = today.getHours();
				var m = today.getMinutes();
				var s = today.getSeconds();
				m = checkTime(m);
				s = checkTime(s);
				if(h<10)
				{
					h = "0"+h;
				}
				
				
				document.getElementById('time').innerHTML =
				h + ":" + m ;
				var t = setTimeout(startTime, 500);
			}
			function checkTime(i) {
				if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
				return i;
			}
		</script>
	</head>
	<body onload="startTime()">
		<?php
			include('manage/DB/db.php');
		?>
		
		<header>
			<div class="container-fluid">
				<div class="row header-container">
					<div class="col-md-4 col-lg-3 menu-container" >
						
						<div class="dropdown">
							<a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-bars  menu-icon" aria-hidden="true"></i> Menu
							</button>
							<div class="dropdown-menu dropdown-menu-wrap " aria-labelledby="dropdownMenuButton">
								<ul class="top-menu">
									<li><a  href="#"><img src="image/icon-home.png" /> Home</a></li>
									<li class="dropdown-submenu"><a  href="#"> <img src="image/icon-our-value.png" /> Product</a>
										
										<!--		<ul class="dropdown-menu">
											<h>prod</h>
											<li><a tabindex="-1" href="#">2nd level dropdown</a></li>
											<li><a tabindex="-1" href="#">2nd level dropdown</a></li>
											<li class="dropdown-submenu">
											<a class="test" href="#">Another dropdown <span class="caret"></span></a>
											<ul class="dropdown-menu">
											<li><a href="#">3rd level dropdown</a></li>
											<li><a href="#">3rd level dropdown</a></li>
											</ul>
											</li>
										</ul> -->
										<?php
											$menu=get_menu();
											echo "<ul class='dropdown-menu dropdown1 my-menu slider'>";
											foreach($menu AS $index1=>$value1){
												//$as='';
												if(count($value1['sub_item'])>0){
													$as="data-vertical='true'";
												}
												else{
													$as='';
												}
												echo "<li class='dropdown-submenu ' ".$as.">";
												echo $value1['name'];
												if(count($value1['sub_item'])>0){
													echo "<ul class='dropdown-menu '>";
													foreach($value1['sub_item'] AS $index2=>$value2){
														echo "<li class='dropdown-submenu'>";
														echo $value2['name'];
														if(count($value2['sub_item'])>0){
															echo "<ul class='dropdown-menu dropdown1'>";
															foreach($value2['sub_item'] AS $index3=>$value3){
																echo "<li class='dropdown-submenu'>";
																echo $value3['name'];
																if(count($value3['products'])>0){
																	echo "<ul class='dropdown-menu'>";
																	foreach($value3['products'] AS $index4=>$value4){
																		
																		$a= "\"product_details.php?id=".$value4['id']."\"";
																		
																		echo "<li onclick='window.location=(".$a.")'>";
																		echo $value4['fname'];
																		echo "</li>";
																	}
																	echo "</ul>";
																}
																echo "</li>";
															}
															echo "</ul>";
														}
														else{
															if(count($value2['products'])>0){
																echo "<ul class='dropdown-menu'>";
																foreach($value2['products'] AS $index4=>$value4){
																	
																	$a= "\"product_details.php?id=".$value4['id']."\"";
																	
																	echo "<li onclick='window.location=(".$a.")'>";
																	echo $value4['fname'];
																	echo "</li>";
																}
																echo "</ul>";
															}
														}
														echo "</li>";
													}
													echo "</ul>";	
												}
												else{
													if(count($value1['products'])>0){
														echo "<ul class='dropdown-menu'>";
														foreach($value1['products'] AS $index4=>$value4){
															
															$a= "\"product_details.php?id=".$value4['id']."\"";
															
															echo "<li onclick='window.location=(".$a.")'>";
															echo $value4['fname'];
															echo "</li>";
														}
														echo "</ul>";
													}
												}
												echo "</li>";
											}
											echo "</ul>";
											
											
											
										?>
									</li>
									<li><a  href="#"><img src="image/icon-refference-site.png" /> Refference Site</a></li>
									
									<li><a  href="#"><img src="image/icon-press-room.png" /> Press Room</a></li>
									<li><a  href="#"><img src="image/icon-product.png" /> Our Value</a></li>
									
									<li><a  href="#"><img src="image/icon-contact-us.png" />Contact us</a></li>
									<li><a  href="#"><img src="image/my-assistance.png" /> My assistant <div class="assistant"><p>Your product inquiry and  our instant co-operation.</span></p></a></li>
								</ul>
								
								
								
							</div>
							
							<a href="" class="user"><i class="fa fa-user-o user-icon" aria-hidden="true"></i> </a>
							<a href="" class="shopping-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i></a> 
						</div>
					</div>
					
					<div class="col-md-4 col-lg-6"
					style="height:70px;background-color:rgb(121,18,27);vertical-align: middle;line-height: 70px;">
						<div class="row" style="vertical-align: middle;line-height: 50px;">
							<div class="col-md-12"
							style="margin-top:5px;margin-bottom:5px;background-color:rgb(168,168,168);height:60px;">
								<div class="input-group" style="margin-top:5px;" style="display:none;">
									
									<input type="text" class="form-control" id="exampleInputAmount" style="height: 48px;"
									placeholder="Product">
									<span class="search"> <i class="fa fa-search" aria-hidden="true"></i>  </span>
									
									
								</div>
							</div>
						</div>
						
					</div>
					<div class="col-md-4 col-lg-3 header-right"
					style="">
						<a href="" class="white">B to B</a>
						<a href="" class="white">B to C  <span class="white">|</span></a>
						
						<a href="" class="white">Group</a>
					</div>
				</div>
			</div>
		</header>
		<section class="banner">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12" style="padding:0px;">
						
						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
								<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
								<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
							</ol>
							<div class="carousel-inner">
								<div class="overlay">
									<div class="site-logo">
										
									</div>
									<div class="weather-container">
										<div class="weather">
											<div class="row">
												<div class="col-md-5">
													<p class="city">dhaka</p>
													<p class="time" id="time">88:88</p>
												</div>
												<div class="col-md-2">
													<span class="line">|</span>
												</div>
												<div class="col-md-5">
													<img src="image/cloud.png" title="cloud" />
													<p class="temparature">25 <sup>0</sup></p>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="carousel-item active">
									<img class="d-block w-100" src="image/Chrysanthemum.jpg" alt="First slide">
								</div>
								<div class="carousel-item">
									<img class="d-block w-100" src="image/Desert.jpg" alt="Second slide">
								</div>
								<div class="carousel-item">
									<img class="d-block w-100" src="image/Hydrangeas.jpg" alt="Third slide">
								</div>
								<div class="carousel-item">
									<img class="d-block w-100" src="image/Hydrangeas.jpg" alt="Third slide">
								</div>
							</div>
							<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
						<div class="banner-info">
							
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="brand">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 brand-title" style="">
						<h2>OUR WELL KNOWN BRANDS</h2>
					</div>
					<div class="col-md-12">
						
						<section class="center slider">
							<?php
								$brands=get_brands();
								foreach($brands AS $index=>$val){
								?>
								<div class="brand-item">
									<img src="<?php echo $val['image'];?>"/>
								</div>
								<?php
								}
								
							?>
							
						</section>
					</div>
				</div>
			</div>
		</section>
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-2 sidebar">
						<div class="sidebar-top align-middle">
							<div class="sidebar-top-content">
								<h2>
									Product
								</h2>
								<i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
							</div>
							
							
						</div>
						
						<div class="sidebar-content">
							<h3>Show Result For</h3>
							<div class="slide-list">
								<ul class="category">
									<li>
										<i class="fa fa-chevron-down" aria-hidden="true"></i> Accessories
										<ul>
											<li><a href="http://msn.com">Not Available</a></li>
											<li><a href="http://yahoo.com">Not Available</a></li>
										</ul>
									</li>
									<li><i class="fa fa-chevron-down" aria-hidden="true"></i> Board
										<ul>
											<li><a href="http://msn.com">Not Available</a></li>
											<li><a href="http://yahoo.com">Not Available</a></li>
										</ul>
									</li>
									<li><i class="fa fa-chevron-down" aria-hidden="true"></i> Compound
										<ul>
											<li><a href="http://msn.com">Not Available</a></li>
											<li><a href="http://yahoo.com">Not Available</a></li>
										</ul>
									</li>
									<li><i class="fa fa-chevron-down" aria-hidden="true"></i>
										Glass World
										
										<ul>
											<li><a href="http://msn.com">Not Available</a></li>
											<li><a href="http://yahoo.com">Not Available</a></li>
										</ul>
									</li>
									<li><i class="fa fa-chevron-down" aria-hidden="true"></i>
										Steel Frame
										
										<ul>
											<li><a href="http://msn.com">Not Available</a></li>
											<li><a href="http://yahoo.com">Not Available</a></li>
										</ul>
									</li>
									<li><i class="fa fa-chevron-down" aria-hidden="true"></i>
										Wood Plank
										
										<ul>
											<li><a href="http://msn.com">Not Available</a></li>
											<li><a href="http://yahoo.com">Not Available</a></li>
										</ul>
									</li>
								</ul>
							</div>
							
						</div>
						
					</div>
					
					
					<div class="col-md-10">
						<div class="row product-items">
							<?php $products=products();
								/* echo "asd<pre>";
									
									print_r($products);
								echo "</pre>"; */
								foreach($products AS $index=>$val){
								?>
								<div class="item col-xs-3 col-md-4 col-lg-2">
									<div class="thumbnail">
										<img class="group list-group-image"
										src="<?php echo $val['image'];?>"
										alt=""  style="margin-top: 37px;width:100%;">
										<div class="caption">
											<h4 class="group inner list-group-item-heading"><a href="#"> <?php echo $val['cat'];?>/ </a> <?php echo $val['product_name'];?></h4>
											<div class="row">
												<div class="ratings col-xs-12 col-md-12">
													<?php
														if($val['star']==5){
														?>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<?php
														}
														elseif($val['star']<5 AND $val['star']>4){
														?>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star-half-o" aria-hidden="true"></i>
														<?php
														}
														elseif($val['star']==4){
														?>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star-o" aria-hidden="true"></i>
														<?php
														}
														elseif($val['star']<4 AND $val['star']>3){
														?>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star-half-o" aria-hidden="true"></i>
														<i class="fa fa-star-o" aria-hidden="true"></i>
														<?php
														}
														elseif($val['star']==3){
														?>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star-o" aria-hidden="true"></i>
														<i class="fa fa-star-o" aria-hidden="true"></i>
														<?php
														}
														elseif($val['star']<3 AND $val['star']>2){
														?>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star-half-o" aria-hidden="true"></i>
														<i class="fa fa-star-o" aria-hidden="true"></i>
														<i class="fa fa-star-o" aria-hidden="true"></i>
														<?php
														}
														elseif($val['star']==2){
														?>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star-o" aria-hidden="true"></i>
														<i class="fa fa-star-o" aria-hidden="true"></i>
														<i class="fa fa-star-o" aria-hidden="true"></i>
														<?php
														}
														elseif($val['star']<2 AND $val['star']>1){
														?>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star-half-o" aria-hidden="true"></i>
														<i class="fa fa-star-o" aria-hidden="true"></i>
														<i class="fa fa-star-o" aria-hidden="true"></i>
														<i class="fa fa-star-o" aria-hidden="true"></i>
														<?php
														}
														else{
														?>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star-o" aria-hidden="true"></i>
														<i class="fa fa-star-o" aria-hidden="true"></i>
														<i class="fa fa-star-o" aria-hidden="true"></i>
														<i class="fa fa-star-o" aria-hidden="true"></i>
														<?php
														}
														
													?>
													<!--     <i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star-half-o" aria-hidden="true"></i>-->
													
													<p class="count"> 21,23</p>
												</div>
												<div class="col-xs-12 col-md-12">
													<p class="product-price-index"> Price: BDT <?php echo number_format($val['price'],0);?>
													<a class="product-details" href="product_details.php?id=<?php echo $val['id'];?>">details</a></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php }?>
							
						</div>
					</div>
				</div>
			</div>
		</section>
		<footer>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-2 col-lg-2">
						
					</div>
					<div class="footer-info col-md-10 col-lg-10">
						<div class="row" style="margin-bottom:10px;">
							<div class="col-md-4 col-lg-4">
								<div class="contact-info">
									<h2>Contact Us</h2>
									<a href="tel:01811-41 84 02" class="phone"><img src="image/Phone.png" width="35"> <span class="mobile">01811-41 84 02</span></a>
									<div class="clear"></div>
									<a href="#" class="location"><img class="footer-location" src="image/Location.png" width="35"> <p class="address">Ka-52, Pragati Sarani, Sahjadpur, Gulshan, Dhaka 1212, Bangladesh</p> </a>
									
									<h2 class="follow-us-tittle">Follow Us</h2>
									<ul class="follow-us">
										<li><a href="#"><img src="image/Facebook.png" width="30" alt=""> </a></li>
										<li><a href="#"><img src="image/Instagram.png" width="30" alt=""> </a></li>
										<li><a href="#"><img src="image/Twitter.png" width="30" alt=""> </a></li>
										<li><a href="#"><img src="image/Youtube.png" width="30" alt=""> </a></li>
									</ul>
								</div>
							</div>
							<div class="col-md-8 col-lg-8">
								<div style="width:100%;height:266px" class="map-container" id="map">
									<!--    <iframe width="100%" height="300"
                                        src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;coord=23.7903329,90.42489,20.04z&amp;q=1%20Grafton%20Street%2C%20Dublin%2C%20Ireland+(My%20Business%20Name)&amp;ie=UTF8&amp;t=&amp;z=17&amp;iwloc=B&amp;output=embed"
                                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a
                                        href="https://www.maps.ie/create-google-map/">Google Maps iframe generator</a>
									</iframe>-->
									<script>
										function myMap() {
											var myCenter = new google.maps.LatLng(23.790727, 90.424647);
											var mapCanvas = document.getElementById("map");
											var mapOptions = {center: myCenter, zoom:15};
											var map = new google.maps.Map(mapCanvas, mapOptions);
											var marker = new google.maps.Marker({position:myCenter,title: 'TradeWell',
												label: {
													text: "TradeWell",
													color: "#761C19",
													fontWeight: "bold",
													fontSize: "16px",
													position:"left"
												}});
												marker.setMap(map);
										}
									</script>
									
									<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLHtN-9RIR4_a1V0mc0XdpZ8zC6mZY0I8
									&callback=myMap"></script>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 footer-menu">
						<ul class="footer-menu-list">
							<li><a href="#">Help</a></li>
							<li><a href="#">Faq</a></li>
							<li><a href="#">Term and Condition</a></li>
							<li><a href="#">Search</a></li>
							
						</ul>
					</div>
				</div>
			</div>
		</footer>
		
		
		
		
		
		
		
		
		
		
		
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script> -->
		<script  src="js/jquery.min.js"></script>
		<script  src="js/jquery-3.3.1.slim.min.js" ></script>
		<script  src="js/popper.min.js" ></script>
		<script  src="js/bootstrap.min.js" ></script>
		<script  src="js/slick.js"></script>
		
		
		
		<script>
			$(document).ready(function () {
				$('.dropdown-submenu a.test').on("click", function (e) {
					$(this).next('ul').toggle();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				// For Brand
				$(".center").slick({
					dots: false,
					infinite: true,
					centerMode: true,
					slidesToShow: 11,
					slidesToScroll: 3,
					responsive: [
					{
						breakpoint: 1600,
						settings: {
							slidesToShow: 5,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
					// You can unslick at a given breakpoint now by adding:
					// settings: "unslick"
					// instead of a settings object
					]
					
				});
				
				// For slide Category List at sidebar
				var slide_product_list = jQuery(".slide-list ul li ul li");
				var slide_list = jQuery(".slide-list ul li").filter(":has(ul)");
				
				slide_product_list.hide();
				
				slide_list.click(function () {
					$(this).find('ul li').slideToggle("fast, 100");
				});
				
			});
		</script>
		<!--<script src="slider_menu/slider-menu.jquery.js"></script>-->
		
		<script>
			/* ( function( $ ) {
				$( function() {
				alert($( window ).width());
				if($( window ).width()<700){
				
				$( '.my-menu' ).sliderMenu();
				}
				});
			})( jQuery ); */
		</script>
		<!--call jPushMenu, required-->
		
	</body>
	
</html>