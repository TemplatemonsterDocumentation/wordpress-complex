<?php

namespace MPHB\Entities;

class Room {

	private $id;
	private $post;

	/**
	 *
	 * @param int|\WP_POST $id
	 */
	public function __construct( $post ){
		if ( is_a( $post, '\WP_Post' ) ) {
			$this->post	 = $post;
			$this->id	 = $post->ID;
		} else {
			$this->id	 = absint( $post );
			$this->post	 = get_post( $this->id );
		}
	}

	/**
	 *
	 * @return int
	 */
	public function getRoomTypeId(){
		return absint( get_post_meta( $this->id, 'mphb_room_type_id', true ) );
	}

	/**
	 *
	 * @return RoomType
	 */
	public function getRoomType(){
		$roomType = new RoomType( $this->getRoomTypeId() );
		return $roomType;
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
	 * @return string
	 */
	public function getTitle(){
		return get_the_title( $this->id );
	}

	/**
	 * Retrieve link for room post.
	 *
	 * @return string|false
	 */
	public function getLink(){
		return get_permalink( $this->id );
	}

	/**
	 *
	 * @return string|null
	 */
	public function getEditLink(){
		return get_edit_post_link( $this->id );
	}

}
