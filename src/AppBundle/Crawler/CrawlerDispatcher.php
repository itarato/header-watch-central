<?php
/**
 * @file
 */

namespace AppBundle\Crawler;

use AppBundle\DependencyInjection\AppExtension;
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

  /**
   * @var int
   */
  private $capacity;

  /**
   * @var CrawlerOperator
   */
  private $crawlerOperator;

  public static function create(ContainerInterface $container) {
    $instance = new CrawlerDispatcher();
    $instance->crawlerProvider = $container->get('app_bundle.crawler.provider');
    $instance->storageManagerRegistry = $container->get('doctrine_mongodb');
    $instance->dm = $container->get('doctrine_mongodb.odm.document_manager');
    $instance->capacity = $container->getParameter(AppExtension::APP_BUNDLE_CRAWLER_CAPACITY);
    $instance->crawlerOperator = $container->get('app_bundle.crawler.operator');

    return $instance;
  }

  public function execute() {
    // get due locations
    $dueLocations = $this->getDueLocations();

    // get available crawlers
    $availableCrawlerNum = $this->crawlerProvider->countAvailable();
    $neededCrawlers = min($availableCrawlerNum, ceil(count($dueLocations) / $this->capacity));

    $availableCrawlers = $this->crawlerProvider->get($neededCrawlers);
    for ($i = 0; $i < $neededCrawlers; $i++) {
      $locationPortion = array_slice($dueLocations, 0, $this->capacity);
      if (empty($locationPortion)) {
        break;
      }

      if (!($crawler = array_pop($availableCrawlers))) {
        break;
      }

      $this->crawlerOperator->crawl($crawler, $locationPortion);
    }
  }

  /**
   * @return object[]
   */
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
      $ids = array_merge($ids, $availibilityInfo->getLocations());
    }

    return array_unique($ids);
  }

}
