<?php
/**
 * Template part for carousel module displaying
 *
 * @package Monstroid2
 */
?>
<?php
	$delimiter   = $this->_var( 'delimiter' );
	$show_all    = $this->_var( 'show_all' );
	$super_title = $this->_var( 'super_title' );
	$title       = $this->_var( 'title' );
	$subtitle    = $this->_var( 'subtitle' );
	$html        = '';

	if ( $super_title ) {
		$html .= '<h5>' . $this->_var( 'super_title' ) . '</h5>';
	}

	if ( $title ) {
		$html .= '<h3>' . $this->_var( 'title' ) . '</h3>';
	}

	if ( $subtitle ) {
		$html .= '<h6>' . $this->_var( 'subtitle' ) . '</h6>';
	}

	$html .= $delimiter;

	echo $html;
?>
<!-- Slider main container -->
<div class="swiper-container" >
	<!-- Additional required wrapper -->
	<div class="swiper-wrapper">
		<!-- Slides -->
		<?php
			echo $this->_var( 'slides' );
		?>
	</div>
	<!-- If we need pagination -->
	<div class="swiper-pagination"></div>
	<!-- If we need navigation buttons -->
	<div class="swiper-button-prev"><?php echo apply_filters( 'monstroid2_pb_carousel_module_prev_button_icon', '<i class="linearicon linearicon-chevron-left"></i>' ) ?></div>
	<div class="swiper-button-next"><?php echo apply_filters( 'monstroid2_pb_carousel_module_next_button_icon', '<i class="linearicon linearicon-chevron-right"></i>' ) ?></div>
</div>
<div class="btn-wrapper">
	<?php
		echo $show_all;
	?>
</div>
