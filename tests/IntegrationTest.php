<?php

namespace Shiyan\ProcessBuilder\tests;

use PHPUnit\Framework\TestCase;
use Shiyan\ProcessBuilder\Example\Git;
use Shiyan\ProcessBuilder\Process;
use Shiyan\ProcessBuilder\ProcessBuilder;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Exception\ProcessTimedOutException;
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

  public function testGetProcess(): void {
    $false = new ProcessBuilder('false');
    $this->expectException(ProcessFailedException::class);

    try {
      $false();
    }
    catch (\Exception $exception) {
      $this->assertInstanceOf(Process::class, $false->getProcess());
      $this->assertTrue($false->getProcess()->isTerminated());
      throw $exception;
    }
  }

  public function testTimeout(): void {
    // Timeout is enough for the command to execute.
    $sleep = new ProcessBuilder('sleep', timeout: 1);
    $process = $sleep(.1);
    $this->assertTrue($process->isSuccessful());

    // Timeout is lower than the command needs.
    $sleep->setTimeout(.1);
    $this->expectException(ProcessTimedOutException::class);
    $sleep(1);
  }

}
