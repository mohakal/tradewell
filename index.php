<?php include('header.php');?>
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
                                                <p class="city">DHAKA</p>
                                                <p class="time" id="time">88:88</p>
                                            </div>
                                            <!-- <div class="col-md-2">
                                                <span class="line">|</span>
                                            </div>
                                            <div class="col-md-5">
                                                <img src="image/cloud.png" title="cloud" />
                                                <p class="temparature">25 <sup>0</sup></p>
                                            </div> -->
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
					<?php 
					if(isset($_GET['s'])){
					$products=products_search($_GET['s']);
					}
					else{
					$products=products();
					}	/* echo "asd<pre>";
						
						print_r($products);
						echo "</pre>"; */
						if(count($products)>0){
						foreach($products AS $index=>$val){
						?>
                        <div class="item col-xs-3 col-md-4 col-lg-2">
                            <div class="thumbnail">
                                <img class="group list-group-image"
                                     src="<?php echo $val['image'];?>"
                                     alt=""  style="margin-top: 37px;width:141px; height:171px;">
                                <div class="caption">
                                    <h4 class="group inner list-group-item-heading" style="height: 73px;"><a href="#"><span style="font-size:16px;"> <?php echo $val['cat'];?> </span></a><br><span style="font-size:14px;"> <i><?php echo $val['product_name'];?></i></span></h4>
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

                                           <!-- <p class="count"> 21,23</p>-->
                                        </div>
                                        <div class="col-xs-12 col-md-12">
                                            <p class="product-price-index">BDT <?php echo number_format($val['price'],0);?>
                                                <a class="product-details" href="product_details.php?id=<?php echo $val['id'];?>">DETAILS</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<?php }
						}
						else
							echo "<script>alert('Sorry No Product Found');window.location='index.php';</script>";
							
						?>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include('footer.php');?>