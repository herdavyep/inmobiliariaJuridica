jQuery(document).ready(function ($) {
    
    jQuery('.free-package').on('click', function (e) {
        
        var action     	= 'dreamvilla_mp_ajax_package_select';        
        var Package_ID 	= jQuery(this).attr('data-id');        
        
		ctrl = jQuery(this);
		jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: package_object.ajaxurl,
            data: {
                'action'     : action,
                'Package_ID' : Package_ID                
            },
            success: function (data) {
				jQuery('p.status').html('');
				jQuery('.invoice-table tbody tr, .invoice-table tbody p').remove();
                if(data.success){                    
                	jQuery('div.ajax-message .alert.alert-success').remove();
                    jQuery('div.ajax-message').append(data.message);
                    jQuery('.package-feature-list li:nth-child(1) lable').html('Listings Included:' + data.Package_List);
                    jQuery('.package-feature-list li:nth-child(2) lable').html('Featured Included:' + data.Package_Featured);
                    jQuery('.package-feature-list li:nth-child(3) lable').html('Listings Remaining:' + data.Package_List);
                    jQuery('.package-feature-list li:nth-child(4) lable').html('Featured Remaining:' + data.Package_Featured);
                    jQuery("body, html").animate({ scrollTop: jQuery(".package-section").position().top });
                }
            }
        });
        e.preventDefault();
    });
});