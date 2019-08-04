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

wp_enqueue_style( 'octagon-kc-element-video-popup' );
wp_enqueue_style( 'magnific-popup' );
wp_enqueue_script( 'magnific-popup' );

$wrapper_class[] = 'video-popup';
$wrapper_class[] = $ex_class;

$wrapper_class   = array_filter( $wrapper_class );

?>

<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">
	
	<?php
	if( ! empty( $video_link ) ) :
		if( 'text' == $trigger ) {
			$trigger_html = $trigger_text;
		}
		elseif( 'image' == $trigger ) {
			$trigger_html = octagon_get_cropped_image( $trigger_image, 'full', 'full', false );
		}
		else {
			$trigger_html = '<span class="'. esc_attr( $trigger_icon ) .'"></span>';
		}
		?>
		<a class="magnify-video <?php echo esc_attr( $trigger ); ?>" href="<?php echo esc_url( $video_link ); ?>"><?php echo wp_kses( $trigger_html, array( 'img' => array( 'src' => array(), 'alt' => array() ), 'span' => array( 'class' => array() ) ) ); ?></a>	
		<?php
	endif;
	?>
	
</div> <!-- .video-popup -->