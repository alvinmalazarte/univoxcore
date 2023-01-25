<?php 
$incoming_calls_option = isset( $cart_item['incoming_calls_option_'.$cart_item_key] ) ? $cart_item['incoming_calls_option_'.$cart_item_key] : '';
$outgoing_calls_option  = isset( $cart_item['outgoing_calls_option_'.$cart_item_key] ) ? $cart_item['outgoing_calls_option_'.$cart_item_key] : '';



?>

 
<div class="form-group">
 <?php 	  printf(
	 '<input type="email" class="form-control %s" name="phone_email" id="phone_email_%s" data-cart-id="%s" placeholder="Email" value="%s">',
	 'prefix-cart-phone_email',
	 $cart_item_key,
	 $cart_item_key,
	  $phone_email
	 ); ?>
</div>


<div class="form-row phone-setting">
	
	<h5>Record All Incoming Calls</h5>
					
					<div class="custom-control custom-radio custom-control-inline">
					 
					  
					  <?php 
					
					 
						 printf(
						 '<input type="radio" class="custom-control-input %s" name="incoming_calls_option_%s" id="incoming_calls_option_yes_%s" data-cart-id="%s" value="yes"  '.( ($incoming_calls_option =="yes") ? 'checked="checked"' : '').'><label class="custom-control-label" for="incoming_calls_option_yes_%s">Yes</label>',
						 'prefix-cart-incoming_calls_option',
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
						 '<input type="radio" class="custom-control-input %s" name="incoming_calls_option_%s" id="incoming_calls_option_no_%s" data-cart-id="%s" value="no"  '. (($incoming_calls_option =="no") ? 'checked="checked"' : '').'> <label class="custom-control-label" for="incoming_calls_option_no_%s">No</label>',
						 'prefix-cart-incoming_calls_option',
						 $cart_item_key,
						 $cart_item_key,
						  $cart_item_key,
						  $cart_item_key
						 );
						
						?>
					
					  
					</div>
				
		<h5>Record All Outgoing Calls</h5>
					
					<div class="custom-control custom-radio custom-control-inline">
					 
					  
					  <?php 
					   
					 
						 printf(
						 '<input type="radio" class="custom-control-input %s" name="outgoing_calls_option_%s" id="outgoing_calls_option_yes_%s" data-cart-id="%s" value="yes"  '.( ($outgoing_calls_option =="yes") ? 'checked="checked"' : '').'><label class="custom-control-label" for="outgoing_calls_option_yes_%s">Yes</label>',
						 'prefix-cart-outgoing_calls_option',
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
						 '<input type="radio" class="custom-control-input %s" name="outgoing_calls_option_%s" id="outgoing_calls_option_no_%s" data-cart-id="%s" value="no"  '. (($outgoing_calls_option =="no") ? 'checked="checked"' : '').'> <label class="custom-control-label" for="outgoing_calls_option_no_%s">No</label>',
						 'prefix-cart-outgoing_calls_option',
						 $cart_item_key,
						 $cart_item_key,
						  $cart_item_key,
						  $cart_item_key
						 );
						
						?>
					
					  
					</div>		
</div>


