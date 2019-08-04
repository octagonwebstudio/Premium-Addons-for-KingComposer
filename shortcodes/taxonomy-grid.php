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

$wrapper_class[] = 'taxonomy-grid grid-block';
$wrapper_class[] = octagon_trim( $gutter );
$wrapper_class[] = $ex_class;

$wrapper_class = array_filter( $wrapper_class );

$number = octagon_core_get_grid_array_count( $grid_template );

$args = array(
	'taxonomy'   => $taxonomy,
	'orderby'    => $orderby,
	'order'      => $order,
	'hide_empty' => false
);

if( '' != $term_count ) {
	$args['number'] = $term_count;
}

if( '' != $terms_not_in ) {
	$terms_not_in_array = explode( ',', $terms_not_in );
	$args['exclude'] = $terms_not_in_array;
}

if( '' != $offset ) {
	$args['offset'] = $offset;
}

if( 'only_parent' == $method ) {
	$args['parent'] = 0;
}
elseif( ! empty( $parent_term ) && 'first_lvl_child' == $method ) {

	$term_obj = get_term_by( 'slug', $parent_term, $taxonomy );
	$term_id = isset( $term_obj->term_id ) ? $term_obj->term_id : '';

	$args['parent'] = $term_id;
}
elseif( ! empty( $parent_term ) && 'all_lvl_child' == $method ) {

	$term_obj = get_term_by( 'slug', $parent_term, $taxonomy );
	$term_id = isset( $term_obj->term_id ) ? $term_obj->term_id : '';

	$args['child_of'] = $term_id;
}
elseif( ! empty( $terms_in ) && 'terms' == $method ) {

	$terms_in_array = explode( ',', $terms_in );
	
	$args['slug'] = $terms_in_array;
}

$term_objects = get_terms( $args );

if( ! empty( $term_objects ) ):
	?>

	<div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">

		<div class="taxonomies grid-isotope">

			<div class="isotope-item-sizer col-md-1"></div>

			<?php

			$i = 0;
			foreach( $term_objects as $key => $term ) :

				$title = isset( $term->name ) ? $term->name : '';
				$archive_link = get_term_link( $term );

				$term_meta = get_option( 'taxonomy_options'. $term->term_id );

				if( 'product_cat' == $taxonomy ) {
					$attachment_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
				}
				else {
					$attachment_id = isset( $term_meta['image_id'] ) ? $term_meta['image_id'] : '';
				}				

				$i = ( $i > octagon_core_grid_last_index( $grid_template ) ) ? 0 : $i;

				$class   = array();
				$class[] = 'element isotope-item grid';
				$class[] = 'col-md-' . octagon_core_grid_template_column_class( $grid_template, $i );
				?>

				<div class="<?php echo esc_attr( implode( ' ', $class ) ); ?>">

					<div class="grid-inner product-item">
						
						<div class="gallery-thumbnail image-overflow">
							<?php echo octagon_core_grid_template_crop_image( $grid_template, $attachment_id, $i ); ?>
							<div class="image-overlay"></div>
						</div> <!-- .product-thumbnail -->

						<div class="content-holder">
							<<?php echo esc_html( $title_tag ); ?> class="sub-title"><?php echo esc_html( $title ); ?></<?php echo esc_html( $title_tag ); ?>>
						</div>

						<a href="<?php echo esc_url( $archive_link ); ?>" class="content-holder-overlap"></a>

					</div> <!-- .product-item -->

				</div> <!-- .product -->				

			<?php $i++; endforeach; ?>

		</div> <!-- .products -->

	</div> <!-- .products-grid -->

	<?php

endif;
wp_reset_postdata();