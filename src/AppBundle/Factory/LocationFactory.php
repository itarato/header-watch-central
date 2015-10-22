<?php
/**
 * @file
 */

namespace AppBundle\Factory;

use AppBundle\Entity\CrawlerEntity;

class LocationFactory implements IdentifiableFactoryInterface {

  /**
   * @param $address
   * @param $host
   * @return \AppBundle\Entity\CrawlerEntity
   * @throws \Exception
   */
  public function create($address = NULL, $host = NULL) {
    if (NULL === $address || NULL === $host) {
      throw new \Exception('Missing arguments.');
    }

    return new CrawlerEntity($address, $host);
  }

}
