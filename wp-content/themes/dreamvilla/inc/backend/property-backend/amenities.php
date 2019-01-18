<div id="tabs-2" style="border:none;">
	<table id="addamenities" class="table show-table-property">
		<tbody>
		<?php
		$PropertyAmenities = get_post_meta( $post->ID, 'propertyamenities', true );
		if( $PropertyAmenities ){ 
			foreach ($PropertyAmenities as $key => $value) { ?>
			<tr class="main-row">
				<td>
					<input type="text" placeholder="Amenities" name="pamenities[]" value="<?php echo esc_attr($PropertyAmenities[$key]['pamenities']); ?>" class="no-margin">
				</td>
				<td>
					<?php if( $PropertyAmenities[$key]['pamenitiesphoto'] ){ ?>
						<img src="<?php echo esc_url($PropertyAmenities[$key]['pamenitiesphoto']); ?>" height="25px" class="theme_favicon_icon" alt="amenities-icon">
					<?php } ?>
					<button type="button" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
					<input type="hidden" name="pamenitiesphoto[]" class="pbimagestore" value="<?php echo esc_attr($PropertyAmenities[$key]['pamenitiesphoto']); ?>" >
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
		} else { ?>
			<tr class="main-row">
				<td>
					<input type="text" placeholder="Amenities" name="pamenities[]" class="no-margin">
				</td>
				<td>
					<button type="button" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
					<input type="hidden" name="pamenitiesphoto[]" class="pbimagestore" value="<?php echo esc_attr("Property_Agent_Photo"); ?>" >
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