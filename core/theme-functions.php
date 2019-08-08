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

/* ---------------------------------------------------------------------------
 * Post Functions
------------------------------------------------------------------------------ */

if( ! function_exists( 'octagon_share_links' ) ) {

	/**
	 * Posts share url in icons
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @param  array  $social Social Share
	 * @return mixed
	 */
	function octagon_share_links( $social = array( 'facebook', 'twitter', 'google_plus', 'linkedin', 'pinterest' ), $url = '' ) {

		$html = '';

		$url = ! empty( $url ) ? $url : get_permalink();

		foreach( $social as $key => $value ) {
			if( 'facebook' == $value ) {
				$html .= '<a href="facebook.com/sharer/sharer.php?u='. esc_url( $url ) .'" class="oct-social-facebook"></a>';
			}
			elseif( 'twitter' == $value ) {
				$html .= '<a href="twitter.com/home?status='. esc_url( $url ) .'" class="oct-social-twitter"></a>';
			}
			elseif( 'linkedin' == $value ) {
				$html .= '<a href="https://www.linkedin.com/shareArticle?mini=true&url='. esc_url( $url ) .'" class="oct-social-linkedin"></a>';
			}
			elseif( 'pinterest' == $value ) {
				$html .= '<a href="https://pinterest.com/pin/create/button/?url='. esc_url( $url ) .'" class="oct-social-pinterest"></a>';
			}
		}

		echo $html;
	}

}


if( ! function_exists( 'octagon_first_term' ) ) {

	/**
	 * First term
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @param  int  $id 	Post ID
	 * @param  string  $taxonomy Taxonomy
	 * @return array
	 */
	function octagon_first_term( $id = 0, $taxonomy = 'category' ) {

		$value = array();

		$terms = get_the_terms( $id, $taxonomy );
		$terms = isset( $terms[0] ) ? $terms[0] : array();
		
		if( ! empty( $terms ) ) {
			$value['id'] = $terms->term_id;
			$value['name'] = $terms->name;
		}

		return $value;

	}

}


if( ! function_exists( 'octagon_meta' ) ) {

	/**
	 * First term
	 * 
	 * @version  1.0
	 * @since  1.0
	 * @param  int  $id 	Post ID
	 * @param  string  $taxonomy Taxonomy
	 * @return array
	 */
	function octagon_meta( $element = '' ) {

		if( 'category' == $element ) : 

			$term = get_the_category();
			$term_id = isset( $term[0] ) ? $term[0]->term_id : '';

			if( ! empty( $term_id ) ) :
				?>
				<p class="category">
					<a href="<?php echo esc_url( get_category_link( $term[0]->term_id ) ); ?>"><?php echo esc_html( $term[0]->cat_name ); ?></a>
				</p>
				<?php 
			endif;

		elseif( 'date' == $element ) : 
			$year  = get_the_time( 'Y' );
			$month = get_the_time( 'm' );
			?>

			<p class="date"><a href="<?php echo esc_url( get_month_link( $year, $month ) ); ?>"><?php echo esc_html( get_the_date() ); ?></a></p>

			<?php 
		endif;

	}

}