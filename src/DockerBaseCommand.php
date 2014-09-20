<?php

namespace PrivateTravis;

class DockerBaseCommand {

  /**
   * The path to the Docker binary.
   */
  private $binary = 'docker';

  /**
   * The command that gets run as part of the entry point.
   */
  private $cmd = '';

  /**
   * Used to build the Docker command.
   */
  public function build() { }

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
