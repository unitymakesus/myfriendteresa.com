<?php
/*
Plugin Name: Cache-Control
Plugin URI:  https://www.geeky.software/wordpress-plugins/cache-control/
Description: Configurable HTTP Cache-Control headers for webpages generated by WordPress.
Version:     2.1.1
Author:      Geeky Software
Author URI:  https://www.geeky.software/
License:     GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

if ( !defined('ABSPATH') ) {
    header( 'HTTP/1.1 403 Forbidden' );
    exit(   'HTTP/1.1 403 Forbidden' );
}

$cache_control_options = array(
    'front_page'   => array(
        'id'       => 'front_page',
        'name'     => 'Front page',
        'max_age'  => 300,           //                5 min
        's_maxage' => 150            //                2 min 30 sec
    ),
    'singles'      => array(
        'id'       => 'singles',
        'name'     => 'Posts',
        'max_age'  => 600,           //               10 min
        's_maxage' => 60,            //                1 min
        'mmulti'   => 1              // enabled
    ),
    'pages'        => array(
        'id'       => 'pages',
        'name'     => 'Pages',
        'max_age'  => 1200,          //               20 min
        's_maxage' => 300            //                5 min
    ),
    'home'         => array(
        'id'       => 'home',
        'name'     => 'Main index',
        'max_age'  => 180,           //                3 min
        's_maxage' => 45,            //                      45 sec
        'paged'    => 5              //                       5 sec
    ),
    'categories'   => array(
        'id'       => 'categories',
        'name'     => 'Categories',
        'max_age'  => 900,           //               15 min
        's_maxage' => 300,           //                5 min
        'paged'    => 8              //                       8 sec
    ),
    'tags'         => array(
        'id'       => 'tags',
        'name'     => 'Tags',
        'max_age'  => 900,           //               15 min
        's_maxage' => 300,           //                5 min
        'paged'    => 10             //                       8 sec
    ),
    'authors'      => array(
        'id'       => 'authors',
        'name'     => 'Authors',
        'max_age'  => 1800,          //               30 min
        's_maxage' => 600,           //               10 min
        'paged'    => 10             //                      10 sec
    ),
    'dates'        => array(
        'id'       => 'dates',
        'name'     => 'Dated archives',
        'max_age'  => 10800,         //      3 hours
        's_maxage' =>  2700          //               45 min
    ),
    'feeds'        => array(
        'id'       => 'feeds',
        'name'     => 'Feeds',
        'max_age'  => 5400,          //       1 hours 30 min
        's_maxage' => 600            //               10 min
    ),
    'attachment'   => array(
        'id'       => 'attachment',
        'name'     => 'Attachment pages',
        'max_age'  => 10800,         //       3 hours
        's_maxage' =>  2700          //               45 min
    ),
    'search'       => array(
        'id'       => 'search',
        'name'     => 'Search results',
        'max_age'  => 1800,          //               30 min
        's_maxage' => 600            //               10 min
    ),
    'notfound'     => array(
        'id'       => 'notfound',
        'name'     => '404 Not Found',
        'max_age'  => 900,           //               15 min
        's_maxage' => 300            //                5 min
    ),
    //'redirect_temporary' => array(
    //    'id'       => 'redirect_temporary',
    //    'name'     => 'Temporary redirects',
    //    'max_age'  => 60,            //                      60 sec
    //    's_maxage' => 20             //                      20 sec
    //),
    'redirect_permanent' => array(
        'id'       => 'redirect_permanent',
        'name'     => 'Permanent redirects',
        'max_age'  => 86400,         // 1 day
        's_maxage' => 21600          //       6 hours
)   );

if ( cache_control_does_woocommerce() ) {
    $cache_control_options['woocommerce_product'] =
      array(
        'id'       => 'woocommerce_product',
        'name'     => 'WooCommerce products',
        'max_age'  => 600,           //               10 min
        's_maxage' => 60             //                1 min
    );
    $cache_control_options['woocommerce_category'] =
      array(
        'id'       => 'woocommerce_category',
        'name'     => 'WooCommerce categories',
        'max_age'  => 600,           //               10 min
        's_maxage' => 60             //                1 min
    );
}

function cache_control_stale_factorer( $factor, $max_age ) {
    if ( is_paged() && is_int( $factor ) && $factor > 0 ) {
      $multiplier = get_query_var( 'paged' ) - 1;
      if ( $multiplier > 0 ) {
          $factored_max_age = $factor * $multiplier;
          if ( $factored_max_age >= ( $max_age * 10 ) )
              return $max_age * 10;

          return $factored_max_age;
    }  }

    return 0;
}

function cache_control_is_future_now_maxtime( $max_time_future ) {
    // trusting the database to cache this query
    $future_post = new WP_Query( array( 'post_status' => 'future',
                                        'posts_per_page' => 1,
                                        'orderby' => 'date',
                                        'order' => 'ASC'
    ) );

    if ( $future_post->have_posts() ) {
        $local_nowtime = intval( current_time( 'timestamp', 0 ) );

        while ( $future_post->have_posts() ) {
            $future_post->the_post();
            $local_futuretime = get_the_time( 'U' );
            if ( ( $local_nowtime + $max_time_future ) > $local_futuretime )
                $max_time_future = $local_futuretime - $local_nowtime + rand( 2, 32 );
        }

        wp_reset_postdata();
    }

    return $max_time_future;
}

function cache_control_build_directive_header( $max_age, $s_maxage ) {
    $directive = "";
    if ( !empty( $max_age ) && is_int( $max_age ) && $max_age > 0)
        $directive = "max-age=$max_age";

    if ( !empty( $s_maxage ) && is_int( $s_maxage ) && $s_maxage > 0 && $s_maxage != $max_age ) {
        if ( !$directive != "" )
            $directive = "public";

        $directive = "$directive, s-maxage=$s_maxage";
    }

    $directive = apply_filters( 'cache_control_cachedirective', $directive );

    if ( $directive != "" )
        return $directive;

    return "no-cache, no-store, must-revalidate";
}

function cache_control_build_directive_from_option( $option_name ) {
    global $cache_control_options;

    $option = $cache_control_options[$option_name];

    $max_age  = intval( get_option( 'cache_control_' . $option['id'] . '_max_age',  $option['max_age']  ) );
    $s_maxage = intval( get_option( 'cache_control_' . $option['id'] . '_s_maxage', $option['s_maxage'] ) );

    // dynamically shorten caching time when a scheduled post is imminent
    if ( $option_name != 'attachment' &&
         $option_name != 'dates'      &&
         $option_name != 'pages'      &&
         $option_name != 'singles'    &&
         $option_name != 'notfound'  ) {
        $max_age = cache_control_is_future_now_maxtime( $max_age );
        $s_maxage = cache_control_is_future_now_maxtime( $s_maxage );
    }

    if ( is_paged() && isset( $option['paged'] ) ) {
        $page_factor = intval( get_option( 'cache_control_' . $option['id'] . '_paged', $option['paged'] ) );
        $max_age  += cache_control_stale_factorer( $page_factor, $max_age  );
        $s_maxage += cache_control_stale_factorer( $page_factor, $s_maxage );
    }

    if ( $option_name == 'singles' && get_option( 'cache_control_singles_mmulti' ) == 1 ) {
        $date_now = new DateTime();
        $date_mod = new DateTime( get_the_modified_date( 'c' ) );

        $last_com = get_comments( 'post_id=' . get_the_ID() . '&number=1&include_unapproved=1&number=1&orderby=comment_date' );
        if ( $last_com != NULL ) {
            $last_com = new DateTime( $last_com->comment_date );
            $date_mod = max( array( $date_mod, last_com ) );
        }

        $date_diff = $date_now->diff( $date_mod );
        $months_stale = $date_diff->m + ( $date_diff->y * 12 );

        if ( $months_stale > 0 ) {
            $max_age  = intval( $max_age  * ( ( $months_stale + 12 ) / 12 ) );
            $s_maxage = intval( $s_maxage * ( ( $months_stale + 12 ) / 12 ) );
    }   }

    return cache_control_build_directive_header( $max_age,  $s_maxage );
}

function cache_control_nocacheables() {
    global $wp_query;

    $noncacheable = ( is_preview()        ||
                      is_user_logged_in() ||
                      is_trackback()      ||
                      is_admin()
                    );

    // Requires post password, and post has been unlocked.
    if ( !$noncacheable                             &&
         isset($wp_query)                           &&
         isset($wp_query->posts)                    && 
         count($wp_query->posts) >= 1               &&
         !empty($wp_query->posts[0]->post_password) &&
         !post_password_required() ) {
        $noncacheable = TRUE;
    }

    // WooCommerce support
    elseif ( !$noncacheable && function_exists('is_woocommerce') ) {
        $noncacheable = ( is_cart() ||
                          is_checkout() ||
                          is_account_page() );
    }

    $noncacheable = apply_filters( 'cache_control_nocacheables', $noncacheable );

    return $noncacheable;
}

function cache_control_does_woocommerce() {
    return ( function_exists('is_woocommerce') ||
             file_exists( WP_PLUGIN_DIR . '/woocommerce/woocommerce.php' ) );
}

function cache_control_select_directive() {
    if ( cache_control_nocacheables() )
        return cache_control_build_directive_header( false, false );
    elseif ( is_feed() )
        return cache_control_build_directive_from_option( 'feeds' );
    elseif ( is_front_page() && !is_paged() )
        return cache_control_build_directive_from_option( 'front_page' );
    elseif ( is_single() )
        return cache_control_build_directive_from_option( 'singles' );
    elseif ( is_page() )
        return cache_control_build_directive_from_option( 'pages' );
    elseif ( is_home() )
        return cache_control_build_directive_from_option( 'home' );
    elseif ( is_category() )
        return cache_control_build_directive_from_option( 'categories' );
    elseif ( is_tag() )
        return cache_control_build_directive_from_option( 'tags' );
    elseif ( is_author() )
        return cache_control_build_directive_from_option( 'authors' );
    elseif ( is_attachment() )
        return cache_control_build_directive_from_option( 'attachment' );
    elseif ( is_search() )
        return cache_control_build_directive_from_option( 'search' );
    elseif ( is_404() )
        return cache_control_build_directive_from_option( 'notfound' );
    elseif ( is_date() ) {
        if ( ( is_year() && strcmp(get_the_time('Y'), date('Y')) < 0 ) ||
             ( is_month() && strcmp(get_the_time('Y-m'), date('Y-m')) < 0 ) ||
             ( ( is_day() || is_time() ) && strcmp(get_the_time('Y-m-d'), date('Y-m-d')) < 0 ) ) {
            return cache_control_build_directive_from_option( 'dates' );
        }
        else
            return cache_control_build_directive_from_option( 'home' );
    }
    elseif ( cache_control_does_woocommerce() ) {
        if ( function_exists('is_product') && is_product() )
            return cache_control_build_directive_from_option( 'woocommerce_product' );
        elseif ( function_exists('is_product_category') && is_product_category() )
            return cache_control_build_directive_from_option( 'woocommerce_category' );
    }

    // cache_control_handle_redirects() is handled at an earlier stage

    return cache_control_build_directive_header( FALSE, FALSE );
}

function cache_control_send_http_header( $directives ) {
    if ( !empty( $directives ) )
        header ( "Cache-Control: $directives", TRUE );
}

function cache_control_merge_http_header( $directives ) {
    if ( !empty( $directives ) )
        header ( "Cache-Control: $directives", FALSE );
}

function cache_control_send_headers() {
    cache_control_send_http_header( cache_control_select_directive() );
}

add_action( 'template_redirect', 'cache_control_send_headers' );


function cache_control_handle_redirects( $status, $location = NULL ) {
    if ( cache_control_nocacheables() )
      cache_control_send_http_header(
        cache_control_build_directive_header( FALSE, FALSE ) );
    elseif ( $status == 301          ||          $status == 308 )
      cache_control_send_http_header(
        cache_control_build_directive_from_option( 'redirect_permanent' ) );
    //elseif ( $status == 302 || $status == 303 || $status == 307 )
    //  cache_control_merge_http_header(
    //    cache_control_build_directive_from_option( 'redirect_temporary' ) );

    // Include a minimal body message. Recommended by HTTP spec, required by many caching proxies.
    if ( in_array( $status, array( "301", "302", "303", "307", "308" ) ) ) {
      if ( ob_start() ) {
        $location_attr = esc_attr( $location );
        print("<!doctype html>\n<meta charset=\"utf-8\">\n<title>Document moved</title>\n<p>Document has <a href=\"${location_attr}\">moved here</a>.</p>");
    } }

    return $status;
}

add_filter( 'wp_redirect_status', 'cache_control_handle_redirects', 10, 2 );


if ( is_admin() )
    require_once( dirname(__file__) . '/admin.php' );

