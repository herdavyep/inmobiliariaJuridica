<?php 
	$dreamvilla_options = get_option('dreamvilla_options');
	if( !empty($dreamvilla_options['property_main_agent'] ) ){
		$Property_Main_Agent = $dreamvilla_options['property_main_agent'];
		if( empty($Property_Main_Agent) ){
			
			$args = array(
			    'role' => 'subscriber',
			    'orderby' => 'user_nicename',
			    'order' => 'ASC'
			);

			$agents = get_users($args);

			if( $agents[0]->ID )
				$Property_Main_Agent = $agents[0]->ID;
		}
	}
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
 	
 	jQuery(".agnet-contact-form").submit(function(event){
 		
 		event.preventDefault();
      	
      	var ajaxurl = "<?php echo esc_js(admin_url('admin-ajax.php')); ?>";
		
		var full_name 				= this.full_name.value
	 	var p_number 				= this.p_number.value
		var email_address			= this.email_address.value
		var message 				= this.message.value
		var agent_email_address 	= this.agent_email_address.value

		jQuery.ajax({
	    	url:ajaxurl,
	    	dataType: "json",
	     	data: {
				'action'				: 'dreamvilla_mp_send_visiter_message',
				'full_name' 			: full_name,
				'phone_number' 			: p_number,
				'email_address' 		: email_address,
				'message' 				: message,
				'agent_email_address' 	: agent_email_address
	      	},
	    }).done(function(data){
	      	jQuery(".message_area .alert").remove();
	        if( data.mail_info == "success" ){
	        	jQuery("#agent-contact-model .message_area").append("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok'></i> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['sendinquirysuccessmessage']); ?> </div>");
	        } else {
	        	jQuery("#agent-contact-model .message_area").append("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-remove'></i> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['sendinquiryfailedmessage']); ?> </div>");
	        }	        
	    });
	});

	jQuery(".agnet-contact-form-contact-page").submit(function(event){
 		
 		event.preventDefault();
      	
      	var ajaxurl = "<?php echo esc_js(admin_url('admin-ajax.php')); ?>";
		
		var full_name 				= this.full_name.value
	 	var p_number 				= this.p_number.value
		var email_address			= this.email_address.value
		var message 				= this.message.value
		var agent_email_address 	= this.agent_email_address.value

		jQuery.ajax({
	    	url:ajaxurl,
	    	dataType: "json",
	     	data: {
				'action'				: 'dreamvilla_mp_send_visiter_message',
				'full_name' 			: full_name,
				'phone_number' 			: p_number,
				'email_address' 		: email_address,
				'message' 				: message,
				'agent_email_address' 	: agent_email_address
	      	},
	    }).done(function(data){
	      	jQuery("#agent-contact-area .special-contact-form-div .message_area_bottom .alert").remove();
	        if( data.mail_info == "success" ){
	        	jQuery("#agent-contact-area .special-contact-form-div .message_area_bottom").append("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok'></i> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['sendinquirysuccessmessage']); ?> </div>");
	        } else {
	        	jQuery("#agent-contact-area .special-contact-form-div .message_area_bottom").append("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-remove'></i> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['sendinquiryfailedmessage']); ?> </div>");
	        }
	    });
	});	

	jQuery("#propety-agnet-send-message").submit(function(event){
 		
 		event.preventDefault();
      	
      	var ajaxurl = "<?php echo esc_js(admin_url('admin-ajax.php')); ?>";
		
		var full_name 			= this.full_name.value
	 	var p_number 			= this.p_number.value
		var email_address		= this.email_address.value
		var message 			= this.message.value
		var agent_email_address = this.agent_email_address.value

		jQuery.ajax({
		    url:ajaxurl,
		    dataType: "json",
		    data: {
				'action'				: 'dreamvilla_mp_propety_send_visiter_message',
				'full_name' 			: full_name,
				'phone_number' 			: p_number,
				'email_address' 		: email_address,
				'message' 				: message,
				'agent_email_address' 	: agent_email_address
	      	},
	    }).done(function(data){
	      	jQuery(".message_area_bottom .alert").remove();
			if( data.mail_info == "success" ){
	        	jQuery("#propety-agent-contact-area .message_area_bottom").append("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok'></i> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['sendinquirysuccessmessage']); ?> </div>");
	        } else {
	        	jQuery("#propety-agent-contact-area .message_area_bottom").append("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-remove'></i> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['sendinquiryfailedmessage']); ?> </div>");
	        }	        
	    });	    	    	  
	});         
});
</script>