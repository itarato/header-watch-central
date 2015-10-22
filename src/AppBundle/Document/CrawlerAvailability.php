<?php
/**
 * @file
 */

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class CrawlerAvailability
 * @package AppBundle\Document
 *
 * @MongoDB\Document()
 */
class CrawlerAvailability {

  /**
   * @MongoDB\Id(strategy="auto")
   * @var string
   */
  protected $id;

  /**
   * @MongoDB\String()
   * @var string
   */
  protected $server_id;

  /**
   * @MongoDB\Int()
   * @var int
   */
  protected $start_at;

  /**
   * @MongoDB\Collection()
   * @var string[]
   */
  protected $locations;

  /**
   * @param \string[] $locations
   * @return CrawlerAvailability
   */
  public function setLocations($locations) {
    $this->locations = $locations;
    return $this;
  }

  /**
   * @param int $start_at
   * @return CrawlerAvailability
   */
  public function setStartAt($start_at) {
    $this->start_at = $start_at;
    return $this;
  }

  /**
   * @param string $server_id
   * @return CrawlerAvailability
   */
  public function setServerId($server_id) {
    $this->server_id = $server_id;
    return $this;
  }

  /**
   * @return \string[]
   */
  public function getLocations() {
    return $this->locations;
  }

  /**
   * @return int
   */
  public function getStartAt() {
    return $this->start_at;
  }

  /**
   * @return string
   */
  public function getServerId() {
    return $this->server_id;
  }

}
