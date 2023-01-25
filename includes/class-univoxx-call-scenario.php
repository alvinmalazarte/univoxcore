<?php 

	class UnivoxxCallScenario {
		private $get_boolean = false;
		private $scenarion_radio_rings = array();
		public function __construct(){


			/* Action for creating a new woocommerce order */
			add_action( 'unvoxx_create_woo_order', array( $this, 'create_order_func' ) );

			/*61719 - handle call scenario form submit*/
			add_action('wp_ajax_handle_call_scenario_form_submit', array( $this, 'univoxx_handle_call_scenario_form_submit' ));
			add_action('wp_ajax_nopriv_handle_call_scenario_form_submit', array( $this, 'univoxx_handle_call_scenario_form_submit' ));

			
			/*62519 - handle call scenario form submit*/
			add_action('wp_ajax_handle_call_scenario_upload', array( $this, 'univoxx_handle_call_scenario_upload' ));
			add_action('wp_ajax_nopriv_handle_call_scenario_upload', array( $this, 'univoxx_handle_call_scenario_upload' ));
			
			
			
		}

		
		public function set_phone_cart_exist($boolean){
			$this->get_boolean = $boolean;
		}
		public function if_phone_cart_exist(){
			return $this->get_boolean;
		}
		
		public function push_scenarion_radio_rings($value){
			array_push($this->scenarion_radio_rings,$value);
		}
		public function get_scenarion_radio_rings(){
			return $this->scenarion_radio_rings;
		}
		
		/*62519*/
		public function univoxx_handle_call_scenario_upload(){
			
			/* echo $_FILES['audio_upload']['name'];
			 echo $_FILES['audio_upload']['size'];
			 echo $_FILES['audio_upload']['type'];
			 echo $_FILES['audio_upload']['tmp_name']; */
			// print_r($_POST);
			
			 if(isset($_POST['is_scenario_upload'])){
					add_filter( 'upload_dir', array( $this,  'wpse_upload_dir' ));
					
					
					$result = array();

					if ( isset($_POST["data_cart_id"]) && isset($_FILES['audio_upload']) ):

						$data_cart_id = $_POST["data_cart_id"];

						$file_type=$_FILES['audio_upload']['type'];
						
						$newFilePath = UNIVOXX_UPLOAD_PATH . "/{$data_cart_id}/" . date('Y') . '/' . date('m');
						  
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
									$result = array( 
										'success'       => true,
										'key'       => $data_cart_id,
										'short_file_path'       => $data_cart_id. date('Y') . '/' . date('m').'/'.$filename,
										'file_path'   	=> get_home_url()."/wp-content/uploads/univoxx_core" . '/' .$data_cart_id.'/'. date('Y') . '/' . date('m'). '/' .$filename,
										'filename'   	=> $filename
									);
									
									
									 $cart = WC()->cart->cart_contents;
									 $cart_id = $data_cart_id;
									 
									 
									 $cart_item = $cart[$cart_id];
									 $cart_item["file_attachment"] =  $newFilePath . '/' . $filename;
									 
									 
										
									
								else:
									$result = array( 
										'success'       => false,
										'file_path'   	=> $newFilePath . '/' . $filename
									);

								endif;//Moved upload

							endif;//Not empty tmpFIlePath



					endif; // if ( isset($_POST["audio_upload"]) ) */
					 
					 
			}
			global $wpdb;
			$table="univoxx_cart_session";
			$cart_session= $wpdb->insert($table, 
				array(
				  'key_session'=> $_POST["data_cart_id"],
				  'unique_id'    => "_unique_".$_POST["data_cart_id"]
				),
				array(
				  '%s',
				  '%s',
				) 
			); 
			
			 
			echo wp_json_encode($result);
			
			remove_filter( 'upload_dir', array( $this,  'wpse_upload_dir' ));
			
			wp_die(); 
		}
			
		/*61919*/
		public function univoxx_handle_call_scenario_form_submit(){

			
			
			
			
			  if ( isset($_POST) ) {
				
				$result = array();
				
				/* print_r($_POST["form_values"]);  */
				$serializeData = serialize($_POST);
				WC()->session->set( 'serialize_call_scenario' , $serializeData );
				
				$retrive_data = WC()->session->get( 'serialize_call_scenario' );
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
			echo wp_json_encode($result);
			wp_die(); 


		}
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
		 * [create_order_func - Sample function for creating a new order in woo]
		 * @return [unvoxx_create_woo_order]
		 */
		/*public function create_order_func(){
			 // creating woocommerce order
            $order = wc_create_order();
            
            $order->add_product( wc_get_product( $product_id ), 1, $args );
            $order->set_address( $address, 'billing' );
            $order->set_customer_id($user_id);
            $order->set_billing_email( $user_info->user_email );
            $order->set_date_paid( strtotime( $expiring_date ) );

            $payment_url = $order->get_checkout_payment_url();
                
            $order->calculate_totals();
            $order->save();

            
            $order->update_meta_data('meta_key', $meta_value);

            $order->save_meta_data();

            
            $order_id = $order->get_order_number();
		}*/

	}

	if ( class_exists( 'UnivoxxCallScenario' ) ) {
		$univoxx_call_scenario = new UnivoxxCallScenario();
	} 

 ?>