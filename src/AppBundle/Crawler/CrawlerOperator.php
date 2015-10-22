<?php
/**
 * @file
 */

namespace AppBundle\Crawler;

use AppBundle\Document\CrawlResult;
use AppBundle\Document\Location;
use AppBundle\Entity\CrawlerEntity;
use Doctrine\Common\Persistence\ObjectManager;
use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CrawlerOperator {

  /**
   * @var ObjectManager
   */
  private $dm;

  public function __construct(ContainerInterface $container) {
    $this->dm = $container->get('doctrine_mongodb')->getManager();
  }

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

    foreach ($responseArray['locations'] as $locationResult) {
      $resultDocument = new CrawlResult();
      $resultDocument
        ->setLocationId($locationResult['id'])
        ->setResult($locationResult)
        ->setTime(time());

      $this->dm->persist($resultDocument);
    }
  }

  public function __destruct() {
    $this->dm->flush();
  }

}
