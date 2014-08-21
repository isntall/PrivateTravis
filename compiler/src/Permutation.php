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

  /**
   * Adds a container service to the permutation.
   */
  public addService($service) {
    // Convert the service name to uppercase for bash variables.
    $uppercase_service = strtoupper($service);

    // Build the service command.
    $run = new DockerRunCommand();
    $run->setDaemon(true);
    $run->setRemove(true);
    $run->setContainer($this->namespace . '/' . $service);
    $command = $run->build();
    $this->addStep($uppercase_service . '_ID=$(' . $command . ')');

    // Build the inspect command.
    $run = new DockerInspectCommand();
    $run->setFormat('{{ .Name }}');
    $run->setContainer('$' . $up_service . '_ID');
    $run->setCommand('| cut -d "/" -f 2');
    $command = $run->build();
    $this->addStep($uppercase_service . '=$(' . $command . ')');
  }

  /**
   * Build steps.
   */
  public build($main) {

  }

  /**
   * Get steps.
   */
  public function setSteps($steps) {
    $this->steps = $steps;
  }

  /**
   * Set steps.
   */
  public function getSteps() {
    return $this->steps;
  }

  /**
   * Add a steo.
   */
  public function addStep($command) {
    $this->steps[] = $command;
  }

}
