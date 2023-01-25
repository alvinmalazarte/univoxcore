<?php 
$phone_number = isset( $cart_item['phone_number'] ) ? $cart_item['phone_number'] : '';
$automatic_cover = isset( $cart_item['automatic_cover_'.$cart_item_key] ) ? $cart_item['automatic_cover_'.$cart_item_key] : '';


?>

 
<div class="form-group">
 <?php 	
	
	 printf(
	 '<input type="number" class="form-control %s" name="phone_number" id="phone_number_%s" data-cart-id="%s" placeholder="Select Number" value="%s"><div id="number_modal"><i class="fas fa-align-center"></i></div>',
	 'prefix-cart-phone_number',
	 $cart_item_key,
	 $cart_item_key,
	 $phone_number
	 );
 printf(
	 '<input type="email" class="form-control %s" name="phone_email" id="phone_email_%s" data-cart-id="%s" placeholder="Email" value="%s">',
	 'prefix-cart-phone_email',
	 $cart_item_key,
	 $cart_item_key,
	  $phone_email
	 ); ?>
</div>


<div class="form-row phone-setting">
	
	<h5>Automatic cover page</h5>
					
					<div class="custom-control custom-radio custom-control-inline">
					 
					  
					  <?php 
					
				
					 
						 printf(
						 '<input type="radio" class="custom-control-input %s" name="automatic_cover_%s" id="automatic_cover_yes_%s" data-cart-id="%s" value="yes"  '.( ($automatic_cover =="yes") ? 'checked="checked"' : '').'><label class="custom-control-label" for="automatic_cover_yes_%s">Yes</label>',
						 'prefix-cart-automatic_cover',
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
						 '<input type="radio" class="custom-control-input %s" name="automatic_cover_%s" id="automatic_cover_no_%s" data-cart-id="%s" value="no"  '. (($automatic_cover =="no") ? 'checked="checked"' : '').'> <label class="custom-control-label" for="automatic_cover_no_%s">No</label>',
						 'prefix-cart-automatic_cover',
						 $cart_item_key,
						 $cart_item_key,
						  $cart_item_key,
						  $cart_item_key
						 );
						
						?>
					
					  
					</div>
				
		
</div>


