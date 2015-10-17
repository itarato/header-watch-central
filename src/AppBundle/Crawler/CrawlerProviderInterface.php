<?php
/**
 * @file
 */

namespace AppBundle\Crawler;

use AppBundle\Factory\LocationFactory;

interface CrawlerProviderInterface {

  public function __construct(LocationFactory $locationFactory);

  public function register($address, $port);

  public function allocate($serverID);

  public function free($serverID);

  public function countAll();

  public function countAvailable();

  public function get($count = 1);

}
