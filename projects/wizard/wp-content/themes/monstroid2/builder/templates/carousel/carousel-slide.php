<?php
/**
 * Template part for displaying carousel item slides
 *
 * @package Monstroid2
 */
?>
<!-- Slide-->
<div class="swiper-slide">
	<div class="content-wrapper">
		<header class="entry-header">
			<?php echo $this->_var( 'image' ); ?>
			<?php echo $this->_var( 'post_title' ); ?>
		</header>
		<div class="entry-meta">
			<?php echo $this->_var( 'date' ); ?>
			<?php echo $this->_var( 'author' ); ?>
			<?php echo $this->_var( 'count' ); ?>
			<?php echo $this->_var( 'category' ); ?>
			<?php echo $this->_var( 'tag' ); ?>
		</div>
		<article class="entry-content">
			<?php echo $this->_var( 'excerpt' ); ?>
		</article>
	</div>
	<footer class="entry-footer">
		<?php echo $this->_var( 'more_button' ); ?>
	</footer>
</div>
