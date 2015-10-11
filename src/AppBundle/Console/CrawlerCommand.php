<?php
/**
 * @file
 */

namespace AppBundle\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CrawlerCommand extends Command {

  protected function configure() {
    $this
      ->setName('hw:crawl')
      ->setDescription('Crawl paths');
  }

  protected function execute(InputInterface $input, OutputInterface $output) {
    $output->writeln('Hello');
  }

}
