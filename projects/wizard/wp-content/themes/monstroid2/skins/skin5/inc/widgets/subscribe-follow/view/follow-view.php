<?php
/**
 * Template part to display follow list in Subscribe and Follow widget.
 *
 * @package Monstroid2
 * @subpackage widgets
 */
?>
<div class="follow-block">

	<div class="follow-block__content">
		<?php
			echo $this->get_block_title( 'follow' );
			echo $this->get_block_message( 'follow' );
		?>
	</div>

	<?php echo $this->get_social_nav(); ?>

</div>
