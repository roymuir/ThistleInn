/*jQuery(window).bind('load', function() {
	jQuery('.foreground').toggle('slow');
});*/

/*jQuery(function(){
	jQuery('.view-portfolio .views-row .views-field-field-portfolio-image a').hover(function(){
		jQuery(this).find('img').stop().animate({opacity:'.4'})
	},

	function(){
		jQuery(this).find('img').stop().animate({opacity:'1'})
	})
})*/

jQuery(document).ready(function($) {
	/*jQuery('.field-name-field-about-image').addClass('clearfix');*/

	jQuery('#block-views-tweets-block').addClass('grid-5 rt-suffix-1');

	jQuery('#block-views-portfolio-block-1').addClass('grid-5 rt-suffix-1');

	/*jQuery('.follow-link-wrapper a').attr('target', '_blank');*/

	jQuery('#header .menu .expanded .menu').wrap('<div class="menu-wrapper"></div>');

	// Mobile menu
    var $menu = $('#block-system-main-menu').clone().prepend('body');
    $menu.attr('id', 'mobile-mainnav');
    $menu.mmenu({
            slidingSubmenus: false
        }, {
    });
    
    jQuery("#user_amount").on('keyup', function(){
      var dec = parseFloat(this.value.replace('$',''));
      var i = Math.round(dec, 0);
      //this.value = '$' + i + '.00';
      
      jQuery("input[name=amount]", ".paypal").val(i);
    });
    
    jQuery("#user_amount").on('blur', function(){
      var dec = parseFloat(this.value.replace('$',''));
      var i = Math.round(dec, 0);
      this.value = '$' + i + '.00';
    });
    
    jQuery(".positive-integer").numeric({ 
      decimal: true, 
      negative: false 
    }, 
    function() { 
      //alert("Positive integers only"); 
      this.value = ""; 
      this.focus(); 
    });


    // var API = $('#mobile-mainnav').data('mmenu');
    // $('#mobile-link').live('touchend', function() {
    //     API.open();
    // });
});