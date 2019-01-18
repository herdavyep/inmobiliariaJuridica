jQuery(document).ready(function ($) {
    
    if( document.getElementById('payment_fromdate') != null && document.getElementById('payment_todate') != null ){
        jQuery(function() {
    		jQuery( "#payment_fromdate, #payment_todate" ).datepicker({ dateFormat: 'yy-mm-dd' });
    	});
    }

	jQuery('.invoice_form').on('submit', function (e) {
        
        jQuery('p.status', this).show().text(invoice_object.loadingmessage);
        
        action          	= 'dreamvilla_mp_ajax_invoice';        
        payment_fromdate 	= jQuery('#payment_fromdate').val();
        payment_todate   	= jQuery('#payment_todate').val();
        package_name   		= jQuery('#package_name').val();
        payment_status   	= jQuery('#payment_status').val();
        
		ctrl = jQuery(this);
		jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: invoice_object.ajaxurl,
            data: {
                'action'        	: action,
                'payment_fromdate' 	: payment_fromdate,
                'payment_todate' 	: payment_todate,
                'package_name' 		: package_name,
                'payment_status' 	: payment_status                
            },
            success: function (data) {
				jQuery('p.status').html('');
				jQuery('.invoice-table tbody tr, .invoice-table tbody p').remove();
                if(data.success){
                	jQuery('.invoice-table tbody').append(data.invoice);
                } else {
                    jQuery('.invoice-table tbody').append('<p><?php echo __("No Invoice Found!","dreamvilla-multiple-property"); ?></p>');
                }
            }
        });
        e.preventDefault();
    });
});