jQuery(document).ready(function ($) {

	"use strict";

    // Add more option
    dreamvilla_mp_show_close_button("#addroomtable");
    dreamvilla_mp_show_close_button("#addessential");
    dreamvilla_mp_show_close_button("#addinterior");
    dreamvilla_mp_show_close_button("#addexterior");
    dreamvilla_mp_show_close_button("#nearbyplaces");
    dreamvilla_mp_show_close_button("#nearbycustomplaces");
    dreamvilla_mp_show_close_button("#addfloorplans");
    dreamvilla_mp_show_close_button("#addroomtable");
    dreamvilla_mp_show_close_button("#addbathroomtable");
    dreamvilla_mp_show_close_button("#addkitchentable");
    dreamvilla_mp_show_close_button("#addswimmingpooltable");
    dreamvilla_mp_show_close_button("#addgymtable");

    function dreamvilla_mp_show_close_button(tableId){
        if( jQuery(tableId).find("tr").size() > 1 ){
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
        jQuery(tableId + " tbody").find("tr").last().find(".gallery-thumb").remove();
        
        if( jQuery(tableId).find("tr").size() > 1 ) {
            jQuery(tableId).find(".removebedroom").show();
        } else {
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
        
        if( jQuery(tableId).find("tr").size() >1  ){
            jQuery(tableId).find(".removebedroom").show();
        } else {
            jQuery(tableId).find(".removebedroom").hide();
        }                   
    });

    jQuery(document).on("click",".uploadbtn",function(){
        jQuery(this).parent().find(".upload").trigger("click");
    });

    // Google Map
    var lat = jQuery('#platitude').val();
    var lng = jQuery('#plongitude').val();
    var marker;
    var map;
    if( lat == '' || typeof lat === "undefined" || lng == ''  || typeof lng === 'undefined') {
        lat = "21.744192933129906";
        lng = "72.16369589843748";
    }   

    function initialize(){
        var mapProp = {
              center:myCenter,
              zoom:9,
              scrollwheel: false,
              mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        
        map=new google.maps.Map(document.getElementById("property_google_map"),mapProp);
    
        marker=new google.maps.Marker({
            position:myCenter,
            draggable:true              
        });
    
        marker.setMap(map);
    
        google.maps.event.addListener(marker, 'dragend', function (event) {
            document.getElementById("platitude").value = this.getPosition().lat();
            document.getElementById("plongitude").value = this.getPosition().lng();
        });
        
        google.maps.event.addListener(map,'center_changed',function() {
          window.setTimeout(function() {
            map.panTo(marker.getPosition());
          },1000);
        });
    }   
    if(document.getElementById('property_google_map') != null ){
        google.maps.event.addDomListener(window, 'load', initialize);

        var myCenter = new google.maps.LatLng(lat,lng);
        var mapDiv = document.getElementById('property_google_map');
    }

    jQuery('#property_google_map').on('appear',function(){
        google.maps.event.trigger("#property_google_map", 'resize');
    });

    jQuery( ".submit-location" ).on('click',function(){
        var geocoder    = new google.maps.Geocoder();

        var address  = jQuery('#paddress').val();
        var city     = jQuery('#pcity').val();
        var state    = jQuery('#pstate').val();
        var country  = jQuery('#pcountry').val();
        var pincode  = jQuery('#ppincode').val();

        address = address + ' ' + city + ' ' + state + ' ' + country + ' ' + pincode;

        geocoder.geocode( { 'address': address}, function(results, status) {
        
            if (status == google.maps.GeocoderStatus.OK) {
                var longi   = results[0].geometry.location.lat();
                var lati    = results[0].geometry.location.lng();
                
                document.getElementById("platitude").value = longi;
                document.getElementById("plongitude").value = lati;
                
                var latlng = new google.maps.LatLng(longi, lati);
                marker.setPosition(latlng);
                map.panTo(marker.getPosition());
            } 
        });         
    });

    jQuery( "#platitude,#plongitude" ).on('input',function() {
        var geocoder    = new google.maps.Geocoder();
        var address     = jQuery('#paddress').val();
        geocoder.geocode( { 'address': address}, function(results, status) {
        
            if (status == google.maps.GeocoderStatus.OK) {
                var longi   = jQuery('#platitude').val();
                var lati    = jQuery('#plongitude').val();                  
                var latlng = new google.maps.LatLng(longi, lati);
                marker.setPosition(latlng);
                map.panTo(marker.getPosition());
            } 
        });         
    });

    jQuery("#property_address").on("click",function(){
        setTimeout( function(){
            if(document.getElementById('property_google_map') != null ){
                google.maps.event.trigger(map, 'resize');
            }            
        }, 1000);
    });

    // Apply jquery ui sortable on gallery items
    jQuery("#property-gallery-container").sortable({
        revert: 100,
        placeholder: "sortable-placeholder",
        cursor: "move"
    });

    var action = "user_profile_image_upload";

    // initialize uploader 
    var uploader = new plupload.Uploader({
        browse_button   : 'select-images',
        file_data_name  : 'dreamvilla_mp_upload_file',
        drop_element    : 'drag-and-drop',
        url             : submit_property_object.ajaxurl + "?action=" + action,
        filters         : { mime_types : [ { title : 'Valid file formats', extensions : "jpg,jpeg,gif,png" } ], max_file_size: '10000kb', prevent_duplicates: true }
    });

    uploader.init();

    // Run after adding file
    uploader.bind('FilesAdded', function(up, files) {
        var html = '';
        var galleryThumb = "";
        plupload.each(files, function(file) {
            galleryThumb += '<div id="holder-' + file.id + '" class="gallery-thumb">' + '' + '</div>';
        });
        document.getElementById('property-gallery-container').innerHTML += galleryThumb;
        up.refresh();
        uploader.start();
    });


    // Run during upload
    uploader.bind('UploadProgress', function(up, file) {
        document.getElementById( "holder-" + file.id ).innerHTML = '<span>' + file.percent + "%</span>";
    });


    // In case of error
    uploader.bind('Error', function( up, err ) {
        document.getElementById('errors-report').innerHTML += "<br/>" + "Error #" + err.code + ": " + err.message;
    });

    // If files are uploaded successfully
    uploader.bind('FileUploaded', function ( up, file, ajax_response ) {
        var response = $.parseJSON( ajax_response.response );

        if ( response.success ) {

            var galleryThumbHtml = '<img src="' + response.url + '" alt="" />' +
                '<a class="remove-image" data-property-id="' + 0 + '"  data-attachment-id="' + response.attachment_id + '" href="#remove-image"><i class="fa fa-trash-o"></i></a>' +
                '<a class="mark-featured" data-property-id="' + 0 + '"  data-attachment-id="' + response.attachment_id + '" href="#mark-featured"><i class="fa fa-star-o"></i></a>' +
                '<input type="hidden" class="gallery-image-id" name="property_gallery[]" value="' + response.attachment_id + '"/>';

            document.getElementById( "holder-" + file.id ).innerHTML = galleryThumbHtml;

            bindThumbnailEvents();  // bind click event with newly added gallery thumb
        } else {
            console.log ( response );
        }
    });

    // Bind thumbnails events with newly added gallery thumbs
    var bindThumbnailEvents = function () {

        // unbind previous events
        jQuery('a.remove-image').unbind('click');
        jQuery('a.mark-featured').unbind('click');

        // Mark as featured Image Of Property
        jQuery('a.mark-featured').on( 'click', function(event){

            event.preventDefault();

            var Property_Featured_Image = jQuery( this );
            var starIcon = Property_Featured_Image.find( 'i');

            if ( starIcon.hasClass( 'fa-star-o' ) ) {   // if not already featured

                jQuery('.gallery-thumb .featured-img-id').remove();      // remove featured image id field from all the gallery thumbs
                jQuery('.gallery-thumb .mark-featured i').removeClass( 'fa-star').addClass( 'fa-star-o' );   // replace any full star with empty star

                var Property_Featured_Image = jQuery( this );
                var input = Property_Featured_Image.siblings( '.gallery-image-id' );      //  get the gallery image id field in current gallery thumb
                var featured_input = input.clone().removeClass( 'gallery-image-id' ).addClass( 'featured-img-id' ).attr( 'name', 'featured_image_id' );     // duplicate, remove class, add class and rename to full fill featured image id needs

                Property_Featured_Image.closest( '.gallery-thumb' ).append( featured_input );     // append the cloned ( featured image id ) input to current gallery thumb
                starIcon.removeClass( 'fa-star-o' ).addClass( 'fa-star' );      // replace empty star with full star

            }

        });


        // Remove gallery images
        jQuery('a.remove-image').on( 'click', function(event){

            event.preventDefault();
            var remove_image_this = jQuery(this);
            var gallery_thumb = remove_image_this.closest('.gallery-thumb');
            var loader = remove_image_this.siblings('.loader');

            loader.show();

            var removal_request = $.ajax({
                url: submit_property_object.ajaxurl,
                type: "POST",
                data: { attachment_id : remove_image_this.data('attachment-id'), action : "remove_gallery_image", },
                dataType: "html"
            });

            removal_request.done(function( response ) {

                var result = $.parseJSON( response );
                
                if( result.attachment_removed ){
                    gallery_thumb.remove();
                } else {
                    document.getElementById('errors-report').innerHTML += "<br/>" + "Error : Failed to remove attachment";
                }

            });

            removal_request.fail(function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
            });

        });

    };

    bindThumbnailEvents();

    /****************** Apply jQuery ui sortable for gellery Item end ********/

    /****** This is just for the testing purpose only *******/

    // initialize uploader
    var uploader1 = new plupload.Uploader({
        browse_button   : 'uploadlogoBtn',
        file_data_name  : 'dreamvilla_mp_upload_file',
        multi_selection : false,
        url             : submit_property_object.ajaxurl + "?action=" + action,
        filters         : { mime_types : [ { title : 'Valid file formats', extensions : "jpg,jpeg,gif,png" } ], max_file_size: '1000kb', prevent_duplicates: true }
    });

    uploader1.init();

    /* Run after adding file */
    uploader1.bind('FilesAdded', function(up, files) {
        
        var html = '';
        var galleryThumb = "";
        plupload.each(files, function(file) {
            
            var value = jQuery("#uploadlogoBtn_container").find(".gallery-thumb").find(".property-media-id").val();
            
            if(!(typeof value === "undefined")){
            
                jQuery("#uploadlogoBtn_container").find(".gallery-thumb").remove();
                
                var removal_request = $.ajax({
                    url: submit_property_object.ajaxurl,
                    type: "POST",
                    data: { attachment_id : value, action : "remove_gallery_image", },
                    dataType: "html"
                });

                removal_request.done(function( response ) {

                    var result = $.parseJSON( response );
                    
                    if( result.attachment_removed ){
                        
                    } else {
                       // document.getElementById('errors-report').innerHTML += "<br/>" + "Error : Failed to remove attachment";
                    }

                });

                removal_request.fail(function( jqXHR, textStatus ) {
                    alert( "Request failed: " + textStatus );
                });
            }
            galleryThumb += '<div id="holder-' + file.id + '" class="gallery-thumb">' + '' + '</div>';            
        });
        document.getElementById('uploadlogoBtn_container').innerHTML += galleryThumb;
        up.refresh();
        uploader1.start();
    });


    /* Run during upload */
    uploader1.bind('UploadProgress', function(up, file) {
        document.getElementById( "holder-" + file.id ).innerHTML = '<span>' + file.percent + "%</span>";
    });


    /* In case of error */
    uploader1.bind('Error', function( up, err ) {
        document.getElementById('errors-log').innerHTML += "<br/>" + "Error #" + err.code + ": " + err.message;
    });


    /* If files are uploaded successfully */
    uploader1.bind('FileUploaded', function ( up, file, ajax_response ) {
        var response = $.parseJSON( ajax_response.response );

        if( response.success ){

            var galleryThumbHtml = '<img src="' + response.url + '" alt="" />' +
                '<input type="hidden" class="property-media-id" name="property_media_id[]" value="' + response.attachment_id + '"/>' +
                '<input type="hidden" class="gallery-image-id" value="' + response.attachment_id + '"/>';
                
            document.getElementById( "holder-" + file.id ).innerHTML = galleryThumbHtml;

            var value = jQuery("#holder-"+file.id).parent().find(".gallery-image-id").val();
            jQuery("#holder-"+file.id).parent().find(".pbimagestore").val(value);
            jQuery("#holder-"+file.id).parent().find(".gallery-image-id").remove();

            bindThumbnailEvents();  // bind click event with newly added gallery thumb
        } else {
            // log response object
            console.log ( response );
        }
    });
    
    bindThumbnailEvents(); // run it first time - required for property edit page

    /****** This is just for the testing purpose only *******/

    /****************** Upload images using class in pluploader Start **************/

    $(document).on('mouseenter','.uploadlogo',function () {
        $(".uploadlogo").removeAttr("id");
        $(".uploadlogo").parent().removeAttr("id");
        $(this).attr("id",'uploadlogoBtn');
        $(this).parent().attr("id","uploadlogoBtn_container");
        uploader1.setOption("browse_button", $(this).attr('id')); //Assign the ID of the pickfiles button to pluploads browse_button

    });

    /****************** Upload images using class in pluploader Emd **************/

    // Submit Property
    jQuery('.submit-property-form').on('submit', function (e) {
        
        if (!jQuery(this).valid()) return false;
        
        jQuery('p.status', this).show().text(submit_property_object.loadingmessage);
        
        var action = 'dreamvilla_mp_ajax_submit_property';
        
        var newCustomerForm = jQuery(this).serialize();

        jQuery.ajax({
            type        : 'POST',
            dataType    : 'json',
            url         : submit_property_object.ajaxurl + "?action=" + action,
            data        : newCustomerForm,
            success: function (data) {
                jQuery('p.status').html('');
                if ( data.success ) {
                    window.location.href = data.redirect_url;
                } else {
                    jQuery('p.status').html(data.errors);                
                    jQuery('p.status').fadeIn();
                }
            }
        });
        e.preventDefault();
    });
    
    if( jQuery(".submit-property-form").length ){
        jQuery(".submit-property-form").validate();        
    }

});