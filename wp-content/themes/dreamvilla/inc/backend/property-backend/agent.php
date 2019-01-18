<div id="tabs-7" style="border:none;">
	<?php 
	$Property_Agent = get_post_meta( $post->ID, 'pagent', true );
	
	$args = array(
	    'role' => 'subscriber',
	    'orderby' => 'user_nicename',
	    'order' => 'ASC'
	);

	$agents = get_users($args); ?>

	<table class="admin-property-detail">
		<tr>
			<td><label><?php esc_html_e("Agent name","dreamvilla-multiple-property"); ?>:</label></td>
			<td>
				<select name="pagent" id="pagentname">
			    	<option value=""><?php esc_html_e("Select","dreamvilla-multiple-property"); ?></option>
			     	<?php
			     	if( isset($agents) ){
			      		foreach ($agents as $user) { ?>
			       			<option value="<?php echo esc_attr($user->ID); ?>" <?php if( $Property_Agent == $user->ID ){ echo "selected=selected"; } ?>><?php printf( esc_html__('%s','dreamvilla-multiple-property'), get_the_author_meta( 'fullname', $user->ID ) ); ?></option><?php
			      		}
			    	} ?>	
			    </select>
			</td>
		</tr>
	</table>						
</div>