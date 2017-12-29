<?php add_action( 'wp_enqueue_scripts', 'ifba_enqueue_styles', 10); add_action( 'admin_enqueue_scripts', 'ifba_admin_enqueue_styles', 10);

function ifba_enqueue_styles() { wp_enqueue_script('jquery'); wp_register_script( 'ifba_jquery', plugin_dir_url( __FILE__ ) . '../bower_components/jquery/dist/jquery.min.js', array( 'jquery' ) ); wp_register_script( 'ifba_codebird', plugin_dir_url( __FILE__ ) . '../bower_components/codebird-js/codebird.js', array( 'jquery' ) ); wp_register_script( 'ifba_doT', plugin_dir_url( __FILE__ ) . '../bower_components/doT/doT.min.js', array( 'jquery' ) ); wp_register_script( 'ifba_moment', plugin_dir_url( __FILE__ ) . '../bower_components/moment/min/moment.min.js', array( 'jquery' ) ); wp_register_script( 'ifba_socialfeed', plugin_dir_url( __FILE__ ) . '../js/jquery.socialfeed.js', array( 'jquery' ) ); wp_register_style( 'ifba_socialfeed_style', plugin_dir_url( __FILE__ ) . '../css/jquery.socialfeed.css', false, '1.0.0' );

 wp_enqueue_style( 'ifba_jquery'); wp_enqueue_style( 'ifba_socialfeed_style'); wp_enqueue_style( 'ifba_fontawesome_style'); wp_enqueue_script( 'ifba_codebird'); wp_enqueue_script( 'ifba_doT'); wp_enqueue_script( 'ifba_moment'); wp_enqueue_script( 'ifba_socialfeed');

} 

function ifba_admin_enqueue_styles() { wp_enqueue_script('jquery'); wp_register_script( 'ifba_script', plugin_dir_url( __FILE__ ) . '../js/ifba-script.js', array( 'jquery' ) ); wp_enqueue_script( 'ifba_script'); }