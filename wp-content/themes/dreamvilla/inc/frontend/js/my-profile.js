jQuery(document).ready(function ($) {

	jQuery('.edit-profile-form').on('submit', function (e) {
        
        if (!jQuery(this).valid()) return false;
        
        jQuery('p.status', this).show().text(edit_profile_object.loadingmessage);		
        
		action          = 'dreamvilla_mp_ajax_edit_profile';        
        profile_image   = jQuery('.profile-image-id').val();
        fullname        = jQuery('#fullname').val();
        user_email      = jQuery('#user_email').val();
        phone           = jQuery('#phone').val();
        mobile          = jQuery('#mobile').val();
        skype           = jQuery('#skype').val();
        facebookurl     = jQuery('#facebookurl').val();
        twitterurl      = jQuery('#twitterurl').val();        
		linkedinurl     = jQuery('#linkedinurl').val();
        pinteresturl    = jQuery('#pinteresturl').val();
        websiteurl      = jQuery('#websiteurl').val();
        titleposition   = jQuery('#titleposition').val();        
        aboutme         = jQuery('#aboutme').val();        
        oldpassword     = jQuery('#old-password').val();
        newpassword     = jQuery('#new-password').val();
        cpassword       = jQuery('#confirm-password').val();
    	security        = jQuery('#edit-profile-security').val();

		ctrl = jQuery(this);
		jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: edit_profile_object.ajaxurl,
            data: {
                'action'        : action,
                'profile_image' : profile_image,
                'fullname'      : fullname,
                'user_email'         : user_email,
                'phone'         : phone,
                'mobile'        : mobile,
                'skype'         : skype,
                'facebookurl'   : facebookurl,
                'twitterurl'    : twitterurl,                
                'linkedinurl'   : linkedinurl,
                'pinteresturl'  : pinteresturl,
                'websiteurl'    : websiteurl,
                'titleposition' : titleposition,
                'aboutme'       : aboutme,                
                'security'      : security               
            },
            success: function (data) {
				jQuery('p.status').html('');
                if ( data.success ) {
                    jQuery('p.status').html( data.message).fadeIn();
                } else {
                    for ( var i=0; i < data.errors.length; i++ ) {
                        jQuery('p.status').append( '<p>' + data.errors[i] + '</p>' );
                    }
                    jQuery('p.status').fadeIn();
                }
            }
        });
        e.preventDefault();
    });
	
	if( jQuery(".edit-profile-form").length ){
        jQuery(".edit-profile-form").validate();        
    }

    jQuery('.change-password').on('submit', function (e) {
        
        if (!jQuery(this).valid()) return false;
        
        jQuery('p.change_password', this).show().text(edit_profile_object.loadingmessage);
        
        action          = 'dreamvilla_mp_ajax_change_password';        
        oldpassword     = jQuery('#oldpassword').val();
        newpassword     = jQuery('#newpassword').val();
        cpassword       = jQuery('#confirmpassword').val();
        security        = jQuery('#change-password-security').val();

        ctrl = jQuery(this);
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: edit_profile_object.ajaxurl,
            data: {
                'action'        : action,
                'oldpassword'   : oldpassword,
                'newpassword'   : newpassword,
                'cpassword'     : cpassword,
                'security'      : security                
            },
            success: function (data) {
                jQuery('p.change_password').html('');
                if ( data.success ) {
                    jQuery('p.change_password').html( data.message).fadeIn();                    
                    
                    jQuery("#oldpassword").attr('value','');
                    jQuery("#newpassword").attr('value','');
                    jQuery("#cpassword").attr('value','');

                    location.reload();
                } else {
                    for ( var i=0; i < data.errors.length; i++ ) {
                        jQuery('p.change_password').append( '<p>' + data.errors[i] + '</p>' );
                    }
                    jQuery('p.change_password').fadeIn();                    
                }
            }
        });
        e.preventDefault();
    });
    
    if( jQuery("#change-password").length ){
        jQuery("#change-password").validate();        
    }

    var action = "user_profile_image_upload";

    // initialize uploader 
    var uploader = new plupload.Uploader({
        browse_button   : 'user-profile-image',
        file_data_name  : 'dreamvilla_mp_upload_file',
        multi_selection : false,
        url             : edit_profile_object.ajaxurl + "?action=" + action,
        filters         : { mime_types : [ { title : 'Valid file formats', extensions : "jpg,jpeg,gif,png" } ], max_file_size: '2000kb', prevent_duplicates: true }
    });

    uploader.init();

    // Run after adding image file
    uploader.bind('FilesAdded', function(up, files) {
        var ProfileStatus = "";
        plupload.each(files, function(file) {
            ProfileStatus += '<div id="upload_status">' + '' + '</div>';
        });
        document.getElementById('selected-profile-image').innerHTML = ProfileStatus;
        up.refresh();
        uploader.start();
    });


    // Run during upload image
    uploader.bind('UploadProgress', function(up, file) {
        document.getElementById( "upload_status" ).innerHTML = '<span>' + file.percent + "%</span>";
    });


    // Error report
    uploader.bind('Error', function( up, err ) {
        document.getElementById('errors-report').innerHTML += "<br/>" + "Error #" + err.code + ": " + err.message;
    });


    // Files uploaded successfully
    uploader.bind('FileUploaded', function ( up, file, ajax_response ) {
        var response = $.parseJSON( ajax_response.response );

        if ( response.success ) {
            var SelectedImage = '<img src="' + response.url + '" alt="" />' + 
            '<input type="hidden" class="profile-image-id" name="profile-image-id" value="' + response.attachment_id + '"/>';
            document.getElementById( "upload_status" ).innerHTML = SelectedImage;
        }

        jQuery(".removeImageUrl").css('display','block');

    });

     jQuery('.removeImageUrl').on( 'click', function(event){
        event.preventDefault();
        document.getElementById('selected-profile-image').innerHTML = '<div class="profile-thumb"></div>';
    });

});