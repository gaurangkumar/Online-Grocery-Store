<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Grocery Store</title>
<body><?php include 'header.php'?>

	<div class="agile_top_brand_left_grid1">
                            

		<div class="w3l_banner_nav_right">
			<div class="w3l_banner_nav_right_<img src="images/pulsesb.jpg" alt=""  style="height:300px; width:1070px;">
            <img src="images/pulsesb.jpg" alt="" style="height:300px; width:1070px;">
				
			</div>
			<div class="w3ls_w3l_banner_nav_right_grid w3ls_w3l_banner_nav_right_grid_sub">
            
				<h3>Masala And Spices</h3>
                    <?php include 'dbcon.php' ?>
				<?php
                            $sql = 'SELECT  name, price, discount, weight, pic, cid FROM product WHERE cid=7 ';
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);

if ($num > 0) {
    // output data of each row
    while ($row = mysqli_fetch_array($result)) {
        ?>
                
				<div class="col-md-3 w3ls_w3l_banner_left">
						<div class="hover14 column ">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							
							<div class="agile_top_brand_left_grid1">
                            
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<a href="#"><img src="<?php echo $row['pic']; ?>" alt=" " class="img-responsive" height="140px" width="140px" /></a>
											<p><?php echo $row['name'].$row['weight']; ?></p>
											<h4><i class="fa fa-rupee"> <?php echo $row['price']; ?> </i><span><i class="fa fa-rupee"><del> <?php echo $row['discount']; ?></del> </i></h4>
										</div>
										<div class="snipcart-details">
											<form action="#" method="post">
												<fieldset>
													<input type="hidden" name="cmd" value="_cart" />
													<input type="hidden" name="add" value="1" />
													<input type="hidden" name="business" value=" " />
													<input type="hidden" name="item_name" value="<?php echo $row['name']; ?>" />
													<input type="hidden" name="amount" value="<?php echo $row['price']; ?>" />
													<input type="hidden" name="discount_amount" value="1.00" />
													<input type="hidden" name="currency_code" value="INR" />
													<input type="hidden" name="return" value=" " />
													<input type="hidden" name="cancel_return" value=" " />
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
} else {
    echo ' no row';
}

      ?>
  </div>
  </div>
  </div> 
  <div class="clearfix"></div>
	</div>

			<div class="clearfix"> </div>
		</div>
	</div>
    <?php  include 'footer.php'?>
</body>
</html>