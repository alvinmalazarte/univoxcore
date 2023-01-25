<?php 
$ext_number = isset( $cart_item['ext_number'] ) ? $cart_item['ext_number'] : '';
$screen_telemarketers = isset( $cart_item['screen_telemarketers_'.$cart_item_key] ) ? $cart_item['screen_telemarketers_'.$cart_item_key] : '';



?>

 
<div class="form-group">
 <?php 	

	 printf(
	 '<input type="number" class="form-control %s" name="ext_number" id="ext_number_%s" data-cart-id="%s" placeholder="501" value="%s">',
	 'prefix-cart-ext_number',
	 $cart_item_key,
	 $cart_item_key,
	 $ext_number
	 );
?>
</div>


<div class="form-row phone-setting">
	
	<h5>Screen all telemarketers</h5>
					
					<div class="custom-control custom-radio custom-control-inline">
					 
					  
					  <?php 
					
					   
					 
						 printf(
						 '<input type="radio" class="custom-control-input %s" name="screen_telemarketers_%s" id="screen_telemarketers_yes_%s" data-cart-id="%s" value="yes"  '.( ($screen_telemarketers =="yes") ? 'checked="checked"' : '').'><label class="custom-control-label" for="screen_telemarketers_yes_%s">Yes</label>',
						 'prefix-cart-screen_telemarketers',
						 $cart_item_key,
						 $cart_item_key,
						  $cart_item_key,
						 $cart_item_key
						 );
						
						?>
					
					</div>
					<div class="custom-control custom-radio custom-control-inline">
 <?php
					  printf(
						 '<input type="radio" class="custom-control-input %s" name="screen_telemarketers_%s" id="screen_telemarketers_no_%s" data-cart-id="%s" value="no"  '. (($screen_telemarketers =="no") ? 'checked="checked"' : '').'> <label class="custom-control-label" for="screen_telemarketers_no_%s">No</label>',
						 'prefix-cart-screen_telemarketers',
						 $cart_item_key,
						 $cart_item_key,
						  $cart_item_key,
						  $cart_item_key
						 );
						
						?>
					
					  
					</div>
			
</div>

