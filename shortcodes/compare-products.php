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

wp_enqueue_style( 'octagon-kc-element-compare-product' );
wp_enqueue_style( 'slick' );
wp_enqueue_script( 'slick' );

$wrapper_class[] = 'compare-products-table table-wrapper';
$wrapper_class[] = $ex_class;

$wrapper_class   = array_filter( $wrapper_class );

$compare_products_ids = octagon_get_cookie( 'octagon-compare-products' );
$compare_products_ids = ! empty( $compare_products_ids ) ? explode( ',', $compare_products_ids ) : array();

$shop_url             = get_permalink( wc_get_page_id( 'shop' ) );
$attribute_taxonomies = wc_get_attribute_taxonomies();

$count       = count( $compare_products_ids );
$slide_count = ( 3 >= $count ) ? $count : 3;

$slide_data[] = 'data-infinite=false';
$slide_data[] = 'data-slides-to-show='. esc_attr( $slide_count );

$responsive = array(
	array(
		'breakpoint' => 1200,
		'settings' => array(
			'slidesToShow' => 2
		)
	),
	array(
		'breakpoint' => 991,
		'settings' => array(
			'slidesToShow' => 1
		)
	),
	array(
		'breakpoint' => 640,
		'settings' => 'unslick'
	)
);

$slide_data[] = 'data-responsive='. json_encode( $responsive );

?>

<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">

	<?php
	if( ! empty( $compare_products_ids ) ) :

		$args = array(
			'post_type' => 'product',
			'post__in' => $compare_products_ids
		);

		$q = new WP_Query( $args );
		$count = $q->post_count;

		if( $q->have_posts() ):
			?>

			<div class="table-header">
				<h2 class="table-header-title title"><?php echo esc_html( $title ); ?></h2>
				<span class="title"><?php echo sprintf( __( '(<span class="count">%s</span> items)', 'octagon' ), esc_html( $count ) ); ?></span>
			</div> <!-- .table-header -->
			
			<div class="table">
				<div class="table-head">
					<div class="product-name"><p><?php esc_html_e( 'Product', 'octagon-core' ); ?></p></div>
					<div class="product-price"><p><?php esc_html_e( 'Price', 'octagon-core' ); ?></p></div>
					<div class="product-status"><p><?php esc_html_e( 'Status', 'octagon-core' ); ?></p></div>
					<div class="product-dimensions"><p><?php esc_html_e( 'Dimensions(LXBXH)', 'octagon-core' ); ?></p></div>
					<?php
					if( isset( $attribute_taxonomies ) && ! empty( $attribute_taxonomies ) ) :

						foreach( $attribute_taxonomies as $key => $taxonomy ) :
						?>
							<div><p><?php echo esc_html( $taxonomy->attribute_name ); ?></p></div>
						<?php
						endforeach;

					endif;
					?>
					<div>
						
					</div>
				</div> <!-- .table-head -->
				<div class="table-content-wrap compare-product-slide slick-slider" data-count="<?php echo esc_attr( $count ); ?>" <?php echo esc_attr( implode( ' ', $slide_data ) ); ?>>
				<?php
				while( $q->have_posts() ):
					$q->the_post();

					global $product;

					$id = $product->get_id();

					$title = get_the_title();
					$permalink = get_permalink();
					$thumbnail = octagon_get_cropped_image( '', 150, 150 );

					$stock_status = $product->get_stock_status();
					if( 'instock' == $stock_status ) {
						$stock_status_label = esc_html__( 'In Stock', 'octagon-core' );
					}
					elseif( 'onbackorder' == $stock_status ) {
						$stock_status_label = esc_html__( 'Backorder', 'octagon-core' );
					}
					else {
						$stock_status_label = esc_html__( 'Out of Stock', 'octagon-core' );
					}
					
					?>

					<div class="table-content">
						<div class="product-name">
							<p class="title">
								<a href="<?php echo esc_url( $permalink ); ?>"><?php echo $thumbnail; ?></a>
								<a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
								<?php echo sprintf( __( '<span class="sku sub-title">ID: %s</span>', 'octagon' ), esc_html( $product->get_sku() ) ); ?>
							</p>
						</div>
						<div class="product-price"><p><?php echo wp_kses( $product->get_price_html(), array( 'del' => array(), 'ins' => array(), 'span' => array( 'class' => array() ) ) ); ?></p></div>
						<div class="product-status <?php echo esc_attr( $stock_status ); ?>"><p><?php echo esc_html( $stock_status_label ); ?></p></div>
						<div class="product-dimensions"><p><?php echo esc_html( wc_format_dimensions( $product->get_dimensions( false ) ) ); ?></p></div>
						<?php
						if( isset( $attribute_taxonomies ) && ! empty( $attribute_taxonomies ) ) :

							foreach( $attribute_taxonomies as $key => $taxonomy ) :
								$value = ! empty( $product->get_attribute( $taxonomy->attribute_name ) ) ? $product->get_attribute( $taxonomy->attribute_name ) : '-';
							?>
								<div><p><?php echo esc_html( $value ); ?></p></div>
							<?php
							endforeach;

						endif;
						?>
						
						<div class="product-remove">
							<a href="#" class="remove-compare-list" data-id="<?php echo esc_attr( $id ); ?>">
								<div class="loader"><div></div></div>
								×
							</a>
						</div>						

					</div> <!-- .table-content -->

				<?php
				endwhile;
				wp_reset_postdata();
				?>
				</div>

			</div> <!-- .table -->

			<a href="<?php echo esc_url( $shop_url ); ?>" class="back-to-shop"><span class="oct-basic-long-arrow-left"></span><?php echo esc_html( $back_to_shop_text ); ?></a>

			<?php

		endif;

	else:
		?>
		<div class="woocommerce-info">
			<?php esc_html_e( 'Compare product items not found!', 'octagon-core' ) ?>
			<a class="button" href="<?php echo esc_url( $shop_url ); ?>"><?php esc_html_e( 'Go shop', 'octagon-core' ) ?></a>
		</div>
		<?php
	endif;

	?>

</div> <!-- .compare-products-table -->