<?php
/**
 *
 * @package Octagon KC Elements
 * @author Octagon
 * @version 1.0
 * @since 1.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
	
if( ! class_exists( 'Octagon_Core_Custom_Sidebar' ) ) {

	class Octagon_Core_Custom_Sidebar {

		public function __construct() {

			add_action( 'widgets_init', array( $this, 'register_custom_sidebar' ) );

			add_action( 'wp_ajax_add_custom_sidebar',  array( $this, 'add_custom_sidebar' ) );
			add_action( 'wp_ajax_nopriv_add_custom_sidebar', array( $this, 'add_custom_sidebar' ) );

			add_action( 'wp_ajax_remove_custom_sidebar',  array( $this, 'remove_custom_sidebar' ) );
			add_action( 'wp_ajax_nopriv_remove_custom_sidebar', array( $this, 'remove_custom_sidebar' ) );
			
		}

		/**
		 * Register custom sidebar
		 * 
		 * @since  1.1
		 * @return mixed
		 */
		public function register_custom_sidebar() {

			$custom_sidebar_lists = apply_filters( 'octagon_custom_sidebar_lists', get_option( 'octagon_custom_sidebar', array() ) );

			if( ! empty( $custom_sidebar_lists ) ) {

				foreach( $custom_sidebar_lists as $key => $sidebar ) {

					$args = apply_filters( 'octagon_custom_sidebar_args', array(
						'name'          => esc_html( $sidebar ),
						'id'            => $key,
						'description'   => esc_html__( 'Add widgets here.', 'octagon-kc-elements' ),
						'before_widget' => '<section id="%1$s" class="widget %2$s">',
						'after_widget'  => '</section>',
						'before_title'  => '<h2 class="widget-title">',
						'after_title'   => '</h2>'
					), $key, $sidebar );

					register_sidebar( $args );
				}

			}
		}

		/**
		 * Add custom widget area AJAX call
		 * 
		 * @since  1.1
		 * @return mixed
		 */
		public function add_custom_sidebar() {

			$sidebar_name = isset( $_POST['sidebar_name'] ) ? sanitize_text_field( $_POST['sidebar_name'] ) : '';

			$custom_sidebar_lists = get_option( 'octagon_custom_sidebar', array() );
			$sidebar_id = octagon_trim( $sidebar_name );

			if( ! empty( $sidebar_id ) ) {
				$custom_sidebar_lists[$sidebar_id] = esc_html( trim( ucwords( $sidebar_name ) ) );
			}

			update_option( 'octagon_custom_sidebar', $custom_sidebar_lists );

			$this->print_sidebar_list();			

			die();
		}

		/**
		 * Remove registered custom widget area AJAX call
		 * 
		 * @since  1.1
		 * @return mixed
		 */
		public function remove_custom_sidebar() {

			$sidebar_id = isset( $_POST['sidebar_id'] ) ? sanitize_text_field( $_POST['sidebar_id'] ) : '';

			$custom_sidebar_lists = get_option( 'octagon_custom_sidebar', array() );

			if( ! empty( $sidebar_id ) ) {
				unset( $custom_sidebar_lists[$sidebar_id] );
			}

			update_option( 'octagon_custom_sidebar', $custom_sidebar_lists );

			$this->print_sidebar_list();			

			die();
		}

		/**
		 * Custom widget area list
		 * 
		 * @since  1.1
		 * @return mixed
		 */
		public function print_sidebar_list() {

			$custom_sidebar_lists = get_option( 'octagon_custom_sidebar', array() ); ?>

			<div class="sidebar-lists"> 
				
				<?php if( ! empty( $custom_sidebar_lists ) ) : ?>

					<ul>
						<?php foreach( $custom_sidebar_lists as $key => $sidebar ) : ?>

							<li data-id="<?php echo esc_attr( $key ); ?>">
								<span class="sidebar-name"><?php echo esc_html( $sidebar ); ?></span>
								<span class="remove_custom_sidebar btn-red" data-sidebar-id="<?php echo esc_attr( $key ); ?>">
									<div class="loader"><div></div></div>
									<?php esc_html_e( 'Remove', 'octagon-kc-elements' ); ?>
								</span>
							</li>
						
						<?php endforeach; ?>

					</ul>

				<?php else: ?>
					<ul>
						<li><?php esc_html_e( 'No custom sidebar are available.', 'octagon-kc-elements' ); ?></li>
					</ul>
				<?php endif; ?>

			</div> <!-- .sidebar-lists -->

			<?php
			die();
		}

	}

	new Octagon_Core_Custom_Sidebar;

}