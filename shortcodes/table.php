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

wp_enqueue_style( 'octagon-kc-element-table' );

$wrapper_class[] = 'table';
$wrapper_class[] = $style;
$wrapper_class[] = $alignment;
$wrapper_class[] = $ex_class;

$wrapper_class   = array_filter( $wrapper_class );

?>

<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">

	<table>
		<?php

		if( isset( $td ) && ! empty( $td ) ) :

			$i = 1;

			$count = count( $td );

			foreach( $td as $key => $data ) :

				$end = ( (int)$columns == $i ) ? true : false;

				$tag = isset( $data->tag ) && ( null != $data->tag ) ? $data->tag : 'td';
				$td_value = isset( $data->value ) && ( null != $data->value ) ? $data->value : '';
				$class = isset( $data->force_align ) && ( 'default' != $data->force_align ) ? 'class="'. esc_attr( $data->force_align ) .'"' : '';

				if( ! empty( $td_value ) ) :

					if( 1 == $i ) :
						echo '<tr>';
					endif;

					echo sprintf( '<%1$s %3$s>%2$s</%1$s>', esc_html( $tag ), esc_html( $td_value ), $class );

				endif;

				if( $end || $count == $key ) :
					$i = 0;					
					echo '</tr>';
				endif;

			$i++; endforeach;

		endif;
		?>
	</table>

</div> <!-- .table -->