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

}