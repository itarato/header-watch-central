<?php
/**
 * @file
 */

namespace AppBundle\Crawler;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CrawlerDispatcher {

  /**
   * @var CrawlerProviderInterface
   */
  private $crawlerProvider;

  /**
   * @var ManagerRegistry
   */
  private $storageManagerRegistry;

  /**
   * @var DocumentManager
   */
  private $dm;

  public static function create(ContainerInterface $container) {
    $instance = new CrawlerDispatcher();
    $instance->crawlerProvider = $container->get('app_bundle.crawler.provider');
    $instance->storageManagerRegistry = $container->get('doctrine_mongodb');
    $instance->dm = $container->get('doctrine_mongodb.odm.document_manager');
    return $instance;
  }

  public function execute() {
    // get due locations
    $inProgress = $this->getInProgressLocationIDs();
    $locationRepo = $this->storageManagerRegistry->getRepository('AppBundle:LocationEntity');
    $this->dm->createQueryBuilder('AppBundle:LocationEntity');
    // get available crawlers
    // loop through crawlers and add 10-10 locations
  }

  protected function getDueLocations() {
    $it = $this->dm
      ->createQueryBuilder('AppBundle:Location')
      ->field('id')
        ->notIn($this->getInProgressLocationIDs())
      ->getQuery()
      ->getIterator();

    $documents = [];
    foreach ($it as $document) {
      $documents[] = $document;
    }

    return $documents;
  }

  /**
   * @return string[]
   */
  protected function getInProgressLocationIDs() {
    $availibilityInfos = $this
      ->storageManagerRegistry
      ->getRepository('AppBundle:CrawlerAvailability')
      ->findAll();

    $ids = [];
    foreach ($availibilityInfos as $availibilityInfo) {
      $a = 1;
    }

    return [];
  }

}
