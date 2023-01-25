<?php 

	/*
		Plugin Name: Univoxx Core
		Description: Extends Univoxx function
		
	 */
	

	define( 'UNINVOXX_PATH', plugin_dir_path( __FILE__ ) );
	//61419
	define( 'UNIVOXX_UPLOAD_PATH', trailingslashit( wp_upload_dir()['basedir'] ) . 'univoxx_core' );

	include( UNINVOXX_PATH . 'templates/template-forms.php');

	/* 61719 - load template engine*/
	if ( ! class_exists( 'Gamajo_Template_Loader' ) ) {
		require_once dirname( __FILE__ ) . '/lib/class-gamajo-template-loader.php';
	}
	
	
	
	
	
	class Univoxx_Core{
		private $univoxx_func;
		private $univoxx_call_scenario;
		public function __construct(){
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_func' ) ,100 );
			add_action( 'admin_enqueue_scripts',  array( $this, 'univoxx_load_admin_scripts') );
			//add_shortcode( 'univoxx_form', array( $this, 'create_form_function' ) );

			add_action( 'init', array( $this, 'plugin_on_activate' ), 0 );
			
			//61419
			register_activation_hook( __FILE__, array( $this, 'plugin_on_activate' ) );

			foreach ( glob( plugin_dir_path( __FILE__ ) . "includes/*.php" ) as $file ) {
			    include_once $file;
			}
			if ( class_exists( 'Univoxx_Func' ) ) {
				$this->univoxx_func = new Univoxx_Func();
				$this->univoxx_call_scenario = new UnivoxxCallScenario();
			} 
			
			add_shortcode( 'univoxx_woo_cart', array($this,'func_univoxx_univoxx_woo_cart' ));		
			add_shortcode( 'nivoxx_numnber_bar',array($this,'func_univoxx_numnber_bar')  );
			/* 61019 - Shortcode for Select Phone Section */
			add_shortcode( 'univoxx_select_phone', array($this,'func_univoxx_select_phone') );

			
			add_action( 'woocommerce_after_cart_item_thumbnail', array($this,'prefix_after_cart_item_thumbnail'), 10, 2 );
			
			
			/* Shortcode for Call Scenario */
			add_shortcode( 'univoxx_call_scenario', array( $this, 'univoxx_call_scenario_func' ) );
		}
		/**
		 * [univoxx_call_scenario_func - Function for the for displaying the form ]
		 * @return [univoxx_call_scenario]
		 */
		
		public function univoxx_call_scenario_func(){

			global $wpdb;
			$template_loader = new Univoxx_Core_Template_Loader;
			global $woocommerce;
			$items = $woocommerce->cart->get_cart();
			
			ob_start();

			$serialized_data = WC()->session->get( 'serialize_call_scenario' );

			/* echo template data */
		
			
			if(!empty($items )){
				if( !empty( $serialized_data ) ){

					/*$univoxx_id = $_GET["univoxx_id"];
					$post_obj = get_page_by_title($univoxx_id, OBJECT, 'univoxx_temp_data');
					$post_id = $post_obj->ID;

					$serialize_data = get_post_meta( $post_id, "serialized_data", true );*/
					
					$value = array( "serialize_data" => $serialized_data );
					$value["ring_option"] = $this->univoxx_call_scenario->get_scenarion_radio_rings();
					$template_loader->set_template_data( $value )->get_template_part( 'template-call-scenario' );

				}else{
					$template_loader->get_template_part( 'template-call-scenario' );
					
				}
			}
			

				$output = ob_get_clean();
				return $output;
			
		}
		
	
		function func_univoxx_numnber_bar(){
			
			$univoxx_func = $this->univoxx_func;
			
		
			
			ob_start();
		
			include(UNINVOXX_PATH."/templates/search-number-form.php");
			
			$output = ob_get_clean();
			
			return $output; 
		}

		
		function func_univoxx_select_phone(){
			ob_start();
		
			include(UNINVOXX_PATH."/templates/select-phone-form.php");
			
			$output = ob_get_clean();
			
			return $output; 
		}

		
		
		/* Shortcode for Custom Cart  */
		
		function func_univoxx_univoxx_woo_cart(){
			
		/* 	WC()->cart->cart_contents["ce4dc0768e2913318c3d6f6a215ee077"]["product_id"] = "16507";
			
			 WC()->cart->set_session();  */
			
			ob_start();
		
			include(UNINVOXX_PATH."/templates/template-woo-cart.php");
			
			$output = ob_get_clean();
			
			return $output; 
		}
		public function create_form_function(){
			if ( class_exists( 'Univoxx_Forms' ) ) {
				$univoxx_forms = new Univoxx_Forms();
				return $univoxx_forms->univoxx_form_transaction();
			} 

		}
		
				
		/**
		 * Add a text field to each cart item
		 */
		function prefix_after_cart_item_thumbnail( $cart_item, $cart_item_key ) {
		 $notes = isset( $cart_item['notes'] ) ? $cart_item['notes'] : '';
		 $phone_email = isset( $cart_item['phone_email'] ) ? $cart_item['phone_email'] : '';
		 $first_name = isset( $cart_item['first_name'] ) ? $cart_item['first_name'] : 'User 1';
		 $last_name = isset( $cart_item['last_name'] ) ? $cart_item['last_name'] : '';
		 $phone_direct_dial = isset( $cart_item['phone_direct_dial'] ) ? $cart_item['phone_direct_dial'] : '';
		 $phone_ext = isset( $cart_item['phone_ext'] ) ? $cart_item['phone_ext'] : '101';
		 $voicemail_number_of_rings = isset( $cart_item['voicemail_number_of_rings'] ) ? $cart_item['voicemail_number_of_rings'] : '';
		 $voicemail_text_value = isset( $cart_item['voicemail_text_value'] ) ? $cart_item['voicemail_text_value'] : '';
		 $voice_text = isset( $cart_item['voice_text'] ) ? $cart_item['voice_text'] : '';
		 $mobile_number = isset( $cart_item['mobile_number'] ) ? $cart_item['mobile_number'] : '';
		 $call_forwarding_option = isset( $cart_item['call_forwarding_option_'.$cart_item_key] ) ? $cart_item['call_forwarding_option_'.$cart_item_key] : '';
		 
		
		 $file_attachment = isset( $cart_item['file_attachment'] ) ? $cart_item['file_attachment'] : '';
		 
		 $cart_tts = isset( $cart_item['cart_tts_'.$cart_item_key] ) ? $cart_item['cart_tts_'.$cart_item_key] : '';
			
		 $defualt_value = get_post_meta( $cart_item["product_id"], 'univoxx_product_form', true );
		 
		/*  echo "<pre>";
		 print_r($cart_item);
		 echo "</pre>"; */
		 
		
		/* if($defualt_value == "phone_apps"){
			//$univoxx_setting->set_phone_cart_exist(true);
			$this->univoxx_call_scenario->push_scenarion_radio_rings( $first_name."|".$phone_ext);
		} */
		 
		 ob_start();
				switch ($defualt_value) {
					case "online_fax":
						include(UNINVOXX_PATH."/templates/template-woo-cart-form_{$defualt_value}.php");
						break;
					case "conferencing":
						include(UNINVOXX_PATH."/templates/template-woo-cart-form_{$defualt_value}.php");
						break;
					case "spam_call_bot":
						include(UNINVOXX_PATH."/templates/template-woo-cart-form_{$defualt_value}.php");
						break;
					case "call_recording":
						include(UNINVOXX_PATH."/templates/template-woo-cart-form_{$defualt_value}.php");
						break;
					case "phone_apps":
						$this->univoxx_call_scenario->push_scenarion_radio_rings( $first_name."|".$phone_ext."|".$cart_item_key);
						include(UNINVOXX_PATH."/templates/template-woo-cart-form.php");
						break;
					default:
						//include(UNINVOXX_PATH."/templates/template-woo-cart-form.php");
				}
				
				
				$output = ob_get_clean();
			echo $output;
		 
		 
		}

		
		function univoxx_load_admin_scripts() {
				wp_enqueue_script( 'univoxx_admin_script', plugins_url( 'assets/js/univoxx-admin.js', __FILE__ ) );
				wp_enqueue_style( 'univoxx-style-css', plugins_url( '/assets/css/admin-styles.css' , __FILE__ ) );
		}
		public function enqueue_scripts_func() {
			
			
			wp_enqueue_style( 'univoxx-style-css', plugins_url( '/assets/css/styles.css' , __FILE__ ) );
			
			wp_enqueue_style( 'univoxx-jquery-ui-smoothness',"//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" , array(), false, true );
			  wp_enqueue_script( 'univoxx_jquery-1-12-4', "//code.jquery.com/jquery-1.12.4.js"  , array(), false, true );
			wp_enqueue_script( 'univoxx_jquery-ui', "//code.jquery.com/ui/1.12.1/jquery-ui.js", array(), false, true );

			/* 61019 - dependencies for bootstrap */
			wp_enqueue_script( 'jquery-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array(), false, true ) ;
			//wp_enqueue_script( 'bootstrap-js', plugins_url( 'assets/js/bootstrap.min.js', __FILE__ ) );
			//wp_enqueue_style( 'bootstrap', plugins_url( 'assets/css/bootstrap.min.css', __FILE__ ) );
			wp_enqueue_script( 'univoxx_script', plugins_url( 'assets/js/univoxx.js', __FILE__ ) , array(), false, true ,10  );
			wp_localize_script( 'univoxx_script', 'the_ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
			
			/*70219*/
            //Script for swal.js
            wp_enqueue_script( 'swall-js', "https://cdn.jsdelivr.net/npm/sweetalert2@8" , array(), false, true);
            wp_enqueue_script( 'univoxx-cart-js', plugins_url( 'assets/js/univoxx-cart.js', __FILE__ ) , array(), false, true);
		}

		public function plugin_on_activate(){
			
			global $wpdb;
			

			$table_name = 'univoxx_cart_session';
			
			$charset_collate = $wpdb->get_charset_collate();

			$sql = "CREATE TABLE `{$table_name}` (
				ID int(12) NOT NULL AUTO_INCREMENT,
				key_session varchar(55) DEFAULT '' NOT NULL,
				unique_id varchar(55) DEFAULT '' NOT NULL,
				session_expiry timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
				PRIMARY KEY  (ID)
			) $charset_collate;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}

	}
	if ( class_exists( 'Univoxx_Core' ) ) {
		$univoxx_core = new Univoxx_Core();
		
	} 
	
	
	
	
	
	
	
		
	



add_filter( 'woocommerce_is_sold_individually', '__return_true' );



/* 
add_shortcode( 'univoxx_scenario_setting','func_nivoxx_scenario_setting'  );

function func_nivoxx_scenario_setting(){
	
	$univoxx_func = new Univoxx_Func();
	

	
	
	ob_start();

	include(UNINVOXX_PATH."/templates/template-call-scenario.php");
	
	$output = ob_get_clean();
	
	return $output; 
} */

	
/**
 * Filter the cart template path to use our cart.php template instead of the theme's
 */
function wc_change_template_relate( $template, $template_name, $template_path ) {
	 $basename = basename( $template );
	echo  $basename;

 return $template;
}
//add_filter( 'woocommerce_locate_template', 'wc_change_template_relate', 10, 3 );

add_action( 'init', function(){
	
	// Make sure this event hasn't been scheduled
	if( !wp_next_scheduled( 'cart_session_check_expiry' ) ) {
		// Schedule the event
		wp_schedule_event( time(), 'daily', 'cart_session_check_expiry' );
	}
	
});

	
	
	// cart_session_check_expiry will be call when the Cron is executed
	add_action( 'cart_session_check_expiry', 'cart_session_delete_expired' );

	// This function will run once the 'cart_session_check_expiry' is called
	function cart_session_delete_expired() {
		global $wpdb;
		$univoxx_table = 'univoxx_cart_session';
		// $wpdb->delete( $table, array( 'ID' =>2 ) );
		
		
		$univoxx_table_rows = $wpdb->get_results( "SELECT * FROM $univoxx_table" );
		
		//print_r($univoxx_table_rows );
		foreach($univoxx_table_rows as $key => $value){
			$now = time();
			$date = $value->session_expiry; #could be (almost) any string date

			if (strtotime($date) > $now) {
				echo "$date occurs in the future";
			} else {
				//echo "#$date occurs now or in the past";
				
				$result = delete_directory( UNIVOXX_UPLOAD_PATH . "/". $value->cart_session ."/");
				$newFilePath = UNIVOXX_UPLOAD_PATH . "/{$value->cart_session}/";
				if($result || !file_exists($newFilePath)){
					$wpdb->delete( $univoxx_table, array( 'key_session' =>$value->cart_session) );
				}
				
			}
		}
		
	}
	
	function delete_directory($dirname) {
			 if (is_dir($dirname))
			   $dir_handle = opendir($dirname);
		 if (!$dir_handle)
			  return false;
		 while($file = readdir($dir_handle)) {
			   if ($file != "." && $file != "..") {
					if (!is_dir($dirname."/".$file))
						 unlink($dirname."/".$file);
					else
						 delete_directory($dirname.'/'.$file);
			   }
		 }
		 closedir($dir_handle);
		 rmdir($dirname);
		 return true;
	}
	
	
	
	



/*61919*/
add_action('woocommerce_checkout_create_order', 'before_checkout_create_order', 20, 2);
function before_checkout_create_order( $order, $data ) {
	global $wpdb;
	
	/*Get serialize data and update order meta*/
	$retrieve_data = WC()->session->get( 'serialize_call_scenario' );
	$order->update_meta_data( '_scenario_serialized_data', "{$retrieve_data}" );
	
	//62719 - Get the number and update order meta
	$retrieve_phone_number = WC()->session->get( 'primary_phone_number' );
	$order->update_meta_data( '_primary_phone_number', "{$retrieve_phone_number}" );

	$retrieve_configure_system = WC()->session->get( 'configure_system' );
	$order->update_meta_data( '_configure_system_data', "{$retrieve_configure_system}" );
	
}


	// display the extra data in the order admin panel
function kia_display_order_data_in_admin( $order ){ 
   echo ' <div class="order_data_column scenario_setting">';
       echo ' <h4> '. _e( 'Extra Details' ).'</h4>';
       
		
	
					   // Get the $order object from an ID (if needed only)
			


			$scenario_serialized_key = 0;
			
			foreach($order->get_meta_data() as $key => $value){
				if($value->get_data()['key'] == "_scenario_serialized_data")
					$scenario_serialized_key = $key;
			}
		   
		  $scenario_serialized_data = unserialize($order->get_meta_data()[$scenario_serialized_key]->value);
		  
		/*   echo "<pre>";
		  print_r();
		   echo "</pre>"; */
   echo '</div>';
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'kia_display_order_data_in_admin' );
	
	
/**
 * Override woocommerce files
 */
function theme_customisations_wc_get_template( $located, $template_name ) {
    $plugin_template_path = untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/templates/woocommerce/' . $template_name;
    //var_dump($plugin_template_path);
    if ( file_exists( $plugin_template_path ) ) {
        $located = $plugin_template_path;
    }
    return $located;
}
add_filter( 'wc_get_template', 'theme_customisations_wc_get_template', 1, 5 );



 ?>