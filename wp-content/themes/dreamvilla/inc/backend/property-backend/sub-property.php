<div id="tabs-15" style="border:none;">
	<?php 
	
	$Sub_Property = get_post_meta( $post->ID, 'psubproperty', true );

	$args = array(
		'post_type' 	 => 'property',
		'posts_per_page' => -1,
		'orderby'   	 => 'title',
		'order'     	 => 'ASC',
		'post__not_in' 	 => array( $post->ID )
	);
	$property_list = new WP_Query( $args ); ?>
	<table class="admin-property-detail">
		<tr>
			<td><label><?php esc_html_e("Sub Property","dreamvilla-multiple-property"); ?>:</label></td>
			<td>
				<select name="psubproperty[]" id="psubproperty" multiple="multiple">
			    	<option value=""><?php esc_html_e('Select','dreamvilla-multiple-property'); ?></option>
			     	<?php 
			     	if($property_list->have_posts()){
			      		while($property_list->have_posts()):$property_list->the_post(); ?>
			       			<option value="<?php echo esc_attr($property_list->post->ID); ?>" <?php if( !empty($Sub_Property) && ( in_array($property_list->post->ID, $Sub_Property) ) ){ echo "selected=selected"; } ?>><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$property_list->post->post_title); ?></option><?php
			      		endwhile;
			    	 } ?>	
			    </select>
			</td>
		</tr>
	</table>						
</div>