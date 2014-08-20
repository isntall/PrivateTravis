<?php

namespace Compiler;

class DockerRunCommandTest extends \PHPUnit_Framework_TestCase {

    public function testBuild() {

      $docker = new DockerRunCommand();

      // Container.
      $this->assertFalse($docker->build());
      $docker->setContainer('foo/bar');
      $command = $docker->build();
      $this->assertTrue(!empty($command));

      // Daemon.
      $command = $docker->build();
      $this->assertEquals('docker run foo/bar', $command);
      $docker->setDaemon(true);
      $command = $docker->build();
      $this->assertEquals('docker run -d foo/bar', $command);

      // Remove after run.
      $docker->setRemove(true);
      $command = $docker->build();
      $this->assertEquals('docker run -d --rm foo/bar', $command);

      // Volumes.
      $docker->addVolume('foo:bar');
      $command = $docker->build();
      $this->assertEquals('docker run -d --rm -v foo:bar foo/bar', $command);

      $docker->addVolume('wah:weh');
      $command = $docker->build();
      $this->assertEquals('docker run -d --rm -v foo:bar -v wah:weh foo/bar', $command);

      // Links.
      $docker->addLink('waz:wez');
      $command = $docker->build();
      $this->assertEquals('docker run -d --rm -v foo:bar -v wah:weh --link waz:wez foo/bar', $command);

      $docker->addLink('raz:roz');
      $command = $docker->build();
      $this->assertEquals('docker run -d --rm -v foo:bar -v wah:weh --link waz:wez --link raz:roz foo/bar', $command);

      // Entry point command.
      $docker->setCommand('test 1 2 3');
      $command = $docker->build();
      $this->assertEquals('docker run -d --rm -v foo:bar -v wah:weh --link waz:wez --link raz:roz foo/bar test 1 2 3', $command);
    }

}
