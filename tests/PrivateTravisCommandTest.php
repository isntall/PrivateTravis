<?php

require __DIR__.'/../vendor/autoload.php';

use PrivateTravis\PrivateTravisCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class PrivateTravisCommandTest extends \PHPUnit_Framework_TestCase {

  public function testExecute() {
    $application = new Application();
    $application->add(new PrivateTravisCommand());

    $command = $application->find('build');
    $commandTester = new CommandTester($command);
    $commandTester->execute(
      array(
        'commands' => array(
          'foo',
          'bar',
          'baz',
        ),
        '--file' => 'tests/.travis.yml',
        '--namespace' => 'bazza',
        '--fail-fast' => true,
        '--privileged' => true,
      )
    );

    // Commands.
    $this->assertRegExp('/foo bar baz/', $commandTester->getDisplay());

    // Namespace.
    $this->assertRegExp('/bazza\/mysql/', $commandTester->getDisplay());

    // Fail fast.
    $this->assertRegExp('/set -e/', $commandTester->getDisplay());
  }

}
