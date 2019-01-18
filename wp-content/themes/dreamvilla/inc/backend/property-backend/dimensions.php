<div id="tabs-5" style="border:none;">
	<div class="row">
		<div class="col-sm-4">
			<button type="button" id="room" class="btn btn-info" data-toggle="modal" data-target="#roommodel"><?php esc_html_e("Room","dreamvilla-multiple-property"); ?> <span class="glyphicon glyphicon-plus"></span></button>
		</div>

		<div class="col-sm-4">
			<button type="button" id="bathroom" class="btn btn-info" data-toggle="modal" data-target="#bathroommodel"><?php esc_html_e("Bathroom","dreamvilla-multiple-property"); ?> <span class="glyphicon glyphicon-plus"></span></button>
		</div>
		
		<div class="col-sm-4">
			<button type="button" id="kitchen" class="btn btn-info" data-toggle="modal" data-target="#kitchenmodel"><?php esc_html_e("Kitchen","dreamvilla-multiple-property"); ?> <span class="glyphicon glyphicon-plus"></span></button>
		</div>
		
		<div class="col-sm-4">
			<button type="button" id="swimminpool" class="btn btn-info" data-toggle="modal" data-target="#swimmingpoolmodel"><?php esc_html_e("Swimming pool","dreamvilla-multiple-property"); ?> <span class="glyphicon glyphicon-plus"></span></button>
		</div>
		
		<div class="col-sm-4">
			<button type="button" id="gym" class="btn btn-info" data-toggle="modal" data-target="#gymmodel"><?php esc_html_e("Gym","dreamvilla-multiple-property"); ?> <span class="glyphicon glyphicon-plus"></span></button>
		</div>
	</div>
</div>
<!-- Modal for the room start here -->
<div class="modal fade" id="roommodel" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
	  		<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><?php esc_html_e("Add Room","dreamvilla-multiple-property"); ?></h4>
	  		</div>
	  		<div class="modal-body">
				<table class="table show-table-property" id="addroomtable">
				<?php
				$RoomDetails = get_post_meta( $post->ID, 'propertyroom', true );
				if( $RoomDetails ){ 
					foreach ($RoomDetails as $key => $value) { ?>
						<tr class="main-row">
							<td>
								<input type="text" size="6" name="proomsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>"  value="<?php echo esc_attr($RoomDetails[$key]['proomsize']); ?>">
							</td>							
							<td>
								<select name="proomtype[]" class="form-control">
									<option value=""><?php esc_html_e("Select","dreamvilla-multiple-property"); ?></option><?php
								$roomtype = dreamvilla_mp_get_room_type();
								if( $roomtype ){
									foreach ($roomtype as $room_key => $room_value) { ?>
										<option value="<?php echo esc_attr($room_key); ?>" <?php if( $RoomDetails[$key]['proomtype'] == $room_key ) { echo "selected=selected"; } ?> ><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$room_value); ?></option><?php 
									} 
								} ?>
								</select>
							</td>
							<td>
								<button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
								<button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
							</td>
						</tr><?php
					}
				} else { ?>
					<tr class="main-row">
						<td>
							<input type="text" size="6" name="proomsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>" >
						</td>							
						<td>
							<select name="proomtype[]" class="form-control">
								<option value=""><?php esc_html_e("Select","dreamvilla-multiple-property"); ?></option><?php
							$room = dreamvilla_mp_get_room_type();
							if( $room ){
								foreach ($room as $key => $value) { ?>
									<option value="<?php echo esc_attr($key); ?>" ><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value); ?></option><?php 
								} 
							} ?>
							<select>
						</td>
						<td>
							<button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
							<button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
						</td>
					</tr>
				<?php } ?>
				</table>
	  		</div>
		  	<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal"><?php esc_html_e("Save changes","dreamvilla-multiple-property"); ?></button>
		  	</div>
		</div>
  	</div>
</div>		
<!-- Modal for the room end here -->
<!-- Modal for the bathroom start here -->
<div class="modal fade" id="bathroommodel" tabindex="-1" role="dialog" aria-hidden="true">
 	 <div class="modal-dialog modal-lg">
		<div class="modal-content">
		  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><?php esc_html_e("Add Bathroom","dreamvilla-multiple-property"); ?></h4>
			</div>
	  		<div class="modal-body">
				<table class="table show-table-property" id="addbathroomtable">
					<?php
					$BathroomDetails = get_post_meta( $post->ID, 'propertybathroom', true );					
					if( $BathroomDetails ){ 
						foreach ($BathroomDetails as $key => $value) { ?>
							<tr class="main-row">
								<td>
									<input type="text" size="6" name="pbathroomsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>"  value="<?php echo esc_attr($BathroomDetails[$key]['pbathroomsize']); ?>">
								</td>								
								<td>
									<button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
									<button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
								</td>
							</tr><?php
						}
					} else { ?>
						<tr class="main-row">
							<td>
								<input type="text" size="6" name="pbathroomsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>" >
							</td>						
							<td>
								<button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
								<button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
							</td>
						</tr>
					<?php } ?>
				</table>
	  		</div>
	  		<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal"><?php esc_html_e("Save changes","dreamvilla-multiple-property"); ?></button>
	  		</div>
		</div>
  	</div>
</div>		
<!-- Modal for the bathroom end here -->
<!-- Modal for the kitchen start here -->
<div class="modal fade" id="kitchenmodel" tabindex="-1" role="dialog" aria-hidden="true">
  	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><?php esc_html_e("Add Kitchen","dreamvilla-multiple-property"); ?></h4>
			</div>
		  	<div class="modal-body">
				<table class="table show-table-property" id="addkitchentable">
					<?php
					$KitchenDetails = get_post_meta( $post->ID, 'propertykitchen', true );					
					if( $KitchenDetails ){ 
						foreach ($KitchenDetails as $key => $value) { ?>
							<tr class="main-row">
								<td>
									<input type="text" size="6" name="pkitchensize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>"  value="<?php echo esc_attr($KitchenDetails[$key]['pkitchensize']); ?>">
								</td>								
								<td>
									<button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
									<button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
								</td>
							</tr><?php
						}
					} else { ?>
						<tr class="main-row">
							<td>
								<input type="text" size="6" name="pkitchensize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>" >
							</td>						
							<td>
								<button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
								<button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
							</td>
						</tr>
					<?php } ?>
				</table>
		  	</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal"><?php esc_html_e("Save changes","dreamvilla-multiple-property"); ?></button>
		  	</div>
		</div>
  	</div>
</div>		
<!-- Modal for the kitchen end here -->
<!-- Modal for the swimmingpool start here -->
<div class="modal fade" id="swimmingpoolmodel" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
	  		<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><?php esc_html_e("Add Swimming Pool","dreamvilla-multiple-property"); ?></h4>
	  		</div>
	  		<div class="modal-body">
				<table class="table show-table-property" id="addswimmingpooltable">
					<?php
					$SwimmingPoolDetails = get_post_meta( $post->ID, 'propertyswimmingpool', true );					
					if( $SwimmingPoolDetails ){ 
						foreach ($SwimmingPoolDetails as $key => $value) { ?>
							<tr class="main-row">
								<td>
									<input type="text" size="6" name="pswimmingpoolsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>"  value="<?php echo esc_attr($SwimmingPoolDetails[$key]['pswimmingpoolsize']); ?>">
								</td>								
								<td>
									<button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
									<button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
								</td>
							</tr><?php
						}
					} else { ?>
						<tr class="main-row">
							<td>
								<input type="text" size="6" name="pswimmingpoolsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>" >
							</td>						
							<td>
								<button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
								<button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
							</td>
						</tr>
					<?php } ?>
				</table>
	  		</div>
	  		<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal"><?php esc_html_e("Save changes","dreamvilla-multiple-property"); ?></button>
	  		</div>
		</div>
  	</div>
</div>		
<!-- Modal for the swimmingrool end here -->
<!-- Modal for the gym start here -->
<div class="modal fade" id="gymmodel" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
	  		<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><?php esc_html_e("Add Gym","dreamvilla-multiple-property"); ?></h4>
	  		</div>
	  		<div class="modal-body">
				<table class="table show-table-property" id="addgymtable">
					<?php
					$GymDetails = get_post_meta( $post->ID, 'propertygym', true );
					if( $GymDetails ){ 
						foreach ($GymDetails as $key => $value) { ?>
							<tr class="main-row">
								<td>
									<input type="text" size="6" name="pgymsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>"  value="<?php echo esc_attr($GymDetails[$key]['pgymsize']); ?>">
								</td>								
								<td>
									<button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
									<button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
								</td>
							</tr><?php
						}
					} else { ?>
						<tr class="main-row">
							<td>
								<input type="text" size="6" name="pgymsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>" >
							</td>						
							<td>
								<button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
								<button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
							</td>
						</tr>
					<?php } ?>
				</table>
	  		</div>
	  		<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal"><?php esc_html_e("Save changes","dreamvilla-multiple-property"); ?></button>
	  		</div>
		</div>
  	</div>
</div>		
<!-- Modal for the bathroom end here -->