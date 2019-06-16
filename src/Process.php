<?php

namespace Shiyan\ProcessBuilder;

use Exception;
use Symfony\Component\Process\Process as BaseProcess;

/**
 * Extends Symfony Process class with useful methods.
 */
class Process extends BaseProcess {

  /**
   * Returns the current output of the process (STDOUT).
   *
   * @return string
   *   The process output, or an empty string in case the output has been
   *   disabled, or the process has not started.
   */
  public function __toString(): string {
    try {
      return $this->getOutput();
    }
    catch (Exception $e) {
      return '';
    }
  }

}
