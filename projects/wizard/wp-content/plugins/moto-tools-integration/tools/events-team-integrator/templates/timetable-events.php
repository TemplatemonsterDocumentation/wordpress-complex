<?php
/**
 * Template part to display timetable events schedule widget content.
 */

?>

<div class="mti-event__item-holder">
	<a class="mti-event__link" href="<?php echo $permalink ?>">
		<figure class="mti-event__thumbnail">
			<?php echo $image ?>
			<?php echo $title ?>
		</figure>
	</a>
	<?php echo $excerpt ?>
	<?php echo $participants ?>
	<div class="mti-event__schedule">
		<?php echo $event_schedule ?>
	</div>
</div>
