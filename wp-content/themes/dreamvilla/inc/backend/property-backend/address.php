<div id="tabs-6" style="border:none;">
	<div class="row">			
		<div class="col-sm-4">
			<label for="paddress"><?php esc_html_e("Dirección","dreamvilla-multiple-property"); ?>:</label>
		</div>
		<div class="col-sm-8">
			<textarea name="paddress" id="paddress"><?php echo esc_textarea($Property_Address); ?></textarea>
		</div>
		
		<div class="col-sm-4">
			<label for="ppincode"><?php esc_html_e("Código postal","dreamvilla-multiple-property"); ?>:</label>
		</div>
		<div class="col-sm-8">
			<input type="text" name="ppincode" id="ppincode" value="<?php echo esc_attr($Property_Pincode); ?>"/>
		</div>
		
		<div class="col-sm-4">
			<label for="pcountry"><?php esc_html_e("País","dreamvilla-multiple-property"); ?>:</label>
		</div>
		<div class="col-sm-8">
			<input type="text" name="pcountry" id="pcountry" value="<?php echo esc_attr($Property_Country); ?>"/>
		</div>
		
		<div class="col-sm-4">
			<label for="pstate"><?php esc_html_e("Departamento","dreamvilla-multiple-property"); ?>:</label>
		</div>
		<div class="col-sm-8">
			<input type="text" name="pstate" id="pstate" value="<?php echo esc_attr($Property_State); ?>"/>
		</div>
		
		<div class="col-sm-4">
			<label for="pcity"><?php esc_html_e("Ciudad","dreamvilla-multiple-property"); ?>:</label>
		</div>
		<div class="col-sm-8">
			<input type="text" name="pcity" id="pcity" value="<?php echo esc_attr($Property_City); ?>"/>
		</div>
		
		<div class="col-sm-4">
			<label for="googleMap"><?php esc_html_e("Mapa","dreamvilla-multiple-property"); ?>:</label>
		</div>
		<div class="col-sm-8">
			<div id="googleMap" style="width:340px;height:265px;margin-bottom: 20px;"></div>
		</div>
		
		<div class="col-sm-4">
			<label for="platitude"><?php esc_html_e("Latitud","dreamvilla-multiple-property"); ?>:</label>
		</div>
		<div class="col-sm-8">
			<input type="text" name="platitude" id="platitude" value="<?php echo esc_attr($Property_LatLon[0]); ?>"/>
		</div>
		
		<div class="col-sm-4">
			<label for="plongitude"><?php esc_html_e("Longitud","dreamvilla-multiple-property"); ?>:</label>
		</div>
		<div class="col-sm-8">
			<input type="text" name="plongitude" id="plongitude" value="<?php echo esc_attr($Property_LatLon[1]); ?>"/>
		</div>
	</div>
</div>