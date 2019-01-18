<div id="tabs-14" style="border:none;">
	<div class="row">
		<div class="col-md-12">
			<?php $DocumentsStatus = get_post_meta( $post->ID, 'pdocumentsstatus', true ); ?>
			<div class="col-md-4">
				<label><?php esc_html_e("Display Documents : ","dreamvilla-multiple-property"); ?> </label>
			</div>
			<div class="col-md-8">
				<div class="btn-group" data-toggle="buttons">
				  <label class="btn btn-default <?php if( !empty($DocumentsStatus) && $DocumentsStatus['pdocumentsstatus'] == "yes" ){ echo "active"; } ?>">
				    <input type="radio" name="pdocumentsstatus" value="yes" id="option1" autocomplete="off" <?php if( !empty($DocumentsStatus) && $DocumentsStatus['pdocumentsstatus'] == "yes" ){ echo "checked=checked"; } ?> > <?php esc_html_e("Yes","dreamvilla-multiple-property"); ?>
				  </label>
				  <label class="btn btn-default <?php if( !empty($DocumentsStatus) && $DocumentsStatus['pdocumentsstatus'] == "no" ){ echo "active"; } ?>">
				    <input type="radio" name="pdocumentsstatus" value="no" id="option2" autocomplete="off" <?php if( !empty($DocumentsStatus) && $DocumentsStatus['pdocumentsstatus'] == "no" ){ echo "checked=checked"; } ?> > <?php esc_html_e("No","dreamvilla-multiple-property"); ?>
				  </label>
				</div>
			</div>

			<div class="col-md-4">
				<label><?php esc_html_e("Document Title : ","dreamvilla-multiple-property"); ?> </label>
			</div>
			<div class="col-md-8">
				<div class="btn-group" data-toggle="buttons">
				  	<input type="text" name="pdocumentstitle" class="form-control" placeholder="<?php esc_html_e("Title","dreamvilla-multiple-property"); ?>"  value="<?php if( !empty($DocumentsStatus) ){ echo esc_attr($DocumentsStatus['pdocumentstitle']); } ?>">
				</div>
			</div>

			<table class="table show-table-property" id="addaboutdocuments"><?php
			$Documents = get_post_meta( $post->ID, 'pdocuments', true );
			if( !empty($Documents) ){
				foreach ($Documents as $key => $value) { ?>
					<tr class="main-row">
						<td>
							<input type="text" size="6" name="pdocumentslabel[]" class="form-control" placeholder="<?php esc_html_e("Label","dreamvilla-multiple-property"); ?>"  value="<?php if( $Documents[$key]['pdocumentslabel'] ){ echo esc_attr($Documents[$key]['pdocumentslabel']); } ?>">
						</td>							
						<td>
							<input type="text" size="6" name="pdocumentslink[]" class="form-control" placeholder="<?php esc_html_e("Link","dreamvilla-multiple-property"); ?>"  value="<?php if( $Documents[$key]['pdocumentslabel'] ){ echo esc_attr($Documents[$key]['pdocumentslink']); } ?>">
						</td>											
						<td>
							<button type="button" class="btn btn-default removebedroom"><span class="glyphicon glyphicon-remove"></span></button>
							<button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
						</td>
					</tr><?php
				}
			} else { ?>
				<tr class="main-row">
					<td>
						<input type="text" size="6" name="pdocumentslabel[]" class="form-control" placeholder="<?php esc_html_e("Label","dreamvilla-multiple-property"); ?>" >
					</td>							
					<td>
						<input type="text" size="6" name="pdocumentslink[]" class="form-control" placeholder="<?php esc_html_e("Link","dreamvilla-multiple-property"); ?>" >
					</td>											
					<td>
						<button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
						<button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
					</td>
				</tr><?php
			} ?>
			</table>						
		</div>
	</div>
</div>