<?php

namespace MPHB\Persistences;

class CPTPersistence {

	protected $postType;

	public function __construct( $postType ){
		$this->postType = $postType;
	}

	/**
	 *
	 * @param array $atts
	 */
	public function getPosts( $atts = array() ){

		$defaultAtts = $this->getDefaultQueryAtts();

		$atts = array_merge( $defaultAtts, $atts );

		$atts = $this->modifyQueryAtts( $atts );

		$atts['ignore_sticky_posts'] = true;
		$atts['suppress_filters']	 = false;

		if ( isset( $atts['meta_query'] ) AND MPHB()->isWPVersion( '4.1', '<' ) ) {

			$metaQuery = $atts['meta_query'];

			$atts['mphb_fix_meta_query'] = true;
			$atts['mphb_meta_query']	 = $metaQuery;

			unset( $atts['meta_query'] );
		}

		return get_posts( $atts );
	}

	/**
	 *
	 * @param array $atts
	 * @return int
	 */
	public function getCount( $atts = array() ){
		$atts['fields']			 = 'ids';
		$atts['posts_per_page']	 = -1;

		return count( $this->getPosts( $atts ) );
	}

	public function getPost( $id ){
		$post = get_post( $id );
		return $post && $post->post_type === $this->postType ? $post : null;
	}

	/**
	 * Insert Post to DB
	 *
	 * @param array $postAttrs Attributes of post
	 * @return int The post ID on success. The value 0 on failure.
	 */
	public function create( \MPHB\Entities\WPPostData $postData ){

		$postId = wp_insert_post( $postData->getPostAtts() );

		if ( $postId ) {
			$postData->setID( $postId );
			$this->updatePostRelatedData( $postData );
		}

		return $postId;
	}

	/**
	 *
	 * @param \MPHB\Entities\WPPostData $postData
	 */
	protected function updatePostRelatedData( \MPHB\Entities\WPPostData $postData ){
		foreach ( $postData->getPostMetas() as $postMetaName => $postMetaValue ) {
			if ( !is_null( $postMetaValue ) ) {
				update_post_meta( $postData->getID(), $postMetaName, $postMetaValue );
			} else {
				delete_post_meta( $postData->getID(), $postMetaName );
			}
		}
		if ( $postData->hasFeaturedImage() ) {
			$featuredImage = $postData->getFeaturedImage();
			if ( $featuredImage ) {
				set_post_thumbnail( $postData->getID(), $postData['thumbnail'] );
			} else {
				delete_post_thumbnail( $postData->getID() );
			}
		}
		foreach ( $postData->getTaxonomies() as $taxName => $terms ) {
			wp_set_post_terms( $postData->getID(), $terms, $taxName );
		}
	}

	/**
	 *
	 * @param \MPHB\Entities\WPPostData $postData
	 * @return int
	 */
	public function update( \MPHB\Entities\WPPostData $postData ){
		wp_update_post( $postData->getPostAtts() );
		$this->updatePostRelatedData( $postData );
		return $postData->getID();
	}

	/**
	 *
	 * @param \MPHB\Entities\WPPostData $postData
	 * @return int
	 */
	public function createOrUpdate( \MPHB\Entities\WPPostData $postData ){
		return $postData->hasID() ? $this->update( $postData ) : $this->create( $postData );
	}

	/**
	 *
	 * @param array $atts
	 * @return array
	 */
	protected function modifyQueryAtts( $atts ){
		$atts['post_type'] = $this->postType;
		return $atts;
	}

	/**
	 *
	 * @return array
	 */
	protected function getDefaultQueryAtts(){
		return array(
			'posts_per_page' => -1,
			'post_status'	 => array(
				'publish'
			),
			'post_type'		 => $this->postType,
			'fields'		 => 'ids'
		);
	}

	/**
	 *
	 * @param array $posts
	 */
	public function convertToIdTitleList( $posts ){
		$list = array();

		foreach ( $posts as $post ) {
			if ( !is_a( $post, '\WP_Post' ) ) {
				$post = get_post( $post );
			}

			if ( is_null( $post ) ) {
				continue;
			}

			$list[$post->ID] = $post->post_title;
		}
		return $list;
	}

}
