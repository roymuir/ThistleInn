/**
 * @file
 * Javascript to display a popup after a delay.
 */

(function ($) {

Drupal.behaviors.initPopupOnLoad = {
  attach: function (context, settings) {
    if (!$.isFunction($.colorbox)) {
      return;
    }

    $('body', context).once('popup_onload', function() {
      var popup_onload_settings = settings.popup_onload;

      setTimeout(function() {
        $.colorbox(popup_onload_settings);
      }, popup_onload_settings.delay);
    });

    $(document).bind('cbox_complete', function() {
      $.ajax({
        async: false,
        dataType: 'json',
        data: {
          popup_id: settings.popup_onload.popup_id
        },
        type: 'POST',
        url: '/popup_onload_save_cookie_gateway'
      });
    });
  }
}
})(jQuery);
