jQuery(document).ready(function ($) {

	"use strict";    

    // Add Favorites Property
    jQuery('.saved_searches').live("click", function (e) {
        
        jQuery('p.ajax_status').show().text(saved_searches_object.loadingmessage);
        
        if( jQuery('.saved_searches_title').val() != '' ){
            var action = 'dreamvilla_mp_ajax_add_saved_searches';        
            var newCustomerForm = jQuery(".search-filter-form").serialize();

            jQuery.ajax({
                type        : 'POST',
                dataType    : 'json',
                url         : saved_searches_object.ajaxurl + "?action=" + action,
                data        : newCustomerForm,
                success: function (data) {
                    jQuery('p.ajax_status').html("Search is saved.");
                    jQuery('p.ajax_status').fadeIn();
                }
            });
        } else {
            jQuery('p.ajax_status').html("Search Name is required.");
            jQuery('p.ajax_status').fadeIn();
        }
        e.preventDefault();
    });

    // Delete Favorites Property
    jQuery('.delete-saved-searches').live("click", function (e) {        
        
        var action  = 'dreamvilla_mp_ajax_delete_saved_searches';
        var Data_ID = '';
        Data_ID     = jQuery(this).attr("data-id");

        jQuery.ajax({
            type        : 'POST',
            dataType    : 'json',
            url         : saved_searches_object.ajaxurl + "?action=" + action,
            data: {
              'Data_ID' : Data_ID
            },
            success: function (data) {
                if ( data.success ) {
                    if( Data_ID ){
                        jQuery(".property-list-list#"+Data_ID).remove();                        
                    }
                }
            }
        });
        e.preventDefault();
    });
});