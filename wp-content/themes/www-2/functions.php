<?php 

function wpbootstrap_scripts_with_jquery()
{
	wp_register_script('custom-script', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array( 'jquery' ) );
	wp_enqueue_script('form-validator',get_template_directory_uri() . '/bootstrap/js/jquery.form-validator.min.js', array('jquery' ));
	wp_enqueue_script('inputmask',get_template_directory_uri() . '/bootstrap/js/jquery.inputmask.js', array('jquery' ));
	wp_enqueue_script('custom',get_template_directory_uri() . '/bootstrap/js/custom.js', array( 'jquery' ));
	wp_enqueue_script('custom-script');
	wp_enqueue_script('two_gis','https://maps.api.2gis.ru/2.0/loader.js?data-id');
}
add_action('wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );
add_filter('pre_option_link_manager_enabled', '__return_true' );
remove_filter('the_content','wptexturize');

add_filter('clean_url','unclean_url',10,3);
function unclean_url( $good_protocol_url, $original_url, $_context) {
  if ( false !== strpos( $original_url, 'data-id' ) ) {
    remove_filter( 'clean_url', 'unclean_url', 10, 3 );
    $url_parts = parse_url( $good_protocol_url );

    return $url_parts['scheme'] . '://' . $url_parts['host'] . $url_parts['path'] . '?pkg=full&lazy=true'."' data-id='dgLoader";
  }

  return $good_protocol_url;
}
?>