<?php
session_start();
require 'dbcon.php';
$result = $conn->query('SELECT * FROM `product` LIMIT 8');
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
<title>Grocery Store </title>
<body>
<?php include 'header.php'?>
            <div class="w3l_banner_nav_right">
                <section class="slider">
                    <div class="flexslider">
                        <ul class="slides">
                            <li>
                                <div class="w3l_banner_nav_right_banner">
                                    <h3>Make your <span>food</span> with Spicy.</h3>
                                    <div class="more">
                                        <a href="products.php" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop now</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="w3l_banner_nav_right_banner1">
                                    <h3>Make your <span>food</span> with Spicy.</h3>
                                    <div class="more">
                                        <a href="products.php" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop now</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="w3l_banner_nav_right_banner">
                                    <h3>upto <i>50%</i> off.</h3>
                                    <div class="more">
                                        <a href="products.php" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop now</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>
                <!-- flexSlider -->
                    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
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
                <!-- //flexSlider -->
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- banner -->
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</div>

<!-- top-brands -->
<div class="top-brands">
    <div class="container">
        <h3>Hot Offers</h3>
        <div class="agile_top_brands_grids">
            <?php
            if ($result->num_rows) {
                while ($product = $result->fetch_assoc()) {
                    $pid = $product['pid'];
                    $name = $product['name'];
                    $weight = trim($product['weight'], '()');
                    $pic = $product['pic'];
                    $price = $product['price'];
                    $discount = $product['discount'];
                    $discount_money = $price * ($product['discount'] / 100);
                    $new_price = $discount == 0
                        ? $price
                        : $product['price'] * (1 - ($product['discount'] / 100)); ?>
            <div class="col-md-3 top_brand_left" style="margin-bottom:15px">
                <div class="hover14 column">
                    <div class="agile_top_brand_left_grid">
                        <div class="tag">
                            <img src="images/tag.png" alt="" class="img-responsive">
                        </div>
                        <div class="agile_top_brand_left_grid1">
                            <figure>
                                <div class="snipcart-item block" >
                                    <div class="snipcart-thumb">
                                        <a href="single.php?id=<?php echo $pid; ?>">
                                            <img title="<?php echo $name; ?>" alt="<?php echo $name; ?>" src="<?php echo $pic; ?>" width="140">
                                        </a>		
                                        <p>
                                            <?php echo $name.($weight ? " ($weight)" : ''); ?>
                                        </p>
                                        <h4>
                                            <i class="fa fa-rupee"></i> <?php echo $new_price; ?>
                                            <span>
                                                <?php if ($discount) { ?>
                                                <i class="fa fa-rupee"></i> <?php echo $product['price']; } ?>
                                            </span>
                                        </h4>
                                    </div>
                                    <div class="snipcart-details top_brand_home_details">
                                        <form action="checkout.php" method="post">
                                            <fieldset>
                                                <input type="hidden" name="pid" value="<?php echo $pid; ?>" />
                                                <input type="hidden" name="cmd" value="_cart" />
                                                <input type="hidden" name="add" value="1" />
                                                <input type="hidden" name="business" value="" />
                                                <input type="hidden" name="item_name" value="<?php echo $name; ?>" />
                                                <input type="hidden" name="amount" value="<?php echo $price; ?>" />
                                                <input type="hidden" name="discount_amount" value="<?php echo $discount_money; ?>" />
                                                <input type="hidden" name="currency_code" value="INR" />
                                                <input type="hidden" name="return" value="" />
                                                <input type="hidden" name="cancel_return" value="" />
                                                <input type="submit" name="submit" value="Add to cart" class="button" />
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!-- //top-brands -->

<!-- fresh-vegetables -->
<div class="fresh-vegetables">
    <div class="container">
        <h3>Top Products</h3>
        <div class="w3l_fresh_vegetables_grids">
            <div class="col-md-3 w3l_fresh_vegetables_grid w3l_fresh_vegetables_grid_left">
                <div class="w3l_fresh_vegetables_grid2">
                    <ul>

                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="vegetables.php">Vegetables</a></li>
                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="vegetables.php">Fruits</a></li>


                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="household.php">Cleaning</a></li>
                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="products.php">Spices</a></li>

                    </ul>
                </div>
            </div>
            <div class="col-md-9 w3l_fresh_vegetables_grid_right">
                <div class="col-md-4 w3l_fresh_vegetables_grid">
                    <div class="w3l_fresh_vegetables_grid1">
                        <img src="images/8.jpg" alt=" " class="img-responsive" />
                    </div>
                </div>
                <div class="col-md-4 w3l_fresh_vegetables_grid">
                    <div class="w3l_fresh_vegetables_grid1">
                        <div class="w3l_fresh_vegetables_grid1_rel">
                            <img src="images/7.jpg" alt=" " class="img-responsive" />
                            <div class="w3l_fresh_vegetables_grid1_rel_pos">
                                <div class="more m1">
                                    <a href="products.php" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w3l_fresh_vegetables_grid1_bottom">
                        <img src="images/10.jpg" alt=" " class="img-responsive" />
                        <div class="w3l_fresh_vegetables_grid1_bottom_pos">
                            <h5>Special Offers</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 w3l_fresh_vegetables_grid">
                    <div class="w3l_fresh_vegetables_grid1">
                        <img src="images/9.jpg" alt=" " class="img-responsive" />
                    </div>
                    <div class="w3l_fresh_vegetables_grid1_bottom">
                        <img src="images/11.jpg" alt=" " class="img-responsive" />
                    </div>
                </div>
                <div class="clearfix"> </div>
                <div class="agileinfo_move_text">
                    <div class="agileinfo_marquee">
                        <h4>get <span class="blink_me">25% off</span> on first order and also get gift voucher</h4>
                    </div>
                    <div class="agileinfo_breaking_news">
                        <span> </span>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<?php include 'footer.php'?>
    
</body>
</html>
