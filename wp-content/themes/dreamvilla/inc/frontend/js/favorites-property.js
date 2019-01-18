jQuery(document).ready(function ($) {

	"use strict";    

    // Add Favorites Property
    jQuery('.add-favorites-property').live("click", function (e) {
        
        var action = 'dreamvilla_mp_ajax_add_favorites_property';        
        
        var Property_ID = '';

        Property_ID = jQuery(this).attr("property-id");

        var add_property = '';
        add_property = jQuery(this);

        jQuery.ajax({
            type        : 'POST',
            dataType    : 'json',
            url         : favorites_property_object.ajaxurl + "?action=" + action,
            data: {
              'Property_ID' : Property_ID
            },
            success: function (data) {
                if ( data.success ) {
                    add_property.attr("class","delete-favorites-property");
                    add_property.children("i").removeClass( 'fa-heart-o').addClass( 'fa-heart' );                    
                }                
            }
        });
        e.preventDefault();
    });

    // Delete Favorites Property
    jQuery('.delete-favorites-property').live("click", function (e) {
        
        var action = 'dreamvilla_mp_ajax_delete_favorites_property';        
        
        var Property_ID = '';
        var Data_ID = '';

        Property_ID = jQuery(this).attr("property-id");
        Data_ID     = jQuery(this).attr("data-id");

        var delete_property = '';
        delete_property = jQuery(this);

        jQuery.ajax({
            type        : 'POST',
            dataType    : 'json',
            url         : favorites_property_object.ajaxurl + "?action=" + action,
            data: {
              'Property_ID' : Property_ID
            },
            success: function (data) {
                if ( data.success ) {
                    if( Data_ID ){
                        jQuery(".property-list-list#"+Property_ID).remove();                        
                    } else {
                        delete_property.attr("class","add-favorites-property");
                        delete_property.children("i").removeClass( 'fa-heart').addClass( 'fa-heart-o' );
                    }
                }
            }
        });
        e.preventDefault();
    });

    jQuery('.open-login-regster-model').live("click", function (e) {        
        jQuery('.login-forms-container.login-register-form-model .login-form-window').css('display','block');
        jQuery('#login-register-model').modal('toggle');   
    });
});