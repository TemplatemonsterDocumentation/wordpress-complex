<?php
/**
 * Vertical timeline layout
 *
 * @package    Timeline
 * @subpackage Timeline
 * @author     Template Monster
 * @license    GPL-3.0+
 * @copyright  2016 Template Monster
 */
if ( 0 < sizeof( $this->timeline_events ) ) :
	?>
	<div class="tm_timeline tm_timeline-layout-vertical">
		<div class="tm_timeline__container">

			<div class="tm_timeline__body-tense">

				<?php foreach ( $this->timeline_events as $post ) : ?>
					<div class="tm_timeline__event">
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
				<?php endforeach; ?>

			</div>

		</div>

	</div>
<?php endif; ?>
