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

if( ! class_exists( 'Octagon_Core_Taxonomy_Image' ) ) {

	class Octagon_Core_Taxonomy_Image {

		public function __construct(){			

			add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
			
		}

		/**
		 * Add taxonomy image
		 * 
		 * @since  1.0
		 */
		public function theme_setup() {

			/* It helps to avoid enqueue metabox styles and scripts not needed post types  */
			global $taxonomy_image_lists;
			$taxonomy_image_lists = array_merge( array( 'category' ), apply_filters( 'octagon_taxonomy_image_lists', array() ) );

			foreach( $taxonomy_image_lists as $key => $taxonomy ) {
				add_action( $taxonomy.'_add_form_fields', array( $this, 'add_field' ), 10, 2 );
				add_action( $taxonomy.'_edit_form_fields', array( $this, 'edit_field' ), 10, 2 );
				add_action( 'edited_'.$taxonomy, array( $this, 'save_taxonomy_fields' ), 10, 2 );  
				add_action( 'create_'.$taxonomy, array( $this, 'save_taxonomy_fields' ), 10, 2 );
			}

		}

		/**
		 * Taxonomy image field
		 * 
		 * @since  1.0
		 * @return mixed
		 */
		public function add_field( $term ) {

			echo '<div class="custom-media-upload image" data-type="image" data-allow-multiple="false">
				<input type="hidden" name="taxonomy_options[\'image_id\']" value="" class="media-upload-image">
				<div class="media-lists"></div>
				<a href="#" class="custom-media-upload-btn button button-primary button-medium">'. esc_html__( 'Upload', 'octagon-kc-elements' ) .'</a>
			</div>';

		}

		/**
		 * Taxonomy image field in edit.php
		 * 
		 * @since  1.0
		 * @return mixed
		 */
		public function edit_field( $term ) {

			$term_id = $term->term_id;		 
			
			$term_meta = get_option( 'taxonomy_options'.$term_id );
			$image_id = isset( $term_meta['image_id'] ) ? $term_meta['image_id'] : '';
			$preview_html = ( ! empty( $image_id ) ) ? $this->get_media_preview( $image_id, 'image' ) : '';

			echo '<tr class="form-field">
				<th scope="row"><label>'. esc_html__( 'Taxonomy Image', 'octagon-kc-elements' ) .'</label></th>
				<td>
					<div class="custom-media-upload image" data-type="image" data-allow-multiple="false">
						<input type="hidden" name="taxonomy_options[image_id]" value="'. esc_attr( $image_id ) .'" class="media-upload-image">
						<div class="media-lists">'. $preview_html .'</div>
						<a href="#" class="custom-media-upload-btn button button-primary button-medium">'. esc_html__( 'Upload', 'octagon-kc-elements' ) .'</a>
					</div>
				</td>
			</tr>';

		}

		/**
		 * Save additional taxonomy image field AJAX call
		 * 
		 * @since  1.0
		 */
		public function save_taxonomy_fields( $term_id ) {

			if( isset( $_POST['taxonomy_options'] ) ) {

				$term_meta = get_option( 'taxonomy_options'. $term_id );

				$cat_keys = array_keys( $_POST['taxonomy_options'] );

				foreach( $cat_keys as $key ) {
					$taxonomy_options[$key] = isset( $_POST['taxonomy_options'][$key] ) ? trim( esc_html( $_POST['taxonomy_options'][$key] ) ) : '';
				}

				update_option( 'taxonomy_options'.$term_id, $taxonomy_options );
			}


		}

		/**
		 * Get taxonomy image icon preview on page load
		 * 
		 * @since  1.0
		 * @return mixed
		 */
		public function get_media_preview( $attachment_id ) {

			$html = '';

			if( ! empty( $attachment_id ) ) {

				$attachment_id = explode( ',', $attachment_id );

				foreach( $attachment_id as $key => $id ) {

					$image = wp_get_attachment_image_src( $id, 'thumbnail', false );
					$html .= '<div class="media">';
						$html .= '<img src="'. esc_url( $image[0] ) .'">';
						$html .= '<span class="remove-custom-media" data-id="'. esc_attr( $id ) .'">x</span>';
					$html .= '</div>';

				}

			}

			return $html;

		}

	}

	new Octagon_Core_Taxonomy_Image;

}