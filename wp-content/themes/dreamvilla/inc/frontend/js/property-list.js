jQuery(document).ready(function ($) {

	"use strict";    

    // Delete Property
    jQuery('.delete-property').click( function (e) {
        
        var action = 'dreamvilla_mp_ajax_delete_property';        
        
        var Agent_ID    = jQuery(this).attr("agent-id");
        var Property_ID = jQuery(this).attr("property-id");

        jQuery.ajax({
            type        : 'POST',
            dataType    : 'json',
            url         : delete_property_object.ajaxurl + "?action=" + action,
            data: {
              'Agent_ID'    : Agent_ID,
              'Property_ID' : Property_ID
            },
            success: function (data) {
                if ( data.success ) {
                    window.location.href = delete_property_object.redirect_url;
                }
            }
        });
        e.preventDefault();
    });
});