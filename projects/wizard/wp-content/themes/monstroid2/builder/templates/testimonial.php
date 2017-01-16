<?php
/**
 * Template part for Testimonial module displaying
 *
 * @package Monstroid2
 */
?>
<?php echo $this->_var( 'portrait_image' ); ?>
<div class="tm_pb_testimonial_description">
	<div class="tm_pb_testimonial_description_inner">
		<div class="tm_pb_testimonial_content">
			<?php echo $this->shortcode_content; ?>
		</div>
		<div class="tm_pb_testimonial_meta_wrap">
			<h6 class="tm_pb_testimonial_author">
				<?php echo $this->_var( 'author' ); ?>
			</h6>
			<p class="tm_pb_testimonial_meta"><?php
				echo $this->_var( 'job_title' );
				if ( $this->_var( 'company_name' ) ) {
					printf( ', %s', $this->_var( 'company_name' ) );
				}
				if ( $this->_var( 'testi_date' ) ) {
					printf( ' - %s', $this->_var( 'testi_date' ) );
				}
				?></p>
		</div>
	</div><!-- .tm_pb_testimonial_description_inner -->
</div><!-- .tm_pb_testimonial_description -->
