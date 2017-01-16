<?php

namespace MPHB\Repositories;

use \MPHB\Entities;

class SeasonRepository extends AbstractPostRepository {

	/**
	 *
	 * @param array $atts
	 * @return Entities\Season[]
	 */
	public function findAll( $atts = array() ){
		return parent::findAll( $atts );
	}

	/**
	 *
	 * @param int $id
	 * @return Entities\Season|null
	 */
	public function findById( $id ){
		return parent::findById( $id );
	}

	public function mapPostToEntity( $post ){

		$id = ( is_a( $post, '\WP_Post' ) ) ? $post->ID : $post;

		$seasonArgs = array(
			'id'			 => $id,
			'title'			 => get_the_title( $id ),
			'description'	 => get_post_field( 'post_content', $id ),
			'start_date'	 => \DateTime::createFromFormat( 'Y-m-d', get_post_meta( $id, 'mphb_start_date', true ) ),
			'end_date'		 => \DateTime::createFromFormat( 'Y-m-d', get_post_meta( $id, 'mphb_end_date', true ) ),
			'days'			 => get_post_meta( $id, 'mphb_days', true )
		);

		return new Entities\Season( $seasonArgs );
	}

	public function mapEntityToPostData( $entity ){
		// @todo
	}

}
