<?php
/**
 * @file
 */

namespace AppBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class AppExtension extends Extension {

  /**
   * Loads a specific configuration.
   *
   * @param array $config An array of configuration values
   * @param ContainerBuilder $container A ContainerBuilder instance
   *
   * @throws \InvalidArgumentException When provided tag is not defined in this extension
   *
   * @api
   */
  public function load(array $config, ContainerBuilder $container) {
    $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
    $loader->load('services.yml');

    $configuration = new Configuration();
    $data = $this->processConfiguration($configuration, $config);

    $crawlerProvider = $container->get('app_bundle.crawler.provider');
    foreach ($data['crawlers'] as $crawler) {
      $crawlerProvider->register($crawler['address'], $crawler['port']);
    }
  }

}
