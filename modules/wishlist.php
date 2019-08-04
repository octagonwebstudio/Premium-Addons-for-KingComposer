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

if( ! class_exists( 'octagon_kc_elements_wishlist_module' ) ) {

	class octagon_kc_elements_wishlist_module {

		public function __construct(){
			add_action( 'init', array( $this, 'map' ) );
			add_shortcode( 'octagon_kc_elements_wishlist', array( $this, 'content' ) );
		}
		
		/**
		 * KingComposer page builder shortcode map
		 * 
		 * @since  1.0
		 * @return mixed
		 */
		public function map() {
			kc_add_map(
				array(
					'octagon_kc_elements_wishlist' => array(
						'name' => esc_html_x( 'Wishlist', 'shortcode-map', 'octagon-kc-elements' ),
						'icon' => 'icon-wishlist',
						'category' => esc_html_x( 'Octagon', 'shortcode-map', 'octagon-kc-elements' ),
						'params' => array(
							esc_html_x( 'General', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'name'        => 'title',
									'label'       => esc_html_x( 'Title', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'value'       => esc_html__( 'My Wishlist', 'octagon-kc-elements' ),
									'description' => esc_html_x( 'Enter the title', 'shortcode-map', 'octagon-kc-elements' )
								),

								array(
									'name'        => 'title_tag',
									'label'       => esc_html_x( 'Title Tag', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Choose the title tag.', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'h3',
									'options'     => array(
										'h1' => 'H1',
										'h2' => 'H2',
										'h3' => 'H3',
										'h4' => 'H4',
										'h5' => 'H5',
										'h6' => 'H6',
										'p'  => 'p'
									)
								),

								array(
									'name'        => 'back_to_shop',
									'label'       => esc_html_x( 'Back to Shop Link', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'select',
									'description' => esc_html_x( 'Show back to shop link?', 'shortcode-map', 'octagon-kc-elements' ),
									'value'       => 'show',
									'options'     => array(
										'show' => esc_html_x( 'Show', 'shortcode-map', 'octagon-kc-elements' ),
										'hide' => esc_html_x( 'Hide', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'back_to_shop_text',
									'label'       => esc_html_x( 'Back to Shop Link Text', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'value'       => esc_html__( 'Continue Shopping', 'octagon-kc-elements' ),
									'description' => esc_html_x( 'Enter the back to shop link text', 'shortcode-map', 'octagon-kc-elements' )
								),

								array(
									'name'        => 'ex_class',
									'label'       => esc_html_x( 'Extra Class', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'value'       => '',
									'description' => esc_html_x( 'Enter the extra class', 'shortcode-map', 'octagon-kc-elements' )
								)

							),

							esc_html_x( 'Add to Cart Button', 'shortcode-map', 'octagon-kc-elements' ) => array(

								array(
									'name'        => 'add_to_cart_btn_text',
									'label'       => esc_html_x( 'Add to Cart Button Text', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'value'       => esc_html__( 'Add to Cart', 'octagon-kc-elements' ),
									'description' => esc_html_x( 'Enter the add to cart button text', 'shortcode-map', 'octagon-kc-elements' )
								),

								array(
									'name'        => 'add_to_cart_btn_type',
									'label'       => esc_html_x( 'Button Type', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'value'       => 'btn-type-solid-rect',
									'options'     => array(
										'btn-type-solid-rect'      => esc_html_x( 'Solid Rectangle', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-solid-round'     => esc_html_x( 'Solid Round', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-solid-ellipse'   => esc_html_x( 'Solid Ellipse', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-outline-rect'    => esc_html_x( 'Outline Rectangle', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-outline-round'   => esc_html_x( 'Outline Round', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-outline-ellipse' => esc_html_x( 'Outline Ellipse', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-no-bg'           => esc_html_x( 'No Background', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-simple'          => esc_html_x( 'Simple', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-line-tr'         => esc_html_x( 'Line Top Right', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-line-tl'         => esc_html_x( 'Line Top Left', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-line-br'         => esc_html_x( 'Line Bottom Right', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-line-bl'         => esc_html_x( 'Line Bottom Left', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'add_to_cart_btn_color',
									'label'       => esc_html_x( 'Button Type', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'value'       => 'btn-color-gradient',
									'options'     => array(
										'btn-color-black'    => esc_html_x( 'Black', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-color-white'    => esc_html_x( 'White', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-color-base'     => esc_html_x( 'Base', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-color-gradient' => esc_html_x( 'Gradient', 'shortcode-map', 'octagon-kc-elements' )
									)
								)

							),

							esc_html_x( 'Remove Wishlist Button', 'shortcode-map', 'octagon-kc-elements' ) => array(								

								array(
									'name'        => 'remove_wishlist_btn_text',
									'label'       => esc_html_x( 'Remove Wishlist Button Text', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'text',
									'value'       => esc_html__( 'Remove', 'octagon-kc-elements' ),
									'description' => esc_html_x( 'Enter the remove wishlist button text', 'shortcode-map', 'octagon-kc-elements' )
								),

								array(
									'name'        => 'remove_wishlist_btn_type',
									'label'       => esc_html_x( 'Button Type', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'value'       => 'btn-type-solid-rect',
									'options'     => array(
										'btn-type-solid-rect'      => esc_html_x( 'Solid Rectangle', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-solid-round'     => esc_html_x( 'Solid Round', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-solid-ellipse'   => esc_html_x( 'Solid Ellipse', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-outline-rect'    => esc_html_x( 'Outline Rectangle', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-outline-round'   => esc_html_x( 'Outline Round', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-outline-ellipse' => esc_html_x( 'Outline Ellipse', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-no-bg'           => esc_html_x( 'No Background', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-simple'          => esc_html_x( 'Simple', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-line-tr'         => esc_html_x( 'Line Top Right', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-line-tl'         => esc_html_x( 'Line Top Left', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-line-br'         => esc_html_x( 'Line Bottom Right', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-type-line-bl'         => esc_html_x( 'Line Bottom Left', 'shortcode-map', 'octagon-kc-elements' )
									)
								),

								array(
									'name'        => 'remove_wishlist_btn_color',
									'label'       => esc_html_x( 'Button Type', 'shortcode-map', 'octagon-kc-elements' ),
									'type'        => 'dropdown',
									'value'       => 'btn-color-black',
									'options'     => array(
										'btn-color-black'    => esc_html_x( 'Black', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-color-white'    => esc_html_x( 'White', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-color-base'     => esc_html_x( 'Base', 'shortcode-map', 'octagon-kc-elements' ),
										'btn-color-gradient' => esc_html_x( 'Gradient', 'shortcode-map', 'octagon-kc-elements' )
									)
								)

							),
							
							esc_html_x( 'Styling', 'shortcode-map', 'octagon-kc-elements' ) => array(
								array(
									'type'    => 'css',
									'label'   => esc_html_x( 'CSS', 'shortcode-map', 'octagon-kc-elements' ),
									'name'    => 'custom_css',
									'options' => array(
										array(
											'screens' => octagon_kc_elements_responsive_breakpoints(),
											esc_html_x( 'Title', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .title' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .title' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .title' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .title' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .title' ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .title' )
											),
											esc_html_x( 'Back to Shop', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .back-to-shop, .wishlist-table .back-to-shop span' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .back-to-shop, .wishlist-table .back-to-shop span' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .back-to-shop, .wishlist-table .back-to-shop span' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .back-to-shop, .wishlist-table .back-to-shop span' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .back-to-shop, .wishlist-table .back-to-shop span' ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .back-to-shop, .wishlist-table .back-to-shop span' )
											),
											esc_html_x( 'Product Title', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .table .table-content .product-name .sub-title a' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .table .table-content .product-name .sub-title a' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .table .table-content .product-name .sub-title a' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .table .table-content .product-name .sub-title a' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .table .table-content .product-name .sub-title a' ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .table .table-content .product-name .sub-title a' )
											),
											esc_html_x( 'Price', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .price, .wishlist-table .woocommerce-Price-amount, .wishlist-table .woocommerce-Price-currencySymbol' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .price, .wishlist-table .woocommerce-Price-amount, .wishlist-table .woocommerce-Price-currencySymbol' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .price, .wishlist-table .woocommerce-Price-amount, .wishlist-table .woocommerce-Price-currencySymbol' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .price, .wishlist-table .woocommerce-Price-amount, .wishlist-table .woocommerce-Price-currencySymbol' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .price, .wishlist-table .woocommerce-Price-amount, .wishlist-table .woocommerce-Price-currencySymbol' ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .price, .wishlist-table .woocommerce-Price-amount, .wishlist-table .woocommerce-Price-currencySymbol' )
											),

											esc_html_x( 'Date', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .table .table-content p' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .table .table-content p' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .table .table-content p' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .table .table-content p' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .table .table-content p' ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.wishlist-table .table .table-content p' )
											),
											esc_html_x( 'Add to Cart Button Style', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.product-buttons button' ),
												array( 'property' => 'background-color', 'label' => esc_html_x( 'Background Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.product-buttons button' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.product-buttons button' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.product-buttons button' ),
												array( 'property' => 'line-height', 'label' => esc_html_x( 'Line Height', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.product-buttons button' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.product-buttons button' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.product-buttons button' ),
												array( 'property' => 'text-align', 'label' => esc_html_x( 'Align', 'shortcode-map', 'octagon-kc-elements' ) ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.product-buttons button' ),
												array( 'property' => 'text-shadow', 'label' => esc_html_x( 'Text Shadow', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.product-buttons button' ),
												array( 'property' => 'width', 'selector' => '.product-buttons button' ),
												array( 'property' => 'height', 'selector' => '.product-buttons button' ),
												array( 'property' => 'display', 'label' => esc_html_x( 'Display', 'shortcode-map', 'octagon-kc-elements' ) ),
												array( 'property' => 'border', 'label' => esc_html_x( 'Border', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.product-buttons button' ),
												array( 'property' => 'border-radius', 'label' => esc_html_x( 'Border Radius', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.product-buttons button' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Padding', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.product-buttons button' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.product-buttons button' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Icon Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.product-buttons button span' )
											),
											esc_html_x( 'Add to Cart Button Mouse Hover', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.product-buttons button:hover' ),
												array( 'property' => 'background-color', 'label' => esc_html_x( 'Background Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.product-buttons button:hover' ),
												array( 'property' => 'border', 'label' => esc_html_x( 'Border', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.product-buttons button:hover' )
											),
											esc_html_x( 'Remove Wishlist Button Style', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.remove-wishlist.btn' ),
												array( 'property' => 'background-color', 'label' => esc_html_x( 'Background Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.remove-wishlist.btn' ),
												array( 'property' => 'font-family', 'label' => esc_html_x( 'Font Family', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.remove-wishlist.btn' ),
												array( 'property' => 'font-size', 'label' => esc_html_x( 'Text Size', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.remove-wishlist.btn' ),
												array( 'property' => 'line-height', 'label' => esc_html_x( 'Line Height', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.remove-wishlist.btn' ),
												array( 'property' => 'font-weight', 'label' => esc_html_x( 'Font Weight', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.remove-wishlist.btn' ),
												array( 'property' => 'text-transform', 'label' => esc_html_x( 'Text Transform', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.remove-wishlist.btn' ),
												array( 'property' => 'text-align', 'label' => esc_html_x( 'Align', 'shortcode-map', 'octagon-kc-elements' ) ),
												array( 'property' => 'letter-spacing', 'label' => esc_html_x( 'Letter Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.remove-wishlist.btn' ),
												array( 'property' => 'text-shadow', 'label' => esc_html_x( 'Text Shadow', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.remove-wishlist.btn' ),
												array( 'property' => 'width', 'selector' => '.remove-wishlist.btn' ),
												array( 'property' => 'height', 'selector' => '.remove-wishlist.btn' ),
												array( 'property' => 'display', 'label' => esc_html_x( 'Display', 'shortcode-map', 'octagon-kc-elements' ) ),
												array( 'property' => 'border', 'label' => esc_html_x( 'Border', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.remove-wishlist.btn' ),
												array( 'property' => 'border-radius', 'label' => esc_html_x( 'Border Radius', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.remove-wishlist.btn' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Padding', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.remove-wishlist.btn' ),
												array( 'property' => 'margin', 'label' => esc_html_x( 'Margin', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.remove-wishlist.btn' ),
												array( 'property' => 'padding', 'label' => esc_html_x( 'Icon Spacing', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.remove-wishlist.btn span' )
											),
											esc_html_x( 'Remove Wishlist Button Mouse Hover', 'shortcode-map', 'octagon-kc-elements' ) => array(
												array( 'property' => 'color', 'label' => esc_html_x( 'Text Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.remove-wishlist.btn:hover' ),
												array( 'property' => 'background-color', 'label' => esc_html_x( 'Background Color', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.remove-wishlist.btn:hover' ),
												array( 'property' => 'border', 'label' => esc_html_x( 'Border', 'shortcode-map', 'octagon-kc-elements' ), 'selector' => '.remove-wishlist.btn:hover' )
											),
										)
									)
								),
							)

						)
					)

				)

			);

		}

		/**
		 * Output shortcode content
		 * 
		 * @since  1.0
		 * @return mixed
		 */
		public function content( $atts ) {
			extract( shortcode_atts( array(
				'title'                     => esc_html__( 'My Wishlist', 'octagon-kc-elements' ),
				'title_tag'                 => 'h3',
				'back_to_shop'              => 'show',
				'back_to_shop_text'         => esc_html__( 'Continue Shopping', 'octagon-kc-elements' ),
				'ex_class'                  => '',
				'add_to_cart_btn_text'      => esc_html__( 'Add to Cart', 'octagon-kc-elements' ),
				'add_to_cart_btn_type'      => 'btn-type-solid-rect',
				'add_to_cart_btn_color'     => 'btn-color-gradient',
				'remove_wishlist_btn_text'  => esc_html__( 'Remove', 'octagon-kc-elements' ),
				'remove_wishlist_btn_type'  => 'btn-type-solid-rect',
				'remove_wishlist_btn_color' => 'btn-color-black'
			), $atts ) );

			$wrapper_class	= apply_filters( 'kc-el-class', $atts );
			$wrapper_class	= apply_filters( 'octagon-el-class', $wrapper_class );

			$output = '<div class="'. esc_attr( implode( ' ', $wrapper_class ) ) .'">';
				$output .= octagon_kc_elements_get_shortcode_template( 'wishlist', $atts );
			$output .= '</div>';

			return $output;

		}
				
	}
}

new octagon_kc_elements_wishlist_module;