# Process Builder

Builds command lines for symfony/process using magic methods.

Best suited for use as a [Composer](https://getcomposer.org) library.

## Requirements

* PHP &ge; 7.4
* [symfony/process](https://github.com/symfony/process) &ge; 5

## Installation

To add this library to your Composer project:
```
composer require shiyan/process-builder
```

## Usage examples

Using the `ProcessBuilder` class:
```
use Shiyan\ProcessBuilder\ProcessBuilder;

$ls = new ProcessBuilder(app: 'ls', cwd: '~');
print $ls('-la'); // Prints the command output.

$ls->chDir('../'); // Changes the working directory, not the command argument.
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

By default, an underlying process runs automatically. This behavior can be
changed:
```
use Shiyan\ProcessBuilder\ProcessBuilder;

$ls = new ProcessBuilder('ls');
$ls->setAutoRun(FALSE);
$process = $ls('-la');
```
