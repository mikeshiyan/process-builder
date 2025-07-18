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
   * @param float|null $timeout
   *   The timeout in seconds or null to disable.
   */
  public function __construct(string $app, ?string $cwd = NULL, ?float $timeout = NULL) {
    $this->args = [$app];
    parent::__construct($cwd, $timeout);
  }

}
