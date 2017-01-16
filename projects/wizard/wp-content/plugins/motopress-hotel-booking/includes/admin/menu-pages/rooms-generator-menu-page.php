<?php

namespace MPHB\Admin\MenuPages;

class RoomsGeneratorMenuPage extends AbstractMenuPage {

	private $nonceName;
	private $nonceAction;

	const NONCE_NAME				 = 'mphb-generate-rooms-nonce';
	const NONCE_ACTION_GENERATE	 = 'mphb-generate-rooms';

	public function render(){
		$this->showNotices();
		$roomTypeId	 = isset( $_GET['mphb_room_type_id'] ) ? $_GET['mphb_room_type_id'] : '';
		?>
		<h1><?php _e( 'Generate Rooms', 'motopress-hotel-booking' ); ?></h1>
		<form method="POST">
			<?php wp_nonce_field( $this->nonceAction, $this->nonceName ); ?>
			<table class="form-table">
				<tbody>
					<tr>
						<th>
							<label><?php _e( 'Number of rooms', 'motopress-hotel-booking' ); ?></label>
						</th>
						<td>
							<input name="mphb_rooms_count" type="number" class="small-text" required="required" min="1" step="1" value="1"/>
						</td>
					</tr>
					<tr>
						<th>
							<label><?php _e( 'Room Type', 'motopress-hotel-booking' ); ?></label>
						</th>
						<td>
							<select name="mphb_room_type_id" required="required">
								<option value=""><?php _e( '— Select —', 'motopress-hotel-booking' ); ?></option>
								<?php
								$roomTypes = MPHB()->getRoomTypeRepository()->getIdTitleList();

								foreach ( $roomTypes as $id => $title ) {
									?>
									<option value="<?php echo $id; ?>" <?php selected( $roomTypeId, $id ); ?>><?php echo $title; ?></option>
									<?php
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							<label><?php _e( 'Title', 'motopress-hotel-booking' ); ?></label>
						</th>
						<td>
							<input name="mphb_room_title_prefix" type="text" class="regular-text" />
							<p class="description"><?php _e( 'Leave empty to use Room type title.', 'motopress-hotel-booking' ); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<?php submit_button( __( 'Generate', 'motoress-hotel-booking' ) ) ?>
		</form>
		<?php
	}

	public function showNotices(){
		if ( isset( $_GET['mphb-rooms-generated'] ) ) {
			$number		 = isset( $_GET['mphb-rooms-count'] ) ? absint( $_GET['mphb-rooms-count'] ) : 0;
			$message	 = sprintf( _n( 'Room generated.', '%s rooms generated.', $number, 'motopress-hotel-booking' ), number_format_i18n( $number ) );
			$linkArgs	 = array(
				'orderby'	 => 'date',
				'order'		 => 'desc'
			);
			if ( isset( $_GET['mphb_room_type_id'] ) ) {
				$linkArgs['mphb_room_type_id'] = $_GET['mphb_room_type_id'];
			}
			$viewUrl = MPHB()->postTypes()->room()->getManagePostsLink( $linkArgs );
			$message .= ' ' . sprintf( '<a href="%s">%s</a>', $viewUrl, __( 'View', 'motopress-hotel-booking' ) );
			echo '<div class="updated"><p>' . $message . '</p></div>';
		}
	}

	public function onLoad(){

		$this->nonceName	 = $this->name . '_nonce';
		$this->nonceAction	 = $this->name . '_generate_rooms';

		if ( $this->checkSaveNonce() ) {
			$this->save();
		}
	}

	public function save(){

		if ( empty( $_POST['mphb_room_type_id'] ) || empty( $_POST['mphb_rooms_count'] ) ) {
			return false;
		}

		$roomType	 = MPHB()->getRoomTypeRepository()->findById( absint( $_POST['mphb_room_type_id'] ) );
		$roomsCount	 = absint( $_POST['mphb_rooms_count'] ) > 0 ? absint( $_POST['mphb_rooms_count'] ) : 1;
		$titlePrefix = !empty( $_POST['mphb_room_title_prefix'] ) ? sanitize_title( $_POST['mphb_room_title_prefix'] ) : false;

		$generated = MPHB()->getRoomRepository()->generateRooms( $roomType, $roomsCount, $titlePrefix );

		if ( $generated ) {

			$sendbackArgs = array(
				'mphb-rooms-generated'	 => true,
				'mphb-rooms-count'		 => $roomsCount,
				'mphb_room_type_id'		 => $roomType->getId()
			);

			$sendbackUrl = $this->getUrl();
			$sendback	 = add_query_arg( $sendbackArgs, $sendbackUrl );

			wp_redirect( esc_url_raw( $sendback ) );
			exit();
		}
	}

	public function checkSaveNonce(){
		return isset( $_POST[$this->nonceName] ) && wp_verify_nonce( $_POST[$this->nonceName], $this->nonceAction );
	}

	public function getUrl( $additionalArgs = array() ){
		$adminUrl	 = admin_url( 'edit.php' );
		$args		 = array_merge( array(
			'page'		 => $this->getName(),
			'post_type'	 => MPHB()->postTypes()->roomType()->getPostType()
			), $additionalArgs );
		$url		 = add_query_arg( $args, $adminUrl );
		return $url;
	}

}
