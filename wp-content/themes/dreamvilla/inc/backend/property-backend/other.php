<div id="tabs-12" style="border:none;">
	<div class="row">
		<div class="col-sm-4">
			<label><?php esc_html_e("Flooring","dreamvilla-multiple-property"); ?>: </label>
		</div>
		<div class="col-sm-8">
			<textarea name="pflooring" id="pflooring"><?php echo esc_attr($PropertyFlooring); ?></textarea>
		</div>
		
		<div class="col-sm-4">
			<label><?php esc_html_e("Goods Included","dreamvilla-multiple-property"); ?>: </label>
		</div>
		<div class="col-sm-8">
			<textarea name="pgoodsincluded" id="pgoodsincluded" ><?php echo esc_attr($PropertyGoodsIncluded); ?></textarea>
		</div>
		
		<div class="col-sm-4">
			<label for="pnoofgarage"><?php esc_html_e("No of garage","dreamvilla-multiple-property"); ?>: </label>
		</div>
		<div class="col-sm-8">
			<input type="number" name="pnoofgarage" id="pnoofgarage" min="1" value="<?php echo esc_attr($PropertyNoOfGarage); ?>">
		</div>

		<!-- start our custom code -->
		<div class="col-sm-12">
			<h4><?php esc_html_e("Street View Block","dreamvilla-multiple-property"); ?>: </h4>
		</div>
		<br/>
		<div class="col-sm-4">
			<label for="streetviewlat"><?php esc_html_e("Enter Latitude","dreamvilla-multiple-property"); ?>: </label>
		</div>
		<div class="col-sm-8">
			<input type="text" name="streetviewlat" id="streetviewlat" value="<?php echo esc_attr($Propertystreetviewlat); ?>">
		</div>

		<div class="col-sm-4">
			<label for="streetviewlng"><?php esc_html_e("Enter Longitude","dreamvilla-multiple-property"); ?>: </label>
		</div>
		<div class="col-sm-8">
			<input type="text" name="streetviewlng" id="streetviewlng" value="<?php echo esc_attr($Propertystreetviewlng); ?>">
		</div>
		<!-- end code -->

	</div>
</div>