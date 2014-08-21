<?php

namespace Compiler;

class DockerInspectCommand extends DockerBaseCommand {

  /**
   * The name of the container.
   */
  private $container = '';

  /**
   * The format for the return value.
   */
  private $format = '';

  /**
   * The command that gets run as part of the entry point.
   */
  private $cmd = '';

  /**
   * Builds the command.
   */
  public function build() {
    // Ensure we have a container to spin up.
    $container = $this->getContainer();
    if (empty($container)) {
      return false;
    }

    $format = $this->getFormat();
    if ($format) {
      $args[] = '--format "' . $format . '"';
    }

    // Put it all together.
    $command = $this->getBinary() . ' inspect';
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
   * Gets the container.
   */
  public function setFormat($format) {
    $this->format = $format;
  }

  /**
   * Sets the container.
   */
  public function getFormat() {
    return $this->format;
  }

}
