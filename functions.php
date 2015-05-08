<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'UZU Genesis' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.1.2' );

//* Remove jQuery and jQuery-ui scripts loading from header
add_action('wp_enqueue_scripts', 'uzu_script_remove_header');
function uzu_script_remove_header() {
      wp_deregister_script( 'jquery' );
      wp_deregister_script( 'jquery-ui' );
}

//* Load jQuery and jQuery-ui script  just before closing Body tag - increases loading speed.
add_action('genesis_after_footer', 'uzu_script_add_body');
function uzu_script_add_body() {
      wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js' );
      wp_register_script( 'jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js' );
      wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js', array( 'jquery' ), '4.0', false );
      wp_enqueue_script( 'jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js', array( 'jquery' ), '1.10.3' );
}

//* Enqueue Javascript - Don't edit the production.js or production.min.js files. Add any js to global.js or new files in the /js/dev folder, they will be concatinated into production.js.
add_action( 'wp_enqueue_scripts', 'uzu_production_js' );
function uzu_production_js(){

   wp_enqueue_script( 'production', get_stylesheet_directory_uri() . '/lib/js/production.min.js', array( 'jquery' ), '', true );

};
//* Enqueue Google Fonts and icons - Change google link to project's font, then edit _typography.scss accordingly.
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );
  wp_enqueue_style( 'dashicons' );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
  'width'           => 600,
  'height'          => 114,
  'header-selector' => '.site-title a',
  'header-text'     => false,
  'flex-height'     => true,
) );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Remove the secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Remove site layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

//* Hook sticky message before site header
add_action( 'genesis_before', 'mobile_first_sticky_message' );
function mobile_first_sticky_message() {

  genesis_widget_area( 'sticky-message', array(
    'before' => '<div class="sticky-message">',
    'after'  => '</div>',
  ) );

}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'mobile_first_remove_comment_form_allowed_tags' );
function mobile_first_remove_comment_form_allowed_tags( $defaults ) {

  $defaults['comment_notes_after'] = '';
  return $defaults;

}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'mobile_first_author_box_gravatar' );
function mobile_first_author_box_gravatar( $size ) {

  return 160;

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'mobile_first_comments_gravatar' );
function mobile_first_comments_gravatar( $args ) {

  $args['avatar_size'] = 100;
  return $args;

}

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Register widget areas
genesis_register_sidebar( array(
  'id'          => 'sticky-message',
  'name'        => __( 'Sticky Message', 'bg-mobile-first' ),
  'description' => __( 'This is the sticky message widget area.', 'bg-mobile-first' ),
) );

