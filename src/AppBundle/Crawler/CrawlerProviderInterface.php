<?php
/**
 * @file
 */

namespace AppBundle\Crawler;

interface CrawlerProviderInterface {

  public function register($host, $port);

  public function allocate($serverID);

  public function free($serverID);

  public function get();

}
