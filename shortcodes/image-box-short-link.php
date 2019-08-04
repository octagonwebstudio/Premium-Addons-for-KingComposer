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

wp_enqueue_style( 'octagon-kc-element-image-box' );

$wrapper_class[] = 'image-box';
$wrapper_class[] = 'image-box-'. $content_position_short;
$wrapper_class[] = $style;
$wrapper_class[] = $ex_class;

$wrapper_class   = array_filter( $wrapper_class );

$btn_link	= ( '||' === $btn_link ) ? '' : $btn_link;
$btn_link	= kc_parse_link($btn_link);

if ( strlen( $btn_link['url'] ) > 0 ) {
	$a_href 	= $btn_link['url'];
	$a_title 	= $btn_link['title'];
	$a_target 	= strlen( $btn_link['target'] ) > 0 ? $btn_link['target'] : '_self';
}

if( ! isset( $a_href ) ) {
	$a_href = '#';
}

if( isset( $a_href ) ) {
	$button_attr[] = 'href="'. esc_url( $a_href ) .'"';
}

if( isset( $a_target ) ) {
	$button_attr[] = 'target="'. esc_attr( $a_target ) .'"';
}

if( isset( $a_title ) ) {
	$button_attr[] = 'title="'. esc_attr( $a_title ) .'"';
}

$button_attr[] = 'class="btn btn-size-simple btn-type-solid-rect btn-color-white"';

?>

<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">

	<div class="image-wrap">
		<?php echo octagon_get_cropped_image( $image, $width, $height, false ); ?>
	</div>
	
	<div class="image-box-content">
		<?php echo '<'. esc_html( $title_tag ) .' class="title"><a '. implode( ' ', $button_attr ) .'>'. esc_html( $title ) .'<span class="oct-basic-plus-light"></span></a></'. esc_html( $title_tag ) .'>'; ?>
	</div>	

</div> <!-- .image-box -->