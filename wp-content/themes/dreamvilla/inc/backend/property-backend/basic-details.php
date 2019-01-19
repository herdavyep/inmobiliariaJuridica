<div id="tabs-1" style="border:none;">
	<div class="row">					
		<div class="col-sm-4">
			<label><?php esc_html_e("Imagen de bandera","dreamvilla-multiple-property"); ?>:</label>
		</div>
		<div class="col-sm-8">		
			<table id="addbanner" class="table show-table-property">
				<tbody>
					<?php $PropertyBanner = get_post_meta( $post->ID, 'propertybannerimage', true ); ?>
					<tr class="main-row">
						<td>
							<?php if( $PropertyBanner ){ ?>
								<img src="<?php echo esc_attr($PropertyBanner); ?>" height="25px" class="theme_favicon_icon" alt="slider">
							<?php } ?>
							<button type="button" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
							<input type="hidden" name="propertybannerimage" class="pbimagestore" value="<?php echo esc_attr($PropertyBanner); ?>" >
						</td>
						<td>
							<button style="display: none;" class="btn btn-default removebedroom" type="button">
								<span class="glyphicon glyphicon-remove"></span>
							</button>							
						</td>
					</tr>				
				</tbody>
			</table>
		</div>

		<div class="col-sm-4">
			<label><?php esc_html_e("Destacados","dreamvilla-multiple-property"); ?>:</label>
		</div>
		<div class="col-sm-8">
			<input type="checkbox" name="pfetured" value="yes" <?php if($PropertyFetured=='yes'){echo esc_attr("checked"); } ?> /> <label for="pfetured"><?php esc_html_e("Hacer esta propiedad destacada","dreamvilla-multiple-property"); ?>:</label>
		</div>
		
		<div class="col-sm-4">
			<label for="pstatus"><?php esc_html_e("Propiedad","dreamvilla-multiple-property"); ?>: </label>
		</div>
		<div class="col-sm-8">
			<input type="radio" name="pstatus" value="sale" class="pstatus" id="psale" <?php echo "checked=checked"; ?> > <label><?php esc_html_e("Venta","dreamvilla-multiple-property"); ?></label>
			<input type="radio" name="pstatus" value="rent" class="pstatus" id="prent" <?php if( $PropertyStatus == "rent" ) { echo "checked=checked"; } ?>><label><?php esc_html_e("Alquiler","dreamvilla-multiple-property"); ?></label>						
		</div>
		
		<div class="col-sm-4">
			<label for="pprice"><?php esc_html_e("Precio","dreamvilla-multiple-property"); ?>:</label>	
		</div>
		<div class="col-sm-8">
			<div class="row">						
				<input type="text" name="pprice" value="<?php echo esc_attr($PropertyPrice[0]); ?>" id="pprice">
				<input type="text" size="7" name="ppricetype" id="ppricetype" class="ppricetype" placeholder="Mensual" value="<?php echo esc_attr($PropertyPrice[1]); ?>" />
			</div>
		</div>

		<div class="col-sm-4">
			<label for="pprice"><?php esc_html_e("Area","dreamvilla-multiple-property"); ?>:</label>	
		</div>
		<div class="col-sm-8">
			<div class="row">						
				<input type="text" name="psbuilduparea" value="<?php echo esc_attr($PropertySBuilupArea[0]); ?>" id="psbuilduparea">
			</div>
		</div>			
	</div>	

	<div class="row">		
		<h1><?php esc_html_e("Información esencial","dreamvilla-multiple-property"); ?></h1>
		<table id="essential" class="table show-table-property">
			<tbody>
				<?php
				$PropertyEssential = get_post_meta( $post->ID, 'essentialinformation', true );
				if( $PropertyEssential ){ 
					foreach ($PropertyEssential as $key => $value) { ?>
					<tr class="main-row">
						<td>
							<input type="text" placeholder="Title" name="essentialtitle[]" value="<?php echo esc_attr($PropertyEssential[$key]['essentialtitle']); ?>" class="no-margin">
						</td>
						<td>
							<input type="text" placeholder="Description" name="essentialvalue[]" value="<?php echo esc_attr($PropertyEssential[$key]['essentialvalue']); ?>" class="no-margin">
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
						<input type="text" placeholder="Title" name="essentialtitle[]" class="no-margin">
					</td>
					<td>
						<input type="text" placeholder="Description" name="essentialvalue[]" class="no-margin">
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