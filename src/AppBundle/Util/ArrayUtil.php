<?php
/**
 * @file
 */

namespace AppBundle\Util;

use AppBundle\Document\Location;

class ArrayUtil {

  public static function walkKeys(array $items, callable $f) {
    $out = [];
    foreach ($items as $key => $item) {
      $key = call_user_func($f, $item, $key);
      $out[$key] = $item;
    }
    return $out;
  }

  /**
   * @param Location[] $locations
   * @return array
   */
  public static function walkKeyForLocation(array $locations) {
    return self::walkKeys(
      $locations, function (Location $item) {
      return $item->getId();
    });
  }

}
