<?php

namespace Compiler;

class DockerRunCommand {

  /**
   * The path to the Docker binary.
   */
  private $binary = 'docker';

  /**
   * The name of the container.
   */
  private $container = '';

  /**
   * If this Docker command will use the "Daemon" flag.
   */
  private $daemon = false;

  /**
   * Determine if the domain should be removed after built.
   */
  private $remove = false;

  /**
   * Volumes that are to be mounted into a container.
   */
  private $volumes = array();

  /**
   * Links that will be run with this container.
   */
  private $links = array();

  /**
   * The command that gets run as part of the entry point.
   */
  private $cmd = '';

  /**
   * Builds the return command.
   */
  public function build() {
    // Ensure we have a container to spin up.
    $container = $this->getContainer();
    if (empty($container)) {
      return false;
    }

    // Variables.
    $args = array();

    $daemon = $this->getDaemon();
    if ($daemon) {
      $args[] = '-d';
    }

    $remove = $this->getRemove();
    if ($remove) {
      $args[] = '--rm';
    }

    $volumes = $this->getVolumes();
    if ($volumes) {
      $args[] .= $this->buildPrefixArgs('-v', $volumes);
    }

    $links = $this->getLinks();
    if ($links) {
      $args[] .= $this->buildPrefixArgs('--link', $links);
    }

    // Put it all together.
    $command = $this->getBinary() . ' run';
    if (!empty($args)) {
      $command .= ' ' . implode(" ", $args);
    }
    $command .= ' ' . $container;
    $cmd = $this->getCommand();
    if (!empty($cmd)) {
      $command .= ' ' . $cmd;
    }

    return $command;
  }

  /**
   * Helper function to build list of args.
   */
  public function buildPrefixArgs($prefix, $args) {
    $strings = array();
    foreach ($args as $arg) {
      $strings[] = $prefix . ' ' . $arg;
    }
    return implode(" ", $strings);
  }

  /**
   * Gets the binary.
   */
  public function setBinary($binary) {
    $this->binary = $binary;
  }

  /**
   * Sets the binary.
   */
  public function getBinary() {
    return $this->binary;
  }

  /**
   * Gets the container.
   */
  public function setContainer($container) {
    $this->container = $container;
  }

  /**
   * Sets the container.
   */
  public function getContainer() {
    return $this->container;
  }

  /**
   * Gets the daemon.
   */
  public function setDaemon($daemon) {
    $this->daemon = $daemon;
  }

  /**
   * Sets the daemon.
   */
  public function getDaemon() {
    return $this->daemon;
  }

  /**
   * Gets the remove.
   */
  public function setRemove($remove) {
    $this->remove = $remove;
  }

  /**
   * Sets the remove.
   */
  public function getRemove() {
    return $this->remove;
  }

  /**
   * Gets the volumes.
   */
  public function setVolumes($volumes) {
    $this->volumes = $volumes;
  }

  /**
   * Sets the volumes.
   */
  public function getVolumes() {
    return $this->volumes;
  }

  /**
   * Adds a volume.
   */
  public function addVolume($volume) {
    $this->volumes[] = $volume;
  }

  /**
   * Gets the links.
   */
  public function setLinks($links) {
    $this->links = $links;
  }

  /**
   * Sets the links.
   */
  public function getLinks() {
    return $this->links;
  }

  /**
   * Adds a links.
   *   --link name:alias
   */
  public function addLink($link) {
    $this->links[] = $link;
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

}
