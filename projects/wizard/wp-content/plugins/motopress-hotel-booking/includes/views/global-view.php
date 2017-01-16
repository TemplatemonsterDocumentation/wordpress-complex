<?php

namespace MPHB\Views;

class GlobalView {

	public static function renderRequiredFieldsTip(){
		mphb_get_template_part( 'required-fields-tip' );
	}

	/**
	 *
	 * @param string $content
	 * @return string
	 */
	public static function prependBr( $content ){
		return '<br/>' . $content;
	}

	public static function renderPagination( \WP_Query $wp_query ){
		$big			 = 999999;
		$search_for		 = array( $big, '#038;' );
		$replace_with	 = array( '%#%', '&' );

		$paginationAtts = array(
			'base'		 => str_replace( $search_for, $replace_with, get_pagenum_link( $big ) ),
			'format'	 => '?paged=%#%',
			'current'	 => max( 1, mphb_get_paged_query_var() ),
			'total'		 => $wp_query->max_num_pages
		);

		$pagination = paginate_links( $paginationAtts );

		if ( !empty( $pagination ) ) :
			?>
			<div class="mphb-pagination">
				<?php echo $pagination; ?>
			</div>
			<?php
		endif;
	}

}
