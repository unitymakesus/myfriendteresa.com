<?php
	
	/*
        Plugin Name: My Friend Teresa
        Description: A Wordpress theme built by Big Ring Interactive.
        Author: Leach Creative
        Version: 1.0
        Author URI: http://leachcreative.com
    */
	include_once('wp-bootstrap-navwalker/wp_bootstrap_navwalker.php');

	function show_image($img, $link = '', $mini_size='medium') {
        if(!empty($img)):
            if($link != ''):
                $size_image = $img['sizes'][ $mini_size ];
                $reg_image = $img['url'];
                $image = '<a href="' . $link . '"><img alt="' . $img['alt'] . '"  src="' . $size_image . '" data-src="' . $reg_image . '" class="lazyload" /></a>';
                return $image;
            else:
                $size_image = $img['sizes'][ $mini_size ];
                $reg_image = $img['url'];
                $image = '<img alt="' . $img['alt'] . '"  src="' . $size_image . '" data-src="' . $reg_image . '" class="lazyload" />';
                return $image;
            endif;
        else:
            return;
        endif;
    }

	add_action("wp_enqueue_scripts", 'load_front_scripts' );
	function load_front_scripts() {
	    wp_enqueue_style( 'style', get_stylesheet_uri());
	    wp_enqueue_script('jQuery');
	    wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), '1.0.0', true );
	    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '1.0.0', true );
	    wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true );
	}

	// Register Custom Post Type
	function portfolio_registration() {

		$labels = array(
			'name'                => _x( 'Portfolio', 'Post Type General Name', 'text_domain' ),
			'singular_name'       => _x( 'Portfolio', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'           => __( 'Portfolio', 'text_domain' ),
			'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
			'all_items'           => __( 'All Items', 'text_domain' ),
			'view_item'           => __( 'View Item', 'text_domain' ),
			'add_new_item'        => __( 'Add New Item', 'text_domain' ),
			'add_new'             => __( 'Add New', 'text_domain' ),
			'edit_item'           => __( 'Edit Item', 'text_domain' ),
			'update_item'         => __( 'Update Item', 'text_domain' ),
			'search_items'        => __( 'Search Item', 'text_domain' ),
			'not_found'           => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
		);
		$args = array(
			'label'               => __( 'portfolio', 'text_domain' ),
			'description'         => __( 'Portfolio', 'text_domain' ),
			'labels'              => $labels,
			'supports'            => array( ),
			'taxonomies'          => array( 'photographers' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'portfolio', $args );

	}

	// Hook into the 'init' action
	add_action( 'init', 'portfolio_registration', 0 );


	// Register Custom Taxonomy
	function photographer_taxonomy() {

		$labels = array(
			'name'                       => _x( 'Photographers', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Photographer', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Photographers', 'text_domain' ),
			'all_items'                  => __( 'All Items', 'text_domain' ),
			'parent_item'                => __( 'Parent Item', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
			'new_item_name'              => __( 'New Item Name', 'text_domain' ),
			'add_new_item'               => __( 'Add New Item', 'text_domain' ),
			'edit_item'                  => __( 'Edit Item', 'text_domain' ),
			'update_item'                => __( 'Update Item', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
			'search_items'               => __( 'Search Items', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used items', 'text_domain' ),
			'not_found'                  => __( 'Not Found', 'text_domain' ),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => array('slug' => 'photographer'),
			'with_front'                 => true,
			'hierarchical'               => true,
			'query_var'					 => true
		);
		register_taxonomy( 'photographer', array( 'portfolio' ), $args );

	}

	// Hook into the 'init' action
	add_action( 'init', 'photographer_taxonomy', 0 );




	add_action( 'after_setup_theme', 'register_my_menu' );
	function register_my_menu() {
	  register_nav_menu( 'primary', __( 'Primary Menu', 'theme-slug' ) );
	}

	/**
	 * Register our sidebars and widgetized areas.
	 *
	 */
	function arphabet_widgets_init() {

		register_sidebar( array(
			'name'          => 'Home Right Footer',
			'id'            => 'home_right_footer',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="rounded">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => 'Home Center Footer',
			'id'            => 'home_center_footer',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="rounded">',
			'after_title'   => '</h2>',
		) );

	}
	add_action( 'widgets_init', 'arphabet_widgets_init' );


	add_filter("gform_field_content", "bootstrap_styles_for_gravityforms_fields", 10, 5);
	function bootstrap_styles_for_gravityforms_fields($content, $field, $value, $lead_id, $form_id){
		
		// Currently only applies to most common field types, but could be expanded.
		$wrapper = "";

		if($field["type"] != 'hidden' && $field["type"] != 'list' && $field["type"] != 'multiselect' && $field["type"] != 'checkbox' && $field["type"] != 'fileupload' && $field["type"] != 'date' && $field["type"] != 'html' && $field["type"] != 'address') {
			$content = str_replace('class=\'medium', 'class=\'form-control medium', $content);
			$wrapper = '<div class="form-group">' . $content . '</div>';
		}
		
		if($field["type"] == 'name' || $field["type"] == 'address') {
			$content = str_replace('<input ', '<input class=\'form-control\' ', $content);
			$wrapper = '<div class="form-group">' . $content . '</div>';
		}
		
		if($field["type"] == 'textarea') {
			$content = str_replace('class=\'textarea', 'class=\'form-control textarea', $content);
			$wrapper = '<div class="form-group">' . $content . '</div>';
		}
		
		if($field["type"] == 'checkbox') {
			$content = str_replace('li class=\'', 'li class=\'checkbox ', $content);
			$content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
			$wrapper = '<div class="form-group">' . $content . '</div>';
		}
		
		if($field["type"] == 'radio') {
			$content = str_replace('li class=\'', 'li class=\'radio ', $content);
			$content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
			$wrapper = '<div class="form-group">' . $content . '</div>';
		}
		
		return $content;
		
	} // End bootstrap_styles_for_gravityforms_fields()

	add_filter("gform_submit_button", "form_submit_button", 10, 2);
	function form_submit_button($button, $form){
	    return "<button class='button btn btn-primary' id='gform_submit_button_{$form["id"]}'><span>Submit</span></button>";
	}

	/**
	 * Mailchimp Subscribe
	 * @return [type] [description]
	 */
	function mft_mailchimp_subscribe() {
	    //If check if nonce is verified
	    if ( 
	        ! isset( $_POST['mailchimp_subscribe'] ) 
	        || ! wp_verify_nonce( $_POST['mailchimp_subscribe'], 'mailchimp_subscribe' ) 
	    ) {

	       //print 'Sorry, your nonce did not verify.';
	       //exit;

	    } else {
	        //Nonce Verified
	        // Get API Key
	        $apikey = "82fce9000292b449c8c82909092de090-us1";
	        $list_id = "4eb5dd5a6c";

	        // Set Email
	        $email = sanitize_email($_POST['email']);

	        $Mailchimp = new Mailchimp($apikey);
	        $subscriber = $Mailchimp->lists->subscribe($list_id, array('email' => $email), '', false, false);
	    }
	}
	add_action('init', 'mft_mailchimp_subscribe');

	



?>