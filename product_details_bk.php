<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Product Details</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">




    <link rel="stylesheet" href="css/lightslider.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="css/responsive.css">

</head>
<body onload="startTime()">
<?php
include('manage/DB/db.php');

$product_details=product_details($_GET['id']);
/* echo "<pre>";
print_r($product_details);
echo "</pre>"; */
//echo $product_details[''];
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
								<li><a  href="index.php"><img src="image/icon-home.png" /> Home</a></li>
									<li class="dropdown-submenu"><a  href="#"> <img src="image/icon-our-value.png" /> Product</a>
						
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
								echo "<li>";
								echo $value4['fname'];
								echo "</li>";
							}
							echo "</ul>";
						}
						echo "</li>";
					}
					echo "</ul>";
				}
				echo "</li>";
			}
			echo "</ul>";	
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
   <section class="product-details">
    <div class="product-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Product Details</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="product-content">
        <div class="container product-logo-container">
            <div class="product-site-logo">
                <img src="image/logo.png" alt="site logo" height="213" width="113">
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                   
						<?php echo $product_details['bread'];?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"><h1 class="product-title"><?php echo $product_details['product_name'];?></h1></div>
            </div>
            <div class="product-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="product-left">
                           <div class="row">
                               <div class="col-md-12">
                                   <div class="item">
                                       <div class="clearfix" style="max-width:474px;">
                                           <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
										   
										   <?php
										   
											foreach($product_details['images'] AS $index=>$value){
											?>
											<li data-thumb="<?php echo $value['timage'];?>">
                                                   <img src="<?php echo $value['image'];?>" />
                                               </li>
											<?php
											}
											   
											?>
                                         
                                           </ul>
                                       </div>
                                   </div>
                               </div>
                           </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="container">

                                        <ul class="tabs">
                                            <li class="tab-link current" data-tab="tab-1">Further Information</li>
                                            <li class="tab-link" data-tab="tab-2">Product Details</li>
                                            <li class="tab-link" data-tab="tab-3">Other Information</li>
                                        </ul>

                                        <div id="tab-1" class="tab-content current" style="word-wrap: break-word;">

                                    
										<?php echo $product_details['further_information'];?>
                                        </div>
                                        <div id="tab-2" class="tab-content" style="word-wrap: break-word;">
										
											<?php echo $product_details['product_details'];?>
                                        </div>
										<div id="tab-3" class="tab-content" style="word-wrap: break-word;">
										
											<?php echo $product_details['other_information'];?>
                                        </div>
                                       

                                    </div><!-- container -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product-right">
                            <div class="row">
                                <div class="col-md-12" >
                                    <img src="<?php echo $product_details['company_logo'];?>" height="39" width="211" alt="asian paint brand logo">
                                    <h3><?php echo $product_details['product_name'];?></h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="product-features">
                                        <ul class="features">
                                          
											
											<?php
												
											foreach($product_details['features'] AS $index=>$value){
											echo $value;
											}
											?>
											
                                        </ul>


                                    </div>
                                    <p class="product-price">Price: <?php echo $product_details['price'];?> taka</p>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-shopping-cart">
                                        <form action="">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Purchase
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                Qty:
                                                <select id="inputState">
                                                    <option selected>1</option>
                                                    <option>2</option>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="price">Price: <?php echo $product_details['price'];?> taka (<?php echo $product_details['measurement'];?>)</label>
                                                <input type="hidden" id="price" name="price" >
                                            </div>
                                            <button type="submit" id="cart-submit" >Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="product-footer">
                                    <h3>
                                        Royale Aspira
                                    </h3>
                                    <img src="image/royale-aspira.png" alt="">
                                </div>


                            </div>
                        </div>
                    </div>
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
                    <div class="row">
                        <div class="col-md-3 col-lg-3">
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
                        <div class="col-md-9 col-lg-9">
                             <div style="width:100%;height:300px" class="map-container" id="map">
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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLHtN-9RIR4_a1V0mc0XdpZ8zC6mZY0I8
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<script src="js/lightslider.js"></script>
<script>



    $(document).ready(function() {

        $("#content-slider").lightSlider({
            loop:true,
            keyPress:true
        });
        $('#image-gallery').lightSlider({
            gallery:true,
            item:1,
            thumbItem:9,
            slideMargin: 0,
            speed:500,
            auto:true,
            loop:true,
            onSliderLoad: function() {
                $('#image-gallery').removeClass('cS-hidden');
            }
        });



            $('ul.tabs li').click(function(){
                var tab_id = $(this).attr('data-tab');

                $('ul.tabs li').removeClass('current');
                $('.tab-content').removeClass('current');

                $(this).addClass('current');
                $("#"+tab_id).addClass('current');
            });
    });
</script>

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
<!--call jPushMenu, required-->

</body>

</html>