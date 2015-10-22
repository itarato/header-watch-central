<?php
/**
 * @file
 */

namespace AppBundle\Console;

use AppBundle\DependencyInjection\AppExtension;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CrawlerCommand extends ContainerAwareCommand {

  protected function configure() {
    $this
      ->setName('hw:crawl')
      ->setDescription('Crawl paths');
  }

  protected function execute(InputInterface $input, OutputInterface $output) {
    $output->writeln('Header Watch: Crawl Command');

    $crawlerProvider = $this->getContainer()->get('app_bundle.crawler.provider');
    $output->writeln($crawlerProvider->countAvailable() . '/' . $crawlerProvider->countAll() . ' crawler available');
    $output->writeln('Capacity: ' . $this->getContainer()->getParameter(AppExtension::APP_BUNDLE_CRAWLER_CAPACITY));

    $repo = $this->getContainer()->get('doctrine_mongodb')->getRepository('AppBundle:Location');
    $list = $repo->findAll();

    $output->writeln('Found: ' . count($list));

    $dispatcher = $this->getContainer()->get('app_bundle.crawler.dispatcher');
    $dispatcher->execute();
  }

}
