<div id="tabs-4" style="border:none;"> 
	<div class="row">
		<table id="exterior" class="table show-table-property">
			<tbody>
				<?php
				$PropertyExterior = get_post_meta( $post->ID, 'pexteriorarray', true );
				if( $PropertyExterior ){ 
					foreach ($PropertyExterior as $key => $value) { ?>
					<tr class="main-row">
						<td>
							<input type="text" placeholder="Title" name="exteriortitle[]" value="<?php echo esc_attr($PropertyExterior[$key]['exteriortitle']); ?>" class="no-margin">
						</td>
						<td>
							<input type="text" placeholder="Description" name="exteriordescription[]" value="<?php echo esc_attr($PropertyExterior[$key]['exteriordescription']); ?>" class="no-margin">
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
						<input type="text" placeholder="Title" name="exteriortitle[]" class="no-margin">
					</td>
					<td>
						<input type="text" placeholder="Description" name="exteriordescription[]" class="no-margin">
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