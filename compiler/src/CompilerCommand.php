<?php

namespace Compiler;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Yaml\Yaml;
use Compiler\Permutation;

class CompilerCommand extends Command {

  protected function configure() {
    $this->setName('build')
         ->setDescription('Build the Docker command to run the .travis.yml file.')
         ->addArgument('commands', InputArgument::IS_ARRAY, 'The TravisCI commands that will be run.', array('env', 'before_script', 'script'))
         ->addOption('file', null, InputOption::VALUE_REQUIRED, 'The file to load.', '.travis.yml')
         ->addOption('namespace', null, InputOption::VALUE_REQUIRED, 'Docker namespace to pull containers.', 'nickschuch');
  }

  protected function execute(InputInterface $input, OutputInterface $output) {
    $namespace = $input->getOption('namespace');
    $file = $input->getOption('file');
    $command = implode(' ', $input->getArgument('commands'));

    // Get the travis configuration.
    $travis = Yaml::parse($file);
    $language = !empty($travis['language']) ? $travis['language'] : '';
    $language_versions = !empty($travis[$language]) ? $travis[$language] : array();
    $services = !empty($travis['services']) ? $travis['services'] : array();

    $output->writeln("#!/bin/bash");

    // Get the permutations.
    foreach ($language_versions as $language_version) {
      $output->writeln("#### Permutation $language$language_version ####");

      $permutation = new Permutation();
      $permutation->setNamespace($namespace);
      $permutation->setLanguage($language . $language_version);
      $permutation->setCommand($command);
      $permutation->addServices($services);

      // Print.
      $lines = $permutation->build();
      foreach ($lines as $line) {
        $output->writeln($line);
      }
    }
  }

}
