<?php
/**
 * Vertical (Chess Order) timeline layout
 *
 * @package    Timeline
 * @subpackage Timeline_Admin
 * @author     Template Monster
 * @license    GPL-3.0+
 * @copyright  2016 Template Monster
 */

if ( 0 < sizeof( $this->timeline_events ) ) :
	?>
	<div class="tm_timeline tm_timeline-layout-vertical tm_timeline-layout-vertical-chessOrder">

	<div class="tm_timeline__container">

		<div class="tm_timeline__body">

			<div class="tm_timeline__tense"></div>

			<?php $class_name = 'odd';
			$i                = 0; ?>
			<?php foreach ( $this->timeline_events as $post ) : ?>
				<div class="tm_timeline__event tm_timeline__event-<?php print esc_attr( $class_name ); ?>">
					<?php
					if ( 0 === ( $i % 2 ) ) {
						$class_name = 'even';
					} else {
						$class_name = 'odd';
					}
					?>
					<div class="tm_timeline__event__dot"></div>
					<?php
					$date = apply_filters( 'tm_timeline_format_date', get_post_meta( $post->ID, 'post-event-date', true ), $this->config['date-format'] );
					?>
					<div class="tm_timeline__event__date"><?php print esc_html( $date ); ?></div>
					<?php if ( isset( $this->config['anchors'] ) && true == $this->config['anchors'] ) : ?>
						<div class="tm_timeline__event__title">
							<a href="<?php print esc_attr( get_permalink( $post->ID ) ); ?>"><?php print esc_html( $post->post_title ); ?></a>
						</div>
					<?php else : ?>
						<div class="tm_timeline__event__title">
							<?php print esc_html( $post->post_title ); ?>
						</div>
					<?php endif; ?>
					<div class="tm_timeline__event__description">
						<?php print apply_filters( 'tm_timeline_format_content', wp_trim_words( $post->post_content, 20, ' ' ) ); ?>
					</div>
				</div>
				<?php $i = $i + 1; ?>
			<?php endforeach; ?>

		</div>

	</div>

	</div>
<?php endif; ?>
