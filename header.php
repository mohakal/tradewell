<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TradeWell</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

   <link href="css/slick.css" rel="stylesheet" type="text/css">
    <link href="css/slick-theme.css" rel="stylesheet" type="text/css">

 

    <link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/lightslider.css">
    <link rel="stylesheet" href="css/responsive.css">
	<!-- slider menu -->
	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

<link rel="shortcut icon" href="favicon.png"/>
<!--<link href="slider_menu/slider-menu.jquery.css" rel="stylesheet">
<link href="slider_menu/slider-menu.theme.jquery.css" rel="stylesheet"> -->
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,600" rel="stylesheet">
<!-- slider menu -->

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
								<li style="padding-bottom: 9px;"><a  href="index.php"><img src="image/icon-home.png" /> Home</a></li>
									<li class="dropdown-submenu" style="padding-bottom: 9px;"><a  href="#"> <img src="image/icon-our-value.png" /> Product</a>
									
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
																echo "<ul class='dropdown-menu dropdown1'>";
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
								<li style="padding-bottom: 9px;"><a  href="#"><img src="image/icon-refference-site.png" /> Refference Site</a></li>
								
								<li style="padding-bottom: 9px;"><a  href="#"><img src="image/icon-press-room.png" /> Press Room</a></li>
								<li style="padding-bottom: 9px;"><a  href="#"><img src="image/icon-product.png" /> Our Value</a></li>
							
								<li style="padding-bottom: 9px;"><a  href="#"><img src="image/icon-contact-us.png" />Contact us</a></li>
								<li style="padding-bottom: 9px;"><a  href="#"><img src="image/my-assistance.png" /> My assistant <div class="assistant"><p>Your product inquiry and  our instant co-operation.</span></p></a></li>
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
								
                                <input type="text" class="form-control" name="product" id="exampleInputAmount" style="height: 48px;"
                                       placeholder="Product" required>
							<span class="search" onclick="search_product()"> <i class="fa fa-search" aria-hidden="true"></i>  </span>

                              
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