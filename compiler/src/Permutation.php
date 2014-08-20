<?php

namespace Compiler;

class Permutation {

  /**
   * The namespace of the services.
   */
  private $namespace = "";

  /**
   * The build steps that are run for this permuation.
   */
  private $steps = array();

  /**
   * The services attached to this permuation.
   */
  private $services = array();

  public addStep($command) {
    $this->steps[] = $command;
  }

  /**
   * Adds a container service to the permutation.
   */
  public addService($service) {
    $up_service = strtoupper($service);
    $this->addStep($up_service . '_ID=$(docker run --rm -v -d ' . $namespace . '/' . $service . ')');
    $this->addStep($up_service . '=$(docker inspect --format "{{ .Name }}" $' . $up_service . '_ID | cut -d "/" -f 2)');
  }

  /**
   * Build steps.
   */
  public buildSteps($main) {

  }

  /**
   * Helper function to build a Docker step.
   */
  private buildDocker($type = "run", $container, $daemon = false, $cmd = '', $links = array()) {
    $command = 'docker ' . $type . ' --rm -v ';

    if ($daemon) {
      $command .= '-d ';
    }

    foreach ($links) {
      $command .= '--link ' . $links['container'] . ':' . $links['name'] . ' ';
    }

    if ($container) {
      $command .= $container;
    }

    if ($cmd) {
      $command .= ' ' . $cmd;
    }

    return $command;
  }

}
