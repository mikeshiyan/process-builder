# Process Builder

[![Build Status](https://travis-ci.org/mikeshiyan/process-builder.svg?branch=master)](https://travis-ci.org/mikeshiyan/process-builder)

Builds command lines for symfony/process using magic methods.

Best suited for use as a [Composer](https://getcomposer.org) library.

## Requirements

* PHP &ge; 7.1
* [symfony/process](https://github.com/symfony/process) &ge; 4.3

## Installation

To add this library to your Composer project:
```
composer require shiyan/process-builder
```

## Usage examples

Using the `ProcessBuilder` class:
```
use Shiyan\ProcessBuilder\ProcessBuilder;

$ls = new ProcessBuilder('ls', '~');
print $ls('-la');

$ls->chDir('../');
print $ls('-la');
```

Using a class which extends the `BaseProcessBuilder`:
```
use Shiyan\ProcessBuilder\Example\Git;

$git = new Git('/var/www');

if ($git->status('-z') != '') {
  $git->add('--all');
  $git->commit('-m', 'Some changes');
  $git->push('origin', 'master');
}
```

By default an underlying process runs automatically. This behavior can be
changed:
```
use Shiyan\ProcessBuilder\ProcessBuilder;

$ls = new ProcessBuilder('ls');
$ls->setAutoRun(FALSE);
$process = $ls('-la');
```
