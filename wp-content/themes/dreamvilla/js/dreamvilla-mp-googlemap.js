 jQuery(document).ready(function()
 {
 	"use strict";
 	var lat = jQuery('#platitude').val();
	var lng = jQuery('#plongitude').val();
	var marker;
	var map;
	if( lat == '' || typeof lat === "undefined" || lng == ''  || typeof lng === 'undefined') {
		lat = "21.744192933129906";
		lng = "72.16369589843748";
	}
    var myCenter=new google.maps.LatLng(lat,lng);
	var mapDiv = document.getElementById('googleMap');
	function initialize(){
		var mapProp = {
			  center:myCenter,
			  zoom:9,
			  mapTypeId:google.maps.MapTypeId.ROADMAP
		};
		
		map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
	
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
	if(document.getElementById('googleMap') != null ){
		google.maps.event.addDomListener(window, 'load', initialize);
	}
	jQuery('#googleMap').on('appear',function(){
		alert("Hello");
		google.maps.event.trigger("#googleMap", 'resize');
	});
	jQuery( "#paddress" ).on('input',function() {
		var geocoder 	= new google.maps.Geocoder();
		var address 	= jQuery('#paddress').val();
		geocoder.geocode( { 'address': address}, function(results, status) {
		
			if (status == google.maps.GeocoderStatus.OK) {
				var longi 	= results[0].geometry.location.lat();
				var lati 	= results[0].geometry.location.lng();
				
			    document.getElementById("platitude").value = longi;
				document.getElementById("plongitude").value = lati;
				
				var latlng = new google.maps.LatLng(longi, lati);
				marker.setPosition(latlng);
				map.panTo(marker.getPosition());
			} 
		});			
	});
	jQuery( "#platitude,#plongitude" ).on('input',function() {
		var geocoder 	= new google.maps.Geocoder();
		var address 	= jQuery('#paddress').val();
		geocoder.geocode( { 'address': address}, function(results, status) {
		
			if (status == google.maps.GeocoderStatus.OK) {
				var longi 	= jQuery('#platitude').val();
				var lati 	= jQuery('#plongitude').val();				    
				var latlng = new google.maps.LatLng(longi, lati);
				marker.setPosition(latlng);
				map.panTo(marker.getPosition());
			} 
		});			
	});	
	jQuery("#property_address").on("click",function(){
		setTimeout(
		  function() 
		  {
		  	if(document.getElementById('googleMap') != null ){
		  		google.maps.event.trigger(map, 'resize');
		  	}
		    //do something special
		  }, 1000);
	});
});