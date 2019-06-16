<?php

namespace Shiyan\ProcessBuilder\tests;

use PHPUnit\Framework\TestCase;
use Shiyan\ProcessBuilder\Example\Git;
use Shiyan\ProcessBuilder\ProcessBuilder;
use TestAppClass;

class IntegrationTest extends TestCase {

  public function testProcessBuilder(): void {
    $echo = new ProcessBuilder('echo');
    $echo->setSharedFlags('-n');

    $process = $echo('Hello world!');
    $this->assertSame("'echo' '-n' 'Hello world!'", $process->getCommandLine());
    $this->assertSame(TRUE, $process->isTerminated());
    $this->assertSame('Hello world!', (string) $process);

    $echo->setAutoRun(FALSE);
    $process = $echo('Hello world!');
    $this->assertSame('', (string) $process);
    $this->assertSame(TRUE, !$process->isStarted());

    $pwd = new ProcessBuilder('pwd');
    $dir_current = trim($pwd());
    $pwd->chDir('../');
    $dir_parent = trim($pwd());
    $this->assertNotEquals($dir_parent, $dir_current);
    $this->assertStringStartsWith($dir_parent, $dir_current);

    $git = new Git();
    $git->setAutoRun(FALSE);
    $this->assertSame("'git' 'version'", $git->version()->getCommandLine());

    require_once __DIR__ . '/TestAppClass.php';
    $app = new TestAppClass();
    $app->setAutoRun(FALSE);
    $command = $app->subCommand(1, 2)->getCommandLine();
    $this->assertSame("'test-app-class' 'sub-command' '1' '2'", $command);
  }

}
