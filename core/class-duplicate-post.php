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

if( ! class_exists( 'Octagon_Core_Post_Row_Actions' ) ) {

	class Octagon_Core_Post_Row_Actions {

		public function __construct() {

			add_filter( 'post_row_actions', array( $this, 'row_actions' ), 10, 2 );
			add_filter( 'page_row_actions', array( $this, 'row_actions' ), 10, 2 );
			add_action( 'admin_action_duplicate_post', array( $this, 'duplicate_post' ) );
			add_action( 'edit_form_after_title', array( $this, 'edit_form_after_title' ), 5, 2 );			
			
		}

		/**
		 * Append post row action
		 * 
		 * @since  1.0
		 * @param  array 	$actions 	Post Row Actions
		 * @param  object 	$post 		Post Object
		 * @return array
		 */
		public function edit_form_after_title( $post ) {

			$post_type = octagon_get_current_post_type();

			echo '<a href="' . wp_nonce_url( admin_url( 'edit.php?post_type='. $post_type .'&action=duplicate_post&amp;post=' . $post->ID ), 'duplicate-post_' . $post->ID ) . '" class="duplicate-btn button button-primary button-large">' . esc_html__( 'Duplicate', 'octagon-kc-elements' ) . '</a>';

		}

		/**
		 * Append post row action
		 * 
		 * @since  1.0
		 * @param  array 	$actions 	Post Row Actions
		 * @param  object 	$post 		Post Object
		 * @return array
		 */
		public function row_actions( $actions, $post ) {

			$post_type = octagon_get_current_post_type();

			$new_action['id'] = 'ID: '. esc_html( $post->ID );

			$actions = array_merge( $new_action, $actions );

			$actions['duplicate'] = '<a href="' . wp_nonce_url( admin_url( 'edit.php?post_type='. $post_type .'&action=duplicate_post&amp;post=' . $post->ID ), 'duplicate-post_' . $post->ID ) . '">' . esc_html__( 'Duplicate', 'octagon-kc-elements' ) . '</a>';

			return $actions;

		}

		/**
		 * Duplicate post AJAX call
		 * 
		 * @since  1.0
		 */
		public function duplicate_post() {

			global $wpdb;

			if( ! ( isset( $_GET['post'] ) || isset( $_POST['post'] )  || ( isset($_REQUEST['action'] ) && 'duplicate_post' == $_REQUEST['action'] ) ) ) {
				wp_die('No post to duplicate has been supplied!');
			}

			$post_id = isset( $_GET['post'] ) ? absint( $_GET['post'] ) : absint( $_POST['post'] );

			check_admin_referer( 'duplicate-post_' . $post_id );

			$post = get_post( $post_id );

			$current_user = wp_get_current_user();
			$new_post_author = $current_user->ID;

			if( isset( $post ) && NULL != $post ) {

				$args = array(
					'comment_status' => $post->comment_status,
					'ping_status'    => $post->ping_status,
					'post_author'    => $new_post_author,
					'post_content'   => octagon_raw_content( $post->ID ),
					'post_excerpt'   => $post->post_excerpt,
					'post_name'      => $post->post_name,
					'post_parent'    => $post->post_parent,
					'post_password'  => $post->post_password,
					'post_status'    => 'draft',
					'post_title'     => $post->post_title,
					'post_type'      => $post->post_type,
					'to_ping'        => $post->to_ping,
					'menu_order'     => $post->menu_order
				);

				$new_post_id = wp_insert_post( $args );

				$taxonomies = get_object_taxonomies( $post->post_type );

				foreach( $taxonomies as $taxonomy ) {
					$post_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'slugs' ) );
					wp_set_object_terms( $new_post_id, $post_terms, $taxonomy, false );
				}

				$post_meta_infos = $wpdb->get_results( "SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id" );

				if( 0 != count( $post_meta_infos ) ) {

					$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";

					foreach( $post_meta_infos as $meta_info ) {

						$meta_key = $meta_info->meta_key;
						if( $meta_key == '_wp_old_slug' ) continue;
						$meta_value = addslashes( $meta_info->meta_value );
						$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";

					}

					$sql_query.= implode( " UNION ALL ", $sql_query_sel );
					$wpdb->query( $sql_query );
				}

				wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
				exit;

			}
			else {
				wp_die( 'Post creation failed, could not find original post: ' . $post_id );
			}
		}

		/**
		 * Clean slug
		 * 
		 * @since  1.0
		 * @param  string  $name Slug
		 * @return string
		 */
		private function slug( $name ) {
			return strtolower( trim( str_replace( array( ' ', '_' ), '-', $name ) ) );
		}

	}

	new Octagon_Core_Post_Row_Actions;

}