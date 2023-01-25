<?php 

	class UnivoxxPostType {
		
		public function create_univoxx_post_type(){
			// Set UI labels for Custom Post Type0
			
			$exists = post_type_exists( 'univoxx_temp_data' );

			if ( $exists == false ) {
			    
			    $labels = array(
			        'name'                => _x( 'Univoxx Temp Data', 'Post Type General Name', 'univoxx' ),
			        'singular_name'       => _x( 'Univoxx Temp Data', 'Post Type Singular Name', 'univoxx' ),
			        'menu_name'           => __( 'Univoxx Temp Data', 'univoxx' ),
			        'parent_item_colon'   => __( 'Parent Temp Data', 'univoxx' ),
			        'all_items'           => __( 'All Temp Data', 'univoxx' ),
			        'view_item'           => __( 'View Temp Data', 'univoxx' ),
			        'add_new_item'        => __( 'Add New Temp Data', 'univoxx' ),
			        'add_new'             => __( 'Add New Temp Data', 'univoxx' ),
			        'edit_item'           => __( 'Edit Temp Data', 'univoxx' ),
			        'update_item'         => __( 'Update Temp Data', 'univoxx' ),
			        'search_items'        => __( 'Search Temp Data', 'univoxx' ),
			        'not_found'           => __( 'Not Found', 'univoxx' ),
			        'not_found_in_trash'  => __( 'Not found in Trash', 'univoxx' ),
			    );
			     
			// Set other options for Custom Post Type
			     
			    $args = array(
			        'label'               => __( 'Temp Data', 'univoxx' ),
			        'labels'              => $labels,
			        // Features this CPT supports in Post Editor
			        'supports'            => array( 'title' ),
			        // You can associate this CPT with a taxonomy or custom taxonomy. 
			        /* A hierarchical CPT is like Pages and can have
			        * Parent and child items. A non-hierarchical CPT
			        * is like Posts.
			        */ 
			        'hierarchical'        => false,
			        'public'              => true,
			        'show_ui'             => true,
			        'show_in_menu'        => true,
			        'show_in_nav_menus'   => true,
			        'show_in_admin_bar'   => true,
			        'menu_position'       => 5,
			        'can_export'          => true,
			        'has_archive'         => false,
			        'exclude_from_search' => true,
			        'publicly_queryable'  => true,
			        'capability_type'     => 'page',
			        'capabilities' => array(
			            'create_posts' => 'do_not_allow',
			          ),
			        'map_meta_cap' => true,
			    );
			     
			    // Registering your Custom Post Type
			    register_post_type( 'univoxx_temp_data', $args );
				
			}

		}

	}

 ?>