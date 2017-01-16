<?php

namespace MPHB\Persistences;

class RoomTypePersistence extends CPTPersistence {

	/**
	 *
	 * @return array
	 */
	protected function getDefaultQueryAtts(){
		$defaultAtts = parent::getDefaultQueryAtts();

		$defaultAtts['orderby']	 = 'menu_order';
		$defaultAtts['order']	 = 'ASC';
		return $defaultAtts;
	}

}
