<?php

namespace PrivateTravis;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Yaml\Yaml;
use PrivateTravis\Permutation;

class PrivateTravisCommand extends Command {

  protected $name = "build";

  /**
   * Constructor.
   *
   * @param string|null $name The name of the command; passing null means it must be set in configure()
   *
   * @throws \LogicException When the command name is empty
   *
   * @api
   */
  public function __construct($name = null) {
    parent::__construct($name);
    $this->name = $name;
  }

  protected function configure() {
    $command = $this->getName();
    $this->setName($command)
      ->setDescription('Build the Docker command to run the .travis.yml file.')
      ->addArgument('commands', InputArgument::IS_ARRAY, 'The TravisCI commands that will be run.', array('env', 'before_script', 'script'))
      ->addOption('file', null, InputOption::VALUE_REQUIRED, 'The file to load.', '.travis.yml')
      ->addOption('namespace', null, InputOption::VALUE_REQUIRED, 'Docker namespace to pull containers.', 'privatetravis')
      ->addOption('fail-fast', null, InputOption::VALUE_NONE, 'Fail the build fast if any errors.')
      ->addOption('privileged', null, InputOption::VALUE_NONE, 'Run the containers in "privileged" mode. Giving them access to high kernel functionality eg. TMPFS.');
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
    $privileged = $input->getOption('privileged');

    $output->writeln("#!/bin/bash");

    $fail_fast = $input->getOption('fail-fast');
    if ($fail_fast) {
      $output->writeln("set -e");
    }

    // Get the permutations.
    foreach ($language_versions as $language_version) {
      $output->writeln("#### Permutation $language$language_version ####");

      $permutation = new Permutation();
      $permutation->setNamespace($namespace);
      $permutation->setLanguage($language . ':' . $language_version);
      $permutation->setCommand($command);
      if ($privileged) {
        $permutation->setPrivileged(true);
      }
      $permutation->addServices($services);

      // Print.
      $lines = $permutation->build();
      foreach ($lines as $line) {
        $output->writeln($line);
      }
    }
  }

}
