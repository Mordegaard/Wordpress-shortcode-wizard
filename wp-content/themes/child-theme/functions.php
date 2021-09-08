<?php
include( get_stylesheet_directory() . '/scripts/shortcode.php' );

function enqueue_load_bootstrap() {
    // Add bootstrap CSS
    wp_register_style( 'bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', false, NULL, 'all' );
    wp_enqueue_style( 'bootstrap-css' );

    // Add popper js
    wp_register_script( 'popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', ['jquery'], NULL, true );
    wp_enqueue_script( 'popper-js' );

    // Add bootstrap js
    wp_register_script( 'bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', ['jquery'], NULL, true );
    wp_enqueue_script( 'bootstrap-js' );
}

// Add integrity and cross origin attributes to the bootstrap css.
function add_bootstrap_css_attributes( $html, $handle ) {
    if ( $handle === 'bootstrap-css' ) {
        return str_replace( '/>', 'integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />', $html );
    }
    return $html;
}
add_filter( 'style_loader_tag', 'add_bootstrap_css_attributes', 10, 2 );

// Add integrity and cross origin attributes to the bootstrap script.
function add_bootstrap_script_attributes( $html, $handle ) {
    if ( $handle === 'bootstrap-js' ) {
        return str_replace( '></script>', ' integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>', $html );
    }
    return $html;
}
add_filter('script_loader_tag', 'add_bootstrap_script_attributes', 10, 2);

// Add integrity and cross origin attributes to the popper script.
function add_popper_script_attributes( $html, $handle ) {
    if ( $handle === 'popper-js' ) {
        return str_replace( '></script>', ' integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>', $html );
    }
    return $html;
}
add_filter('script_loader_tag', 'add_popper_script_attributes', 10, 2);

add_action( 'wp_enqueue_scripts', 'enqueue_load_bootstrap' );
function child_theme_script() {
    wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/scripts/script.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'child_theme_script' );

function child_theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_styles', 99 );

?>