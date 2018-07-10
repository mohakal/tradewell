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
                                <a href="tel:+88 02 55 048 777" class="phone"><img src="image/Phone.png" width="35"> <span class="mobile">+88 02 55 048 777</span></a>
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
  var myCenter = new google.maps.LatLng(23.7903641,90.4247447);
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
<script src="js/lightslider.js"></script>


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
		//
		$(".dropdown-submenu").hover(function(){
			//alert('asd');
			//$(".dropdown-submenu").css( "display", "none" );
			$(this).siblings(".dropdown-submenu").children().css( "display", "none" );
			//$(this).children().children(".dropdown-submenu").css( "display", "none" );
			$(this).children().css( "display", "block" );
		  // action goes here!!
		});
		$(document).click(function(e) 
		{
			var container = $(".dropdown-submenu");

			// if the target of the click isn't the container nor a descendant of the container
			if (!container.is(e.target) && container.has(e.target).length === 0) 
			{
				container.children('ul').css( "display", "none" );
			}
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
<script>
	var input = document.getElementById("exampleInputAmount");
		input.addEventListener("keyup", function(event) {
  // Cancel the default action, if needed
  event.preventDefault();
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Trigger the button element with a click
    //document.getElementById("myBtn").click();
	var a=document.getElementById("exampleInputAmount").value;
	window.location="index.php?s="+a;
	//alert(a);
  }
}); 
		</script>
<script>
	function search_product(){
	var a=document.getElementById("exampleInputAmount").value;
	window.location="index.php?s="+a;
	
	}
</script>	
</body>

</html>