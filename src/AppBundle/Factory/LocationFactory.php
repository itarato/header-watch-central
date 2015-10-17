<?php
/**
 * @file
 */

namespace AppBundle\Factory;

use AppBundle\Entity\LocationEntity;

class LocationFactory implements IdentifiableFactoryInterface {

  /**
   * @param $address
   * @param $host
   * @return \AppBundle\Entity\LocationEntity
   * @throws \Exception
   */
  public function create($address = NULL, $host = NULL) {
    if (NULL === $address || NULL === $host) {
      throw new \Exception('Missing arguments.');
    }

    return new LocationEntity($address, $host);
  }

}
