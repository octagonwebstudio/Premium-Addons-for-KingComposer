<?php
/**
 *
 * @package Octagon KC Elements
 * @author Octagon
 * @version 1.0
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

wp_enqueue_style( 'octagon-kc-element-gradient-text' );

$wrapper_class[] = 'gradient-text';
$wrapper_class[] = $ex_class;

$wrapper_class   = array_filter( $wrapper_class );

$colors = '';
foreach( $gradient as $key => $grad ) {
	$colors .= ( null != $grad->color ) ? $grad->color : '';
	if( count( $gradient ) != ( $key ) ) {
		$colors .= ',';
	}
}

$css = '';

if( ! empty( $colors ) ) {
	$css .= '.kc-css-'. esc_html( $atts['_id'] ) .' .sub-title {
    	background: linear-gradient( '. esc_html( $custom_degrees ) .', '. esc_html( $colors ) .' );
    }';    
}

wp_add_inline_style( 'octagon-kc-element-gradient-text', octagon_minify( $css ) );

?>

<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">
	<?php
	if( ! empty( $title ) ) :
		echo '<'. esc_html( $title_tag ) .' class="sub-title">';
			echo esc_html( $title );
		echo '</'. esc_html( $title_tag ) .'">';
	endif;
	?>
</div> <!-- .gradient-text -->