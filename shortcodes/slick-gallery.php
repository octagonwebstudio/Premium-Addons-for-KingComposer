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

wp_enqueue_style( 'octagon-kc-element-slick-gallery' );
wp_enqueue_style( 'slick' );
wp_enqueue_script( 'slick' );

$wrapper_class[] = 'slick-gallery';
$wrapper_class[] = $ex_class;

$wrapper_class = array_filter( $wrapper_class );

?>

<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">

	<?php
	$slide_data[] = isset( $accessibility ) ? 'data-accessibility='. esc_attr( $accessibility ) : '';
	$slide_data[] = isset( $adaptive_height ) ? 'data-adaptive-height='. esc_attr( $adaptive_height ) : '';
	$slide_data[] = isset( $autoplay ) ? 'data-autoplay='. esc_attr( $autoplay ) : '';
	$slide_data[] = isset( $autoplay_speed ) ? 'data-autoplay-speed='. esc_attr( $autoplay_speed ) : '';
	$slide_data[] = isset( $arrows ) ? 'data-arrows='. esc_attr( $arrows ) : '';
	$slide_data[] = isset( $center_mode ) ? 'data-center-mode='. esc_attr( $center_mode ) : '';
	$slide_data[] = isset( $center_padding ) ? 'data-center-padding='. esc_attr( $center_padding ) : '';
	$slide_data[] = isset( $dots ) ? 'data-dots='. esc_attr( $dots ) : '';
	$slide_data[] = isset( $draggable ) ? 'data-draggable='. esc_attr( $draggable ) : '';
	$slide_data[] = isset( $fade ) ? 'data-fade='. esc_attr( $fade ) : '';
	$slide_data[] = isset( $easing ) ? 'data-easing='. esc_attr( $easing ) : '';
	$slide_data[] = isset( $infinite ) ? 'data-infinite='. esc_attr( $infinite ) : '';
	$slide_data[] = isset( $initial_slide ) ? 'data-initial-slide='. esc_attr( $initial_slide ) : '';
	$slide_data[] = isset( $pause_on_hover ) ? 'data-pause-on-hover='. esc_attr( $pause_on_hover ) : '';
	$slide_data[] = isset( $slides_per_row ) ? 'data-slides-per-row='. esc_attr( $slides_per_row ) : '';
	$slide_data[] = isset( $slides_to_show ) ? 'data-slides-to-show='. esc_attr( $slides_to_show ) : '';
	$slide_data[] = isset( $slides_to_scroll ) ? 'data-slides-to-scroll='. esc_attr( $slides_to_scroll ) : '';
	$slide_data[] = isset( $speed ) ? 'data-speed='. esc_attr( $speed ) : '';
	$slide_data[] = isset( $swipe ) ? 'data-swipe='. esc_attr( $swipe ) : '';
	$slide_data[] = isset( $touch_move ) ? 'data-touch-move='. esc_attr( $touch_move ) : '';
	$slide_data[] = isset( $rtl ) ? 'data-rtl='. esc_attr( $rtl ) : '';

	$slide_data = array_filter( $slide_data );

	$images = ! empty( $images ) ? explode( ',', $images ) : array();

	if( ! empty( $images ) ) :
		?>

		<div class="image-gallery-slide slick-slider" <?php echo esc_attr( implode( ' ', $slide_data ) ); ?>>
			
			<?php
			foreach( $images as $key => $attachment_id ) :
				?>
				<div>
					<?php echo octagon_get_cropped_image( $attachment_id, 'full', 'full', false ); ?>
				</div>
				<?php
			endforeach;
			?>
		</div> <!-- .image-gallery-slide -->

	<?php endif; ?>

</div> <!-- .slick-gallery -->