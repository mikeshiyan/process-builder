<?php

namespace Shiyan\ProcessBuilder;

/**
 * Base for process builders.
 */
abstract class BaseProcessBuilder {

  /**
   * Application name and shared flags as separate elements.
   *
   * @var string[]
   */
  protected array $args = [];

  /**
   * Current working directory.
   *
   * @var string|null
   */
  protected ?string $cwd = NULL;

  /**
   * Whether to run a process automatically.
   *
   * @var bool
   */
  protected bool $autoRun = TRUE;

  /**
   * BaseProcessBuilder constructor.
   *
   * @param string|null $cwd
   *   Working directory to use by process.
   */
  public function __construct(?string $cwd = NULL) {
    $this->cwd = $cwd;

    if (!$this->args) {
      if ($class = strrchr(static::class, '\\')) {
        $class = substr($class, 1);
      }
      else {
        $class = static::class;
      }

      $this->args = [static::camelToKebab($class)];
    }
  }

  /**
   * Sets command-line flags to be used by all processes.
   *
   * @param string ...$arguments
   *   Command-line flags as separate arguments.
   *
   * @return static
   */
  public function setSharedFlags(string ...$arguments): static {
    $this->args = array_merge($this->args, $arguments);
    return $this;
  }

  /**
   * Changes the working directory for process to use.
   *
   * @param string|null $cwd
   *   The new working directory, or NULL to use the working dir of the current
   *   PHP process.
   *
   * @return static
   */
  public function chDir(?string $cwd = NULL): static {
    $this->cwd = $cwd;
    return $this;
  }

  /**
   * Sets whether to run a process automatically.
   *
   * @param bool $auto_run
   *   Whether to run a process automatically or not.
   *
   * @return static
   */
  public function setAutoRun(bool $auto_run): static {
    $this->autoRun = $auto_run;
    return $this;
  }

  /**
   * Creates and optionally runs a process.
   *
   * @param string ...$arguments
   *   Command arguments.
   *
   * @return \Shiyan\ProcessBuilder\Process
   *   The process instance.
   *
   * @throws \Symfony\Component\Process\Exception\LogicException
   *   If proc_open is not installed.
   * @throws \Symfony\Component\Process\Exception\RuntimeException
   *   If working directory does not exist or process can't be launched.
   * @throws \Symfony\Component\Process\Exception\ProcessSignaledException
   *   If process stopped after receiving signal.
   * @throws \Symfony\Component\Process\Exception\ProcessTimedOutException
   *   If process timed out.
   * @throws \Symfony\Component\Process\Exception\ProcessFailedException
   *   If process didn't terminate successfully.
   */
  public function __invoke(string ...$arguments): Process {
    // Use all getenv() vars explicitly, because the variables_order php ini
    // directive may omit "E" due to performance reasons, and symfony/process
    // limits getenv() vars by what's in $_SERVER by default.
    $process = new Process(array_merge($this->args, $arguments), $this->cwd, getenv());
    return $this->autoRun ? $process->mustRun() : $process;
  }

  /**
   * Creates and optionally runs a process for a sub-command.
   *
   * @param string $sub_command
   *   Sub-command name.
   * @param string[] $arguments
   *   Sub-command arguments.
   *
   * @return \Shiyan\ProcessBuilder\Process
   *   The process instance.
   *
   * @throws \Symfony\Component\Process\Exception\LogicException
   *   If proc_open is not installed.
   * @throws \Symfony\Component\Process\Exception\RuntimeException
   *   If working directory does not exist or process can't be launched.
   * @throws \Symfony\Component\Process\Exception\ProcessSignaledException
   *   If process stopped after receiving signal.
   * @throws \Symfony\Component\Process\Exception\ProcessTimedOutException
   *   If process timed out.
   * @throws \Symfony\Component\Process\Exception\ProcessFailedException
   *   If process didn't terminate successfully.
   */
  public function __call(string $sub_command, array $arguments = []): Process {
    return $this->__invoke(static::camelToKebab($sub_command), ...$arguments);
  }

  /**
   * Converts CamelCased class and camelCased method names to kebab-cased.
   *
   * @param string $string
   *   String to convert.
   *
   * @return string
   *   Converted string.
   */
  protected static function camelToKebab(string $string): string {
    if (!ctype_lower($string)) {
      $string = strtolower(preg_replace('/(.)(?=[A-Z])/u', '$1-', $string));
    }

    return $string;
  }

}
