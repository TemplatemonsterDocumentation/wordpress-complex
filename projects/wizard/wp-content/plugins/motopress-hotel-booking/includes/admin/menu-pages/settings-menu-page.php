<?php

namespace MPHB\Admin\MenuPages;

use \MPHB\Admin\Fields;
use \MPHB\Admin\Groups;
use \MPHB\Admin\Tabs;

class SettingsMenuPage extends AbstractMenuPage {

	protected $tabs = array();

	public function initFields(){

		$generalTab				 = $this->_generateGeneralTab();
		$adminEmailsTab			 = $this->_generateAdminEmailsTab();
		$customerEmailsTab		 = $this->_generateCustomerEmailsTab();
		$globalEmailSettingsTab	 = $this->_generateGlobalEmailSettingsTab();
		$bookingRulesTab		 = $this->_generateBookingRulesTab();

		$this->tabs = array(
			$generalTab->getName()				 => $generalTab,
			$adminEmailsTab->getName()			 => $adminEmailsTab,
			$customerEmailsTab->getName()		 => $customerEmailsTab,
			$globalEmailSettingsTab->getName()	 => $globalEmailSettingsTab,
			$bookingRulesTab->getName()			 => $bookingRulesTab
		);

		if ( MPHB()->settings()->license()->isEnabled() ) {
			$licenseTab							 = $this->_generateLicenseTab();
			$this->tabs[$licenseTab->getName()]	 = $licenseTab;
		}
	}

	/**
	 *
	 * @return Tabs\SettingsTab
	 */
	private function _generateGeneralTab(){
		$generalTab = new Tabs\SettingsTab( 'general', __( 'General', 'motopress-hotel-booking' ), $this->name );

		// Pages
		$pagesGroup = new Groups\SettingsGroup( 'mphb_pages', __( 'Pages', 'motopress-hotel-booking' ), $generalTab->getPseudoPageName() );

		$pagesGroupFields = array(
			Fields\FieldFactory::create( 'mphb_search_results_page', array(
				'type'			 => 'page-select',
				'label'			 => __( 'Search Results Page', 'motopress-hotel-booking' ),
				'description'	 => __( 'Select page to display search results. Use search results shortcode on this page.', 'motopress-hotel-booking' ),
				'default'		 => ''
			) ),
			Fields\FieldFactory::create( 'mphb_checkout_page', array(
				'type'			 => 'page-select',
				'label'			 => __( 'Checkout Page', 'motopress-hotel-booking' ),
				'description'	 => __( 'Select page user will be redirected to complete booking.', 'motopress-hotel-booking' ),
				'default'		 => ''
			) )
		);

		$pagesGroup->addFields( $pagesGroupFields );

		$generalTab->addGroup( $pagesGroup );

		// Misc
		$miscGroup = new Groups\SettingsGroup( 'mphb_misc', __( 'Misc', 'motopress-hotel-booking' ), $generalTab->getPseudoPageName() );

		$miscGroupFields = array(
			Fields\FieldFactory::create( 'mphb_square_unit', array(
				'type'		 => 'select',
				'label'		 => __( 'Square Units', 'motopress-hotel-booking' ),
				'list'		 => MPHB()->settings()->units()->getBundle()->getLabels(),
				'default'	 => 'm2'
			) ),
			Fields\FieldFactory::create( 'mphb_currency_symbol', array(
				'type'		 => 'select',
				'label'		 => __( 'Currency', 'motopress-hotel-booking' ),
				'list'		 => MPHB()->settings()->currency()->getBundle()->getLabels(),
				'default'	 => 'USD'
			) ),
			Fields\FieldFactory::create( 'mphb_currency_position', array(
				'type'		 => 'select',
				'label'		 => __( 'Currency Position', 'motopress-hotel-booking' ),
				'list'		 => MPHB()->settings()->currency()->getBundle()->getPositions(),
				'default'	 => 'before'
			) ),
			Fields\FieldFactory::create( 'mphb_check_in_time', array(
				'type'		 => 'timepicker',
				'label'		 => __( 'Check-in Time', 'motopress-hotel-booking' ),
				'default'	 => '11:00'
			) ),
			Fields\FieldFactory::create( 'mphb_check_out_time', array(
				'type'		 => 'timepicker',
				'label'		 => __( 'Check-out Time', 'motopress-hotel-booking' ),
				'default'	 => '10:00'
			) ),
			Fields\FieldFactory::create( 'mphb_bed_types', array(
				'type'		 => 'complex',
				'label'		 => __( 'Bed Types', 'motopress-hotel-booking' ),
				'fields'	 => array(
					Fields\FieldFactory::create( 'type', array(
						'type'		 => 'text',
						'default'	 => '',
						'label'		 => __( 'Type', 'motopress-hotel-booking' ),
					) )
				),
				'default'	 => array(),
				'add_label'	 => __( 'Add Bed Type', 'motopress-hotel-booking' )
			) ),
			Fields\FieldFactory::create( 'mphb_template_mode', array(
				'type'			 => 'select',
				'label'			 => __( 'Template Mode', 'motopress-hotel-booking' ),
				'list'			 => array(
					'plugin' => __( 'Developer Mode', 'motopress-hotel-booking' ),
					'theme'	 => __( 'Theme Mode', 'motopress-hotel-booking' )
				),
				'description'	 => '<br/>' . __( 'Choose Theme Mode to display the content with the styles of your theme. Choose Developer Mode to control appearance of the content with custom page templates, actions and filters. This option can\'t be changed if your theme is initially integrated with the plugin.', 'motopress-hotel-booking' ),
				'disabled'		 => current_theme_supports( 'motopress-hotel-booking' ),
				'default'		 => 'theme'
			) ),
			Fields\FieldFactory::create( 'mphb_checkout_text', array(
				'type'			 => 'rich-editor',
				'label'			 => __( 'Terms & Conditions', 'motopress-hotel-booking' ),
				'description'	 => __( 'Specify terms and conditions that apply to your clients\' purchases. This text will appear on the Check Out/Place Order screen.', 'motopress-hotel-booking' ),
				'default'		 => ''
			) )
		);
		$miscGroup->addFields( $miscGroupFields );

		$bookingDisablingGroup = new Groups\SettingsGroup( 'mphb_disabling_group', __( 'Disable Booking', 'motopress-hotel-booking' ), $generalTab->getPseudoPageName() );

		$bookingDisablingFields = array(
			Fields\FieldFactory::create( 'mphb_booking_disabled', array(
				'type'			 => 'checkbox',
				'inner_label'	 => __( 'Disable booking', 'motopress-hotel-booking' ),
				'label'			 => '',
//				'description'	 => '<br/>' . __( 'Hide reservation form and book buttons', 'motopress-hotel-booking' ),
				'default'		 => false
			) ),
			Fields\FieldFactory::create( 'mphb_disabled_booking_text', array(
				'type'		 => 'rich-editor',
				'label'		 => __( 'Text instead of reservation form while booking is disabled', 'motopress-hotel-booking' ),
				'default'	 => false
			) )
		);

		$bookingDisablingGroup->addFields( $bookingDisablingFields );

		$bookingConfirmationGroup = new Groups\SettingsGroup( 'mphb_confirmation_group', __( 'Booking Confirmation', 'motopress-hotel-booking' ), $generalTab->getPseudoPageName() );

		$bookingConfirmationFields = array(
			Fields\FieldFactory::create( 'mphb_confirmation_mode', array(
				'type'		 => 'select',
				'label'		 => __( 'Confirmation Mode', 'motopress-hotel-booking' ),
				'list'		 => array(
					'auto'	 => __( 'By User via email', 'motopress-hotel-booking' ),
					'manual' => __( 'By Admin manually', 'motopress-hotel-booking' )
				),
				'default'	 => 'auto'
			) ),
			Fields\FieldFactory::create( 'mphb_booking_confirmation_page', array(
				'type'			 => 'page-select',
				'label'			 => __( 'Confirmation Page', 'motopress-hotel-booking' ),
				'description'	 => __( 'Page user will be redirected to once the booking is confirmed.', 'motopress-hotel-booking' ),
				'default'		 => ''
			) ),
			Fields\FieldFactory::create( 'mphb_user_approval_time', array(
				'type'			 => 'number',
				'label'			 => __( 'Approval Time for User', 'motopress-hotel-booking' ),
				'description'	 => __( 'minutes.<br/>Period of time the user is given to confirm booking via email. Unconfirmed bookings become Abandoned and room status changes to Available.', 'motopress-hotel-booking' ),
				'min'			 => 5,
				'step'			 => 1,
				'default'		 => MPHB()->settings()->main()->getDefaultUserApprovalTime()
			) )
		);

		$bookingConfirmationGroup->addFields( $bookingConfirmationFields );

		$bookingCancellationGroup = new Groups\SettingsGroup( 'mphb_cancellation_group', __( 'Booking Cancellation', 'motopress-hotel-booking' ), $generalTab->getPseudoPageName() );

		$bookingCancellationFields = array(
			Fields\FieldFactory::create( 'mphb_user_can_cancel_booking', array(
				'type'			 => 'checkbox',
				'inner_label'	 => __( 'User can cancel booking via link provided inside email', 'motopress-hotel-booking' ),
				'default'		 => false
			) ),
			Fields\FieldFactory::create( 'mphb_user_cancel_redirect', array(
				'type'		 => 'page-select',
				'label'		 => __( 'Page to redirect to after booking cancellation', 'motopress-hotel-booking' ),
				'default'	 => ''
			) ),
		);

		$bookingCancellationGroup->addFields( $bookingCancellationFields );

		$searchParametersGroup	 = new Groups\SettingsGroup( 'mphb_search_parameters', __( 'Search Parameters', 'motopress-hotel-booking' ), $generalTab->getPseudoPageName(), __( 'Maximum room occupancy available in the Search Form', 'motopress-hotel-booking' ) );
		$searchParametersFields	 = array(
			Fields\FieldFactory::create( 'mphb_search_max_adults', array(
				'type'		 => 'number',
				'min'		 => 1,
				'step'		 => 1,
				'max'		 => MPHB()->settings()->main()->getMaxAdults(),
				'default'	 => MPHB()->settings()->main()->getMaxAdults(),
				'label'		 => __( 'Max Adults', 'motopress-hotel-booking' )
			) ),
			Fields\FieldFactory::create( 'mphb_search_max_children', array(
				'type'		 => 'number',
				'min'		 => 1,
				'step'		 => 1,
				'max'		 => MPHB()->settings()->main()->getMaxChildren(),
				'default'	 => MPHB()->settings()->main()->getMaxChildren(),
				'label'		 => __( 'Max Children', 'motopress-hotel-booking' )
			) )
		);

		$searchParametersGroup->addFields( $searchParametersFields );

		$generalTab->addGroup( $miscGroup );
		$generalTab->addGroup( $bookingDisablingGroup );
		$generalTab->addGroup( $bookingConfirmationGroup );
		$generalTab->addGroup( $bookingCancellationGroup );
		$generalTab->addGroup( $searchParametersGroup );

		return $generalTab;
	}

	/**
	 *
	 * @return Tabs\SettingsTab
	 */
	private function _generateAdminEmailsTab(){

		$tab = new Tabs\SettingsTab( 'admin_emails', __( 'Admin Emails', 'motopress-hotel-booking' ), $this->name );

		do_action( 'mphb_generate_settings_admin_emails', $tab );

		return $tab;
	}

	/**
	 *
	 * @return Tabs\SettingsTab
	 */
	private function _generateCustomerEmailsTab(){

		$tab = new Tabs\SettingsTab( 'customer_emails', __( 'Customer Emails', 'motopress-hotel-booking' ), $this->name );

		do_action( 'mphb_generate_settings_customer_emails', $tab );

		return $tab;
	}

	/**
	 *
	 * @return Tabs\SettingsTab
	 */
	private function _generateGlobalEmailSettingsTab(){
		$tab = new Tabs\SettingsTab( 'global_emails', __( 'Email Settings', 'motopress-hotel-booking' ), $this->name );

		$emailGroup = new Groups\SettingsGroup( 'mphb_global_emails_settings_group', __( 'Email Sender Options', 'motopress-hotel-booking' ), $tab->getPseudoPageName() );

		$emailGroupFields = array(
			Fields\FieldFactory::create( 'mphb_email_from_email', array(
				'type'			 => 'email',
				'label'			 => __( 'From Email', 'motopress-hotel-booking' ),
				'default'		 => '',
				'placeholder'	 => MPHB()->settings()->emails()->getDefaultFromEmail()
			) ),
			Fields\FieldFactory::create( 'mphb_email_from_name', array(
				'type'			 => 'text',
				'label'			 => __( 'From Name', 'motopress-hotel-booking' ),
				'default'		 => '',
				'placeholder'	 => MPHB()->settings()->emails()->getDefaultFromName()
			) )
		);

		$emailGroup->addFields( $emailGroupFields );

		// Style Group
		$styleGroup = new Groups\SettingsGroup( 'mphb_global_emails_settings_style_group', __( 'Style', 'motopress-hotel-booking' ), $tab->getPseudoPageName() );

		$styleGroupFields = array(
			Fields\FieldFactory::create( 'mphb_email_logo', array(
				'type'			 => 'text',
				'label'			 => __( 'Logo Url', 'motopress-hotel-booking' ),
				'size'			 => 'large',
				'default'		 => '',
				'placeholder'	 => MPHB()->settings()->emails()->getDefaultLogoUrl()
			) ),
			Fields\FieldFactory::create( 'mphb_email_footer_text', array(
				'type'		 => 'rich-editor',
				'label'		 => __( 'Footer Text', 'motopress-hotel-booking' ),
//				'description' => __('Default: ', 'motopress-hotel-booking') . MPHB()->settings()->emails()->getDefaultFooterText(),
				'rows'		 => 3,
				'default'	 => MPHB()->settings()->emails()->getDefaultFooterText()
			) ),
			Fields\FieldFactory::create( 'mphb_email_base_color', array(
				'type'			 => 'color-picker',
				'label'			 => __( 'Base Color', 'motopress-hotel-booking' ),
				'default'		 => MPHB()->settings()->emails()->getDefaultBaseColor(),
				'placeholder'	 => MPHB()->settings()->emails()->getDefaultBaseColor()
			) ),
			Fields\FieldFactory::create( 'mphb_email_bg_color', array(
				'type'			 => 'color-picker',
				'label'			 => __( 'Background Color', 'motopress-hotel-booking' ),
				'default'		 => MPHB()->settings()->emails()->getDefaultBGColor(),
				'placeholder'	 => MPHB()->settings()->emails()->getDefaultBGColor()
			) ),
			Fields\FieldFactory::create( 'mphb_email_body_bg_color', array(
				'type'			 => 'color-picker',
				'label'			 => __( 'Body Background Color', 'motopress-hotel-booking' ),
				'default'		 => MPHB()->settings()->emails()->getDefaultBodyBGColor(),
				'placeholder'	 => MPHB()->settings()->emails()->getDefaultBodyBGColor()
			) ),
			Fields\FieldFactory::create( 'mphb_email_body_text_color', array(
				'type'			 => 'color-picker',
				'label'			 => __( 'Body Text Color', 'motopress-hotel-booking' ),
				'default'		 => MPHB()->settings()->emails()->getDefaultBodyTextColor(),
				'placeholder'	 => MPHB()->settings()->emails()->getDefaultBodyTextColor()
			) )
		);

		$styleGroup->addFields( $styleGroupFields );

		$tab->addGroup( $emailGroup );
		$tab->addGroup( $styleGroup );

		return $tab;
	}

	/**
	 *
	 * @return Tabs\SettingsTab
	 */
	private function _generateBookingRulesTab(){
		$tab = new Tabs\SettingsTab( 'booking_rules', __( 'Booking Rules', 'motopress-hotel-booking' ), $this->name );

		$globalRulesGroup = new Groups\SettingsGroup( 'mphb_global_booking_rules_group', __( 'Global Booking Rules', 'motopress-hotel-booking' ), $tab->getPseudoPageName() );

		$globalRulesGroupFields = array(
			Fields\FieldFactory::create( 'mphb_global_min_days', array(
				'type'		 => 'number',
				'label'		 => __( 'Min Days Stay', 'motopress-hotel-booking' ),
				'min'		 => 1,
				'step'		 => 1,
				'default'	 => 1
			) ),
			Fields\FieldFactory::create( 'mphb_global_max_days', array(
				'type'		 => 'number',
				'label'		 => __( 'Max Days Stay', 'motopress-hotel-booking' ),
				'min'		 => 1,
				'step'		 => 1,
				'default'	 => 15
			) ),
			Fields\FieldFactory::create( 'mphb_global_check_in_days', array(
				'type'		 => 'multiple-select',
				'label'		 => __( 'Check-in Days', 'motopress-hotel-booking' ),
				'list'		 => \MPHB\Utils\DateUtils::getDaysList(),
				'default'	 => array_keys( \MPHB\Utils\DateUtils::getDaysList() )
			) ),
			Fields\FieldFactory::create( 'mphb_global_check_out_days', array(
				'type'		 => 'multiple-select',
				'label'		 => __( 'Check-out Days', 'motopress-hotel-booking' ),
				'list'		 => \MPHB\Utils\DateUtils::getDaysList(),
				'default'	 => array_keys( \MPHB\Utils\DateUtils::getDaysList() )
			) ),
		);

		$globalRulesGroup->addFields( $globalRulesGroupFields );

		$customRulesGroup = new Groups\SettingsGroup( 'mphb_custom_booking_rules_group', __( 'Custom Booking Rules', 'motopress-hotel-booking' ), $tab->getPseudoPageName() );

		$customRulesGroupFields = array(
			Fields\FieldFactory::create( 'mphb_custom_booking_rules', array(
				'type'		 => 'complex-vertical',
				'label'		 => __( 'Custom Booking Rules', 'motopress-hotel-booking' ),
				'fields'	 => array(
					Fields\FieldFactory::create( 'title', array(
						'type'		 => 'text',
						'default'	 => '',
						'label'		 => __( 'Title', 'motopress-hotel-booking' ),
					) ),
					Fields\FieldFactory::create( 'description', array(
						'type'		 => 'textarea',
						'default'	 => '',
						'label'		 => __( 'Description', 'motopress-hotel-booking' ),
					) ),
					Fields\FieldFactory::create( 'date_from', array(
						'type'		 => 'datepicker',
						'required'	 => true,
						'label'		 => __( 'Date From', 'motopress-hotel-booking' ),
					) ),
					Fields\FieldFactory::create( 'date_to', array(
						'type'		 => 'datepicker',
						'required'	 => true,
						'label'		 => __( 'Date Till', 'motopress-hotel-booking' ),
					) ),
					Fields\FieldFactory::create( 'not_check_in', array(
						'type'			 => 'checkbox',
						'default'		 => false,
						'label'			 => __( 'Not Check-in', 'motopress-hotel-booking' ),
						'inner_label'	 => __( 'Users will not be able to check in during these dates (check-in is available before or after these days)', 'motopress-hotel-booking' ),
					) ),
					Fields\FieldFactory::create( 'not_check_out', array(
						'type'			 => 'checkbox',
						'default'		 => false,
						'label'			 => __( 'Not Check-out', 'motopress-hotel-booking' ),
						'inner_label'	 => __( 'Users will not be able to check out during these dates (check-out is available before or after these days)', 'motopress-hotel-booking' ),
					) ),
					Fields\FieldFactory::create( 'not_stay_in', array(
						'type'			 => 'checkbox',
						'default'		 => false,
						'label'			 => __( 'Not Stay-in', 'motopress-hotel-booking' ),
						'inner_label'	 => __( 'During these days accommodation is not available (best choice for complete hotel reservation or repairing)', 'motopress-hotel-booking' ),
					) ),
				),
				'default'	 => array(),
				'add_label'	 => __( 'New Booking Rule', 'motopress-hotel-booking' )
			) )
		);

		$customRulesGroup->addFields( $customRulesGroupFields );

		$tab->addGroup( $globalRulesGroup );
		$tab->addGroup( $customRulesGroup );

		return $tab;
	}

	/**
	 *
	 * @return Tabs\SettingsTab
	 */
	private function _generateLicenseTab(){
		$tab = new Tabs\SettingsTab( 'license', __( 'License', 'motopress-hotel-booking' ), $this->name );

		$licenseGroup = new Groups\LicenseSettingsGroup( 'mphb_license_group', __( 'License', 'motopress-hotel-booking' ), $tab->getPseudoPageName() );

		$tab->addGroup( $licenseGroup );

		return $tab;
	}

	public function addActions(){
		parent::addActions();
		add_action( 'admin_init', array( $this, 'initFields' ) );
		add_action( 'admin_init', array( $this, 'registerSettings' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueueAdminScripts' ) );
	}

	public function enqueueAdminScripts(){
		$screen = get_current_screen();
		if ( !is_null( $screen ) && $screen->id === $this->hookSuffix ) {
			MPHB()->getAdminScriptManager()->enqueue();
		}
	}

	public function onLoad(){
		$this->save();
	}

	public function render(){
		echo '<div class="wrap">';
		if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ) {
			add_settings_error( 'mphbSettings', esc_attr( 'settings_updated' ), __( 'Settings saved.', 'motopress-hotel-booking' ), 'updated' );
		}
		settings_errors( 'mphbSettings', false );
		$this->renderTabs();
		$tabName = $this->detectTab();
		if ( isset( $this->tabs[$tabName] ) ) {
			$this->tabs[$tabName]->render();
		}
		echo '</div>';
	}

	private function renderTabs(){
		echo '<h1 class="nav-tab-wrapper">';
		if ( is_array( $this->tabs ) ) {
			foreach ( $this->tabs as $tabId => $tab ) {
				$class = ($tabId == $this->detectTab()) ? ' nav-tab-active' : '';
				echo '<a href="' . esc_url( add_query_arg( array( 'page' => $this->name, 'tab' => $tabId ), admin_url( 'admin.php' ) ) ) . '" class="nav-tab' . $class . '">' . esc_html( $tab->getLabel() ) . '</a>';
			}
		}
		echo '</h1>';
	}

	private function detectTab(){
		$defaultTab	 = 'general';
		$tab		 = isset( $_GET['tab'] ) ? $_GET['tab'] : $defaultTab;
		return $tab;
	}

	public function save(){
		$tabName = $this->detectTab();
		if ( isset( $this->tabs[$tabName] ) && !empty( $_POST ) && current_user_can( 'manage_options' ) ) {
			$this->tabs[$tabName]->save();
		}
	}

	public function registerSettings(){
		foreach ( $this->tabs as $tab ) {
			$tab->register();
		}
	}

}
