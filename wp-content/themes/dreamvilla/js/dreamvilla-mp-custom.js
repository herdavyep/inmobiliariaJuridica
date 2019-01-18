jQuery(document).ready(function(){
	"use strict";
	jQuery("div.dimension-btn.show-hide-btn a").eq(0).addClass("active").end();

	jQuery("div.carousel-inner").find("div.item:first-child").addClass("active");
	
	/*To show the model in center of the screen start here*/
	function dreamvilla_mp_centerModals(){
	  jQuery('.modal').each(function(i){
	    var $clone = jQuery(this).clone().css('display', 'block').appendTo('body');
	    var top = Math.round(($clone.height() - $clone.find('.modal-content').height()) / 2);
	    top = top > 0 ? top : 0;
	    $clone.remove();
	    jQuery(this).find('.modal-content').css("margin-top", top);
	  });
	}
	
	jQuery('.modal').on('show.bs.modal', dreamvilla_mp_centerModals);
	
	jQuery(window).on('resize', dreamvilla_mp_centerModals);
	
	/*To show the model in center of the screen end here*/
	jQuery("#main-menu").mmenu({
		offCanvas: {
			position  : "right",
			pageNodetype: "section"				
		}
	});

	jQuery('.search-form label span.screen-reader-text').remove();
	jQuery('.search-submit.screen-reader-text').remove();
	jQuery('.form-control.custom_input').remove();
	jQuery('.search-field').attr('class','form-control custom_input');
	jQuery('.btn.btn-default.custom_input').click(function(){
		jQuery('.search-form').submit();
	});

	var j=0;
	jQuery(".carousel-inner").each(function(){
		 var carosusel_slider_img = jQuery(this).find(".item").length;
		 for(var i=0;i<carosusel_slider_img;i++)
		 {
			  if(i==0)
			  {
			 	  var html_code='<li data-target="#myCarousel'+j+ '" data-slide-to="'+ i +'" class="active"></li>';    
			  }
			  else
			  {
			 	  var html_code='<li data-target="#myCarousel'+j+ '" data-slide-to="'+ i +'"></li>';
			  }
			  jQuery(this).parent().find(".carousel-indicators").append(html_code);
		 }
		 jQuery(this).parent().attr("id","myCarousel"+j);
		 j++;	
	});
	
	jQuery(function() {
		jQuery( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
		jQuery( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
	});
	jQuery(".property-type li a").click(function(){
		var property_type = jQuery(this).attr('data-id');
		jQuery(".property-type li a").removeClass("active");
		jQuery(this).addClass("active");
		jQuery(".carousel.slide.carousel-slide-recent-property").css('display','none');
		jQuery("div[data-target="+property_type+"]").css('display','block');

		jQuery(".property-list-list.property-list-grid").hide();
		jQuery(".carousel-slide-recent-property").hide();
		jQuery(".load_more").hide();		
		jQuery("div[data-target="+property_type+"]").show();
	});
	jQuery(".property-type li a").first().trigger("click");

	jQuery(".property-type.bs-select-hidden").change(function(){
		var property_type = jQuery(this).val();
		jQuery(".property-type option").removeClass("active");
		jQuery(".property-type.bs-select-hidden option[value="+property_type+"]").addClass("active");
		jQuery(".carousel.slide.carousel-slide-recent-property").css('display','none');
		jQuery("div[data-target="+property_type+"]").css('display','block');

		jQuery(".property-list-list.property-list-grid").hide();
		jQuery(".carousel-slide-recent-property").hide();
		jQuery(".load_more").hide();		
		jQuery("div[data-target="+property_type+"]").show();
	});
	jQuery(".property-type.bs-select-hidden").first().trigger("change");
	
	jQuery("#more-filter").on("click",function(){
		jQuery("#more-filter-options").slideToggle();
	});

	jQuery(".button-div button").on("click",function(){
		jQuery(this).toggleClass("active-button");
		jQuery(this).parent().next().slideToggle();
	});

	jQuery(".choose-plan-url").on("click",function(){
		jQuery(this).toggleClass("active-button");
		jQuery(this).parent().next().slideToggle();
	})
});