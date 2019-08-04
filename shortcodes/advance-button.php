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

wp_enqueue_style( 'octagon-kc-element-advance-button' );

$wrapper_class[] = 'advance-btn';
$wrapper_class[] = $ex_class;

$wrapper_class   = array_filter( $wrapper_class );

$link = ( '||' === $link ) ? '' : $link;
$link = kc_parse_link( $link );

if ( strlen( $link['url'] ) > 0 ) {
	$a_href 	= $link['url'];
	$a_title 	= $link['title'];
	$a_target 	= strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
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

if( isset( $onclick ) ) {
	$button_attr[] = 'onclick="'. esc_attr( $onclick  ) .'"';
}

if( isset( $btn_size ) || isset( $btn_type ) || isset( $btn_color ) ) {
	$button_class[] = 'btn';
	$button_class[] = isset( $btn_size ) ? $btn_size : 'btn-size-small';
	$button_class[] = isset( $btn_type ) ? $btn_type : 'btn-type-solid-ellipse';
	$button_class[] = isset( $btn_color ) ? $btn_color : 'btn-color-black';
	$button_class[] = ( 'btn-color-gradient-palette' == $btn_color ) && isset( $gradient_palette ) ? $gradient_palette : '';

	if( 'yes' == $show_icon ) {
		$button_class[] = ( 'left' == $icon_position ) ? 'icon-back' : 'icon-front';
	}

	if( 'yes' == $only_icon ) {
		$button_class[] = 'only-icon';
	}	

	$button_class   = array_filter( $button_class );

	$button_attr[] = 'class="'. esc_attr( implode( ' ', $button_class ) ) .'"';
}

if( 'yes' == $only_icon ) {
	$text_title = '';
}

?>

<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">

	<a <?php echo implode( ' ', $button_attr ); ?>>
		<?php
		if( 'yes' == $show_icon ) {
			if( 'left' == $icon_position ) {
				echo '<span class="'. esc_attr( $icon ).'"></span> '. esc_html( $text_title ) ;
			}
			else {
				echo esc_html( $text_title ) .'<span class="'. esc_attr( $icon ) .'"></span>';
			}
		}
		else {
			echo esc_html( $text_title );
		}
		?>
	</a>

</div> <!-- .advance-btn -->