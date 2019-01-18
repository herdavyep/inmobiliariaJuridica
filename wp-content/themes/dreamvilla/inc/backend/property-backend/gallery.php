<div id="tabs-8" style="border:none;">
	<table id="addgallery" class="table show-table-property">
		<tbody>
		<?php
		$PropertyGallery = get_post_meta( $post->ID, 'propertygallery', true );
		if( $PropertyGallery ){ 
			foreach ($PropertyGallery as $key => $value) { ?>
			<tr class="main-row">
				<td>
					<?php if( $PropertyGallery[$key]['pgallery'] ){ ?>
						<img src="<?php echo esc_attr($PropertyGallery[$key]['pgallery']); ?>" height="25px" class="theme_favicon_icon" alt="slider">
					<?php } ?>
					<button type="button" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
					<input type="hidden" name="pgallery[]" class="pbimagestore" value="<?php echo esc_attr($PropertyGallery[$key]['pgallery']); ?>" >
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
					<button type="button" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
					<input type="hidden" name="pgallery[]" class="pbimagestore" >
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