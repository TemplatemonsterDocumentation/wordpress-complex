<?php

namespace MPHB\Admin\EditCPTPages;

class RateEditCPTPage extends EditCPTPage {

	public function customizeMetaBoxes(){
		remove_meta_box( 'submitdiv', $this->postType, 'side' );

		add_meta_box( 'submitdiv', __( 'Update Rate', 'motopress-hotel-booking' ), array( $this, 'renderSubmitMetaBox' ), $this->postType, 'side' );
	}

	public function renderSubmitMetaBox( $post, $metabox ){
		$postTypeObject	 = get_post_type_object( $this->postType );
		$can_publish	 = current_user_can( $postTypeObject->cap->publish_posts );
		$postStatus		 = get_post_status( $post->ID );

		if ( $postStatus === 'auto-draft' ) {
			$postStatus = 'draft';
		}

		if ( $this->isCurrentAddNewPage() ) {
			$postStatus = 'publish';
		}

		$availableStatuses = array(
			'publish'	 => __( 'Active', 'motopress-hotel-booking' ),
			'draft'		 => __( 'Disabled', 'motopress-hotel-booking' )
		);
		?>
		<div class="submitbox" id="submitpost">
			<div id="minor-publishing">
				<div id="minor-publishing-actions">
				</div>
				<div id="misc-publishing-actions">
					<div class="misc-pub-section">
						<label for="mphb_post_status">Status:</label>
						<select name="mphb_post_status" id="mphb_post_status">
							<?php foreach ( $availableStatuses as $statusName => $statusLabel ) { ?>
								<option value="<?php echo $statusName; ?>" <?php selected( $statusName, $postStatus ); ?>><?php echo $statusLabel; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="misc-pub-section">
						<span><?php _e( 'Created on:', 'motopress-hotel-booking' ); ?></span>
						<strong><?php echo date_i18n( MPHB()->settings()->dateTime()->getDateTimeFormatWP( ' @ ' ), strtotime( $post->post_date ) ); ?></strong>
					</div>
				</div>
			</div>
			<div id="major-publishing-actions">
				<div id="delete-action">
					<?php
					if ( current_user_can( "delete_post", $post->ID ) ) {
						if ( !EMPTY_TRASH_DAYS ) {
							$delete_text = __( 'Delete Permanently', 'motopress-hotel-booking' );
						} else {
							$delete_text = __( 'Move to Trash', 'motopress-hotel-booking' );
						}
						?>
						<a class="submitdelete deletion" href="<?php echo get_delete_post_link( $post->ID ); ?>"><?php echo $delete_text; ?></a>
					<?php } ?>
				</div>
				<div id="publishing-action">
					<span class="spinner"></span>
					<input name="original_publish" type="hidden" id="original_publish" value="<?php esc_attr_e( 'Update Rate', 'motopress-hotel-booking' ); ?>" />
					<input name="save" type="submit" class="button button-primary button-large" id="publish" accesskey="p" value="<?php
					in_array( $post->post_status, array( 'new', 'auto-draft' ) ) ? esc_attr_e( 'Create Rate', 'motopress-hotel-booking' ) : esc_attr_e( 'Update Rate', 'motopress-hotel-booking' );
					?>" />
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?php
	}

	public function saveMetaBoxes( $postId, $post, $update ){
		$success = parent::saveMetaBoxes( $postId, $post, $update );

		if ( !$success ) {
			return false;
		}

		$availableStatuses = array( 'draft', 'publish' );

		$status = isset( $_POST['mphb_post_status'] ) && in_array( $_POST['mphb_post_status'], $availableStatuses ) ? $_POST['mphb_post_status'] : '';
		if ( $status ) {
			wp_update_post( array(
				'ID'			 => $postId,
				'post_status'	 => $status
			) );
		}
	}

}
