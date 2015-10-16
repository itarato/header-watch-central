<?php
/**
 * @file
 */

namespace AppBundle\Console;

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
    $output->writeln('Hello');

    $repo = $this->getContainer()->get('doctrine_mongodb')->getRepository('AppBundle:Location');
    $list = $repo->findAll();

    $output->writeln('Found: ' . count($list));
  }

}
