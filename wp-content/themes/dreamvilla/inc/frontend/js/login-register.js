jQuery(document).ready(function ($) {
    
    // Perform AJAX Login, Register And Reser Password on form submit
	jQuery('.login-form, .register-form, .forgot-password-form').on('submit', function (e) {
        
        if (!jQuery(this).valid()) return false;
        
        jQuery('p.status', this).show().text(ajax_auth_login.loadingmessage);

        if (jQuery(this).hasClass("login-form")) {
            
            action = 'dreamvilla_mp_ajax_login';        
            username = jQuery(this).find('#username').val();
            password = jQuery(this).find('#password').val();            
            email = '';
            security = jQuery(this).find('#login-security').val();

            ctrl = jQuery(this);
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_auth_login.ajaxurl,
                data: {
                    'action'    : action,
                    'username'  : username,
                    'password'  : password,
                    'email'     : email,
                    'security'  : security
                },
                success: function (data) {
                    jQuery('p.status', ctrl).text(data.message);
                    if (data.loggedin == true) {
                        document.location.href = ajax_auth_login.redirecturl;                    
                    }
                }
            });
            e.preventDefault();        
        }

        if (jQuery(this).hasClass('register-form')) {

			action     = 'dreamvilla_mp_ajax_register';			
            username   = jQuery(this).find('#signonname').val();
			password   = jQuery(this).find('#signonpassword').val();
        	email      = jQuery(this).find('#email').val();
        	security   = jQuery(this).find('#register-security').val();

            ctrl = jQuery(this);
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_auth_register.ajaxurl,
                data: {
                    'action'    : action,
                    'username'  : username,
                    'password'  : password,
                    'email'     : email,
                    'security'  : security
                },
                success: function (data) {
                    jQuery('p.status', ctrl).text(data.message);
                    if (data.loggedin == true) {
                        document.location.href = ajax_auth_register.redirecturl;                    
                    }
                }
            });
            e.preventDefault();
		}

        if (jQuery(this).hasClass('forgot-password-form')) {
            action     = 'dreamvilla_mp_ajax_reset_password';          
            username   = jQuery(this).find('#signonname').val();
            password   = '';
            email      = '';
            security   = jQuery(this).find('#reset-security').val();

            ctrl = jQuery(this);
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_auth_reset.ajaxurl,
                data: {
                    'action'    : action,
                    'username'  : username,
                    'password'  : password,
                    'email'     : email,
                    'security'  : security
                },
                success: function (data) {
                    jQuery('p.status', ctrl).text(data.message);
                    if (data.loggedin == true) {
                        document.location.href = ajax_auth_reset.redirecturl;
                    }
                }
            });
            e.preventDefault();
        }
		
    });
	
	// Client side form validation
    if( jQuery("#register").length ){
		jQuery("#register").validate( { rules:{ password2:{ equalTo:'#signonpassword' } } } );
    } else if( jQuery("#login").length ){
		jQuery("#login").validate();
    } else if( jQuery("#reset-password").length ){
        jQuery("#reset-password").validate();
    }

    jQuery(".login-button").on("click",function(){
        jQuery(".login-form-window").slideToggle();
    });
    
    jQuery(".login-form-window form a").on("click",function(){
        var className = jQuery(this).attr("class");
        className = className.replace("url", "form");
        jQuery(".login-form-window form").removeClass("active");
        jQuery(".login-form-window ." + className).addClass("active");
    });

});