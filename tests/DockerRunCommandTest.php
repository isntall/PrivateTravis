<?php

namespace Compiler;

/**
 * @codeCoverageIgnore
 */
class DockerRunCommandTest extends \PHPUnit_Framework_TestCase {

    public function testBuild() {

      $run = new DockerRunCommand();

      // Container.
      $run->setBinary('docker');
      $this->assertFalse($run->build());
      $run->setImage('foo/bar');
      $command = $run->build();
      $this->assertTrue(!empty($command));

      // Daemon.
      $command = $run->build();
      $this->assertEquals('docker run foo/bar', $command);
      $run->setDaemon(true);
      $command = $run->build();
      $this->assertEquals('docker run -d foo/bar', $command);

      // Remove after run.
      $run->setRemove(true);
      $command = $run->build();
      $this->assertEquals('docker run -d --rm foo/bar', $command);

      // Volumes.
      $run->addVolume('foo:bar');
      $command = $run->build();
      $this->assertEquals('docker run -d --rm -v foo:bar foo/bar', $command);

      $run->addVolume('wah:weh');
      $command = $run->build();
      $this->assertEquals('docker run -d --rm -v foo:bar -v wah:weh foo/bar', $command);

      // Links.
      $run->addLink('waz:wez');
      $command = $run->build();
      $this->assertEquals('docker run -d --rm -v foo:bar -v wah:weh --link waz:wez foo/bar', $command);

      $run->addLink('raz:roz');
      $command = $run->build();
      $this->assertEquals('docker run -d --rm -v foo:bar -v wah:weh --link waz:wez --link raz:roz foo/bar', $command);

      // Entry point command.
      $run->setCommand('test 1 2 3');
      $command = $run->build();
      $this->assertEquals('docker run -d --rm -v foo:bar -v wah:weh --link waz:wez --link raz:roz foo/bar test 1 2 3', $command);
    }

}
