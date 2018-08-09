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
  private function calcMapCenter() {
    // todo: calc boundries
    return [40.730610, -73.935242];
  }

  /**
   * Returns array.
   */
  private function calcMapZoom() {
    // todo: calc boundries
    return 12;
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

    $center = $this->calcMapCenter($locations);
    $zoom = $this->calcMapZoom($locations);

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
             'center' => $center,
             'zoom' => $zoom,
           ]
        ]
      ],
    ];
    return $build;
  }

}
