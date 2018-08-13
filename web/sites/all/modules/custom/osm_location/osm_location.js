(function ($) {
  'use strict';
  Drupal.behaviors.osm_location = {
    attach: function (context) {
      $('#mapid', context).once('init').each(function () {
        osm_location_map_init(drupalSettings.osm_location.locations, drupalSettings.osm_location.center, drupalSettings.osm_location.zoom);
      });
    }
  };
})(jQuery);
