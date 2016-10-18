XHProf Helper
=============

Helper scripts for profiling PHP code with XHProf.

## Installation

Stub.

- Included in localenv stack.
- How to use, view results.

## Profiling Drush

Locate your drush.php file and at the top add:

    #!/usr/bin/env php
    <?php
    
    use rallentemp\DrushProfiler;

Then within drush_main(), add:

    function drush_main() {
      $COMPOSER_HOME = (array_key_exists('COMPOSER_HOME', $_SERVER)) ? $_SERVER['COMPOSER_HOME'] : '/composer';
      require $COMPOSER_HOME . "/vendor/autoload.php";
      new rallentemp\DrushProfiler();
    
      ...

__TODO__

- Update README
- Is there a way to create a drush command wrapper with as minimal forking as possible?
- More documentation about installation (containers, vhost, etc.).

__References__

- http://php.net/manual/en/xhprof.examples.php
