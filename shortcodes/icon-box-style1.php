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

wp_enqueue_style( 'octagon-kc-element-icon-box' );

$wrapper_class[] = 'icon-box';
$wrapper_class[] = $style;
$wrapper_class[] = 'icon-box-'. $alignment;
$wrapper_class[] = 'type-'. $type;
$wrapper_class[] = $ex_class;

$wrapper_class   = array_filter( $wrapper_class );

$btn_wrapper_class[] = 'advance-btn';
$btn_wrapper_class[] = $btn_ex_class;

$btn_wrapper_class   = array_filter( $btn_wrapper_class );

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
	
	<?php if( ( 'icon' == $type && ! empty( $icon ) ) || ( 'image' == $type && ! empty( $image ) )  || ( 'svg' == $type && ! empty( $svg ) ) ) : ?>
		<div class="icon-wrap">
			<?php if( 'icon' == $type ) : ?>
				<span class="<?php echo esc_attr( $icon ); ?>"></span>
				<?php 
			elseif( 'image' == $type ) : 
				echo octagon_get_cropped_image( $image );
			elseif( 'svg' == $type ) : 
				echo octagon_get_cropped_image( $svg );
			endif; ?>
		</div> <!-- .icon-wrap -->
	<?php endif; ?>

	<div class="content">
		<?php
		echo '<'. esc_html( $title_tag ) .' class="icon-box-title">'. esc_html( $title ) .'</'. esc_html( $title_tag ) .'>';
		if( ! empty( $desc ) ) :
		?>
			<p class="description"><?php echo esc_html( $desc ); ?></p>
		<?php endif; ?>
	</div> <!-- .content -->
	
	<?php
	if( 'show' == $show_btn ) :
	?>
		<div class="<?php echo esc_attr( implode( ' ', $btn_wrapper_class ) ); ?>">

			<a <?php echo implode( ' ', $button_attr ); ?>>
				<?php
				if( 'yes' == $show_icon ) {
					if( 'left' == $icon_position ) {
						echo '<span class="'. esc_attr( $btn_icon ).'"></span> '. esc_html( $text_title ) ;
					}
					else {
						echo esc_html( $text_title ) .'<span class="'. esc_attr( $btn_icon ) .'"></span>';
					}
				}
				else {
					echo esc_html( $text_title );
				}
				?>
			</a>

		</div> <!-- .advance-btn -->
	<?php
	endif;
	?>

</div> <!-- .icon-box -->