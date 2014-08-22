<?php

namespace Compiler;

/**
 * @codeCoverageIgnore
 */
class PermutationTest extends \PHPUnit_Framework_TestCase {

  public function testAddService() {

    $permutation = new Permutation();
    $permutation->setNamespace('drupal');
    $permutation->setLanguage('php5.4');
    $permutation->setCommand('env before_script script');

    // Single service.
    $permutation->addService('mysql');
    $steps = $permutation->getSteps();
    $require = array(
      'MYSQL_ID=$(docker run -d --rm drupal/mysql)',
      'MYSQL=$(docker inspect --format "{{ .Name }}" $MYSQL_ID | cut -d "/" -f 2)',
    );
    $this->assertEquals($require, $steps);
    $steps = $permutation->build();
    $require[] = 'docker run --rm -v `pwd`:/data --link $MYSQL:mysql drupal/php5.4 env before_script script';
    $this->assertEquals($require, $steps);

    // More than one service.
    $permutation->addServices(array('postgres'));
    $steps = $permutation->getSteps();
    $require = array(
      'MYSQL_ID=$(docker run -d --rm drupal/mysql)',
      'MYSQL=$(docker inspect --format "{{ .Name }}" $MYSQL_ID | cut -d "/" -f 2)',
      'POSTGRES_ID=$(docker run -d --rm drupal/postgres)',
      'POSTGRES=$(docker inspect --format "{{ .Name }}" $POSTGRES_ID | cut -d "/" -f 2)',
    );
    $this->assertEquals($require, $steps);
    $steps = $permutation->build();
    $require[] = 'docker run --rm -v `pwd`:/data --link $MYSQL:mysql --link $POSTGRES:postgres drupal/php5.4 env before_script script';
    $this->assertEquals($require, $steps);

  }

}
