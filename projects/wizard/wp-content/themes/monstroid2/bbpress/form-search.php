<?php
/**
 * Search
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<form role="search" method="get" id="bbp-search-form" action="<?php bbp_search_url(); ?>">
	<div>
		<label class="screen-reader-text hidden" for="bbp_search"><?php esc_html_e( 'Search for:', 'monstroid2' ); ?></label>
		<input type="hidden" name="action" value="bbp-search-request"/>
		<i class="linearicon linearicon-magnifier"></i>
		<input tabindex="<?php echo esc_attr( bbp_get_tab_index() ); ?>" placeholder="<?php echo esc_html_x( 'Enter keyword', 'placeholder', 'monstroid2' ) ?>" type="text" value="<?php echo esc_attr( bbp_get_search_terms() ); ?>" name="bbp_search" id="bbp_search"/>
		<input tabindex="<?php echo esc_attr( bbp_get_tab_index() ); ?>" class="button" type="submit" id="bbp_search_submit" value="<?php esc_html_e( 'Go!', 'monstroid2' ); ?>"/>
	</div>
</form>
