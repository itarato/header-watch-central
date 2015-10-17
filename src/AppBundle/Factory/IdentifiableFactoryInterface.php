<?php
/**
 * @file
 */

namespace AppBundle\Factory;


use AppBundle\IdentifiableInterface;

interface IdentifiableFactoryInterface {

  /**
   * @param array $params
   * @return \AppBundle\IdentifiableInterface
   */
  public function create($params);

}