<?php
/**
 * @file
 */

namespace AppBundle\Entity;

use AppBundle\IdentifiableInterface;

class CrawlerEntity implements IdentifiableInterface {

  private $address;

  private $port;

  public function __construct($address, $port) {
    $this->address = $address;
    $this->port = $port;
  }

  /**
   * @return mixed
   */
  public function getAddress() {
    return $this->address;
  }

  /**
   * @param mixed $address
   */
  public function setAddress($address) {
    $this->address = $address;
  }

  /**
   * @return mixed
   */
  public function getPort() {
    return $this->port;
  }

  /**
   * @param mixed $port
   */
  public function setPort($port) {
    $this->port = $port;
  }

  /**
   * @return string
   */
  public function getID() {
    return md5($this->address . ':' . $this->port);
  }

}
