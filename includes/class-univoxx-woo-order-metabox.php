<?php 

    class WooOrderMetabox {

    	public function __construct(){
    		add_action( 'add_meta_boxes', array( $this, 'univoxx_add_call_scenario_metabox' ) );
    	}

    	public function univoxx_add_call_scenario_metabox(){

    		add_meta_box( 'call_scenario_field', __('Call Scenario','woocommerce'), array( 'WooOrderMetabox', 'univoxx_call_scenario_field_for_woo' ), 'shop_order', 'normal', 'default' );
    	}

    	public static function univoxx_call_scenario_field_for_woo(){
    		global $post;
    		$template_loader = new Univoxx_Core_Template_Loader;
    		
    		//set_template_data
    		$get_field = get_post_meta( $post->ID, '_scenario_serialized_data', true );
    		$serialize_data = unserialize($get_field);

    		$value = array( 'call_scenario_data' => $serialize_data );

			$template_loader->set_template_data( $value )->get_template_part( 'admin/template-woo-order-metabox' );
    	}

    }

    if ( class_exists( 'WooOrderMetabox' ) ) {
		$univoxx_woo_metabox = new WooOrderMetabox();
	} 

 ?>