<?php 

	class Univoxx_Func {
		private $phone_product_id = array();
		
		public function __construct(){

			add_action('wp_ajax_save_temp_data', array( $this, 'save_temp_data' ));
			add_action('wp_ajax_nopriv_save_temp_data', array( $this, 'save_temp_data' ));

			add_action('wp_ajax_find_the_unique_id', array( $this, 'find_the_unique_id' ));
			add_action('wp_ajax_nopriv_find_the_unique_id', array( $this, 'find_the_unique_id' ));
			
			add_action('wp_ajax_univoxx_new_number', array( $this, 'univoxx_new_number' ));
			add_action('wp_ajax_nopriv_univoxx_new_number', array( $this, 'univoxx_new_number' ));
			
			/* Toll Free Option 3 digit */
			add_action('wp_ajax_option_univoxx_toll_free_number', array( $this, 'option_univoxx_toll_free_number' ));
			add_action('wp_ajax_nopriv_option_univoxx_toll_free_number', array( $this, 'option_univoxx_toll_free_number' ));
			
			/* Toll Free phone number generated */
			add_action('wp_ajax_univoxx_phone_tollfree_number', array( $this, 'univoxx_phone_tollfree_number' ));
			add_action('wp_ajax_nopriv_univoxx_phone_tollfree_number', array( $this, 'univoxx_phone_tollfree_number' ));
			
			/* Search filter number */
			add_action('wp_ajax_univoxx_search_phone_number', array( $this, 'univoxx_search_phone_number' ));
			add_action('wp_ajax_nopriv_univoxx_search_phone_number', array( $this, 'univoxx_search_phone_number' ));

			
			/* Text to speech Voice Rss */
			add_action('wp_ajax_univoxx_text_to_speech', array( $this, 'univoxx_text_to_speech' ));
			add_action('wp_ajax_nopriv_univoxx_text_to_speech', array( $this, 'univoxx_text_to_speech' ));

			//61919
			/* Save temp audio file in the plugin directory */
			add_action('wp_ajax_univoxx_save_temp_audio', array( $this, 'univoxx_save_temp_audio' ));
			add_action('wp_ajax_nopriv_univoxx_save_temp_audio', array( $this, 'univoxx_save_temp_audio' ));

			// 61419 - Save temp file upload
			add_action('wp_ajax_univoxx_handle_file_uploads', array( $this, 'univoxx_handle_file_uploads' ));
			add_action('wp_ajax_nopriv_univoxx_handle_file_uploads', array( $this, 'univoxx_handle_file_uploads' ));
			
			/* Action after cart */
			add_filter( 'woocommerce_add_cart_item',array( $this,"woo_action_after_add_cart_item" ), 11, 1 );
			
					
			/**
			 * Update cart item data
			 */
			add_action( 'wp_ajax_prefix_update_cart_meta_data', array( $this,'prefix_update_cart_meta_data' ));
			add_action( 'wp_ajax_nopriv_prefix_update_cart_meta_data', array( $this,'prefix_update_cart_meta_data') );
			
			/* Save meta data cart input */
			add_action( 'woocommerce_checkout_create_order_line_item', array( $this,'raa_add_custom_data_to_order'), 10, 4 );
			
			/* Update database cart session on place order */
			add_action('woocommerce_thankyou', array( $this,'univoxx_update_cart_session'), 10, 1);	
			
			
			/* add_action('woocommerce_checkout_create_order', array( $this,'before_checkout_create_order'), 20, 2); */
			
			/* Woocommerce custom field for form product */
			add_action('woocommerce_product_options_general_product_data',  array($this ,'univoxx_woocommerce_product_custom_fields'));
			
			
			/* Woocommerce custom filed save */
			add_action('woocommerce_process_product_meta',  array($this ,'univoxx_woocommerce_product_custom_fields_save'));
			
			
			 /* Force add to cart quantity to 1 and disable +- quantity input */
			add_filter( 'woocommerce_add_cart_item_data',array($this , 'bbloomer_split_product_individual_cart_items'), 10, 2 );
			
			/*
			* Validating the quantity on add to cart action with the quantity of the same product available in the cart. 
			*/
			add_filter( 'woocommerce_add_to_cart_validation',array($this ,  'wc_qty_add_to_cart_validation'), 1, 5 );
			
			
			
			//62719
			add_action('wp_ajax_create_woo_session', array( $this, 'univoxx_create_woo_session' ));
			add_action('wp_ajax_nopriv_create_woo_session', array( $this, 'univoxx_create_woo_session' ));
			
			
			
			//70219
			add_action('wp_ajax_univoxx_ajax_add_to_cart', array( $this, 'univoxx_ajax_add_to_cart' ));
			add_action('wp_ajax_nopriv_univoxx_ajax_add_to_cart', array( $this, 'univoxx_ajax_add_to_cart' ));


			add_action('wp_ajax_univoxx_remove_item_from_cart', array( $this, 'univoxx_remove_item_from_cart' ));
			add_action('wp_ajax_nopriv_univoxx_remove_item_from_cart', array( $this, 'univoxx_remove_item_from_cart' ));
			
			
			/* 7042019 get all phone form product ID */
			add_action( 'init', function(){
				global $wpdb;
				$posts = $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta
				WHERE meta_key = 'univoxx_product_form' AND  meta_value = 'phone_apps'");
				$this->phone_product_id = $posts;
			});
			
			
			add_action('wp_ajax_univoxx_remove_item_attachment_cart', array( $this, 'univoxx_remove_item_attachment_cart' ));
			add_action('wp_ajax_nopriv_univoxx_remove_item_attachment_cart', array( $this, 'univoxx_remove_item_attachment_cart' ));
			
			//70419
			add_action('wp_ajax_univoxx_change_phone_type', array( $this, 'univoxx_change_phone_type' ));
			add_action('wp_ajax_nopriv_univoxx_change_phone_type', array( $this, 'univoxx_change_phone_type' ));
			
			
			add_action('wp_ajax_univoxx_show_cart', array( $this, 'univoxx_show_cart' ));
			add_action('wp_ajax_nopriv_univoxx_show_cart', array( $this, 'univoxx_show_cart' ));
			
		}
		
		
		public function univoxx_show_cart(){
			if ( ! WC()->cart->is_empty() ) {
				echo json_encode(do_shortcode('[woocommerce_checkout]'));
			}
			wp_die();
		}
		
		  function univoxx_change_phone_type(){
	    	global $woocommerce;

	    	$cart_item_key = $_POST['cart_item_key'];
	    	$product_id = $_POST['product_id'];
	    	$phone_type = $_POST['phone_type'];
	    	$product = wc_get_product( $product_id );

		    WC()->cart->cart_contents[$cart_item_key]["product_id"] = $product_id;
			
			WC()->cart->set_session();

			$data = array(
                'success' => true,
                'product_id' => $product_id,
                'product_name' => $product->get_title(),
	            'product_image' => $product->get_image(),
                'cart_item_key' => $cart_item_key,
            );

            echo wp_send_json($data);
	    }
		
		
		function univoxx_remove_item_attachment_cart(){
		$file_path = str_replace(' ', '', $_POST['file']);
		$cart_id =  $_POST['cart_id'];
			
		$parse_url = parse_url($file_path);
		
			
		// print_r();
	 
		 $file_path = $_SERVER['DOCUMENT_ROOT'].$parse_url["path"]; 
		
		 //echo $file_path;
	 
			if( unlink($file_path )){
				
				
				$result = array(
                    'success' => true,
                    'action' => "remove_item_attachment_cart",
                    'file_path' => $file_path
				);
				
				
				
			}
			else{
				$result = array(
                    'success' => false,
                    'action' => "remove_item_attachment_cart",
					'file_path' => $file_path
				);
				
			}
			
			 $cart = WC()->cart->cart_contents;
			 $cart_item = $cart[$cart_id ];
			 $cart_item["file_attachment"] = "";
			 WC()->cart->cart_contents[$cart_id] = $cart_item;
			 WC()->cart->set_session();
			
            echo wp_send_json($result); 
			die();
		}
		function pull_phone_array(){
			return $this->phone_product_id;
		}
		
		function univoxx_ajax_add_to_cart() {
               
            global $woocommerce;

            $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
            $product = wc_get_product( $product_id );
            $univoxx_product_form = get_post_meta( $product_id, 'univoxx_product_form', true );

            $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
            $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
            $product_status = get_post_status($product_id);
            
            //70419 - edited
            $data = array();
            $item = array();
            
            if ('publish' === $product_status) {

                $product_qty = $_POST['quantity'];
	        	if( $product_qty > 1){
	            	
	            	for ($i=1; $i <= $_POST['quantity']; $i++) { 

	            		if(WC()->cart->add_to_cart($product_id, 1)){
			                
			                do_action('woocommerce_ajax_added_to_cart', $product_id);

			                $cartkey = '';
							foreach ( $woocommerce->cart->cart_contents as $cart_item_key => $cart_item ) {
							    $cartkey = $cart_item['key'];
							}

						    $item = array(
				                'cart_key' 		=> $cartkey,
				                'product_name' 	=> $product->get_title(),
				                'product_image' => $product->get_image(),
				                'product_id' 	=> $product_id,
				                'product_type' 	=> $univoxx_product_form,
				                'quantity' 		=> $product_qty
				            );

				            array_push($data, $item);

	            		}

	            	}

				}else{

	        		if(WC()->cart->add_to_cart($product_id, 1)){
			                
		                do_action('woocommerce_ajax_added_to_cart', $product_id);

		                $cartkey = '';
						foreach ( $woocommerce->cart->cart_contents as $cart_item_key => $cart_item ) {
						    $cartkey = $cart_item['key'];
						}
						//70519
					    $item = array(
			                'cart_key' 		=> $cartkey,
			                'product_name' 	=> $product->get_title(),
			                'product_image' => $product->get_image(),
			                'product_id' 	=> $product_id,
			                'product_type' 	=> $univoxx_product_form,
			                'quantity' 		=> $product_qty
			            );

			            array_push($data, $item);

            		}

	        	}

			    echo wp_send_json($data);

            } else {

                $data = array(
                    'error' => true,
                    //'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
                    'product_url' => get_permalink($product_id), $product_id);

                echo wp_send_json($data);
            }

            wp_die();
        }

        function univoxx_remove_item_from_cart() {
        	$cart_item_key = $_POST['cart_item_key'];
		    if($cart_item_key){
		       WC()->cart->remove_cart_item($cart_item_key);
		       return true;
		    } 
		    return false;

	    }
		
		
		//62719
		/**
		 * univoxx_create_woo_session
		 * Type = Ajax
		 * @param $_POST, WC session name
		 * @return json - result
		 */
		public function univoxx_create_woo_session(){

			  if ( isset($_POST) ) {
			  	$session_name = '';
			  	$data = array();
			  	$result = array();
			  	foreach ($_POST as $key => $value) {

			  		if( $key == "session_name" ){

			  			$session_name = $value;

			  		}elseif( $key == "action" ){
			  			
			  			//skip the action value

			  		}else{

			  			$data[$key] = $value;

			  		}

			  	}

				$serializeData = serialize($data);

				WC()->session->set( $session_name, $serializeData );
				
				$retrive_data = WC()->session->get( $session_name );

				if ( !empty($retrive_data) ) {

					$result = array(
						"success" 	=> true,
						"data"		=> $retrive_data
					);
					
				}else{

					$result = array(
						"success"	=> false,
						"error"		=> "Empty data."
					);
				}
				
			}else{

				$result = array(
					"success"	=> false,
					"error"		=> "Empty post."
				);

			}
			
			if(isset($_POST["userCount"] )  ){
				if($_POST["userCount"] > 0  )
					$add_cart = WC()->cart->add_to_cart( $this->phone_product_id, $_POST["userCount"] ); 
					$result["woo_cart_id"] = $add_cart;
			}
			
			echo wp_json_encode($result);
			wp_die(); 

		}
		
			
	/*
	* Validating the quantity on add to cart action with the quantity of the same product available in the cart. 
	*/
	function wc_qty_add_to_cart_validation( $passed, $product_id, $quantity, $variation_id = '', $variations = '' ) {
		
		$product_min =  get_post_meta( $product_id, 'univox_min_input', true );
		$product_max = get_post_meta( $product_id, 'univox_max_input', true );
		
		if ( ! empty( $product_min ) ) {
			// min is empty
			if ( false !== $product_min ) {
				$new_min = $product_min;
			} else {
				// neither max is set, so get out
				return $passed;
			}
		}
		if ( ! empty( $product_max ) ) {
			// min is empty
			if ( false !== $product_max ) {
				$new_max = $product_max;
			} else {
				// neither max is set, so get out
				return $passed;
			}
		}
		$already_in_cart 	= $this->wc_qty_get_cart_qty( $product_id );
		$product 			= wc_get_product( $product_id );
		$product_title 		= $product->get_title();
		
		if ( !is_null( $new_max ) && !empty( $already_in_cart ) ) {
			
			if ( ( $already_in_cart + $quantity ) > $new_max ) {
				// oops. too much.
				$passed = false;			
				wc_add_notice( apply_filters( 'isa_wc_max_qty_error_message_already_had', sprintf( __( 'You can add a maximum of %1$s %2$s\'s to %3$s. You already have %4$s.', 'woocommerce-max-quantity' ), 
							$new_max,
							$product_title,
							'<a href="' . esc_url( wc_get_cart_url() ) . '">' . __( 'your cart', 'woocommerce-max-quantity' ) . '</a>',
							$already_in_cart ),
						$new_max,
						$already_in_cart ),
				'error' );
			}
		}
		return $passed;
	}

	/*
	* Get the total quantity of the product available in the cart.
	*/ 
	function wc_qty_get_cart_qty( $product_id ) {
		
		global $woocommerce;
		$running_qty = 0; // iniializing quantity to 0
		// search the cart for the product in and calculate quantity.
		foreach($woocommerce->cart->get_cart() as $other_cart_item_keys => $values ) {
			if ( $product_id == $values['product_id'] ) {				
				$running_qty += (int) $values['quantity'];
			}
		}
		return $running_qty;
	}
		
		
		 /* Force add to cart quantity to 1 and disable +- quantity input */
		function bbloomer_split_product_individual_cart_items( $cart_item_data, $product_id ){
		  $unique_cart_item_key = uniqid();
		  $cart_item_data['unique_key'] = $unique_cart_item_key;
		  return $cart_item_data;
		}
		
		
		
		function univoxx_woocommerce_product_custom_fields_save($post_id)
		{
			// WooCommerce custom dropdown Select
		   $woocommerce_custom_product_select = $_POST['univoxx_product_form'];
		   
		   $univox_max_input = $_POST['univox_max_input'];
		   
		   $univox_min_input = $_POST['univox_min_input'];
				
				
			update_post_meta($post_id, 'univoxx_product_form', esc_attr($woocommerce_custom_product_select));
			
			update_post_meta($post_id, 'univox_max_input', esc_attr($univox_max_input));
			
			update_post_meta($post_id, 'univox_min_input', esc_attr($univox_min_input));
		}
		function univoxx_woocommerce_product_custom_fields(){
			global $woocommerce, $post;
		
			$defualt_value = get_post_meta( $post->ID, 'univoxx_product_form', true );
			$defualt_value_max = get_post_meta( $post->ID, 'univox_max_input', true );
			$defualt_value_min = get_post_meta( $post->ID, 'univox_min_input', true );
		
			$option = array();
			$option[""] = __( "Select Form" , 'woocommerce' );
			$option["phone_apps"] = __( "Phone and Apps" , 'woocommerce' );
			$option["online_fax"] = __( "Online Fax" , 'woocommerce' );
			$option["conferencing"] = __( "Conferencing" , 'woocommerce' );
			$option["spam_call_bot"] = __( "Spam Call Bot" , 'woocommerce' );
			$option["call_recording"] = __( "Call Recording" , 'woocommerce' );
			
			//print_r($option);
			echo '<div class="univoxx_product_form_field options_group show_if_promocode" >';
			// Custom Product Text Field
			 woocommerce_wp_select( array(
				'id'      => 'univoxx_product_form',
				'label'   => __( 'Univoxx Product Form', 'woocommerce' ),
				'options' =>  $option, //this is where I am having trouble
				'value'   => $defualt_value ,
				'desc_tip' => 'true',
				'description' => __('Select addictional form input for product.', 'woocommerce')
				
			) );
			
			woocommerce_wp_text_input(
				array('id' => 'univox_max_input',
					'label' => __( 'Univoxx max quantity', 'woocommerce' ),
					'placeholder' => 'max',
					'desc_tip' => 'true',
					'description' => __('Validation maximum input of product quantity.', 'woocommerce'),
					'type' => 'number',
					'value' => $defualt_value_max
					));
					
			woocommerce_wp_text_input(
				array('id' => 'univox_min_input',
					'label' => __( 'Univoxx min quantity', 'woocommerce' ),
					'placeholder' => 'min',
					'desc_tip' => 'true',
					'description' => __('Validation minimum input of product quantity.', 'woocommerce'),
					'type' => 'number',
					'value' => $defualt_value_min
					));
			echo '</div>';
			
		}
		/* function before_checkout_create_order( $order, $data ) {
			 $order->update_meta_data( '_custom_meta_key', 'value' ); 
			
			print_r($_POST);
		} */
		
		function univoxx_update_cart_session( $order_id ) {
			global $wpdb;
			if ( ! $order_id )
				return;
			 $order = wc_get_order( $order_id );
			// $order["new information"] = array("sample" ,"koto");
			 $order_items = $order->get_items(  );
			 foreach ( $order_items as $item_id => $item ) {
				$cart_id_data = wc_get_order_item_meta( $item_id, 'cart_id_data', true ); 
				$table = 'univoxx_cart_session';
				$wpdb->delete( $table, array( 'key_session' =>$cart_id_data ) );
			 }
		
		}
		
		
				
		function raa_add_custom_data_to_order( $item, $cart_item_key, $values, $order ) {
			 foreach( $item as $cart_item_key=>$cart_item ) {
				if( isset( $cart_item['phone_email'] ) ) {
					 $item->add_meta_data( 'phone_email', $cart_item['phone_email'], true ); 
				}
			  if( isset( $cart_item['first_name'] ) ) {
				   $item->add_meta_data( 'first_name', $cart_item['first_name'], true );
			  }
			  if( isset( $cart_item['last_name'] ) ) {
				   $item->add_meta_data( 'last_name', $cart_item['last_name'], true );
			  }
			  if( isset( $cart_item['phone_direct_dial'] ) ) {
				  $item->add_meta_data( 'phone_direct_dial', $cart_item['phone_direct_dial'], true );
			  }
			  if( isset( $cart_item['phone_ext'] ) ) {
				  $item->add_meta_data( 'phone_ext', $cart_item['phone_ext'], true );
			  }
				 
			  if( isset( $cart_item['voicemail_number_of_rings'] ) ) {
				  $item->add_meta_data( 'voicemail_number_of_rings', $cart_item['voicemail_number_of_rings'], true );
			  }
				   if( isset( $cart_item['voicemail_text_value'] ) ) {
				  $item->add_meta_data( 'voicemail_text_value', $cart_item['voicemail_text_value'], true );
			  }
				   if( isset( $cart_item['voice_text'] ) ) {
				  $item->add_meta_data( 'voice_text', $cart_item['voice_text'], true );
			  }
			  if( isset( $cart_item['mobile_number'] ) ) {
				  $item->add_meta_data( 'mobile_number', $cart_item['mobile_number'], true );
			  }
				if( isset( $cart_item['call_forwarding_option'] ) ) {
				  $item->add_meta_data( 'call_forwarding_option', $cart_item['call_forwarding_option'], true );
			  }
			 if( isset( $cart_item['cart_id_data'] ) ) {
				  $item->add_meta_data( 'cart_id_data', $cart_item['cart_id_data'], true );
			 }
			 if( isset( $cart_item['file_attachment'] ) ) {
				  $item->add_meta_data( 'file_attachment', $cart_item['file_attachment'], true );
			 }
			 
			 if( isset( $cart_item['phone_number'] ) ) {
				  $item->add_meta_data( 'phone_number', $cart_item['phone_number'], true );
			 }
			 
			 }
		}
			
		/**
		 * Update cart item notes
		 */
		function prefix_update_cart_meta_data() {
			 // Do a nonce check
			 if( ! isset( $_POST['security'] ) || ! wp_verify_nonce( $_POST['security'], 'woocommerce-cart' ) ) {
				wp_send_json( array( 'nonce_fail' => 1 ) );
				 die();
			 }
			 // Save the notes to the cart meta
			 $cart = WC()->cart->cart_contents;
			 $cart_id = $_POST['cart_id'];
			 parse_str($_POST['data'] , $data);
			 
			 $cart_item = $cart[$cart_id];
			 
			 
			 foreach($data as $key => $value){
				 $cart_item[$key] = $value;
			 }
			
			
			 WC()->cart->cart_contents[$cart_id] = $cart_item;
			 WC()->cart->set_session();
			 
			 
			 wp_send_json( array( 'success' => 1 , WC()->cart->cart_contents[$cart_id]) );
			 
			 die();
		}

		
	/* Action after cart */	
    function woo_action_after_add_cart_item( $data_item ){
			//print_r($cart_item);
			global $wpdb;
			$table="univoxx_cart_session";
			$cart_session= $wpdb->insert($table, 
				array(
				  'key_session'=> $data_item["key"],
				  'unique_id'    => $data_item["unique_key"]
				),
				array(
				  '%s',
				  '%s',
				) 
			); 
			$data_item["cart_id_data"] = $data_item["key"];
		return $data_item;	
		}
		
		
		/**
		 * Override the default upload path.
		 * 
		 * @param   array   $dir
		 * @return  array
		 */
		 
		 
		function wpse_upload_dir( $dir ) {
			
			$data_cart_id = $_POST["data_cart_id"];
			return array(
				'path'   => $dir['basedir']. "/univoxx_core/{$data_cart_id}/" . date('Y') . '/' . date('m'),
				'url'    => $dir['baseurl'] . "/univoxx_core/{$data_cart_id}/" . date('Y') . '/' . date('m'),
				'subdir' => '/upload',
				'basedir' => $dir['basedir']. "/univoxx_core/{$data_cart_id}/" . date('Y') . '/' . date('m'),
				'baseurl' => $dir['baseurl'] . "/univoxx_core/{$data_cart_id}/" . date('Y') . '/' . date('m'),
			) + $dir;
		}
		/**
		 * [handle_file_uploads description]
		 * @return [type]       [description]
		 */
		public function univoxx_handle_file_uploads(){
			add_filter( 'upload_dir', array( $this,  'wpse_upload_dir' ));
			/* import
			  $_FILES['audio_upload']['name']
			  $_FILES['audio_upload']['size']
			  $_FILES['audio_upload']['type']
			  $_FILES['audio_upload']['tmp_name']
			 */
			
			$result = array();

			if ( isset($_POST["data_cart_id"]) && isset($_FILES['audio_upload']) ):

				$data_cart_id = $_POST["data_cart_id"];

				$file_type=$_FILES['audio_upload']['type'];
				
				$newFilePath = UNIVOXX_UPLOAD_PATH . "/{$data_cart_id}/" . date('Y') . '/' . date('m');
				
				$url_file = get_site_url(). "/wp-content/uploads/univoxx_core" . "/{$data_cart_id}/" . date('Y') . '/' . date('m');
			      
			    $extensions= array('mp3' , 'wav' , 'ogg' , 'wma');

			    $file_ext=strtolower(end(explode('.',$_FILES['audio_upload']['name'])));
			      
			    if(in_array($file_ext,$extensions)=== false){
			         $result = array( 
	                	'success'       => false,
	                	'file_path'   	=> $newFilePath . '/' . $filename,
	                	'error'			=> 'Filetype error'
	             	);
			        echo wp_json_encode($result);

			        wp_die();
			    }

				$filename = $_FILES['audio_upload']['name'];

			 	$tmpFilePath = $_FILES['audio_upload']['tmp_name'];
			  	if(!file_exists($newFilePath)):
			  		
			  		wp_mkdir_p( $newFilePath, 0755, true );

			  	endif;
				  	
				  	if ($tmpFilePath != "" ):
						$movefile = wp_handle_upload( $_FILES['audio_upload'], array('test_form' => false) );
		
				    	if( $movefile && ! isset( $movefile['error'] )) :
						
						
							 $cart = WC()->cart->cart_contents;
							 $cart_item = $cart[$data_cart_id];
							 $cart_item["file_attachment"] = $url_file. '/' . $filename ;
							 
							 WC()->cart->cart_contents[$data_cart_id] = $cart_item;
							 WC()->cart->set_session();
						
							$result = array( 
			                	'success'       => true,
			                	'file_path'   	=> $newFilePath . '/' . $filename ,
								'url_file' => $url_file. '/' . $filename 
			             	);
							
							
							
							
							
							
						else:
							$result = array( 
			                	'success'       => false,
			                	'file_path'   	=> $newFilePath . '/' . $filename
			             	);

				    	endif;//Moved upload

				  	endif;//Not empty tmpFIlePath



			endif; // if ( isset($_POST["audio_upload"]) )
			
			echo wp_json_encode($result);
			remove_filter( 'upload_dir', array( $this,  'wpse_upload_dir' ));
			wp_die();
			
		}
		public function univoxx_text_to_speech() {
			
			$tts = new VoiceRSS;
			$voice = $tts->speech([
				'key' => 'c695e33fdced40aca7dcec86ecac289c',
				'hl' => 'en-us',
				'src' => $_POST["text"],
				'r' => '1',
				'c' => 'mp3',
				'f' => '44khz_16bit_stereo',
				'ssml' => 'false',
				'b64' => 'true'
			]);
			
			echo '<audio controls src="' . $voice['response'] . '" autoplay="autoplay"></audio>';
			
			die();
		}
		public function univoxx_search_phone_number() {
			header('Content-Type: application/json');
			$search_start_length = (int)str_repeat("1", $_POST["unusedlength"]);
			$search_end_length = (int)str_repeat("9", $_POST["unusedlength"]);
			$array_numnber = array();
			
			
			  for($x = 1; $x <= 12; $x++){
				$randnum = rand($search_start_length,$search_end_length);
				array_push($array_numnber, $_POST["input_number"] . $randnum );
			} 
			
			echo json_encode($array_numnber); 
			
			//print_r($array_numnber);
			die();
		}
		public function univoxx_phone_tollfree_number() {
			header('Content-Type: application/json');
			$array_numnber = array();
			
			for($x = 1; $x <= 12; $x++){
				$randnum = rand(1111111,9999999);
				array_push($array_numnber,$_POST['toll_free'] . $randnum );
			}
			
			echo json_encode($array_numnber);
			die();
		}
		public function option_univoxx_toll_free_number() {
			header('Content-Type: application/json');
			$array_numnber = array("844" , "877" , "855" , "888" , "866" , );
			echo json_encode($array_numnber);
			die();
		}
		public function univoxx_new_number() {
			header('Content-Type: application/json');
			$array_numnber = array();
			
			for($x = 1; $x <= 12; $x++){
				$randnum = rand(1111111111,9999999999);
				array_push($array_numnber,$randnum );
			}
			echo json_encode($array_numnber);
			die();
		}
		public function state_option_utility() {
			 $json_state = '{ 
				 "AB": "Alberta",
				"AK": "Alaska",
				"AL": "Alabama",
				"AR": "Arkansas",
				"AZ": "Arizona",
				"BC": "British Columbia",
				"CA": "California",
				"CO": "Colorado",
				"CT": "Connecticut",
				"DC": "District Of Columbia",
				"DE": "Delaware",
				"FL": "Florida",
				"GA": "Georgia",
				"HI": "Hawaii",
				"IA": "Iowa",
				"ID": "Idaho",
				"IL": "Illinois",
				"IN": "Indiana",
				"KS": "Kansas",
				"KY": "Kentucky",
				"LA": "Louisiana",
				"MA": "Massachusetts",
				"MB": "Manitoba",
				"MD": "Maryland",
				"ME": "Maine",
				"MI": "Michigan",
				"MN": "Minnesota",
				"MO": "Missouri",
				"MS": "Mississippi",
				"MT": "Montana",
				"NB": "New Brunswick",
				"NC": "North Carolina",
				"ND": "North Dakota",
				"NE": "Nebraska",
				"NH": "New Hampshire",
				"NJ": "New Jersey",
				"NL": "Newfoundland and Labrador",
				"NM": "New Mexico",
				"NS": "Nova Scotia",
				"NT": "Northwest Territories",
				"NU": "Nunavut",
				"NV": "Nevada",
				"NY": "New York",
				"OH": "Ohio",
				"OK": "Oklahoma",
				"ON": "Ontario",
				"OR": "Oregon",
				"PA": "Pennsylvania",
				"PE": "Prince Edward Island",
				"QC": "Quebec",
				"RI": "Rhode Island",
				"SC": "South Carolina",
				"SD": "South Dakota",
				"SK": "Saskatchewan",
				"TN": "Tennessee",
				"TX": "Texas",
				"UT": "Utah",
				"VA": "Virginia",
				"VT": "Vermont",
				"WA": "Washington",
				"WI": "Wisconsin",
				"WV": "West Virginia",
				"WY": "Wyoming",
				"YT": "Yukon",
				"null": "Select State"
				}';
				return $json_state;
		}
		public function save_temp_data(){

			global $wpdb;
			$serializeData = serialize($_POST['data']);

			$theTable = $wpdb->prefix . 'postmeta';

			$data = $wpdb->get_row( $wpdb->prepare( "SELECT post_id FROM $theTable WHERE meta_value = %s", $_POST["unique_id"] ) , true);

			if ( $data ){
				update_post_meta( $data->post_id, 'serialized_data', $serializeData );
			}else{
				
				$temp_data = array(
	                'post_title' => wp_strip_all_tags($_POST['unique_id']),
	                'post_type' => 'univoxx_temp_data',
	                'post_status' => 'publish'
	            );

	            $post_id = wp_insert_post($temp_data);
	            
	            if ( $post_id ) {

		            update_post_meta( $post_id, 'serialized_data', $serializeData );
		            update_post_meta( $post_id, 'unique_id', $_POST["unique_id"] );
	            
	            }

			}

            
			wp_die();
		}

		public function find_the_unique_id() {
			global $wpdb;

			$theTable = $wpdb->prefix . 'postmeta';

			$data = $wpdb->get_row( $wpdb->prepare( "SELECT post_id FROM $theTable WHERE meta_value = %s", $_POST["unique_id"] ) , true);

			$getData = get_post_meta( $data->post_id, 'serialized_data', true );
			echo "<pre>";
			var_dump(unserialize($getData));
			echo "</pre>";
			wp_die();
		}

		/**
		 * Function for converting the base_64 audio to mp3 file and saving it in the assets/temp_data/voicemail folder
		 * @param $_POST["base64_audio"] - data from the ajax request
		 * @return [file_path] - The file path of the saved mp3 file
		 */
		public function univoxx_save_temp_audio(){
			if ( isset($_POST["base64_audio"]) && isset($_POST["unique_id"]) ):
				
				$data = $_POST["base64_audio"];
				$unique_id = $_POST["unique_id"];

				//file_put_contents( UNINVOXX_PATH . '/assets/test2.mp3', $data);

				if (preg_match('/^data:audio\/(\w+);base64,/', $data, $type)) {
				    $data = substr($data, strpos($data, ',') + 1);
				    $type = strtolower($type[1]); // jpg, png, gif

				    if (!in_array($type, [ 'mp3', 'mpeg' ])) {
				        throw new \Exception('invalid image type');
				        $result = array( 
			                'success'       	=> false,
			                'error_message'  	=> "invalid audio type"
			             );

				    }

				    $data = base64_decode($data);

				    if ($data === false) {
				        $result = array( 
			                'success'       	=> false,
			                'error_message'  	=> "Decode failed"
			             );
				    }
				} else {
				    $result = array( 
		                'success'       	=> false,
		                'error_message'  	=> "Did not match data URI with audio data"
		             );
				}

				file_put_contents( UNINVOXX_PATH . "/assets/temp_data/voicemail/{$unique_id}_voicemail.mp3", $data);

				$result = array( 
	                'success'       => true,
	                'file_path'   	=> UNINVOXX_PATH . "/assets/temp_data/voicemail/{$unique_id}_voicemail.mp3"
	             );

				echo wp_json_encode($result);

			endif; // if ( isset($_POST["base64_audio"]) )

			wp_die();

		}

		
	}
	
 ?>