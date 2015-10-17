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

  const APP_BUNDLE_CRAWLER_CAPACITY = 'app_bundle.crawler.capacity';

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

    $crawlerProviderDefinition = $container->getDefinition('app_bundle.crawler.provider');
    foreach ($data['crawlers'] as $crawler) {
      $crawlerProviderDefinition->addMethodCall('register', [$crawler['address'], $crawler['port']]);
    }

    $container->setParameter(self::APP_BUNDLE_CRAWLER_CAPACITY, $data['capacity']);
  }

}
