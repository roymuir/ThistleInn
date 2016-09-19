jQuery(window).bind('load', function() {
	jQuery('.foreground').toggle('slow');
});

jQuery(function(){
	jQuery('.view-portfolio .views-row .views-field-field-portfolio-image a').hover(function(){
		jQuery(this).find('img').stop().animate({opacity:'.4'})
	},

	function(){
		jQuery(this).find('img').stop().animate({opacity:'1'})
	})
})

jQuery(document).ready(function() {
	jQuery('.field-name-field-about-image').addClass('clearfix');
	jQuery('#block-views-tweets-block').addClass('grid-5 rt-suffix-1');
	jQuery('#block-views-portfolio-block-1').addClass('grid-5 rt-suffix-1');
	if (jQuery(window).width() <= 747){	
		jQuery('#block-block-6').appendTo('#content .region-content');
	}	
	jQuery('.follow-link-wrapper a').attr('target', '_blank');
});

jQuery(window).resize(function(){
	if (jQuery(window).width() <= 747){	
		jQuery('#block-block-6').appendTo('#content .region-content');
	}	else {
		jQuery('#block-block-6').appendTo('#header .col2 .region');
	}
});


