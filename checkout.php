<?php
session_start();

require 'dbcon.php';

if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
    if (empty($_POST)) {
        header('Location: index.php');
        exit;
    }
    foreach ($_POST as $key => $val) {
        $array = explode('_', $key); // discount_amount_1 => Array([0] => discount, [1] => amount, [2] => 1)

        if (count($array) > 1) { // exclude keys without _
            $i = array_pop($array); // get and remove last member of array => Array([0] => discount, [1] => amount)
        } else {
            $i = $array[0];
        }

        $key = implode('_', $array); // Array([0] => discount, [1] => amount) => discount_amount

        if (is_numeric($i)) {
            $products[$i][$key] = $val;
        } else {
            $cart[$key] = $val;
        }
    }

    $total = $cart['total'];
    $_SESSION['products'] = $products;
    $_SESSION['total'] = $total;
} else {
    $products = $_SESSION['products'];
    $total = $_SESSION['total'];
}

if (isset($_SESSION['USER_ID']) && !empty($_SESSION['USER_ID'])) {
    $uid = $_SESSION['USER_ID'];
    $total = $_SESSION['total'];

    // Save order in ord
    $query = "INSERT INTO `ord`(`uid`, `total`) VALUES ($uid, $total)";
    $result = $conn->query($query);
    if (!$result) {
        echo 'Error: '.$conn->error;
        exit;
    }
    // Get oid of last saved order
    $oid = $conn->query('SELECT LAST_INSERT_ID();')
        ->fetch_assoc()['LAST_INSERT_ID()'];

    // Save all ordered products in order_items
    foreach ($products as $pid => $product) {
        $query = "INSERT INTO `order_items`(`oid`, `pid`, `quantity`, `amount`, `subtotal`) 
        VALUES ($oid, $pid, $product[quantity], $product[amount], $product[subtotal])";
        $result = $conn->query($query);
        if (!$result) {
            echo 'Error: '.$conn->error;
            exit;
        }
    }

    // Save payment info in payment
    $query = "INSERT INTO `payment`(`total_amount`, `payment_type`, `oid`, `uid`) VALUES ($total, 'COD', $oid, $uid)";
    $result = $conn->query($query);
    if (!$result) {
        echo 'Error: '.$conn->error;
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout | Grocery Store</title>
<?php
    include 'header.php'?>

<!-- banner -->
	<div class="banner">
		<div class="w3l_banner_nav_right">
<!-- payment -->
            <div class="privacy about">
                <h3>Pay<span>ment</span></h3>

                 <div class="checkout-right">
                    <?php
                    if (!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID'])) {
                        ?>
                    <div class="col-md-12 address_form_agile">
                        <section class="creditly-wrapper wthree, w3_agileits_wrapper" style="margin-top: 35px">
                            <div class="information-wrapper">
                                <a href="login.php?page=checkout">
                                    <button class="submit check_out btn-block">Login To Continue</button>
                                </a>
                            </div>
                        </section>
                    </div>
                    <div class="clearfix"></div>
                    <?php
                    } else {
                        ?>
                    <div class="col-md-12 address_form_agile">
                        <section class="creditly-wrapper wthree, w3_agileits_wrapper" style="margin-top: 35px">
                            <div class="information-wrapper">
                                <button class="submit check_out btn-block">Your order has been placed</button>
                            </div>
                        </section>
                    </div>
                    <div class="clearfix"></div>
                    <!--Horizontal Tab-->
                    <div id="parentHorizontalTab">
                        <ul class="resp-tabs-list hor_1">
                            <li>Cash on delivery (COD)</li>
                            <li>Credit/Debit</li>
                            <li>Netbanking</li>
                            <li>Paypal Account</li>
                        </ul>
                        <div class="resp-tabs-container hor_1">
                            <div>
                                 <div class="vertical_post check_box_agile">
                                    <div class="checkbox">
                                        <div class="check_box_one cashon_delivery">
                                            <label class="anim">
                                                <span> FOR NOW, We only support Cash on Delivery. We also accept Credit/Debit card on delivery.</span> 
                                            </label> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <form action="#" method="post" class="creditly-card-form agileinfo_form">
                                                <section class="creditly-wrapper wthree, w3_agileits_wrapper">
                                                    <div class="credit-card-wrapper">
                                                        <div class="first-row form-group">
                                                            <div class="controls">
                                                                <label class="control-label">Name on Card</label>
                                                                <input class="billing-address-name form-control" type="text" name="name" placeholder="John Smith">
                                                            </div>
                                                            <div class="w3_agileits_card_number_grids">
                                                                <div class="w3_agileits_card_number_grid_left">
                                                                    <div class="controls">
                                                                        <label class="control-label">Card Number</label>
                                                                        <input class="number credit-card-number form-control" type="text" name="number"
                                                                                      inputmode="numeric" autocomplete="cc-number" autocompletetype="cc-number" x-autocompletetype="cc-number"
                                                                                      placeholder="&#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149;">
                                                                    </div>
                                                                </div>
                                                                <div class="w3_agileits_card_number_grid_right">
                                                                    <div class="controls">
                                                                        <label class="control-label">CVV</label>
                                                                        <input class="security-code form-control"Â·
                                                                                      inputmode="numeric"
                                                                                      type="text" name="security-code"
                                                                                      placeholder="&#149;&#149;&#149;">
                                                                    </div>
                                                                </div>
                                                                <div class="clear"> </div>
                                                            </div>
                                                            <div class="controls">
                                                                <label class="control-label">Expiration Date</label>
                                                                <input class="expiration-month-and-year form-control" type="text" name="expiration-month-and-year" placeholder="MM / YY">
                                                            </div>
                                                        </div>
                                                        <button class="submit"><span>Make a payment </span></button>
                                                    </div>
                                                </section>
                                            </form>
                            </div>
                            <div>
                                 <div class="vertical_post">
                                  <form action="#" method="post">
                                    <h5>Select From Popular Banks</h5>
                                    <div class="swit-radio">								
                                        <div class="check_box_one"> <div class="radio_one"> <label><input type="radio" name="radio" checked=""><i></i>Syndicate Bank</label> </div></div>
                                        <div class="check_box_one"> <div class="radio_one"> <label><input type="radio" name="radio"><i></i>Bank of Baroda</label> </div></div>
                                        <div class="check_box_one"> <div class="radio_one"> <label><input type="radio" name="radio"><i></i>Canara Bank</label> </div></div>	
                                        <div class="check_box_one"> <div class="radio_one"> <label><input type="radio" name="radio"><i></i>ICICI Bank</label> </div></div>	
                                        <div class="check_box_one"> <div class="radio_one"> <label><input type="radio" name="radio"><i></i>State Bank Of India</label> </div></div>		
                                        <div class="clearfix"></div>
                                    </div>
                                    <h5>Or SELECT OTHER BANK</h5>
                                    <div class="section_room_pay">
                                        <select class="year"><option value="">=== Other Banks ===</option><option value="ALB-NA">Allahabad Bank NetBanking</option><option value="ADB-NA">Andhra Bank</option><option value="BBK-NA">Bank of Bahrain and Kuwait NetBanking</option><option value="BBC-NA">Bank of Baroda Corporate NetBanking</option><option value="BBR-NA">Bank of Baroda Retail NetBanking</option><option value="BOI-NA">Bank of India NetBanking</option><option value="BOM-NA">Bank of Maharashtra NetBanking</option><option value="CSB-NA">Catholic Syrian Bank NetBanking</option><option value="CBI-NA">Central Bank of India</option><option value="CUB-NA">City Union Bank NetBanking</option><option value="CRP-NA">Corporation Bank</option><option value="DBK-NA">Deutsche Bank NetBanking</option><option value="DCB-NA">Development Credit Bank</option><option value="DC2-NA">Development Credit Bank - Corporate</option><option value="DLB-NA">Dhanlaxmi Bank NetBanking</option><option value="FBK-NA">Federal Bank NetBanking</option><option value="IDS-NA">Indusind Bank NetBanking</option><option value="IOB-NA">Indian Overseas Bank</option><option value="ING-NA">ING Vysya Bank (now Kotak)</option><option value="JKB-NA">Jammu and Kashmir NetBanking</option><option value="JSB-NA">Janata Sahakari Bank Limited</option><option value="KBL-NA">Karnataka Bank NetBanking</option><option value="KVB-NA">Karur Vysya Bank NetBanking</option><option value="LVR-NA">Lakshmi Vilas Bank NetBanking</option><option value="OBC-NA">Oriental Bank of Commerce NetBanking</option><option value="CPN-NA">PNB Corporate NetBanking</option><option value="PNB-NA">PNB NetBanking</option><option value="RSD-DIRECT">Rajasthan State Co-operative Bank-Debit Card</option><option value="RBS-NA">RBS (The Royal Bank of Scotland)</option><option value="SWB-NA">Saraswat Bank NetBanking</option><option value="SBJ-NA">SB Bikaner and Jaipur NetBanking</option><option value="SBH-NA">SB Hyderabad NetBanking</option><option value="SBM-NA">SB Mysore NetBanking</option><option value="SBT-NA">SB Travancore NetBanking</option><option value="SVC-NA">Shamrao Vitthal Co-operative Bank</option><option value="SIB-NA">South Indian Bank NetBanking</option><option value="SBP-NA">State Bank of Patiala NetBanking</option><option value="SYD-NA">Syndicate Bank NetBanking</option><option value="TNC-NA">Tamil Nadu State Co-operative Bank NetBanking</option><option value="UCO-NA">UCO Bank NetBanking</option><option value="UBI-NA">Union Bank NetBanking</option><option value="UNI-NA">United Bank of India NetBanking</option><option value="VJB-NA">Vijaya Bank NetBanking</option></select>
                                    </div>
                                    <input type="submit" value="PAY NOW">
                                </form>
                            </div>
                            </div>
                            <div>
                                <div id="tab4" class="tab-grid" style="display: block;">
                                        <div class="row">
                                    <div class="col-md-6">
                                        <img class="pp-img" src="images/paypal.png" alt="Image Alternative text" title="Image Title">
                                        <p>Important: You will be redirected to PayPal's website to securely complete your payment.</p><a class="btn btn-primary">Checkout via Paypal</a>	
                                    </div>
                                    <div class="col-md-6">
                                        <form class="cc-form">
                                            <div class="clearfix">
                                                <div class="form-group form-group-cc-number">
                                                    <label>Card Number</label>
                                                    <input class="form-control" placeholder="xxxx xxxx xxxx xxxx" type="text"><span class="cc-card-icon"></span>
                                                </div>
                                                <div class="form-group form-group-cc-cvc">
                                                    <label>CVV</label>
                                                    <input class="form-control" placeholder="xxxx" type="text">
                                                </div>
                                            </div>
                                            <div class="clearfix">
                                                <div class="form-group form-group-cc-name">
                                                    <label>Card Holder Name</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="form-group form-group-cc-date">
                                                    <label>Valid Thru</label>
                                                    <input class="form-control" placeholder="mm/yy" type="text">
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-small">
                                                <label>
                                                    <input class="i-check" type="checkbox" checked="">Add to My Cards</label>
                                            </div>
                                            <input class="btn btn-primary submit" type="submit" class="submit" value="Proceed Payment">
                                        </form>
                                    </div>
                                </div>

                                    </div>
                            </div>
                        </div>
                    </div>
                    <!--Plug-in Initialisation-->
                    <!-- // Pay -->
                    <?php
                    }
                    ?>
                 </div>
            </div>
<!-- //payment -->
		</div>
		<div class="clearfix"></div>
	</div>
<!-- //banner -->

<!-- footer -->
<?php include 'footer.php'?>
<!-- //footer -->

<!-- easy-responsive-tabs -->    
<link rel="stylesheet" type="text/css" href="css/easy-responsive-tabs.css " />
<script src="js/easyResponsiveTabs.js"></script>
<!-- //easy-responsive-tabs --> 
	<script type="text/javascript">
    $(document).ready(function() {
        //Horizontal Tab
        $('#parentHorizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
    });
</script>
<!-- credit-card -->
		<script type="text/javascript" src="js/creditly.js"></script>
        <link rel="stylesheet" href="css/creditly.css" type="text/css" media="all" />

		<script type="text/javascript">
			$(function() {
			  var creditly = Creditly.initialize(
				  '.creditly-wrapper .expiration-month-and-year',
				  '.creditly-wrapper .credit-card-number',
				  '.creditly-wrapper .security-code',
				  '.creditly-wrapper .card-type');

			  $(".creditly-card-form .submit").click(function(e) {
				e.preventDefault();
				var output = creditly.validate();
				if (output) {
				  // Your validated credit card output
				  console.log(output);
				}
			  });
			});
		</script>
	<!-- //credit-card -->

<!-- //js -->
<!-- script-for sticky-nav -->
	<script>
	$(document).ready(function() {
		 var navoffeset=$(".agileits_header").offset().top;
		 $(window).scroll(function(){
			var scrollpos=$(window).scrollTop(); 
			if(scrollpos >=navoffeset){
				$(".agileits_header").addClass("fixed");
			}else{
				$(".agileits_header").removeClass("fixed");
			}
		 });
		 
	});
	</script>
<!-- //script-for sticky-nav -->
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
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>
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
    <script src="js/minicart.js"></script>
    <script>
        paypal.minicart.reset();
		paypal.minicart.render();
	</script>
</body>
</html>