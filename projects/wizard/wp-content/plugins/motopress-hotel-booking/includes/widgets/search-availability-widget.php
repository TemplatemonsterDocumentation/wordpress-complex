<?php

namespace MPHB\Widgets;

class SearchAvailabilityWidget extends BaseWidget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct(){

		$baseId	 = 'mphb_search_availability_widget';
		$name	 = __( 'Search Availability', 'motopress-hotel-booking' );

		$widgetOptions = array(
			'description' => __( 'Search Availability Form', 'motopress-hotel-booking' )
		);

		add_action( 'mphb_widget_search_form_top', array( '\MPHB\Widgets\SearchAvailabilityWidget', 'renderHiddenInputs' ) );

		parent::__construct( $baseId, $name, $widgetOptions );
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see \WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ){
		$this->enqueueStylesScripts();

		echo $args['before_widget'];

		$title	 = isset( $instance['title'] ) ? $instance['title'] : '';
		$title	 = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		if ( !empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$instance = $this->fillStoredSearchParameters( $instance );

		$this->renderMain( $instance );

		echo $args['after_widget'];
	}

	/**
	 *
	 * @param array $instance
	 */
	private function renderMain( $instance ){

		$adults		 = !empty( $instance['adults'] ) ? $instance['adults'] : MPHB()->settings()->main()->getMinAdults();
		$children	 = !empty( $instance['children'] ) ? $instance['children'] : MPHB()->settings()->main()->getMinChildren();

		$formattedCheckInDate	 = isset( $instance['check_in_date'] ) ? $instance['check_in_date'] : '';
		$formattedCheckOutDate	 = isset( $instance['check_out_date'] ) ? $instance['check_out_date'] : '';

		$action	 = MPHB()->settings()->pages()->getSearchResultsPageUrl();
		$uniqid	 = uniqid();

		$templateAtts = array(
			'action'		 => $action,
			'uniqid'		 => $uniqid,
			'adults'		 => $adults,
			'children'		 => $children,
			'checkInDate'	 => $formattedCheckInDate,
			'checkOutDate'	 => $formattedCheckOutDate
		);

		mphb_get_template_part( 'widgets/search-availability/search-form', $templateAtts );
	}

	/**
	 *
	 * @param array $atts
	 * @return array
	 */
	private function fillStoredSearchParameters( $atts ){

		$storedParameters = MPHB()->searchParametersStorage()->get();

		if ( !empty( $storedParameters['mphb_adults'] ) &&
			$storedParameters['mphb_adults'] <= MPHB()->settings()->main()->getSearchMaxAdults() ) {
			$atts['adults'] = (string) $storedParameters['mphb_adults'];
		}

		if ( $storedParameters['mphb_children'] !== '' &&
			$storedParameters['mphb_children'] <= MPHB()->settings()->main()->getSearchMaxChildren() ) {
			$atts['children'] = (string) $storedParameters['mphb_children'];
		}

		if ( !empty( $storedParameters['mphb_check_in_date'] ) ) {
			$atts['check_in_date'] = (string) $storedParameters['mphb_check_in_date'];
		}

		if ( !empty( $storedParameters['mphb_check_out_date'] ) ) {
			$atts['check_out_date'] = (string) $storedParameters['mphb_check_out_date'];
		}

		return $atts;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see \WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ){

		$instance = wp_parse_args( $instance, array(
			'title'			 => '',
			'adults'		 => MPHB()->settings()->main()->getMinAdults(),
			'children'		 => MPHB()->settings()->main()->getMinChildren(),
			'check_in_date'	 => '',
			'check_out_date' => ''
			) );

		extract( $instance );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'motopress-hotel-booking' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'check_in_date' ) ); ?>"><?php _e( 'Check-in Date:', 'motopress-hotel-booking' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'check_in_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'check_in_date' ) ); ?>" type="text" value="<?php echo esc_attr( $check_in_date ); ?>"><small><?php printf( _x( 'Preset date. Formated as %s', 'Date format tip', 'motopress-hotel-booking' ), 'mm/dd/yyyy' ); ?></small>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'check_out_date' ) ); ?>"><?php _e( 'Check-out Date:', 'motopress-hotel-booking' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'check_out_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'check_out_date' ) ); ?>" type="text" value="<?php echo esc_attr( $check_out_date ); ?>">
			<small><?php printf( _x( 'Preset date. Formated as %s', 'Date format tip', 'motopress-hotel-booking' ), 'mm/dd/yyyy' ); ?></small>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'adults' ) ); ?>"><?php _e( 'Preset Adults:', 'motopress-hotel-booking' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'adults' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'adults' ) ); ?>" >
				<?php foreach ( MPHB()->settings()->main()->getAdultsListForSearch() as $adultsCount => $adultsCountLabel ) : ?>
					<option value="<?php echo $adultsCount; ?>" <?php selected( $adults, $adultsCount ); ?>><?php echo $adultsCountLabel; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'children' ) ); ?>"><?php _e( 'Preset Children:', 'motopress-hotel-booking' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'children' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'children' ) ); ?>" >
				<?php foreach ( MPHB()->settings()->main()->getChildrenListForSearch() as $childrenCount => $childrenCountLabel ) : ?>
					<option value="<?php echo $childrenCount; ?>" <?php selected( $children, $childrenCount ); ?>><?php echo $childrenCountLabel; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see \WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ){
		$instance = array();

		$instance['title']			 = ( isset( $new_instance['title'] ) && $new_instance['title'] !== '' ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['adults']			 = ( isset( $new_instance['adults'] ) && $new_instance['adults'] !== '' ) ? $this->sanitizeInt( $new_instance['adults'], MPHB()->settings()->main()->getMinAdults(), MPHB()->settings()->main()->getSearchMaxAdults() ) : '';
		$instance['children']		 = ( isset( $new_instance['children'] ) && $new_instance['children'] !== '' ) ? $this->sanitizeInt( $new_instance['children'], MPHB()->settings()->main()->getMinChildren(), MPHB()->settings()->main()->getSearchMaxChildren() ) : '';
		$instance['check_in_date']	 = ( isset( $new_instance['check_in_date'] ) && !empty( $new_instance['check_in_date'] ) ) ? $this->sanitizeDate( $new_instance['check_in_date'] ) : '';
		$instance['check_out_date']	 = ( isset( $new_instance['check_out_date'] ) && !empty( $new_instance['check_out_date'] ) ) ? $this->sanitizeDate( $new_instance['check_out_date'] ) : '';

		return $instance;
	}

	public function enqueueStylesScripts(){
		MPHB()->getPublicScriptManager()->enqueue();
	}

	public static function renderHiddenInputs(){
		$parameters	 = array();
		$actionQuery = parse_url( MPHB()->settings()->pages()->getSearchResultsPageUrl(), PHP_URL_QUERY );
		parse_str( $actionQuery, $parameters );
		foreach ( $parameters as $paramName => $paramValue ) {
			printf( '<input type="hidden" name="%s" value="%s" />', $paramName, $paramValue );
		}
	}

}
