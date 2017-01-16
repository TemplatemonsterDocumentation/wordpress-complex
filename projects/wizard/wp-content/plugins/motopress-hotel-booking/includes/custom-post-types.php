<?php

namespace MPHB;

use \MPHB\PostType;

class CustomPostTypes {

	/**
	 *
	 * @var PostTypes\RoomTypeCPT
	 */
	private $roomType;

	/**
	 *
	 * @var PostTypes\RoomCPT
	 */
	private $room;

	/**
	 *
	 * @var PostTypes\ServiceCPT
	 */
	private $service;

	/**
	 *
	 * @var PostTypes\BookingCPT
	 */
	private $booking;

	/**
	 *
	 * @var PostTypes\SeasonCPT
	 */
	private $season;

	/**
	 *
	 * @var PostTypes\RateCPT
	 */
	private $rate;

	public function __construct(){
		$this->booking	 = new PostTypes\BookingCPT();
		$this->roomType	 = new PostTypes\RoomTypeCPT();
		$this->season	 = new PostTypes\SeasonCPT();
		$this->rate		 = new PostTypes\RateCPT();
		$this->service	 = new PostTypes\ServiceCPT();
		$this->room		 = new PostTypes\RoomCPT();
	}


	public function roomType(){
		return $this->roomType;
	}

	public function room(){
		return $this->room;
	}

	public function service(){
		return $this->service;
	}

	public function booking(){
		return $this->booking;
	}

	public function season(){
		return $this->season;
	}

	public function rate(){
		return $this->rate;
	}

}
