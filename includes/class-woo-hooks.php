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
	
if( ! class_exists( 'Octagon_KC_Elements_Woo_Hooks' ) ) {

	class Octagon_KC_Elements_Woo_Hooks {

		public function __construct() {

			/* Compare Products ---------------------------------------------------------- */

			add_action( 'wp_ajax_octagon_add_compare_products_ajax', array( $this, 'add_compare_products_ajax' ) );
			add_action( 'wp_ajax_nopriv_octagon_add_compare_products_ajax', array( $this, 'add_compare_products_ajax' ) );


			/* Remove Compare Products ---------------------------------------------------------- */

			add_action( 'wp_ajax_octagon_remove_compare_products_ajax', array( $this, 'remove_compare_products_ajax' ) );
			add_action( 'wp_ajax_nopriv_octagon_remove_compare_products_ajax', array( $this, 'remove_compare_products_ajax' ) );


			/* Wishlist ------------------------------------------------------------------ */

			add_action( 'wp_ajax_octagon_wishlist_ajax', array( $this, 'wishlist_ajax' ) );
			add_action( 'wp_ajax_nopriv_octagon_wishlist_ajax', array( $this, 'wishlist_ajax' ) );


			/* Remove Wishlist ------------------------------------------------------------ */

			add_action( 'wp_ajax_octagon_remove_wishlist_ajax', array( $this, 'remove_wishlist_ajax' ) );
			add_action( 'wp_ajax_nopriv_octagon_remove_wishlist_ajax', array( $this, 'remove_wishlist_ajax' ) );


			/* Quick View ---------------------------------------------------------------- */

			add_action( 'wp_ajax_octagon_quick_view_ajax', array( $this, 'quick_view_ajax' ) );
			add_action( 'wp_ajax_nopriv_octagon_quick_view_ajax', array( $this, 'quick_view_ajax' ) );
			
		}

		/**
		 * WooCommerce add product into compare product list via AJAX
		 * 
		 * @since  1.0
		 */
		public function add_compare_products_ajax() {

			$id = isset( $_POST['id'] ) ? absint( $_POST['id'] ) : '';

			if( false === get_post_status( $id ) ) {
				die();
			}

			$old_values = octagon_get_cookie( 'octagon-compare-products' );
			$old_values = ! empty( $old_values ) ? explode( ',', trim( $old_values ) ) : array();

			$values = array_filter( array_unique( array_merge( $old_values, array( $id ) ) ) );

			$count = count( $values );

			$values = ! empty( $values ) && is_array( $values ) ? implode( ',', $values ) : '';

			if( ! empty( $values ) ) {
				setcookie( 'octagon-compare-products', $values, strtotime( '+1 week' ), '/' );
			}

			echo json_encode( array( 'count' => $count ) );

			die();

		}

		/**
		 * WooCommerce remove compare product list via AJAX
		 * 
		 * @since  1.0
		 */
		public function remove_compare_products_ajax() {

			$id = isset( $_POST['id'] ) ? absint( $_POST['id'] ) : '';

			if( false === get_post_status( $id ) ) {
				die();
			}

			$old_values = octagon_get_cookie( 'octagon-compare-products' );
			$count = count( $old_values );
			$old_values = ! empty( $old_values ) ? explode( ',', trim( $old_values ) ) : array();

			if( in_array( $id, $old_values ) ) {
				$values = array_diff( $old_values, array( $id ) );
				$count = count( $values );
				$values = ! empty( $values ) && is_array( $values ) ? implode( ',', $values ) : '';				
			}

			setcookie( 'octagon-compare-products', $values, strtotime( '+1 week' ), '/' );
			?>

			<div class="ajax-return" data-count="<?php echo esc_attr( $count ); ?>">
				<?php
				if( ! $count ) {

					$shop_url = get_permalink( wc_get_page_id( 'shop' ) );
					?>
					<div class="woocommerce-info">
						<?php esc_html_e( 'Compare product items not found!', 'octagon-kc-elements' ) ?>
						<a class="button" href="<?php echo esc_url( $shop_url ); ?>"><?php esc_html_e( 'Go shop', 'octagon-kc-elements' ) ?></a>
					</div>
					<?php
				}
				?>
			</div>
			
			<?php

			die();

		}

		/**
		 * WooCommerce add product into wishlist product list via AJAX
		 * 
		 * @since  1.0
		 */
		public function wishlist_ajax() {

			$id = isset( $_POST['id'] ) ? absint( $_POST['id'] ) : '';

			if( false === get_post_status( $id ) ) {
				die();
			}

			$old_values = octagon_get_cookie( 'octagon-wishlist' );
			$old_values = ! empty( $old_values ) ? explode( ',', trim( $old_values ) ) : array();

			if( in_array( $id, $old_values ) ) {
				$values = array_diff( $old_values, array( $id ) );
			}
			else {
				$values = array_filter( array_unique( array_merge( $old_values, array( $id ) ) ) );				
			}

			$count = count( $values );

			$values = ! empty( $values ) && is_array( $values ) ? implode( ',', $values ) : '';			

			setcookie( 'octagon-wishlist', $values, strtotime( '+1 week' ), '/' );

			echo json_encode( array( 'count' => $count ) );

			die();

		}

		/**
		 * WooCommerce remove wishlist product list via AJAX
		 * 
		 * @since  1.0
		 */
		public function remove_wishlist_ajax() {

			$id = isset( $_POST['id'] ) ? absint( $_POST['id'] ) : '';

			if( false === get_post_status( $id ) ) {
				die();
			}

			$old_values = octagon_get_cookie( 'octagon-wishlist' );
			$old_values = ! empty( $old_values ) ? explode( ',', trim( $old_values ) ) : array();

			if( in_array( $id, $old_values ) ) {
				$values = array_diff( $old_values, array( $id ) );
			}
			else {
				$values = array_filter( array_unique( array_merge( $old_values, array( $id ) ) ) );				
			}

			$count = count( $values );

			$values = ! empty( $values ) && is_array( $values ) ? implode( ',', $values ) : '';

			setcookie( 'octagon-wishlist', $values, strtotime( '+1 week' ), '/' );

			?>

			<div class="ajax-return" data-count="<?php echo esc_attr( $count ); ?>">
				<?php
				if( ! $count ) {

					$shop_url = get_permalink( wc_get_page_id( 'shop' ) );
					?>
					<div class="woocommerce-info">
						<?php esc_html_e( 'Wishlist items not found!', 'octagon-kc-elements' ) ?>
						<a class="button" href="<?php echo esc_url( $shop_url ); ?>"><?php esc_html_e( 'Go shop', 'octagon-kc-elements' ) ?></a>
					</div>
					<?php
				}
				?>
			</div>
			
			<?php
			die();

		}

		/**
		 * WooCommerce quick view product details
		 * 
		 * @since  1.0
		 * @return mixed
		 */
		public function quick_view_ajax() {

			$id = isset( $_POST['id'] ) ? absint( $_POST['id'] ) : '';

			if( false === get_post_status( $id ) ) {
				die();
			}
			
			$args = array(
				'post_type' => 'product',
				'p' => $id
			);

			$q = new Wp_Query( $args );

			if ( $q->have_posts() ) :

				while ( $q->have_posts() ) :
					$q->the_post();

					global $product;
					?>

					<div class="product-quick-view">

						<div class="container">
						
							<div class="quick-view-inner">
								
								<div class="product-thumb">
									<?php echo octagon_get_cropped_image( '', 600, 600, false ); ?>
								</div>

								<div class="summary entry-summary">
									<?php
									//get_template_part( 'template/wc-template/single-product-category' );

									woocommerce_template_single_title();

									woocommerce_template_single_price();

									woocommerce_template_single_excerpt();

									woocommerce_template_single_add_to_cart();

									//get_template_part( 'template/wc-template/single-product-meta' );

									?>
								</div>

								<a href="#" class="quick-view-close"><span class="oct-basic-cross"></span></a>
							</div>

						</div>

					</div>					

					<?php
				endwhile;
				wp_reset_postdata();

			endif;

			die();

		}

	}

	new Octagon_KC_Elements_Woo_Hooks;

}