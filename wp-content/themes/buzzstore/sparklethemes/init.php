<?php
/**
 * Main Custom admin functions area
 *
 * @since SparklewpThemes
 *
 * @param BuzzStore
 *
*/
if( !function_exists('buzzstore_file_directory') ){

    function buzzstore_file_directory( $file_path ){
        if( file_exists( trailingslashit( get_stylesheet_directory() ) . $file_path) ) {
            return trailingslashit( get_stylesheet_directory() ) . $file_path;
        }
        else{
            return trailingslashit( get_template_directory() ) . $file_path;
        }
    }
}


/**
 * Load Custom Admin functions that act independently of the theme functions.
*/
require buzzstore_file_directory('sparklethemes/functions.php');

/**
 * Custom template tags for this theme.
*/
require buzzstore_file_directory('sparklethemes/core/template-tags.php');

/**
 * Custom functions that act independently of the theme header.
*/
require buzzstore_file_directory('sparklethemes/core/custom-header.php');

/**
 * Custom functions that act independently of the theme templates.
*/
require buzzstore_file_directory('sparklethemes/core/extras.php');

/**
 * Load Jetpack compatibility file.
*/
require buzzstore_file_directory('sparklethemes/core/jetpack.php');

/**
 * Customizer additions.
*/
require buzzstore_file_directory('sparklethemes/customizer/customizer.php');

/**
 * Load widget compatibility field file.
*/
require buzzstore_file_directory('sparklethemes/buzzwidgets/widgets-fields.php');

/**
 * Load header hooks file.
*/
require buzzstore_file_directory('sparklethemes/hooks/header.php');

/**
 * Load footer hooks file.
*/
require buzzstore_file_directory('sparklethemes/hooks/footer.php');

/**
 * Load woocommerce hooks file.
*/
if ( buzzstore_is_woocommerce_activated() ) {
	require buzzstore_file_directory('sparklethemes/hooks/woocommerce.php');
}

/**
 * Load theme about page
*/
require buzzstore_file_directory('sparklethemes/admin/about-theme/buzzstore-about.php');