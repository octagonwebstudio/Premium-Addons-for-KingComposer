<?php
/**
 *
 * @package Octagon Core
 * @author Octagon
 * @version 1.0
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( ! class_exists( 'Octagon_Core_Post_Columns' ) ) {

	class Octagon_Core_Post_Columns {

		public $post_types;

		public function __construct() {						

			add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
			add_action( 'admin_action_feature_post', array( $this, 'feature_post' ) );
			
		}

		/**
		 * Post Columns
		 * 
		 * @since  1.0
		 */
		public function theme_setup() {

			$this->post_types = array_merge( array( 'post' ), apply_filters( 'octagon_core_post_columns', array() ) );

			if( ! empty( $this->post_types ) ) {

				foreach( $this->post_types as $key => $post_type ) {

					add_filter( 'manage_'.$post_type.'_posts_columns',  array( $this, 'add_new_columns' ), 10, 1 );
					add_action( 'manage_'.$post_type.'_posts_custom_column' , array( $this, 'custom_columns' ), 10, 2 );

				}

			}

		}

		/**
		 * Append few post columns
		 * 
		 * @since  1.0
		 * @param  array  $columns Post Columns
		 * @return array
		 */
		public function add_new_columns( $columns ) {

			$new_columns = array(
				'cb'       => '<input type="checkbox" />',
				'thumb'    => '<span class="wp-list-table-icon thumb">'. esc_html__( 'Thumb', 'octagon-kc-elements' ) .'</span>',
				'title'    => esc_html__( 'Title', 'octagon-kc-elements' ),
				'featured' => '<span class="wp-list-table-icon featured">'. esc_html__( 'Featured', 'octagon-kc-elements' ) .'</span>',
			);

			return array_merge( $new_columns, $columns );

		}

		/**
		 * Custom post columns
		 * 
		 * @since  1.0
		 * @param  string 	$column 	Post Column
		 * @param  int  	$post_id 	Post ID
		 * @return mixed
		 */
		public function custom_columns( $column, $post_id ) {

			$post_type = function_exists( 'octagon_get_current_post_type' ) ? octagon_get_current_post_type() : '';

			switch ( $column ) {

				case 'thumb':
					$thumbnail = octagon_get_meta( $post_id, 'thumbnail', '' );
					$thumbnail = ! empty( $thumbnail ) ? $thumbnail : get_post_thumbnail_id();
					echo octagon_get_cropped_image( $thumbnail, 40, 40, true );
				break;

				case 'featured':
					$featured = get_post_meta( $post_id, 'featured_post', true );
					$class = ( '' == $featured || NULL == $featured || 'not-featured' == $featured ) ? 'dashicons-star-empty' : 'dashicons-star-filled';

					echo '<a href="' . wp_nonce_url( admin_url( 'edit.php?post_type='. $post_type .'&action=feature_post&amp;post=' . $post_id ), 'feature-post_' . $post_id ) . '"><span class="dashicons '. esc_attr( $class) .'"></span></a>';
				break;

			}
		}

		/**
		 * Feature post column AJAX call
		 * 
		 * @since  1.0
		 */
		public function feature_post() {

			$post_type = function_exists( 'octagon_get_current_post_type' ) ? octagon_get_current_post_type() : '';

			if( ! ( isset( $_GET['post'] ) || isset( $_POST['post'] )  || ( isset($_REQUEST['action'] ) && 'feature_post' == $_REQUEST['action'] ) ) ) {
				wp_die('No post to feature has been supplied!');
			}

			$post_id = isset( $_GET['post'] ) ? absint( $_GET['post'] ) : absint( $_POST['post'] );

			check_admin_referer( 'feature-post_' . $post_id );

			if( isset( $post_id ) && NULL != $post_id ) {

				$featured = get_post_meta( $post_id, 'featured_post', true );
				$featured = ( '' == $featured || NULL == $featured || 'not-featured' == $featured ) ? 'featured' : 'not-featured';

				update_post_meta( $post_id, 'featured_post', $featured );

				wp_redirect( admin_url( 'edit.php?post_type='. $post_type ) );
				exit;

			}
			else {
				wp_die( 'Choose feature post failed, could not find a post: ' . $post_id );
			}
		}

	}

	new Octagon_Core_Post_Columns;

}