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

wp_enqueue_style( 'octagon-kc-element-info-icons' );

$wrapper_class[] = 'info-icons';
$wrapper_class[] = 'info-icons-'. $alignment;
$wrapper_class[] = $columns;
$wrapper_class[] = $with_border;
$wrapper_class[] = $ex_class;

$wrapper_class   = array_filter( $wrapper_class );

?>

<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">
	<?php
	if( isset( $icon_set ) && ! empty( $icon_set ) ) :
		foreach( $icon_set as $key => $icon ) :

			$link = ( '||' === $icon->link ) ? '' : $icon->link;
			$link = kc_parse_link( $link );

			if ( strlen( $link['url'] ) > 0 ) {
				$a_href 	= $link['url'];
				$a_title 	= $link['title'];
				$a_target 	= strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
			}

			if( isset( $a_href ) ) {
				$a_attr[] = 'href="'. esc_url( $a_href ) .'"';
			}

			if( isset( $a_target ) ) {
				$a_attr[] = 'target="'. esc_attr( $a_target ) .'"';
			}

			if( isset( $a_title ) ) {
				$a_attr[] = 'title="'. esc_attr( $a_title ) .'"';
			}

			if( isset( $onclick ) ) {
				$a_attr[] = 'onclick="'. esc_attr( $onclick  ) .'"';
			}

			$icon_wrap_class[] = 'icon-wrap';
			$icon_wrap_class[] = 'icon-type-'.$icon->type;
			$icon_wrap_class[] = 'icon-method-'.$icon->method;

			$icon_wrap_class   = array_filter( $icon_wrap_class );

			?>
			<div class="info-icon-group">

				<div class="<?php echo esc_attr( implode( ' ', $icon_wrap_class ) ); ?>">
					<?php
					if( 'icon' == $icon->type ) :
						?>
						<span class="<?php echo esc_attr( $icon->icon ); ?>"></span>
						<?php
					elseif( 'image' == $icon->type ) :
						echo wp_kses( octagon_get_cropped_image( $icon->image, 60, 60 ), array( 'img' => array( 'src' => array(), 'alt' => array() ) ) );
						?>
						<?php
					endif;
					?>
				</div>

				<div class="content">
					<?php
					echo '<'. esc_html( $title_tag ) .' class="info-icon-title sub-title">';
						if( isset( $a_href ) ) :
							?>
							<a <?php echo implode( ' ', $a_attr ); ?>><?php echo esc_html( $icon->title ); ?></a>
							<?php
						else:
							echo esc_html( $icon->title );
						endif;
					echo '</'. esc_html( $title_tag ) .'>';
					?>
				</div>

			</div> <!-- .info-icon-group -->

		<?php
		endforeach;
	endif;
	?>

</div> <!-- .info-icons -->