<?php

namespace MPHB\Repositories;

use \MPHB\Entities;

class RoomTypeRepository extends AbstractPostRepository {

	public function mapEntityToPostData( $entity ){
		// @todo
	}

	function mapPostToEntity( $post ){
		$id = ( is_a( $post, '\WP_Post' ) ) ? $post->ID : $post;
		return new Entities\RoomType( $id );
	}

	public function getIdTitleList( $atts = array() ){

		$defaults = array(
			'fields'		 => 'default',
//			'orderby'		 => 'ID',
//			'order'			 => 'ASC',
			'post_status'	 => array( 'publish', 'pending', 'draft', 'future', 'private' )
		);

		$atts = array_merge( $defaults, $atts );

		$posts = $this->persistence->getPosts( $atts );

		$list = array();
		foreach ( $posts as $post ) {
			$list[$post->ID] = $post->post_title;
		}
		return $list;
	}

}
