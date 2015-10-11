<?php
/**
 * @file
 */

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Location
 * @package AppBundle\Document
 * @MongoDB\Document()
 */
class Location {

  /**
   * @MongoDB\Id(strategy="auto")
   * @var string
   */
  protected $id;

  /**
   * @todo try objectid or referenceone
   * @MongoDB\String()
   * @var string
   */
  protected $user_id;

  /**
   * @MongoDB\String()
   * @var string
   */
  protected $path;

  /**
   * Get id
   *
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set userId
   *
   * @param string $userId
   * @return self
   */
  public function setUserId($userId) {
    $this->user_id = $userId;
    return $this;
  }

  /**
   * Get userId
   *
   * @return string $userId
   */
  public function getUserId() {
    return $this->user_id;
  }

  /**
   * Set path
   *
   * @param string $path
   * @return self
   */
  public function setPath($path) {
    $this->path = $path;
    return $this;
  }

  /**
   * Get path
   *
   * @return string $path
   */
  public function getPath() {
    return $this->path;
  }

}
