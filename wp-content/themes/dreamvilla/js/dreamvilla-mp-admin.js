jQuery(document).ready(function() {
    "use strict";
    
	// ADJUST THIS to match the correct button
    jQuery( document ).on( "click", ".uploadbtn", function( event ){
        var _custom_media = true,
        _orig_send_attachment = wp.media.editor.send.attachment;

        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = jQuery(this);
        _custom_media = true;
        wp.media.editor.send.attachment = function(props, attachment)
        {
            if ( _custom_media ){
                var img_src = attachment.url;
                button.parent().prev().remove();
                button.parent().before("<td><img src="+img_src+" alt='image'></td>");
                button.parent().find(".pbimagestore").val(img_src);
            } else {
                return _orig_send_attachment.apply( this, [props, attachment] );
            };
        }

        wp.media.editor.open(button);
        return false;
    });

    jQuery('.add_media').on('click', function()
    {
        _custom_media = false;
    });

    dreamvilla_mp_show_close_button("#addroomtable");
	dreamvilla_mp_show_close_button("#addbathroomtable");
	dreamvilla_mp_show_close_button("#addkitchentable");
	dreamvilla_mp_show_close_button("#addswimmingpooltable");
	dreamvilla_mp_show_close_button("#addgymtable");
	dreamvilla_mp_show_close_button("#addamenities");
    dreamvilla_mp_show_close_button("#addgallery");
    dreamvilla_mp_show_close_button("#essential");
    dreamvilla_mp_show_close_button("#interior");
    dreamvilla_mp_show_close_button("#exterior");
    dreamvilla_mp_show_close_button("#nearbyplaces");
    dreamvilla_mp_show_close_button("#shareproperty");
    dreamvilla_mp_show_close_button("#addfloorplans");
    dreamvilla_mp_show_close_button("#addbanner");    

	function dreamvilla_mp_show_close_button(tableId)
	{
		if(jQuery(tableId).find("tr").size()>1)
		{
			var addbutton = jQuery(tableId).find(".addmorebedroombtn").first();
			jQuery(tableId).find(".addmorebedroombtn").remove();
			jQuery(tableId + " tbody").find("tr").last().find("td").last().append(addbutton);
			jQuery(tableId + " tr").removeClass("main-row");
			jQuery(tableId + " tr").first().addClass("main-row");
			jQuery(tableId).find(".removebedroom").show();			
		}
	}
	
	jQuery(document).on("click",".addmorebedroombtn",function(){
		var tableId="#"+jQuery(this).parent().parent().parent().parent().attr("id");				
		var addbutton = jQuery(tableId).find(".addmorebedroombtn").first();
		jQuery(tableId).append("<tr>"+jQuery(tableId + " .main-row").html()+"</tr>");
		jQuery(tableId).find(".addmorebedroombtn").remove();
		jQuery(tableId + " tbody").find("tr").last().find("td").last().append(addbutton);
		jQuery(tableId + " tbody").find("tr").last().find("input").val("");
		jQuery(tableId + " tbody").find("tr").last().find("textarea").val("");
		jQuery(tableId + " tbody").find("tr").last().find("img").remove();
		jQuery(tableId + " tbody").find("tr").last().find("select").prop('selectedIndex',0);
		if(jQuery(tableId).find("tr").size()>1)
		{
			jQuery(tableId).find(".removebedroom").show();
		}
		else
		{
			jQuery(tableId).find(".removebedroom").hide();
		}
	});

	jQuery(document).on("click",".removebedroom",function(){
		var tableId="#"+jQuery(this).parent().parent().parent().parent().attr("id");
		var addbutton = jQuery(tableId).find(".addmorebedroombtn").first();
		jQuery(this).parent().parent().remove();
		jQuery(tableId).find(".addmorebedroombtn").remove();
		jQuery(tableId + " tbody").find("tr").last().find("td").last().append(addbutton);
		jQuery(tableId + " tr").removeClass("main-row");
		jQuery(tableId + " tr").first().addClass("main-row");
		if(jQuery(tableId).find("tr").size()>1)
		{
			jQuery(tableId).find(".removebedroom").show();
		}
		else
		{
			jQuery(tableId).find(".removebedroom").hide();
		}					
	});

	jQuery(document).on("click",".uploadbtn",function(){
		jQuery(this).parent().find(".upload").trigger("click");
	});

	//jQuery('#starttime1,#endtime1,#starttime2,#endtime2').timepicker({ 'timeFormat': 'H' });
	
	jQuery(function() {
		jQuery( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
		jQuery( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
	});
	
	// ADJUST THIS to match the correct button
    jQuery( document ).on( "click", ".uploadlogo", function( event ){
        
        var _custom_media = true,
        _orig_send_attachment = wp.media.editor.send.attachment;

        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = jQuery(this);
        _custom_media = true;
        wp.media.editor.send.attachment = function(props, attachment)
        {
            if ( _custom_media ){
                var img_src = attachment.url;
                button.prev().remove();
                button.before("<img src="+img_src+" width=100px height=100px class='theme_favicon_icon' alt='favicon-icon'>");
                button.parent().find(".pbimagestore").val(img_src);
            } else {
                return _orig_send_attachment.apply( this, [props, attachment] );
            };
        }

        wp.media.editor.open(button);
        return false;
    });

    if( jQuery('.pstatus:checked').val() == "rent" ){
    	jQuery('.ppricetype').show();
   	} else {
		jQuery('.ppricetype').hide();
	}

    jQuery('.pstatus').change(function() {
    	if( jQuery(this).val() == "rent" ){
    		jQuery('.ppricetype').show();
    	} else {
    		jQuery('.ppricetype').hide();
    	}
    });
	
    /* WP Media Uploader */
    var _shr_media = true;
    var _orig_send_attachment = wp.media.editor.send.attachment;
 
    jQuery( '.agent-image, .agent-logo-image' ).click( function() {
 
        var button = jQuery( this ),
                textbox_id = jQuery( this ).attr( 'data-id' ),
                image_id = jQuery( this ).attr( 'data-src' ),
                _shr_media = true;
 
        wp.media.editor.send.attachment = function( props, attachment ) {
 
            if ( _shr_media && ( attachment.type === 'image' ) ) {
                if ( image_id.indexOf( "," ) !== -1 ) {
                    image_id = image_id.split( "," );
                    $image_ids = '';
                    jQuery.each( image_id, function( key, value ) {
                        if ( $image_ids )
                            $image_ids = $image_ids + ',#' + value;
                        else
                            $image_ids = '#' + value;
                    } );
 
                    var current_element = jQuery( $image_ids );
                } else {
                    var current_element = jQuery( '#' + image_id );
                }
 
                jQuery( '#' + textbox_id ).val( attachment.id );
                                console.log(textbox_id)
                current_element.attr( 'src', attachment.url ).show();
            } else {
                alert( 'Please select a valid image file' );
                return false;
            }
        }
 
        wp.media.editor.open( button );
        return false;
    });

    jQuery( '.agent-logo-image' ).click( function() {
 
        var button = jQuery( this ),
                textbox_id = jQuery( this ).attr( 'data-id' ),
                image_id = jQuery( this ).attr( 'data-src' ),
                _shr_media = true;
 
        wp.media.editor.send.attachment = function( props, attachment ) {
 
            if ( _shr_media && ( attachment.type === 'image' ) ) {
                if ( image_id.indexOf( "," ) !== -1 ) {
                    image_id = image_id.split( "," );
                    $image_ids = '';
                    jQuery.each( image_id, function( key, value ) {
                        if ( $image_ids )
                            $image_ids = $image_ids + ',#' + value;
                        else
                            $image_ids = '#' + value;
                    } );
 
                    var current_element = jQuery( $image_ids );
                } else {
                    var current_element = jQuery( '#' + image_id );
                }
 
                jQuery( '#' + textbox_id ).val( attachment.id );
                                console.log(textbox_id)
                current_element.attr( 'src', attachment.url ).show();
            } else {
                alert( 'Please select a valid image file' );
                return false;
            }
        }
 
        wp.media.editor.open( button );
        return false;
    });

    /* <![CDATA[ */ var quicktagsL10n = {"closeAllOpenTags":"Close all open tags","closeTags":"close tags","enterURL":"Enter the URL","enterImageURL":"Enter the URL of the image","enterImageDescription":"Enter a description of the image","textdirection":"text direction","toggleTextdirection":"Toggle Editor Text Direction","dfw":"Distraction-free writing mode","strong":"Bold","strongClose":"Close bold tag","em":"Italic","emClose":"Close italic tag","link":"Insert link","blockquote":"Blockquote","blockquoteClose":"Close blockquote tag","del":"Deleted text (strikethrough)","delClose":"Close deleted text tag","ins":"Inserted text","insClose":"Close inserted text tag","image":"Insert image","ul":"Bulleted list","ulClose":"Close bulleted list tag","ol":"Numbered list","olClose":"Close numbered list tag","li":"List item","liClose":"Close list item tag","code":"Code","codeClose":"Close code tag","more":"Insert Read More tag"}; /* ]]> */    
    
});