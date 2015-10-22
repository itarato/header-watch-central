<?php
/**
 * @file
 */

namespace AppBundle\Crawler;

use AppBundle\Entity\CrawlerEntity;

class CrawlerOperator {

  public function crawl(CrawlerEntity $crawlerEntity, array $locations) {
    var_dump($crawlerEntity->getID());
    var_dump(count($locations));
  }

}
