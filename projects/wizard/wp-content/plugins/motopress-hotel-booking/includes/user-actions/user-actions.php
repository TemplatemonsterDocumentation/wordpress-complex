<?php

namespace MPHB\UserActions;

class UserActions {

	private $actionLinkHelper;
	private $bookingCancellationAction;
	private $bookingConfirmationAction;

	public function __construct(){
		$this->actionLinkHelper			 = new ActionLinkHelper();
		$this->bookingCancellationAction = new BookingCancellationAction();
		$this->bookingConfirmationAction = new BookingConfirmationAction();
	}

	/**
	 *
	 * @return ActionLinkHelper
	 */
	public function getActionLinkHelper(){
		return $this->actionLinkHelper;
	}

	/**
	 *
	 * @return BookingCancellationAction
	 */
	public function getBookingCancellationAction(){
		return $this->bookingCancellationAction;
	}

	/**
	 *
	 * @return BookingConfirmationAction
	 */
	public function getBookingConfirmationAction(){
		return $this->bookingConfirmationAction;
	}

}
