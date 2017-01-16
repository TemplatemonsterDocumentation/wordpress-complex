<?php

namespace MPHB\Emails;

class AdminEmail extends AbstractEmail {

	/**
	 *
	 * @param array $args
	 * @param string $args['id'] ID of Email.
	 * @param string $args['label'] Label.
	 * @param string $args['description'] Optional. Email description.
	 * @param string $args['default_subject'] Optional. Default subject of email.
	 * @param string $args['default_header_text'] Optional. Default text in header.
	 * @param EmailTemplater $templater
	 */
	public function __construct( $args, EmailTemplater $templater ){
		parent::__construct( $args, $templater );
		add_action( 'mphb_generate_settings_admin_emails', array( $this, 'generateSettingsFields' ) );
	}

	/**
	 *
	 * @return string
	 */
	protected function getReceiver(){
		return MPHB()->settings()->emails()->getFromEmail();
	}

	/**
	 *
	 * @param bool $isSended
	 */
	protected function log( $isSended ){

		if ( $isSended ) {
			$this->booking->addLog( sprintf( __( '"%s" mail was sent to admin.', 'motopress-hotel-booking' ), $this->label ) );
		} else {
			$this->booking->addLog( sprintf( __( '"%s" mail sending to admin is failed.', 'motopress-hotel-booking' ), $this->label ) );
		}
	}

}
