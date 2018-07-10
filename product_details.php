<?php include('header.php');
$product_details=product_details($_GET['id']);	
	?>
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
               <a href="index.php"> <img src="image/logo.png" alt="site logo" height="213" width="113"> </a>
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
                                       <div class="clearfix" style="max-width:474px;margin-left:0px;">
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
                                <div class="col-md-12" style="padding-left:0px;">
                                    <div class="container" style="padding-left:0px;">

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
                                    <img src="<?php echo $product_details['company_logo'];?>" width="211" alt=" ">
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

<?php include('footer.php');?>
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