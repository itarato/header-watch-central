<?php
/**
 * @file
 */

namespace AppBundle\Crawler;

use AppBundle\Entity\CrawlerEntity;
use AppBundle\Factory\LocationFactory;

interface CrawlerProviderInterface {

  public function __construct(LocationFactory $locationFactory);

  public function register($address, $port);

  public function allocate($serverID);

  public function free($serverID);

  public function countAll();

  public function countAvailable();

  /**
   * @param int $count
   * @return CrawlerEntity[]
   */
  public function get($count = 1);

}
