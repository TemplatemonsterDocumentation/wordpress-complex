<?php

namespace MPHB\Admin\MenuPages;

class CalendarMenuPage extends AbstractMenuPage {

	private $calendar;

	public function addActions(){
		parent::addActions();
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueueAdminScripts' ), 15 );
	}

	public function setupCalendar(){
		$this->calendar = new \MPHB\BookingsCalendar();
	}

	public function enqueueAdminScripts(){
		$screen = get_current_screen();
		if ( !is_null( $screen ) && $screen->id === $this->hookSuffix ) {
			MPHB()->getAdminScriptManager()->enqueue();
		}
	}

	public function render(){
		$this->setupCalendar();
		?>
		<div class="wrap">
			<h1><?php _e( 'Booking Calendar', 'motopress-hotel-booking' ); ?></h1>
			<?php
			$this->calendar->render();
			?>
		</div>
		<?php
	}

	public function onLoad(){

	}

}
