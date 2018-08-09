<?php

namespace Drupal\osm_location\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * A controller.
 */
class OSMLocationMap extends ControllerBase {

  /**
   * Returns array.
   */
  private function calcBoundries() {
    // todo: calc boundries
    return [40.730610, -73.935242]
  }


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

    $boundries = $this->calcBoundries($locations);

    $build = [
      'map' => [
        '#type' => 'markup',
        '#markup' => 'map:<div id=mapid></div>',
        '#allowed_tags' => ['div'],
      ],
      '#attached' => [
        'library' => [
           'core/jquery',
           'core/drupalSettings',
           'osm_location/leaflet',
           'osm_location/leaflet_custom',
        ],
        'drupalSettings' => [
           'osm_location' => [
             'locations' => $locations,
             'boundries' => $boundries,
           ]
        ]
      ],
    ];
    return $build;
  }

}
