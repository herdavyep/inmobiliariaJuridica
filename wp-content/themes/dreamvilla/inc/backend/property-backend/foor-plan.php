<div id="tabs-13" style="border:none;">
	<table id="addfloorplans" class="table show-table-property">
		<tbody>
		<?php
		$PropertyFloors = get_post_meta( $post->ID, 'propertyfloors', true );
		if( $PropertyFloors ){
			foreach ($PropertyFloors as $key => $value) { ?>
			<tr class="main-row">
				<td>
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<input type="text" placeholder="Floor title" name="floortitle[]" value="<?php echo esc_attr($PropertyFloors[$key]['floortitle']); ?>">
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<input type="text" placeholder="Price" name="floorprice[]" value="<?php echo esc_attr($PropertyFloors[$key]['floorprice']); ?>">
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<input type="text" placeholder="Squre Foot" name="floorsqrt[]" value="<?php echo esc_attr($PropertyFloors[$key]['floorsqrt']); ?>">
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<input type="text" placeholder="Bedrooms" name="floorbedrooms[]" value="<?php echo esc_attr($PropertyFloors[$key]['floorbedrooms']); ?>">
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<input type="text" placeholder="Bathrooms" name="floorbathrooms[]" value="<?php echo esc_attr($PropertyFloors[$key]['floorbathrooms']); ?>">
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<textarea placeholder="Detail" name="floordetail[]"><?php echo esc_textarea($PropertyFloors[$key]['floordetail']); ?></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<?php if( $PropertyFloors[$key]['floorplanimage'] ){ ?>
								<img src="<?php echo esc_attr($PropertyFloors[$key]['floorplanimage']); ?>" height="25px" class="theme_favicon_icon" alt="slider">
							<?php } ?>
							<button type="button" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
							<input type="hidden" name="floorplanimage[]" class="pbimagestore" value="<?php echo esc_attr($PropertyFloors[$key]['floorplanimage']); ?>" >
						</div>
					</div>
				</td>
				<td>
					<button style="display: none;" class="btn btn-default removebedroom" type="button">
						<span class="glyphicon glyphicon-remove"></span>
					</button>
					<button class="btn btn-default addmorebedroombtn" type="button">
						<span class="glyphicon glyphicon-plus"></span>
					</button>
				</td>
			</tr>
		<?php }
		} else {?>
			<tr class="main-row">
				<td>
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<input type="text" placeholder="Floor title" name="floortitle[]">
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<input type="text" placeholder="Price" name="floorprice[]">
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<input type="text" placeholder="Squre Foot" name="floorsqrt[]">
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<input type="text" placeholder="Bedrooms" name="floorbedrooms[]">
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<input type="text" placeholder="Bathrooms" name="floorbathrooms[]">
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<textarea placeholder="Detail" name="floordetail[]"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<button type="button" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
							<input type="hidden" name="floorplanimage[]" class="pbimagestore">
						</div>
					</div>
				</td>
				<td>
					<button style="display: none;" class="btn btn-default removebedroom" type="button">
						<span class="glyphicon glyphicon-remove"></span>
					</button>
					<button class="btn btn-default addmorebedroombtn" type="button">
						<span class="glyphicon glyphicon-plus"></span>
					</button>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>