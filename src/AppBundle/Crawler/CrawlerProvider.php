<?php
/**
 * @file
 */

namespace AppBundle\Crawler;

use AppBundle\Factory\LocationFactory;
use AppBundle\IdentifiableInterface;

class CrawlerProvider implements CrawlerProviderInterface {

  /**
   * @var IdentifiableInterface[]
   */
  private $items = [];

  /**
   * @var LocationFactory
   */
  private $locationFactory;

  public function allocate($serverID) {
    // TODO: Implement allocate() method.
  }

  public function free($serverID) {
    // TODO: Implement free() method.
  }

  public function register($address, $port) {
    $this->items[] = $this->locationFactory->create($address, $port);
  }

  public function countAll() {
    return count($this->items);
  }

  public function countAvailable() {
    // @todo count the real available
    return $this->countAll();
  }

  public function get($count = 1) {
    // @todo select only the available ones
    $out = [];
    foreach ($this->items as $item) {
      $out[] = $item;
    }
    return $out;
  }

  public function __construct(LocationFactory $locationFactory) {
    $this->locationFactory = $locationFactory;
  }

}
