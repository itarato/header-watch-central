<?php
/**
 * @file
 */

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class CrawlResult
 * @package AppBundle\Document
 * @MongoDB\Document()
 */
class CrawlResult {

  /**
   * @MongoDB\Id(strategy="auto")
   * @var string
   */
  protected $id;

  /**
   * @MongoDB\String()
   * @var string
   */
  protected $location_id;

  /**
   * @MongoDB\Hash()
   * @var object
   */
  protected $result;

  /**
   * @MongoDB\Int()
   * @var int
   */
  protected $time;

  /**
   * @return string
   */
  public function getLocationId() {
    return $this->location_id;
  }

  /**
   * @param string $location_id
   * @return $this
   */
  public function setLocationId($location_id) {
    $this->location_id = $location_id;
    return $this;
  }

  /**
   * @return object
   */
  public function getResult() {
    return $this->result;
  }

  /**
   * @param object $result
   * @return $this
   */
  public function setResult($result) {
    $this->result = $result;
    return $this;
  }

  /**
   * @return int
   */
  public function getTime() {
    return $this->time;
  }

  /**
   * @param int $time
   * @return $this
   */
  public function setTime($time) {
    $this->time = $time;
    return $this;
  }

}
