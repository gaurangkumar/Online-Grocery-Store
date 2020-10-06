<?php
$products = $cart = [];

foreach($_POST as $key => $val) {
    $array = explode('_', $key); // discount_amount_1 => Array([0] => discount, [1] => amount, [2] => 1)

    if( count($array) > 1) { // exclude keys without _
        $i = array_pop($array); // get and remove last member of array => Array([0] => discount, [1] => amount)
    } else {
        $i = $array[0];
    }


    $key = implode('_', $array); // Array([0] => discount, [1] => amount) => discount_amount

    if(is_numeric($i)) {
        $products[$i][$key] = $val;
    } else {
        $cart[$key] = $val;
    }
    
}
?>
<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
<?php include "header.php"?>
		<div class="w3l_banner_nav_right">
            <!-- about -->
            <div class="privacy about">
                <h3>Chec<span>kout</span></h3>
                <div class="checkout-right">
                    <h4>Your shopping cart contains: <span><?php echo count($products); ?> Products</span></h4>
                    <table class="timetable_sub">
                        <thead>
                            <tr>
                                <th>SL No.</th>	
                                <th>Product</th>
                                <th>Quality</th>
                                <th>Product Name</th>

                                <th>Price</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($products as $i => $product) {
                            ?>
                            <tr class="rem<?php echo $i; ?>">
                                <td class="invert"><?php echo $i; ?></td>
                                <td class="invert-image">
                                    <a href="single.php">
                                        <img src="images/3.png" alt=" " class="img-responsive">
                                    </a>
                                </td>
                                <td class="invert">
                                     <div class="quantity"> 
                                        <div class="quantity-select">                           
                                            <div class="entry value-minus">&nbsp;</div>
                                            <div class="entry value">
                                                <span>
                                                    <?php echo $product['quantity']; ?>
                                                    <input type="hidden" name="<?php echo $i; ?>" value="<?php echo $product['quantity']; ?>">
                                                </span>
                                            </div>
                                            <div class="entry value-plus active">&nbsp;</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="invert"><span><?php echo $product['item_name']; ?></td>
                                <td class="invert"><span><?php echo $product['amount']; ?></td>
                                <td class="invert">
                                    <div class="rem" id="<?php echo $i; ?>">
                                        <div class="close1"></div>
                                    </div>

                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                    </tbody>
                  </table>
                </div>
                <div class="checkout-left">	
                    <div class="col-md-4 checkout-left-basket">
                        <h4>Continue to basket</h4>
                        <ul>
                            <li>Product1 <i>-</i> <span>$15.00 </span></li>
                            <li>Product2 <i>-</i> <span>$25.00 </span></li>
                            <li>Product3 <i>-</i> <span>$29.00 </span></li>
                            <li>Total Service Charges <i>-</i> <span>$15.00</span></li>
                            <li>Total <i>-</i> <span>$84.00</span></li>
                        </ul>
                    </div>
                    <div class="col-md-8 address_form_agile">
                          <h4>Add a new Details</h4>
                    <form action="payment.html" method="post" class="creditly-card-form agileinfo_form">
                                        <section class="creditly-wrapper wthree, w3_agileits_wrapper">
                                            <div class="information-wrapper">
                                                <div class="first-row form-group">
                                                    <div class="controls">
                                                        <label class="control-label">Full name: </label>
                                                        <input class="billing-address-name form-control" type="text" name="name" placeholder="Full name">
                                                    </div>
                                                    <div class="w3_agileits_card_number_grids">
                                                        <div class="w3_agileits_card_number_grid_left">
                                                            <div class="controls">
                                                                <label class="control-label">Mobile number:</label>
                                                                <input class="form-control" type="text" placeholder="Mobile number">
                                                            </div>
                                                        </div>
                                                        <div class="w3_agileits_card_number_grid_right">
                                                            <div class="controls">
                                                                <label class="control-label">Landmark: </label>
                                                             <input class="form-control" type="text" placeholder="Landmark">
                                                            </div>
                                                        </div>
                                                        <div class="clear"> </div>
                                                    </div>
                                                    <div class="controls">
                                                        <label class="control-label">Town/City: </label>
                                                     <input class="form-control" type="text" placeholder="Town/City">
                                                    </div>
                                                        <div class="controls">
                                                                <label class="control-label">Address type: </label>
                                                         <select class="form-control option-w3ls">
                                                                                                <option>Office</option>
                                                                                                <option>Home</option>
                                                                                                <option>Commercial</option>

                                                                                        </select>
                                                        </div>
                                                </div>
                                                <button class="submit check_out">Delivery to this Address</button>
                                            </div>
                                        </section>
                                    </form>
                                        <div class="checkout-right-basket">
                                <a href="payment.html">Make a Payment <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
                        </div>
                        </div>

                    <div class="clearfix"> </div>

                </div>

            </div>
            <!-- //about -->
		</div>
		<div class="clearfix"></div>
	</div>
    <!-- //banner -->

<?php include "footer.php"?>

    <!--quantity-->
    <script>
    $('.value-plus').on('click', function(){
        var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
        divUpd.text(newVal);
    });

    $('.value-minus').on('click', function(){
        var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
        if(newVal>=1) divUpd.text(newVal);
    });
    </script>
    <!--quantity-->

    <script>
    $(document).ready(function(c) {
        $('.rem').on('click', function(c) {
            id = $(this).attr("id");
            $('.rem'+id).fadeOut('slow', function(c){
                $('.rem'+id).remove();
            });
        });
    });
    </script>
    <script>$(document).ready(function(c) {
        $('.close2').on('click', function(c){
            $('.rem2').fadeOut('slow', function(c){
                $('.rem2').remove();
            });
            });	  
        });
   </script>
    <script>$(document).ready(function(c) {
        $('.close3').on('click', function(c){
            $('.rem3').fadeOut('slow', function(c){
                $('.rem3').remove();
            });
            });	  
        });
   </script>

</body>
</html>