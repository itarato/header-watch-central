<?php
/**
 * @file
 */

namespace AppBundle\Crawler;

use AppBundle\Document\Location;
use AppBundle\Entity\CrawlerEntity;
use GuzzleHttp\Client;

class CrawlerOperator {

  /**
   * @param \AppBundle\Entity\CrawlerEntity $crawlerEntity
   * @param Location[] $locations
   */
  public function crawl(CrawlerEntity $crawlerEntity, array $locations) {
    $json = ['locations' => []];
    foreach ($locations as $location) {
      $json['locations'][] = [
        'id' => $location->getId(),
        'url' => $location->getPath(),
      ];
    }

    $client = new Client();
    $response = $client->post($crawlerEntity->getAddress() . ':' . $crawlerEntity->getPort(), [
      'body' => json_encode($json),
    ]);
    $responseJSON = $response->getBody()->getContents();
    $responseArray = json_decode($responseJSON, JSON_OBJECT_AS_ARRAY);
//    var_dump($responseArray);
  }

}
