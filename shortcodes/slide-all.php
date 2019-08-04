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

wp_enqueue_style( 'octagon-kc-element-slide-all' );
wp_enqueue_style( 'slick' );
wp_enqueue_script( 'slick' );

$wrapper_class[] = 'slide-all slick-slider';
$wrapper_class[] = $ex_class;

$wrapper_class   = array_filter( $wrapper_class );

$slide_data[] = isset( $accessibility ) ? 'data-accessibility='. esc_attr( $accessibility ) : '';
$slide_data[] = isset( $adaptive_height ) ? 'data-adaptive-height='. esc_attr( $adaptive_height ) : '';
$slide_data[] = isset( $autoplay ) ? 'data-autoplay='. esc_attr( $autoplay ) : '';
$slide_data[] = isset( $autoplay_speed ) ? 'data-autoplay-speed='. esc_attr( $autoplay_speed ) : '';
$slide_data[] = isset( $arrows ) ? 'data-arrows='. esc_attr( $arrows ) : '';
$slide_data[] = isset( $center_mode ) ? 'data-center-mode='. esc_attr( $center_mode ) : '';
$slide_data[] = isset( $center_padding ) ? 'data-center-padding='. esc_attr( $center_padding ) : '';
$slide_data[] = isset( $css_ease ) ? 'data-css-ease='. esc_attr( $css_ease ) : '';
$slide_data[] = isset( $dots ) ? 'data-dots='. esc_attr( $dots ) : '';
$slide_data[] = isset( $draggable ) ? 'data-draggable='. esc_attr( $draggable ) : '';
$slide_data[] = isset( $fade ) ? 'data-fade='. esc_attr( $fade ) : '';
$slide_data[] = isset( $easing ) ? 'data-easing='. esc_attr( $easing ) : '';
$slide_data[] = isset( $edge_friction ) ? 'data-edge-friction='. esc_attr( $edge_friction ) : '';
$slide_data[] = isset( $infinite ) ? 'data-infinite='. esc_attr( $infinite ) : '';
$slide_data[] = isset( $initial_slide ) ? 'data-initial-slide='. esc_attr( $initial_slide ) : '';
$slide_data[] = isset( $lazy_load ) ? 'data-lazy-load='. esc_attr( $lazy_load ) : '';
$slide_data[] = isset( $pause_on_hover ) ? 'data-pause-on-hover='. esc_attr( $pause_on_hover ) : '';
$slide_data[] = isset( $pause_on_dots_hover ) ? 'data-pause-on-dots-hover='. esc_attr( $pause_on_dots_hover ) : '';
$slide_data[] = isset( $rows ) ? 'data-rows='. esc_attr( $rows ) : '';
$slide_data[] = isset( $slides_per_row ) ? 'data-slides-per-row='. esc_attr( $slides_per_row ) : '';
$slide_data[] = isset( $slides_to_show ) ? 'data-slides-to-show='. esc_attr( $slides_to_show ) : '';
$slide_data[] = isset( $slides_to_scroll ) ? 'data-slides-to-scroll='. esc_attr( $slides_to_scroll ) : '';
$slide_data[] = isset( $speed ) ? 'data-speed='. esc_attr( $speed ) : '';
$slide_data[] = isset( $swipe ) ? 'data-swipe='. esc_attr( $swipe ) : '';
$slide_data[] = isset( $touch_move ) ? 'data-touch-move='. esc_attr( $touch_move ) : '';
$slide_data[] = isset( $variable_width ) ? 'data-variable-width='. esc_attr( $variable_width ) : '';
$slide_data[] = isset( $vertical ) ? 'data-vertical='. esc_attr( $vertical ) : '';
$slide_data[] = isset( $vertical_swiping ) ? 'data-vertical-swiping='. esc_attr( $vertical_swiping ) : '';
$slide_data[] = isset( $rtl ) ? 'data-rtl='. esc_attr( $rtl ) : '';

$slide_data = array_filter( $slide_data );
?>

<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>" <?php echo esc_attr( implode( ' ', $slide_data ) ); ?>>

	<?php echo do_shortcode( str_replace( 'octagon_slide_all#', 'octagon_slide_all', $content ) ); ?>

</div> <!-- .slide-all -->