<?php

namespace MPHB\Views;

class RoomTypeView {

	const TEMPLATE_CONTEXT = '';

	public static function renderTitle(){
		mphb_get_template_part( static::TEMPLATE_CONTEXT . '/title' );
	}

	public static function renderExcerpt(){
		mphb_get_template_part( static::TEMPLATE_CONTEXT . '/excerpt' );
	}

	public static function renderDescription(){
		mphb_get_template_part( static::TEMPLATE_CONTEXT . '/description' );
	}

	public static function renderFeaturedImage(){
		mphb_get_template_part( static::TEMPLATE_CONTEXT . '/featured-image' );
	}

	public static function renderGallery(){
		$templateAtts = array(
			'galleryIds' => MPHB()->getCurrentRoomType()->getGalleryIds()
		);
		mphb_get_template_part( static::TEMPLATE_CONTEXT . '/gallery', $templateAtts );
	}

	public static function renderBedType(){
		mphb_get_template_part( static::TEMPLATE_CONTEXT . '/attributes/bedType' );
	}

	public static function renderCategories(){

		$templateAtts = array(
			'categories' => MPHB()->getCurrentRoomType()->getCategoriesArray()
		);

		mphb_get_template_part( static::TEMPLATE_CONTEXT . '/attributes/categories', $templateAtts );
	}

	public static function renderFacilities(){
		$templateAtts = array(
			'facilities' => MPHB()->getCurrentRoomType()->getFacilitiesArray()
		);
		mphb_get_template_part( static::TEMPLATE_CONTEXT . '/attributes/facilities', $templateAtts );
	}

	public static function renderView(){
		mphb_get_template_part( static::TEMPLATE_CONTEXT . '/attributes/view' );
	}

	public static function renderSize(){
		mphb_get_template_part( static::TEMPLATE_CONTEXT . '/attributes/size' );
	}

	public static function renderAdults(){
		mphb_get_template_part( static::TEMPLATE_CONTEXT . '/attributes/adults' );
	}

	public static function renderChildren(){
		mphb_get_template_part( static::TEMPLATE_CONTEXT . '/attributes/children' );
	}

	public static function renderPrice(){
		mphb_get_template_part( static::TEMPLATE_CONTEXT . '/price' );
	}

	/**
	 *
	 * @param \MPHB\Entities\RoomRate $rate
	 * @param string $checkInDate date in format 'Y-m-d'
	 * @param string $checkOutDate date in format 'Y-m-d'
	 */
	public static function renderPriceBreakdown( $rate, $checkInDate, $checkOutDate ){
		$priceBreakdown = $rate->getPriceBreakdown( $checkInDate, $checkOutDate );
		if ( !empty( $priceBreakdown ) ) :
			?>
			<table class="mphb-price-breakdown">
				<thead>
					<tr>
						<th>
							<?php _e( 'Date', 'motopress-hotel-booking' ); ?>
						</th>
						<th>
							<?php _e( 'Price', 'motopress-hotel-booking' ); ?>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ( $priceBreakdown as $date => $price ) :
						?>
						<tr>
							<td>
								<?php
								$dateObj = \DateTime::createFromFormat( 'Y-m-d', $date );
								echo $dateObj ? \MPHB\Utils\DateUtils::formatDateWPFront( $dateObj ) : '';
								?>
							</td>
							<td>
								<?php echo mphb_format_price( $price ); ?>
							</td>
						</tr>
						<?php
					endforeach;
					?>
				</tbody>
				<tfoot>
					<tr>
						<th>
							<?php _e( 'Total Room Price', 'motopress-hotel-booking' ); ?>
						</th>
						<td>
							<?php
							$totalPrice = $rate->calcPrice( $checkInDate, $checkOutDate );
							echo mphb_format_price( $totalPrice );
							?>
						</td>
					</tr>
				</tfoot>
			</table>
			<?php
		endif;
	}

	public static function renderAttributes(){
		mphb_get_template_part( static::TEMPLATE_CONTEXT . '/attributes' );
	}

}
