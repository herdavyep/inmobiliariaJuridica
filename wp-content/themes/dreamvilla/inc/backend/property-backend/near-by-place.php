<div id="tabs-11" class="google_place" style="border:none;">
	<div id="theme-option-other-tab" class="row">					
		<table id="nearbyplaces" class="table show-table-property">
			<tbody><?php
			$Near_By_Place = get_post_meta( $post->ID, 'google_near_by_place', true );
			if( $Near_By_Place ){
				foreach ($Near_By_Place as $Near_By_Place_Key => $Near_By_Place_Value) { ?>
				<tr class="main-row">
					<td>
						<select name="google_near_by_place_type[]">
							<option value="">Select</option><?php
							$google_places = dreamvilla_mp_google_places();
							foreach ($google_places as $key => $value) { ?>
								<option value="<?php echo esc_attr($key); ?>" <?php if( $Near_By_Place[$Near_By_Place_Key]['google_near_by_place_type'] == $key ){ echo "selected=selected"; } ?> ><?php echo esc_html($value); ?></option><?php
							} ?>
						</select>										
					</td>
					<td>
						<input type="text" placeholder="Place Label" name="google_near_by_place_label[]" value="<?php echo esc_attr($Near_By_Place[$Near_By_Place_Key]['google_near_by_place_label']); ?>" class="no-margin" size="15">
					</td>
					<td>
						<?php if( $Near_By_Place[$Near_By_Place_Key]['google_near_by_place_icon'] ){ ?>
							<img src="<?php echo esc_attr($Near_By_Place[$Near_By_Place_Key]['google_near_by_place_icon']); ?>" height="25px" class="theme_favicon_icon" alt="amenities-icon">
						<?php } ?>
						<button type="button" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
						<input type="hidden" name="google_near_by_place_icon[]" class="pbimagestore" value="<?php echo esc_attr($Near_By_Place[$Near_By_Place_Key]['google_near_by_place_icon']); ?>" >
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
						<select name="google_near_by_place_type[]">
							<option value="">Select</option><?php
							$google_places = dreamvilla_mp_google_places();
							foreach ($google_places as $key => $value) { ?>
								<option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option><?php
							} ?>										
						</select>
					</td>
					<td>
						<input type="text" placeholder="Place Label" name="google_near_by_place_label[]" class="no-margin" size="15" >
					</td>
					<td>
						<button type="button" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
						<input type="hidden" name="google_near_by_place_icon[]" class="pbimagestore" value="" >
					</td>
					<td>
						<button style="display: none;" class="btn btn-default removebedroom" type="button">
							<span class="glyphicon glyphicon-remove"></span>
						</button>
						<button class="btn btn-default addmorebedroombtn" type="button">
							<span class="glyphicon glyphicon-plus"></span>
						</button>
					</td>
				</tr><?php 
			} ?>
		</tbody>
	</table>
	<div class="col-xs-12 col-sm-12 col-md-12">
			<label><?php echo esc_html_e( 'Enter your custom near by places as per your choice.', 'dreamvilla-multiple-property'); ?></label>
		</div>
		<table id="nearbycustomplaces" class="table show-table-property">
			<tbody>
				<?php
					$Near_By_Custom_Place = get_post_meta( $post->ID, 'google_near_by_custom_place', true );
					if( $Near_By_Custom_Place ){
						foreach ($Near_By_Custom_Place as $Near_By_Custom_Place_Key => $Near_By_Custom_Place_Value) { ?>
						<tr class="main-row">
							<td>
								<input type="text" placeholder="Place Label" name="google_near_by_custom_place_label[]" value="<?php echo esc_attr($Near_By_Custom_Place[$Near_By_Custom_Place_Key]['google_near_by_custom_place_label']); ?>" class="no-margin" size="10">								
							</td>
							<td>
								<textarea placeholder="Detail" cols="10" name="google_near_by_custom_place_detail[]" class="no-margin"><?php echo esc_attr($Near_By_Custom_Place[$Near_By_Custom_Place_Key]['google_near_by_custom_place_detail']); ?></textarea>
							</td>
							<td>
								<input type="text" placeholder="Latitude" name="google_near_by_custom_place_latitude[]" value="<?php echo esc_attr($Near_By_Custom_Place[$Near_By_Custom_Place_Key]['google_near_by_custom_place_latitude']); ?>" class="no-margin" size="5">
							</td>
							<td>
								<input type="text" placeholder="Longitude" name="google_near_by_custom_place_longitude[]" value="<?php echo esc_attr($Near_By_Custom_Place[$Near_By_Custom_Place_Key]['google_near_by_custom_place_longitude']); ?>" class="no-margin" size="5">
							</td>
							<td>
								<?php if( $Near_By_Custom_Place[$Near_By_Custom_Place_Key]['google_near_by_custom_place_icon'] ){ ?>
									<img src="<?php echo esc_attr($Near_By_Custom_Place[$Near_By_Custom_Place_Key]['google_near_by_custom_place_icon']); ?>" height="25px" class="theme_favicon_icon" alt="amenities-icon">
								<?php } ?>
								<button type="button" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
								<input type="hidden" name="google_near_by_custom_place_icon[]" class="pbimagestore" value="<?php echo esc_attr($Near_By_Custom_Place[$Near_By_Custom_Place_Key]['google_near_by_custom_place_icon']); ?>" >
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
								<input type="text" placeholder="Place Label" name="google_near_by_custom_place_label[]" class="no-margin" size="10">
							</td>
							<td>
								<textarea placeholder="Detail" cols="10" name="google_near_by_custom_place_detail[]" class="no-margin"></textarea>
							</td>
							<td>
								<input type="text" placeholder="Latitude" name="google_near_by_custom_place_latitude[]" class="no-margin" size="5">
							</td>
							<td>
								<input type="text" placeholder="Longitude" name="google_near_by_custom_place_longitude[]" class="no-margin" size="5">
							</td>
							<td>
								<button type="button" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
								<input type="hidden" name="google_near_by_custom_place_icon[]" class="pbimagestore" value="" >
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
</div>