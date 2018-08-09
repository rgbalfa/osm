<?php

namespace Drupal\osm_location\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * A controller.
 */
class OSMLocationMap extends ControllerBase {

  /**
   * Returns a render-able array for the map page.
   */
  public function content() {
    $build = [
      '#markup' => '<div id=mapid></div>'
    ];
    return $build;
  }

}
