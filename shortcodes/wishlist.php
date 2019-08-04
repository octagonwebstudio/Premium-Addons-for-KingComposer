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

wp_enqueue_style( 'octagon-kc-element-wishlist' );

$wrapper_class[] = 'wishlist-table table-wrapper';
$wrapper_class[] = $ex_class;

$wrapper_class   = array_filter( $wrapper_class );

$wishlist_ids = octagon_get_cookie( 'octagon-wishlist' );
$wishlist_ids = ! empty( $wishlist_ids ) ? explode( ',', $wishlist_ids ) : array();

$shop_url             = get_permalink( wc_get_page_id( 'shop' ) );
$attribute_taxonomies = wc_get_attribute_taxonomies();

?>

<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">
	
	<?php
	if( ! empty( $wishlist_ids ) ) :

		$args = array(
			'post_type' => 'product',
			'post__in' => $wishlist_ids
		);

		$q = new WP_Query( $args );
		$count = $q->post_count;

		if( $q->have_posts() ):
			?>

			<div class="table-header">
				<h2 class="table-header-title title"><?php echo esc_html( $title ); ?></h2>
				<span class="title"><?php echo sprintf( __( '(<span class="count">%s</span> items)', 'octagon-kc-elements' ), esc_html( $count ) ); ?></span>
			</div> <!-- .table-header -->
			
			<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
				<div class="table">

					<?php
					while( $q->have_posts() ):
						$q->the_post();

						global $product;

						$id = $product->get_id();

						$title = get_the_title();
						$permalink = get_permalink();
						$thumbnail = octagon_get_cropped_image( '', 120, 120 );

						$stock_status = $product->get_stock_status();
						if( 'instock' == $stock_status ) {
							$stock_status_label = esc_html__( 'In Stock', 'octagon-kc-elements' );
						}
						elseif( 'onbackorder' == $stock_status ) {
							$stock_status_label = esc_html__( 'Backorder', 'octagon-kc-elements' );
						}
						else {
							$stock_status_label = esc_html__( 'Out of Stock', 'octagon-kc-elements' );
						}
						
						?>

						<div class="table-content">
							<div class="product-remove">
								<a href="#" class="remove-wishlist"  data-id="<?php echo esc_attr( $id ); ?>"><div class="loader"><div></div></div>×</a>
							</div>
							<div class="product-thumb">
								<a href="<?php echo esc_url( $permalink ); ?>"><?php echo wp_kses( $thumbnail, array( 'img' => array( 'src' => array(), 'alt' => array() ) ) ); ?></a>
							</div>
							<div class="product-name">
								<p class="title"><a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a></p>
								<?php echo sprintf( __( '<span class="sku">ID: %s</span>', 'octagon-kc-elements' ), esc_html( $product->get_sku() ) ); ?>
							</div>
							<div class="product-price">
								<p class="price"><?php echo wp_kses( $product->get_price_html(), array( 'del' => array(), 'ins' => array(), 'span' => array( 'class' => array() ) ) ); ?></p>
							</div>
							<div class="product-status <?php echo esc_attr( $stock_status ); ?>"><p><?php echo esc_html( $stock_status_label ); ?></p></div>

							<div class="product-buttons">
								<?php
								$add_to_cart_btn_class       = array( 'btn' );
								$add_to_cart_btn_class[]     = 'btn-size-mini';
								$add_to_cart_btn_class[]     = $add_to_cart_btn_type;
								$add_to_cart_btn_class[]     = $add_to_cart_btn_color;
								
								echo sprintf( '<a href="%s" class="%s" data-view-cart="%s">%s%s</a>',
									esc_url( $product->add_to_cart_url() ),
									esc_attr( implode( ' ', $add_to_cart_btn_class ) ),
									esc_attr__( 'View Cart', 'octagon-kc-elements' ),
									$product->supports( 'ajax_add_to_cart' ) ? '<div class="loader"><div></div></div>' : '',
									esc_html( $product->add_to_cart_text() )
								);
								?>
							</div>						
							
						</div> <!-- .table-content -->

					<?php
					endwhile;
					wp_reset_postdata();
					?>

				</div> <!-- .table -->
			</form>

			<a href="<?php echo esc_url( $shop_url ); ?>" class="back-to-shop"><span class="oct-basic-long-arrow-left"></span><?php echo esc_html( $back_to_shop_text ); ?></a>

			<?php
		endif;

	else:
		?>
		<div class="woocommerce-info">
			<?php esc_html_e( 'Wishlist items not found!', 'octagon-kc-elements' ) ?>
			<a class="button" href="<?php echo esc_url( $shop_url ); ?>"><?php esc_html_e( 'Go shop', 'octagon-kc-elements' ) ?></a>
		</div>
		<?php
	endif;

	?>

</div> <!-- .wishlist-table -->