<?php

require __DIR__.'/../vendor/autoload.php';

use Compiler\CompilerCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class CompilerCommandTest extends \PHPUnit_Framework_TestCase {

  public function testExecute() {
    $application = new Application();
    $application->add(new CompilerCommand());

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
      )
    );

    // Commands.
    $this->assertRegExp('/foo bar baz/', $commandTester->getDisplay());

    // Namespace.
    $this->assertRegExp('/bazza\/mysql/', $commandTester->getDisplay());
  }

}
