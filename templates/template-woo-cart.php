
<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;


$phone_list = $this->univoxx_func->pull_phone_array( );

 ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post" enctype="multipart/form-data">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	
	<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			
<section class="selected-phones mt-5 pt-2">
	<div class="container">
		<div class="row selected-phones-row">
<?php 
 global $woocommerce;
    $items = $woocommerce->cart->get_cart();
	
       foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		
		$checker_phone_cart = get_post_meta( $cart_item['product_id'], 'univoxx_product_form', true ); 
		
		
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
			$product_permalink = get_permalink( $product_id );
			
          
            //$getProductDetail = wc_get_product( $values['product_id'] );
			
			
			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
            /* echo $getProductDetail->get_image(); // accepts 2 arguments ( size, attr )

            echo "<b>".$_product->get_title() .'</b>  <br> Quantity: '.$values['quantity'].'<br>'; 
            $price = get_post_meta($values['product_id'] , '_price', true);
            echo "  Price: ".$price."<br>";
           
            echo "Regular Price: ".get_post_meta($values['product_id'] , '_regular_price', true)."<br>";
            echo "Sale Price: ".get_post_meta($values['product_id'] , '_sale_price', true)."<br>"; */
			
			?>
				<div class="card col-md-6 loop-item <?=$checker_phone_cart?>" >
				<input type="hidden" name="phone_type">
			  <div class="card-body">
			  	<h5 class="card-title product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
				<?php 
					$current_product = wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ));
					//var_dump($defualt_value);
				 ?>
				 
				 <?php 
					if($checker_phone_cart == "phone_apps"){
				 ?>
				<select name="" class="product-name-option" data-cart-id ="<?= $cart_item_key; ?>">
					
					
					<?php 
					foreach($phone_list as $key => $value ){
						//echo ;
						//echo get_the_title( $value->post_id );
						?>
						<option data-id="<?=$value->post_id?>" value="<?=get_the_title( $value->post_id )?>"<?= ($cart_item['product_id'] == $value->post_id) ? " selected" : "" ?>><?=get_the_title( $value->post_id )?></option>
						<?php
					}
					
					?>
					
				</select>
				<?php }else{
					
					echo get_the_title( $cart_item['product_id']);
				} ?>
				<?php
						//70419
						/*if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
						} else {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
						}*/

						do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

						// Meta data.
						echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
						}
						?>
				
				</h5>
			  	<div class="form-row justify-content-between right-panel">
				  	
					<div class="align-items-center">
					<?php 
	
	
	echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove-item" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-trash fa-2x remove-item"></i></a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									__( 'Remove this item', 'woocommerce' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
	
					?>
					
					</div>
			  	</div>
			    <hr>
			    <div class="row">
			    	<div class="col-md-12" id="image_cart_thumbnail">
					
					
			    		<?php
						
						
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

						if ( ! $product_permalink ) {
							echo $thumbnail; // PHPCS: XSS ok.
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
						}
						
						
						
						
						?>
						
						
						
			    	</div>
					  </div>
					<div class="row">
			    	<div class="col-md-12" >
		    		
					  
					  <?php 
					  do_action( 'woocommerce_after_cart_item_thumbnail', $cart_item, $cart_item_key );	
					  ?>
					
			    	</div>
			    <hr>
			   

			  </div>
		</div>
			</div>
			<?php
        }
		}
		do_action( 'woocommerce_cart_contents' ); 
		do_action( 'woocommerce_cart_actions' );
		wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' );
		do_action( 'woocommerce_after_cart_contents' );
		do_action( 'woocommerce_after_cart_table' );
?>

	</div>
	</div>	
</section>
</form>

<?php do_action( 'woocommerce_after_cart' ); ?>


<script>


var theTimeout = null;
	 jQuery(document).ready(function(){
		 jQuery("div#file-attachment span.close").on("click" , function(){
				var link = jQuery(this).parent().find('a').attr("href");
				var data_cart_id = jQuery(this).attr("data-cart-id");

				console.log(link);
				console.log(data_cart_id);
				jQuery.ajax({	
					type: "post",
					url: the_ajax_object.ajax_url,
					data : {
								'action': 'univoxx_remove_item_attachment_cart',
								'file' : link,
								'cart_id' : data_cart_id
							},
					success: function(response) {
						console.log(response);
						jQuery(this).parent().hide();
			}})


			});
		
		jQuery("div#number_modal").click(function(){
			jQuery(".modal-body-block").fadeIn();
		
			var data_box_input = jQuery(this).attr("data-box-input");
			
			
			if(data_box_input !== "undefined")
			
			jQuery(".modal-body-block div#modal-one").attr("data-input-selector" , data_box_input);
			
			
		})
				 
		
		
		// 61419 - On change of file upload
        jQuery('form.woocommerce-cart-form input[type="file"]').change(function(e){
			e.preventDefault();
			
            var data_cart_id = jQuery(this).parents(".loop-item").find("[name='first_name']").attr("data-cart-id");

           	var audio_upload = e.target.files[0];
           	//var formData = new FormData(); formData.append('file', jQuery('input[type=file]')[0].files[0]); data: formData
           	var formData = new FormData(); 
           	formData.append('action', 'univoxx_handle_file_uploads');
           	formData.append('audio_upload', audio_upload);
           	formData.append('data_cart_id', data_cart_id);
           	//data: formData
           	console.log(audio_upload);
           	

            /*var data = {
				'action' 			: 'univoxx_handle_file_uploads',
				'data_cart_id'		: data_cart_id,
				'audio_upload'		: formData,
			}*/
			
			jQuery.ajax({
	            url: the_ajax_object.ajax_url,
	            type: 'POST',
	            data: formData,
	            cache: false,
	            dataType: 'json',
	            processData: false,
	            contentType: false,
	            //enctype: 'multipart/form-data',
	            success: function (data) {
	                console.log(data); 
					// data.url_file
					
					console.log(jQuery(this).parents(".loop-item").find("div#file-attachment"));
					/* jQuery(this).parents(".loop-item").find("div#file-attachment").find("a").attr(data.url_file);
					
					jQuery(this).parents(".loop-item").find("div#file-attachment").find("a").html(audio_upload['name']); */
					
					//"<a href='"+data["file_path"]+"'>" + data["filename"] +"</a>"
					
					
					
	            }
	        });
			
	        /*jQuery.post(the_ajax_object.ajax_url, data, function(response) {
				response		=	jQuery.trim(response);
				response		=	jQuery.parseJSON( response);
				//console.log(response);
				if(response.success){
					console.log(response);
				}else{
					console.log(response);
				}

			});*/
        });
		
		
		
jQuery("button#insert_text_to_voice").click(function(e){
	e.preventDefault();
var voice_text = jQuery(this).closest(".card.loop-item").find("textarea[name='voice_text']").val();
var thisis = jQuery(this);
jQuery(this).closest("div#phone-voice-mail").find("div#audio_converted").html('<div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>');
jQuery.ajax(
			 {
				 type: 'POST',
				 url: the_ajax_object.ajax_url,
				  dataType : 'html',
				 data: {
					 action: 'univoxx_text_to_speech',
					 text : voice_text
				 },
				 success: function( response ) { 
					console.log(response);
					thisis.closest("div#phone-voice-mail").find("div#audio_converted").html(response );


				 }
			 } 
			 )
	

})

		  jQuery('select[name="voicemail_text_value"]').on('click',function(e){
			
			var text_value = jQuery(this).find('option:selected').attr("data-text-value");
			
			
			

			
			
			jQuery(this).closest(".card.loop-item").find("textarea[name='voice_text']").val(text_value).change();	
		 });
		 
		  //70519
		  function checkEmail(email) {
			  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			  if(!regex.test(email)) {
			    return false;
			  }else{
			    return true;
			  }
			}
		 
		 jQuery('section.selected-phones input[type="number"] , section.selected-phones input[type="email"] ,section.selected-phones input[type="text"],section.selected-phones input[type="radio"] , section.selected-phones textarea').on('input keyup paste change',function(){
			 
			
			 clearTimeout(theTimeout);

		
			 
			var card_loop_item = jQuery(this).serialize();
			
			 var cart_id = jQuery(this).data('cart-id');
			 var card_item = jQuery(this);
			
			
			
			
			
			if(jQuery(this).attr("name") == "first_name" || jQuery(this).attr("name") == "phone_ext"){
				var data_cart_id = jQuery(this).attr("data-cart-id");
				var value_name = jQuery("input#first_name_"+data_cart_id).val();
				var phone_ext = jQuery("input#phone_ext_"+data_cart_id).val();

				//console.log(value_name+"|"+phone_ext+"|"+data_cart_id)
				jQuery("form#univoxx-call-scenario-form").find("input#"+data_cart_id).attr("value" ,value_name+"|"+phone_ext+"|"+data_cart_id );
				 
				jQuery("form#univoxx-call-scenario-form").find("label[for='"+data_cart_id+"']").html(value_name +" - "+ phone_ext  );
				 
				
				

				var setting_form_class = "";
				
				if(jQuery("div#setting-form.basic").css('display') == "block"){
					setting_form_class = ".basic";
				}
				if(jQuery("div#setting-form.team").css('display') == "block"){
					setting_form_class = ".team";
				}
				if(jQuery("div#setting-form.auto-attendant").css('display') == "block"){
					setting_form_class = ".auto-attendant";
				}
				if(jQuery("div#setting-form.advanced").css('display') == "block"){
					setting_form_class = ".advanced";
				}
				
				var check_value = jQuery("form#univoxx-call-scenario-form  div#setting-form"+setting_form_class+" .ring_options input:checked");
				
				// For some browsers, `attr` is undefined; for others,
				// `attr` is false.  Check for both.
				if (check_value.attr("id") == data_cart_id && check_value.attr("type") == "radio") {
					// ...
					check_value.click();
				}
			}
			

			 // Make a new timeout set to go off in 800ms
			theTimeout = setTimeout(function () {
				 if( card_item.attr("type") == "email" && checkEmail( card_item.val() ) == false ){
					console.log("email error : " + card_item.val() );
					return;
				} 
				//70519
				/*  let haveEmpty = 0;
				jQuery(".selected-phones-row").find("input[type='text'], input[type='email'], input[type='number']").each(function(){
					if( jQuery(this).val() == "" && jQuery(this).attr("name") !== "mobile_number"){
						jQuery(this).addClass("input-error");
						haveEmpty = 1;
					}else{
						jQuery(this).removeClass("input-error");
					}
				});  */
				/* if( haveEmpty == 1 ){
					return;
				} */

				jQuery.ajax(
			 {
				 type: 'POST',
				 url: the_ajax_object.ajax_url,
				 data: {
					 action: 'prefix_update_cart_meta_data',
					 security: jQuery('#woocommerce-cart-nonce').val(),
					 data: card_loop_item,
					 cart_id: cart_id
				 },
				 success: function( response ) {
					//$('.cart_totals').unblock();
					console.log(response);
				 }
			 } 
			 )
			}, 2000);
			 
		 });
		 
		 
		  jQuery('section.selected-phones select').on('change',function(){
			 
			 var card_loop_item = jQuery(this).serialize();
			
			
			 var cart_id = jQuery(this).data('cart-id');

			 clearTimeout(theTimeout);
			
			
			 // Make a new timeout set to go off in 800ms
			 
			theTimeout = setTimeout(function () {
			jQuery.ajax(
			 {
				 type: 'POST',
				 url: the_ajax_object.ajax_url,
				 data: {
					 action: 'prefix_update_cart_meta_data',
					 security: jQuery('#woocommerce-cart-nonce').val(),
					 data: card_loop_item,
					 cart_id: cart_id
				 },
				 success: function( response ) {
					//$('.cart_totals').unblock();
					
				 }
			 } 
			 )
			}, 2000); 
			 

			
			 
		 });
		 
		  
		 jQuery('form[name="checkout"]').attr("id" , "checkout")
		 jQuery( ".form-row.phone-setting" ).tabs();
		 
		 
	 });



</script>



