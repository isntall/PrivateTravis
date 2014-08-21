<?php

namespace Compiler;

/**
 * @codeCoverageIgnore
 */
class DockerInspectCommandTest extends \PHPUnit_Framework_TestCase {

  public function testBuild() {

    $inspect = new DockerInspectCommand();

    // Container.
    $this->assertFalse($inspect->build());
    $inspect->setContainer('123456');
    $command = $inspect->build();
    $this->assertTrue(!empty($command));

    // Format.
    $inspect->setFormat('{{ .Rock }}');
    $command = $inspect->build();
    $this->assertEquals('docker inspect --format "{{ .Rock }}" 123456', $command);

    // Command.
    $inspect->setCommand('| grep "wazzup"');
    $command = $inspect->build();
    $this->assertEquals('docker inspect --format "{{ .Rock }}" 123456 | grep "wazzup"', $command);

  }

}
