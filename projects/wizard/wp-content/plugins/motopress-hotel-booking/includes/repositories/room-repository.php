<?php

namespace MPHB\Repositories;

use \MPHB\Entities;

class RoomRepository extends AbstractPostRepository {

	function mapPostToEntity( $post ){
		$id = ( is_a( $post, '\WP_Post' ) ) ? $post->ID : $post;
		return new Entities\Room( $id );
	}

	/**
	 *
	 * @param Entities\Room $entity
	 * @return \MPHB\Entities\WPPostData
	 */
	public function mapEntityToPostData( $entity ){
		$postAtts = array(
			'ID'			 => $entity->getId(),
			'post_metas'	 => array(),
			'post_status'	 => $entity->isActive() ? 'publish' : 'draft',
			'post_title'	 => $entity->getTitle(),
			'post_content'	 => $entity->getDescription(),
			'post_type'		 => MPHB()->postTypes()->rate()->getPostType(),
		);

		$postAtts['post_metas'] = array(
			'mphb_room_type_id'	 => $entity->getRoomTypeId(),
			'mphb_season_prices' => array_reverse( $entity->getSeasonPrices() )
		);

		return new Entities\WPPostData( $postAtts );
	}

	/**
	 *
	 * @param Entities\RoomType $roomType
	 * @param int $count Optional. Number of rooms to generate. Default 1.
	 * @param string $customPrefix Optional. Default ''
	 * @return bool
	 */
	public function generateRooms( Entities\RoomType $roomType, $count = 1, $customPrefix = '' ){
		$titlePrefix = '';

		if ( !$roomType ) {
			return false;
		}

		if ( $count < 1 ) {
			return false;
		}

		if ( empty( $customPrefix ) ) {
			$titlePrefix = $roomType->getTitle() . ' ';
		} else {
			$titlePrefix = $customPrefix . ' ';
		}

		for ( $i = 1; $i <= $count; $i++ ) {
			$postMetaAtts	 = array(
				'mphb_room_type_id' => $roomType->getId(),
			);
			$postDataAtts	 = array(
				'post_metas'	 => $postMetaAtts,
				'post_title'	 => $titlePrefix . $i,
				'post_type'		 => MPHB()->postTypes()->room()->getPostType(),
				'post_status'	 => 'publish'
			);

			$postData = new Entities\WPPostData( $postDataAtts );

			$created = $this->persistence->create( $postData );
		}

		return true;
	}

	public function findAllByRoomType( $roomTypeId, $atts = array() ){
		$atts['room_type'] = $roomTypeId;
		return $this->findAll( $atts );
	}

}
