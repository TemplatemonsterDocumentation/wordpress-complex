<?php

namespace MPHB\Repositories;

use \MPHB\Persistences;

abstract class AbstractPostRepository {

	/**
	 *
	 * @var Persistences\CPTPersistence
	 */
	protected $persistence;

	public function __construct( Persistences\CPTPersistence $persistence ){
		$this->persistence = $persistence;
	}

	/**
	 *
	 * @param int $id
	 * @return Entities\Rate|null
	 */
	public function findById( $id ){

		$post = $this->persistence->getPost( $id );

		return !is_null( $post ) ? $this->mapPostToEntity( $post ) : null;
	}

	/**
	 *
	 * @param array $atts
	 * @return Entities\Rate[]
	 */
	public function findAll( $atts = array() ){

		$posts = $this->persistence->getPosts( $atts );

		$entities = array_map( array( $this, 'mapPostToEntity' ), $posts );

		$entities = array_filter( $entities );

		return $entities;
	}

	public function save( $entity ){

		$postData = $this->mapEntityToPostData( $entity );

		return $this->persistence->createOrUpdate( $postData );
	}

	abstract function mapPostToEntity( $post );

	/**
	 * @return \MPHB\Entities\WPPostData
	 */
	abstract function mapEntityToPostData( $entity );
}
