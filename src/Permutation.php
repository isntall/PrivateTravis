<?php

namespace PrivateTravis;

class Permutation {

  /**
   * The namespace of the services.
   */
  private $namespace = '';

  /**
   * Sets the containers as "privileged".
   */
  private $privileged = false;

  /**
   * The build steps that are run for this permuation.
   */
  private $steps = array();

  /**
   * The links that will be attached to the main test container.
   */
  private $links = array();

  /**
   * The language of the test that will be run.
   */
  private $language = '';

  /**
   * The command that gets run as part of the entry point.
   */
  private $cmd = '';

  /**
   * Build steps.
   */
  public function build() {
    $namespace = $this->getNamespace();
    $language = $this->getLanguage();
    $links = $this->getLinks();
    $command = $this->getCommand();
    $privileged = $this->getPrivileged();

    $run = new DockerRunCommand();
    $run->setRemove(true);
    $run->setImage($namespace . '/' . $language);
    $run->addVolume('`pwd`:/data');
    $run->setLinks($links);

    // Privileged.
    if ($privileged) {
      $run->setPrivileged(true);
    }

    $run->setCommand($command);

    $commands = $this->getSteps();
    $commands[] = $run->build();

    return $commands;
  }

  /**
   * Get namespace.
   */
  public function setNamespace($namespace) {
    $this->namespace = $namespace;
  }

  /**
   * Set namespace.
   */
  public function getNamespace() {
    return $this->namespace;
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
   * Add a steps.
   */
  public function addStep($step) {
    $steps = $this->getSteps();
    $steps[] = $step;
    $this->setSteps($steps);
  }

  /**
   * Get namespace.
   */
  public function setLinks($links) {
    $this->links = $links;
  }

  /**
   * Set namespace.
   */
  public function getLinks() {
    return $this->links;
  }

  /**
   * Set namespace.
   */
  public function addLink($link) {
    $links = $this->getLinks();
    $links[] = $link;
    $this->setLinks($links);
  }

  /**
   * Adds a container service to the permutation.
   */
  public function addService($service) {
    // Convert the service name to uppercase for bash variables.
    $uppercase_service = str_replace("-", "_", strtoupper($service));
    $namespace = $this->getNamespace();

    // Build the service command.
    $run = new DockerRunCommand();
    $run->setDaemon(true);
    // $run->setRemove(true);
    $run->setImage($namespace . '/' . $service);

    // Privileged.
    $privileged = $this->getPrivileged();
    if ($privileged) {
      $run->setPrivileged(true);
    }

    $command = $run->build();
    $this->addStep($uppercase_service . '_ID=$(' . $command . ')');

    // Build the inspect command.
    $run = new DockerInspectCommand();
    $run->setFormat('{{ .Name }}');
    $run->setContainer('$' . $uppercase_service . '_ID');
    $run->setCommand('| cut -d "/" -f 2');
    $command = $run->build();
    $this->addStep($uppercase_service . '=$(' . $command . ')');

    // Add a link so we can access these services from the main container.
    $this->addLink('$' . $uppercase_service . ':' . $service);
  }

  /**
   * A little wrapper around addService() so we can take multiple services in
   * one line.
   */
  public function addServices($services) {
    foreach ($services as $service) {
      $this->addService($service);
    }
  }

  /**
   * Get language.
   */
  public function setLanguage($language) {
    $this->language = $language;
  }

  /**
   * Set language.
   */
  public function getLanguage() {
    return $this->language;
  }

  /**
   * Gets the cmd.
   */
  public function setCommand($cmd) {
    $this->cmd = $cmd;
  }

  /**
   * Sets the cmd.
   */
  public function getCommand() {
    return $this->cmd;
  }

  /**
   * Sets the containers as "privileged".
   */
  public function setPrivileged($privileged) {
    $this->privileged = $privileged;
  }

  /**
   * Gets the containers "privileged" status.
   */
  public function getPrivileged() {
    return $this->privileged;
  }

}
