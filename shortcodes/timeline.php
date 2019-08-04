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

wp_enqueue_style( 'octagon-kc-element-timeline' );

$wrapper_class[] = 'timeline';
$wrapper_class[] = $ex_class;

$wrapper_class   = array_filter( $wrapper_class );

?>

<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">
	<?php
	if( isset( $timeline ) && ! empty( $timeline ) ) : ?>
		
		<span class="vertical-line"></span>

		<div class="timeline-set-group">
			<?php
			foreach( $timeline as $key => $set ) :

				$date = ( null != $set->date ) ? $set->date : '';
				$title = ( null != $set->title ) ? $set->title : '';
				$desc = ( null != $set->desc ) ? $set->desc : '';

				?>
				<div class="timeline-set">
					<?php if( ! empty( $desc ) ) :

						if( ! empty( $date ) ) : ?>
							<span class="date"><?php echo esc_html( $date ); ?></span>
							<?php
						endif;

						if( ! empty( $title ) ) : ?>
							<p class="title"><?php echo esc_html( $title ); ?></p>
							<?php
						endif; ?>

						<p class="desc"><?php echo esc_html( $desc ); ?></p>

						<?php
					endif; ?>
				</div> <!-- .timeline-set -->

			<?php endforeach; ?>
		</div> <!-- .timeline-set-group -->
		<?php
	endif;
	?>

</div> <!-- .timeline -->