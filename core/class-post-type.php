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

if( ! class_exists( 'Octagon_Core_Post_type' ) ) {

	class Octagon_Core_Post_type {

		public function __construct( $args ) {

			$this->args = $args;

			add_action( 'init', array( $this, 'register_post_types' ), 10, 2 );
			
		}

		/**
		 * Register custom post types
		 * 
		 * @since  1.0
		 */
		public function register_post_types() {

			$args = $this->args;

			$id       = $args['id'];
			$name     = $args['name'];
			$singular = $args['singular'];

			$labels = array(
				'name'               => esc_html( $name ),
				'singular_name'      => esc_html( $singular ),
				'add_new'            => esc_html__( 'Add New', 'octagon-kc-elements' ),
				'add_new_item'       => sprintf( esc_html__( 'Add New %s', 'octagon-kc-elements' ), $singular ),
				'edit_item'          => sprintf( esc_html__( 'Edit %s', 'octagon-kc-elements' ), $singular ),
				'new_item'           => sprintf( esc_html__( 'New %s', 'octagon-kc-elements' ), $singular ),
				'view_item'          => sprintf( esc_html__( 'View %s', 'octagon-kc-elements' ), $singular ),
				'search_items'       => sprintf( esc_html__( 'Search %s', 'octagon-kc-elements' ), $name ),
				'not_found'          => sprintf( esc_html__( 'No %s found', 'octagon-kc-elements' ), strtolower( $name ) ),
				'not_found_in_trash' => sprintf( esc_html__( 'No %s found in trash', 'octagon-kc-elements' ), strtolower( $name ) ),
				'parent_item_colon'  => sprintf( esc_html__( 'Parent %s', 'octagon-kc-elements' ), $name ),
				'all_items'          => sprintf( esc_html__( 'All %s', 'octagon-kc-elements' ), $name ),
				'menu_name'          => esc_html( $name ),
				'name_admin_bar'     => esc_html( $singular )
			);

			if( isset( $args['labels'] ) && ! empty( $args['labels'] ) ) {
				$labels = array_merge( $labels, $args['labels'] );
			}

			$options = array(
				'labels'             => $labels,
				'description'        => esc_html__( 'Description.', 'octagon-kc-elements' ),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => $this->slug( $singular ) ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'menu_icon'          => null,
				'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
			);

			if( isset( $args['options'] ) && ! empty( $args['options'] ) ) {
				$options = array_merge( $options, $args['options'] );
			}

			register_post_type( $id, $options );

			if( isset( $args['taxonomy'] ) && ! empty( $args['taxonomy'] ) ) {
				$this->register_taxonomy();
			}

		}

		/**
		 * Register custom taxonomy
		 * 
		 * @since  1.0
		 */
		public function register_taxonomy() {

			$args = $this->args;

			$post_type = $args['id'];
			$taxonomies = $args['taxonomy'];

			foreach( $taxonomies as $key => $taxonomy ) {

				$id       = $taxonomy['id'];
				$name     = $taxonomy['name'];
				$singular = $taxonomy['singular'];

				$labels = array(
					'name'                       => esc_html( $name ),
					'singular_name'              => esc_html( $singular ),
					'search_items'               => sprintf( esc_html__( 'Search %s', 'octagon-kc-elements' ), $name ),
					'popular_items'              => sprintf( esc_html__( 'Popular %s', 'octagon-kc-elements' ), $name ),
					'all_items'                  => sprintf( esc_html__( 'All %s', 'octagon-kc-elements' ), $name ),
					'parent_item'                => null,
					'parent_item_colon'          => null,
					'edit_item'                  => sprintf( esc_html__( 'Edit %s', 'octagon-kc-elements' ), $singular ),
					'update_item'                => sprintf( esc_html__( 'Update %s', 'octagon-kc-elements' ), $singular ),
					'add_new_item'               => sprintf( esc_html__( 'Add New %s', 'octagon-kc-elements' ), $singular ),
					'new_item_name'              => sprintf( esc_html__( 'New %s Name', 'octagon-kc-elements' ), $singular ),
					'separate_items_with_commas' => sprintf( esc_html__( 'Separate %s with commas', 'octagon-kc-elements' ), strtolower( $name ) ),
					'add_or_remove_items'        => sprintf( esc_html__( 'Add or remove %s', 'octagon-kc-elements' ), $name ),
					'choose_from_most_used'      => sprintf( esc_html__( 'Choose from the most used %s', 'octagon-kc-elements' ), $name ),
					'not_found'                  => sprintf( esc_html__( 'No %s found.', 'octagon-kc-elements' ), strtolower( $name ) ),
					'menu_name'                  => esc_html( $name )
				);

				if( isset( $taxonomy['labels'] ) && ! empty( $taxonomy['labels'] ) ) {
					$labels = array_merge( $labels, $taxonomy['labels'] );
				}

				$options = array(
					'hierarchical'          => true,
					'labels'                => $labels,
					'show_ui'               => true,
					'show_admin_column'     => true,
					'update_count_callback' => '_update_post_term_count',
					'query_var'             => true,
					'rewrite'               => array( 'slug' => $this->slug( $singular ) ),
				);

				if( isset( $taxonomy['options'] ) && ! empty( $taxonomy['options'] ) ) {
					$options = array_merge( $options, $taxonomy['options'] );
				}

				register_taxonomy( $id, $post_type, $options );

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

}