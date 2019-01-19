
<?php /*
<div id="tabs-10" style="border:none;">
	<div class="row">		
		<div class="col-sm-5">
			<label for="pvideo"><?php esc_html_e("Video Source","dreamvilla-multiple-property"); ?></label>
		</div>
		<div class="col-sm-7">
			<input type="text" name="pvideo" id="pvideo" value="<?php echo esc_attr($PropertyVideo); ?>" />
		</div>
		
		<div class="col-sm-5">
			<label for="pvideo"><?php esc_html_e("Video Placeholder Image","dreamvilla-multiple-property"); ?></label>
		</div>
		<div class="col-sm-7">
			<?php if( $PropertyVideoPlaceholder ){ ?>
				<img src="<?php echo esc_url($PropertyVideoPlaceholder); ?>" height="25px" class="theme_favicon_icon" alt="slider">
			<?php } ?>
			<button type="button" class="btn btn-default uploadlogo" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
			<input type="hidden" name="pvideoplaceholder" class="pbimagestore" value="<?php echo esc_attr($PropertyVideoPlaceholder); ?>" >
		</div>
		
		<div class="col-sm-5">
			<label><?php esc_html_e("Advertisement","dreamvilla-multiple-property"); ?></label>
		</div>
		<div class="col-sm-7">
			<textarea name="padvertisement"><?php echo esc_attr($PropertyAdvertisement); ?></textarea>
		</div>
	</div>
</div>
*/ ?>

<!-- Our custom code -->
<div id="tabs-10" style="border:none;">
	<div class="row">	
		<div class="col-sm-5">
			<label for="pvideo"><?php esc_html_e("Imagen para el video","dreamvilla-multiple-property"); ?></label>
		</div>
		<div class="col-sm-7">
			<?php if( $PropertyVideoPlaceholder ){ ?>
				<img src="<?php echo esc_url($PropertyVideoPlaceholder); ?>" height="25px" class="theme_favicon_icon" alt="slider">
			<?php } ?>
			<button type="button" class="btn btn-default uploadlogo" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
			<input type="hidden" name="pvideoplaceholder" class="pbimagestore" value="<?php echo esc_attr($PropertyVideoPlaceholder); ?>" >
		</div>

		<div class="col-sm-5">
			<label for="pvideoheight"><?php esc_html_e("Altura del video","dreamvilla-multiple-property"); ?></label>
		</div>
		<div class="col-sm-7">
			<input type="number" name="pvideoheight" id="pvideoheight" value="<?php echo esc_attr($PropertyVideoHeight); ?>" />
		</div>
		
		<div class="col-sm-5">
			<label for="pvideowidth"><?php esc_html_e("Anchura del video","dreamvilla-multiple-property"); ?></label>
		</div>
		<div class="col-sm-7">
			<input type="number" name="pvideowidth" id="pvideowidth" value="<?php echo esc_attr($PropertyVideoWidth); ?>" />
		</div>
		
		<div class="col-sm-5">
			<label for="pvideourl"><?php esc_html_e("Escribir URL del video","dreamvilla-multiple-property"); ?></label>
		</div>
		<div class="col-sm-7">
			<input type="text" name="pvideourl" id="pvideourl" value="<?php echo esc_attr($PropertyVideoUrl); ?>" placeholder="" />
			<label for="pvideourl"><?php esc_html_e("Ejemplos : https://www.youtube.com/embed/musbvPUkRov0bhU","dreamvilla-multiple-property"); ?><br>
			<?php esc_html_e("http://player.vimeo.com/video/531705441599","dreamvilla-multiple-property"); ?></label>			
		</div>

		<div class="col-sm-5">
			<label><?php esc_html_e("Anuncio","dreamvilla-multiple-property"); ?></label>
		</div>
		<div class="col-sm-7">
			<textarea name="padvertisement"><?php echo esc_attr($PropertyAdvertisement); ?></textarea>
		</div>
	</div>
</div>