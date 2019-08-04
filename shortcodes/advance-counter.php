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

wp_enqueue_style( 'octagon-kc-element-advance-counter' );
wp_enqueue_script( 'countimator' );

$wrapper_class[] = 'advance-counter';
$wrapper_class[] = $alignment;
$wrapper_class[] = $ex_class;

$wrapper_class   = array_filter( $wrapper_class );

$counter_data[] = isset( $decimals ) ? 'data-decimals='. esc_attr( $decimals ) : '';
$counter_data[] = isset( $decimal_delimiter ) ? 'data-decimal-delimiter='. esc_attr( $decimal_delimiter ) : '';
$counter_data[] = isset( $thousand_delimiter ) ? 'data-thousand-delimiter='. esc_attr( $thousand_delimiter ) : '';

$counter_data = array_filter( $counter_data );

$prefix = ! empty( $prefix ) ? sprintf( '<span>%s</span>', $prefix ) : '';
$suffix = ! empty( $suffix ) ? sprintf( '<span>%s</span>', $suffix ) : '';

$number = ! empty( $number ) ? sprintf( '<span class="number" %s>%s</span>', esc_attr( implode( ' ', $counter_data ) ), esc_html( $number ) ) : '';
?>

<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">
	
	<div class="counter-wrap">
		
		<?php if( 'yes' == $show_icon && ! empty( $icon ) ) : ?>
			<span class="counter-icon <?php echo esc_attr( $icon ); ?>"></span>
		<?php endif; ?>

		<div class="counter-content">
			<div class="counter">
				<?php echo wp_kses( sprintf( '%s %s %s', $prefix, $number, $suffix ), array( 'span' => array( 'class' => array(), 'data-decimals' => array(), 'data-decimal-delimiter' => array(), 'data-thousand-delimiter' => array() ) ) ); ?>
			</div>
			<div class="counter-label"><?php echo esc_html( $label ); ?></div>
		</div>

	</div> <!-- .counter-wrap -->

</div> <!-- .advance-counter -->