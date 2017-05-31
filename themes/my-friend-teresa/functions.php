<?php
require 'vendor/autoload.php';
include_once('inc/lc-testimonials.php');
include_once('wp-bootstrap-navwalker/wp_bootstrap_navwalker.php');

add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails', array( 'post' ) );          // Posts only

add_action("wp_enqueue_scripts", 'load_front_scripts' );
function load_front_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '1.0');

	wp_enqueue_script('jQuery');
	wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true );

	wp_enqueue_script('mft_ajax', get_template_directory_uri() . '/js/ajax-load-more.js' );
	wp_localize_script('mft_ajax', 'mft_load_more_ajax', array(
		'ajaxurl' =>admin_url('admin-ajax.php'),
	));
}

add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
	register_nav_menu( 'primary', __( 'Primary Menu', 'theme-slug' ) );
}

// Register our sidebars and widgetized areas.
add_action( 'widgets_init', 'arphabet_widgets_init' );
function arphabet_widgets_init() {
	register_sidebar( array(
		'name'          => 'Home Right Footer',
		'id'            => 'home_right_footer',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );
}

// Register Custom Post Type
add_action( 'init', 'team_post_type', 0 );
function team_post_type() {
	$labels = array(
		'name'                => _x( 'Post Team Members', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Team Member', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Team Members', 'text_domain' ),
		'name_admin_bar'      => __( 'Team Member', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Team Member:', 'text_domain' ),
		'all_items'           => __( 'All Team Members', 'text_domain' ),
		'add_new_item'        => __( 'Add New Team Member', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'new_item'            => __( 'New Team Member', 'text_domain' ),
		'edit_item'           => __( 'Edit Team Member', 'text_domain' ),
		'update_item'         => __( 'Update Team Member', 'text_domain' ),
		'view_item'           => __( 'View Team Member', 'text_domain' ),
		'search_items'        => __( 'Search Team Member', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'team', 'text_domain' ),
		'description'         => __( 'Post Type Description', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', ),
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
		'capability_type'     => 'page',
	);
	register_post_type( 'team', $args );
}


// Register Custom Post Type
add_action( 'init', 'portfolio_registration', 0 );
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


// Register Custom Taxonomy
add_action( 'init', 'photographer_taxonomy', 0 );
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

function mft_load_more_ajax() {

	if( ! wp_verify_nonce($_POST['nonce'], 'mft_load_more_ajax'))
	return;

	$offset = $_POST['offset'];
	$init_offset = $_POST['init_offset'];
	if($offset != NULL && absint($offset) && $init_offset != NULL && absint($init_offset)) {
		$post_list = array();
		if($_POST['taxonomy'] != NULL && $_POST['taxterm'] != NULL ) {

			$query_args = array(
				'post_type' => 'portfolio',
				'tax_query' => array(
					array(
						'taxonomy' => $_POST['taxonomy'],
						'field'    => 'slug',
						'terms'    => array( $_POST['taxterm'] )
					),
				),
				'posts_per_page'     =>  $init_offset,
				'offset'     =>  $offset
			);
		} else {
			// Finally, we'll set the query arguments and instantiate WP_Query
			$query_args = array(
				'post_type'  =>  'portfolio',
				'posts_per_page'     =>  $init_offset,
				'offset'     =>  $offset
			);
		}


		$i = 0;
		$custom_query = new WP_Query ( $query_args );
		if ( $custom_query->have_posts() ) {
			while ( $custom_query->have_posts() ) {
				$custom_query->the_post();
				$image = get_field('image');
				$type = get_field('type');
				$type = strtolower($type);
				ob_start(); ?>
				<div class="item item-<?php echo $type; ?>">
					<?php echo show_image($image, get_permalink(), 'large'); ?>
				</div>
				<?php
				$post_list[$i] = ob_get_clean();
				$i++;
			}
			echo json_encode($post_list);

		} else {
			// no posts found
		}
	}

	die();
}
add_action( 'wp_ajax_mft_load_more_ajax', 'mft_load_more_ajax' );
add_action( 'wp_ajax_nopriv_mft_load_more_ajax', 'mft_load_more_ajax' );




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


// Comment Layout
function wp_bootstrap_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<div class="row">
				<div class="comment-author vcard clearfix">
					<div class="avatar col-sm-2">
						<?php echo get_avatar( $comment, $size='75' ); ?>
					</div>
					<div class="col-sm-10 comment-text">
						<?php printf('<h4>%s</h4>', get_comment_author_link()) ?><time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
						<?php edit_comment_link(__('Edit','wpbootstrap'),'<span class="edit-comment btn btn-sm btn-info"><i class="glyphicon-white glyphicon-pencil"></i>','</span>') ?>

						<?php if ($comment->comment_approved == '0') : ?>
							<div class="alert-message success">
								<p><?php _e('Your comment is awaiting moderation.','wpbootstrap') ?></p>
							</div>
						<?php endif; ?>

						<?php comment_text() ?>

						<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</div>
				</div>
			</div><!-- Row -->
		</article>
	<!-- </li> is added by wordpress automatically -->
	<?php
} // don't remove this bracket!


// Hide related posts on all single pages except posts
add_filter( 'jetpack_relatedposts_filter_options', function( $options ) {
    if ( !is_singular('post') ) {
        $options['enabled'] = false;
    }

    return $options;
} );
