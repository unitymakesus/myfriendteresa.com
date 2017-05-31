<?php
	
	/*
        Plugin Name: Easy Instagram Feed
        Description: <STRONG>WARNING DO NOT UPDATE THIS PLUGIN</STRONG>
        Author: Leach Creative
        Version: 50
        Author URI: http://leachcreative.com
    */



	class eif_instafeed_setup {
		function __construct() {
			include('inc/class-WP_Settings_Page.php');
			include('inc/class-Instafeed_Widget.php');

			add_filter('settings_array', array($this, 'create_settings' ));
			add_action( 'admin_menu', array( $this, 'register_settings_page' ));
			add_action( 'wp_enqueue_scripts', array( $this, 'front_enqueue' ));



		}
		function admin_enqueue() {

		}
		function front_enqueue() {
			//wp_enqueue_script('myscript', plugins_url('instawidget/assets/front/js/instafeed.min.js'));
			wp_enqueue_script('instagram-keys',plugins_url('/assets/front/js/instafeed.min.js', __FILE__),array( 'jquery' ), null, true);
			wp_enqueue_script('instagram-feed',plugins_url('/assets/front/js/instagram-feed.js', __FILE__),array( 'jquery' ), null, true);
			wp_localize_script('instagram-feed', 'eif_vars', array(
					'user_id' 			=> $this->get_setting_value('user_id'),
					'accessToken' 		=> $this->get_setting_value('token'),
					'client_id'			=> $this->get_setting_value('client_id'),
					'number_photos' 	=> $this->get_setting_value('number_photos'),
				)
			);
		}
		function get_setting_value($id) {
	        $settings = get_option('eif_settings');
	        $value = $settings[$id];
	        return $value;
	    }
		function create_settings( $settings ){
		    $settings = array(
		        'slug'          => 'eif_settings',
		        'menu_title'    => 'Instagram Widget Settings',
		        'capability'    => 'manage_options',
		        'page_title'    => 'Instagram Widget Settings',
		        'parent_slug'   => '/options-general.php',
		        'sections'      => array(
		            'eif_instagram' => array(
		                'slug'              => 'eif_instagram',
		                'title'             => 'Instagram Widget Settings',
		                'settings_page'     => 'eif_settings',
		                'fields'            => array(
		                    'user_id' => array(
		                        'slug'          => 'user_id',
		                        'title'         => 'Instagram User ID',
		                        'field_type'    => 'text',
		                    ),
		                    'token' => array(
		                        'slug'          => 'token',
		                        'title'         => 'Instagram Access Token',
		                        'field_type'    => 'text',
		                    ),
		                    'client_id' => array(
		                        'slug'          => 'client_id',
		                        'title'         => 'Instagram Client ID',
		                        'field_type'    => 'text',
		                    ),
		                    'number_photos' => array(
		                        'slug'          => 'number_photos',
		                        'title'         => 'Number of Photos to Pull',
		                        'field_type'    => 'text',
		                    ),
		                    'sort_by' => array(
		                        'slug'          => 'sort_by',
		                        'title'         => 'Sort By',
		                        'field_type'    => 'text',
		                    ),
		                )
		            ),
		            
		        )
		    );
		    return $settings;
		}
		function register_settings_page() {
	        $mysettings = apply_filters( 'settings_array', array());
	        $currPage = array();
	        $currPage['slug'] = $mysettings['slug'];
	        $currPage['menu_title'] = $mysettings['menu_title'];
	        $currPage['capability'] = $mysettings['capability'];
	        $currPage['page_title'] = $mysettings['page_title'];

	        if(isset($mysettings['parent_slug'])) {
	            $currPage['parent_slug'] = $mysettings['parent_slug'];
	        }
	        $settings_page = new WP_Settings_Page( $currPage );

	        $sections = $mysettings['sections'];
	        foreach($sections as $slug => $section_info ) {
	            $settings_page->add_section( array(
	                'slug'          => $section_info['slug'],
	                'title'         => $section_info['title'],
	                'settings_page' => $section_info['settings_page']
	            ));
	            $fields = $section_info['fields'];

	            foreach ( (array) $fields as $field ) {
	                $currField = array();
	                $currField['slug'] = $field['slug'];
	                $currField['title'] = $field['title'];
	                $currField['field_type'] = $field['field_type'];
	                if(isset($field['instructions'])) {
	                    $currField['instructions'] = $field['instructions'];
	                }
	                $settings_page->get_section( $section_info['slug'] )->add_field( $currField );
	            }

	        }
	    }
	}

	if (class_exists('eif_instafeed_setup')) {
	    $myclass = new eif_instafeed_setup();
	}
	add_filter( 'http_request_args', 'dm_prevent_update_check', 10, 2 );
	function dm_prevent_update_check( $r, $url ) {
	    if ( 0 === strpos( $url, 'http://api.wordpress.org/plugins/update-check/' ) ) {
	        $my_plugin = plugin_basename( __FILE__ );
	        $plugins = unserialize( $r['body']['plugins'] );
	        unset( $plugins->plugins[$my_plugin] );
	        unset( $plugins->active[array_search( $my_plugin, $plugins->active )] );
	        $r['body']['plugins'] = serialize( $plugins );
	    }
	    return $r;
	}