(function ($, Drupal) {
  Drupal.behaviors.recordingFilter = {
    attach: function (context, settings) {
      if (context !== document) {
        $('[id^=song-name-wrapper-] input').each(function () {
          if (!$.data(this, 'recordingFilter-attached')) {
            $.data(this, 'recordingFilter-attached', true);
            Drupal.attachBehaviors(this);
          }
        });
      }
    }
  };
})(jQuery, Drupal);

