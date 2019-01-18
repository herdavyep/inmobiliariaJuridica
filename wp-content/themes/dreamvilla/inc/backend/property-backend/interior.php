<div id="tabs-3" style="border:none;">
	<div class="row">
		<table id="interior" class="table show-table-property">
			<tbody>
				<?php
				$PropertyInterior = get_post_meta( $post->ID, 'pinteriorarray', true );
				if( $PropertyInterior ){ 
					foreach ($PropertyInterior as $key => $value) { ?>
					<tr class="main-row">
						<td>
							<input type="text" placeholder="Title" name="interiortitle[]" value="<?php echo esc_attr($PropertyInterior[$key]['interiortitle']); ?>" class="no-margin">
						</td>
						<td>
							<input type="text" placeholder="Description" name="interiordescription[]" value="<?php echo esc_attr($PropertyInterior[$key]['interiordescription']); ?>" class="no-margin">
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
						<input type="text" placeholder="Title" name="interiortitle[]" class="no-margin">
					</td>
					<td>
						<input type="text" placeholder="Description" name="interiordescription[]" class="no-margin">
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