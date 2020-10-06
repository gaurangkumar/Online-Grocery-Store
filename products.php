<?php
require 'dbcon.php';
$category = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($category) {
    $result = mysqli_query($conn, "SELECT * FROM `category` WHERE `cid` = $category");
    $row = $result->fetch_assoc();
    $category_name = $row['name'];
    $title = ucwords($category_name).' products';
    $result = mysqli_query($conn, "SELECT * FROM `product` WHERE `cid` = $category");
} else {
    $title = 'All products';
    $result = mysqli_query($conn, 'SELECT * FROM `product` LIMIT 20');
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
<title><?php echo $title; ?> | Grocery Store</title>
<body>
    <?php include 'header.php'?>
		<div class="w3l_banner_nav_right">
			<div class="w3l_banner_nav_right_banner4">
				<h3>Best Deals For New Products<span class="blink_me"></span></h3>
			</div>
			<div class="w3ls_w3l_banner_nav_right_grid w3ls_w3l_banner_nav_right_grid_sub">
				<h3><?php echo $title; ?></h3>
				<div class="w3ls_w3l_banner_nav_right_grid1">
					<!--<h6>cleaning</h6>-->
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
            <div class="clearfix"></div>
        </div>
        <!-- banner -->
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</div>
<?php include 'footer.php'?>
</body>
</html>