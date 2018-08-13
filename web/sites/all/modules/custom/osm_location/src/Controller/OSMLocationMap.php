<?php

namespace Drupal\osm_location\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Cache\Cache;

/**
 * A controller.
 */
class OSMLocationMap extends ControllerBase {

  /**
   * Returns a render-able array for the map page.
   */
  public function content() {
    $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties([
      'type' => 'location'
    ]);
    $locations = [];
    foreach ($nodes as $key => $node) {
      $location = [
        'title' => $node->title->value,
        'lat' => $node->field_lat->value,
        'long' => $node->field_long->value,
      ];
      $locations[] = $location;
    }

    $build = [
      'map' => [
        '#type' => 'markup',
        '#markup' => '<div id="mapid"></div>',
        '#allowed_tags' => ['div'],
      ],
      '#attached' => [
        'library' => [
           'osm_location/leaflet_custom',
        ],
        'drupalSettings' => [
           'osm_location' => [
             'locations' => $locations,
           ]
        ]
      ],
      '#cache' => [
        'contexts' => ['url.query_args:debug'], // setting this cache contexts as debug aid.
        'tags' => ['osm_location_map'],
        'max-age' => Cache::PERMANENT,
      ],
    ];
    return $build;
  }

}
