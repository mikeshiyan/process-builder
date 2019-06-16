<?php

namespace Shiyan\ProcessBuilder;

/**
 * Process builder for arbitrary applications.
 */
class ProcessBuilder extends BaseProcessBuilder {

  /**
   * ProcessBuilder constructor.
   *
   * @param string $app
   *   Application name.
   * @param string|null $cwd
   *   Working directory to use by process.
   */
  public function __construct(string $app, string $cwd = NULL) {
    $this->args = [$app];
    parent::__construct($cwd);
  }

}
