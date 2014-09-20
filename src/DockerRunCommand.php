<?php

namespace PrivateTravis;

class DockerRunCommand extends DockerBaseCommand {

  /**
   * The name of the image.
   */
  private $image = '';

  /**
   * Sets the containers as "privileged".
   */
  private $privileged = false;

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
   * Builds the return command.
   */
  public function build() {
    // Ensure we have a container to spin up.
    $image = $this->getImage();
    if (empty($image)) {
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

    $privileged = $this->getPrivileged();
    if ($privileged) {
      $args[] = '--privileged';
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
    $command .= ' ' . $image;
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
   * Gets the image.
   */
  public function setImage($image) {
    $this->image = $image;
  }

  /**
   * Sets the image.
   */
  public function getImage() {
    return $this->image;
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
    $volumes = $this->getVolumes();
    $volumes[] = $volume;
    $this->setVolumes($volumes);
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
