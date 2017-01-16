<?php

namespace MPHB\Emails;

use \MPHB\Library\Emogrifier;
use \MPHB\Admin\Fields;
use \MPHB\Admin\Groups;
use \MPHB\Admin\Tabs;

abstract class AbstractEmail {

	/**
	 *
	 * @var string
	 */
	protected $id;

	/**
	 *
	 * @var string
	 */
	protected $label;

	/**
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 *
	 * @var bool
	 */
	protected $active;

	/**
	 *
	 * @var string
	 */
	protected $defaultSubject = '';

	/**
	 *
	 * @var string
	 */
	protected $defaultHeaderText = '';

	/**
	 *
	 * @var \MPHB\Entities\Booking
	 */
	protected $booking;

	/**
	 *
	 * @var EmailTemplater
	 */
	protected $templater;

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

		$this->id	 = $args['id'];
		$this->label = $args['label'];

		if ( isset( $args['description'] ) ) {
			$this->description = $args['description'];
		}

		if ( isset( $args['default_subject'] ) ) {
			$this->defaultSubject = $args['default_subject'];
		}

		if ( isset( $args['default_header_text'] ) ) {
			$this->defaultHeaderText = $args['default_header_text'];
		}

		$this->templater = $templater;
	}

	/**
	 * Send Mail
	 */
	public function send(){
		return MPHB()->emails()->getMailer()->send(
				$this->getReceiver(), $this->getSubject(), $this->getMessage()
		);
	}

	/**
	 *
	 * @param \MPHB\Entities\Booking $booking
	 * @return bool
	 */
	public function trigger( \MPHB\Entities\Booking $booking ){
		if ( $this->isDisabled() ) {
			return false;
		}

		$this->booking = $booking;

		$isSended = $this->send();

		$this->log( $isSended );

		return $isSended;
	}

	/**
	 *
	 * @return string
	 */
	protected function getSubject(){
		$subject = get_option( 'mphb_email_' . $this->id . '_subject', '' );

		if ( empty( $subject ) ) {
			$subject = $this->getDefaultSubject();
		}

		$subject = $this->replaceTags( $subject );

		return $subject;
	}

	/**
	 *
	 * @return string
	 */
	protected function getMessage(){
		$message = $this->getMessageHeader();
		$message .= $this->getMessageContent();
		$message .= $this->getMessageFooter();

		$message = $this->applyStyles( $message );

		return $message;
	}

	/**
	 * Applies styles for mail html.
	 *
	 * @param string $html HTML of mail.
	 * @return string
	 */
	protected function applyStyles( $html ){
		// make sure we only inline CSS for html emails
		ob_start();
		require MPHB()->getPluginPath( 'includes/emails/templates/email-styles.php' );
		$styles = ob_get_clean();

		// apply CSS styles inline for picky email clients
		$emogrifier	 = new Emogrifier\Emogrifier( $html, $styles );
		$html		 = $emogrifier->emogrify();

		return $html;
	}

	/**
	 *
	 * @return string
	 */
	protected function getMessageHeader(){
		ob_start();
		$headerText	 = $this->getMessageHeaderText();
		require MPHB()->getPluginPath( 'includes/emails/templates/email-header.php' );
		$header		 = ob_get_contents();
		ob_end_clean();
		return $header;
	}

	/**
	 *
	 * @return string
	 */
	protected function getMessageContent(){
		$template	 = $this->getMessageTemplate();
		$content	 = $this->replaceTags( $template );
		return $content;
	}

	/**
	 *
	 * @return string
	 */
	protected function getMessageTemplate(){
		$template = get_option( 'mphb_email_' . $this->id . '_content', '' );

		if ( empty( $template ) ) {
			$template = $this->getDefaultMessageTemplate();
		}

		return $template;
	}

	/**
	 *
	 * @return string
	 */
	protected function getMessageHeaderText(){
		$headerText = get_option( 'mphb_email_' . $this->id . '_header', '' );

		if ( empty( $headerText ) ) {
			$headerText = $this->defaultHeaderText;
		}

		$headerText = $this->replaceTags( $headerText );

		return $headerText;
	}

	/**
	 *
	 * @return string
	 */
	protected function getMessageFooter(){
		ob_start();
		$footerText	 = $this->getMessageFooterText();
		require MPHB()->getPluginPath( 'includes/emails/templates/email-footer.php' );
		$footer		 = ob_get_contents();
		ob_end_clean();
		return $footer;
	}

	/**
	 *
	 * @return string
	 */
	protected function getMessageFooterText(){
		return MPHB()->settings()->emails()->getFooterText();
	}

	/**
	 *
	 * @param string $template
	 * @return string
	 */
	protected function replaceTags( $template ){
		return $this->templater->replaceTags( $template, $this->booking );
	}

	/**
	 *
	 * @return string
	 */
	public function getDefaultMessageTemplate(){
		$templateName = str_replace( '_', '-', $this->id );
		ob_start();
		mphb_get_template_part( 'emails/' . $templateName );
		return ob_get_clean();
	}

	/**
	 *
	 * @return string
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 *
	 * @return bool
	 */
	public function isDisabled(){
		$disableOption = get_option( 'mphb_email_' . $this->id . '_disable', false );
		return filter_var( $disableOption, \FILTER_VALIDATE_BOOLEAN );
	}

	/**
	 *
	 * @return string
	 */
	public function getLabel(){
		return $this->label;
	}

	/**
	 *
	 * @return string
	 */
	public function getDescription(){
		return $this->description;
	}

	/**
	 *
	 * @return string
	 */
	public function getDefaultSubject(){
		return $this->defaultSubject;
	}

	/**
	 *
	 * @return string
	 */
	public function getDefaultMessageHeaderText(){
		return $this->defaultHeaderText;
	}

	/**
	 *
	 * @param Tabs\SettingsTab $tab
	 */
	public function generateSettingsFields( Tabs\SettingsTab $tab ){
		$optionPrefix	 = 'mphb_email_' . $this->id;
		$group			 = new Groups\SettingsGroup(
			$optionPrefix, $this->label, $tab->getPseudoPageName(), $this->description . '<br/><br/>' . $this->templater->getTagsDescription()
		);

		$disableField = Fields\FieldFactory::create( $optionPrefix . '_disable', array(
				'type'			 => 'checkbox',
				'inner_label'	 => __( 'Disable this email notification', 'motopress-hotel-booking' )
			) );

		$subjectField = Fields\FieldFactory::create( $optionPrefix . '_subject', array(
				'type'			 => 'text',
				'label'			 => __( 'Subject', 'motopress-hotel-booking' ),
				'default'		 => '',
				'placeholder'	 => $this->getDefaultSubject(),
				'size'			 => 'large'
			) );

		$headerField = Fields\FieldFactory::create( $optionPrefix . '_header', array(
				'type'			 => 'text',
				'label'			 => __( 'Header', 'motopress-hotel-booking' ),
				'default'		 => '',
				'placeholder'	 => $this->getDefaultMessageHeaderText(),
				'size'			 => 'large'
			) );

		$contentField = Fields\FieldFactory::create( $optionPrefix . '_content', array(
				'type'		 => 'rich-editor',
				'label'		 => __( 'Email Template', 'motopress-hotel-booking' ),
				'rows'		 => 24,
				'default'	 => $this->getDefaultMessageTemplate()
			) );

		$group->addField( $disableField );
		$group->addField( $subjectField );
		$group->addField( $headerField );
		$group->addField( $contentField );

		$tab->addGroup( $group );
	}

	abstract protected function getReceiver();

	abstract protected function log( $isSended );
}
