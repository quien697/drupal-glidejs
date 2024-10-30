# Drupal 11 with Glide.js

This is a [Drupal](https://www.drupal.org/home) project bootstrapped with [Composer](https://getcomposer.org).

## Description

It's a practice project to create a slider or a carousel with glide.js.

## Development Environment

* MacOS Sequoia 15.0.1
* MAMP PRO 7.1
  * Apache 2.4.58
  * PHP 8.3.10
  * MySQL 8.0.35

## Technologies used 

* Drupal 11.05
* Composer 2.8.1
* drush
* bootstrap5
* oomphinc/composer-installers-extender
* glidejs--glide

## Steps

1. Create a initial Drupal project using composer ([Using Composer to Install Drupal and Manage Dependencies](https://www.drupal.org/docs/develop/using-composer/manage-dependencies)).

   ```bash
   composer create-project drupal/recommended-project your-project-name
   ```

2. Setup the project on MAMP.

3. Open site in browser and following the steps to install Drupal.

4. Creata a local settings file instead of editing settings files directly.

   1. Copy file `/web/sites/example.settings.local.php` to folder `/web/sites/default/` and rename it to `settings.local.php`.

   2. Move database settings like below from `settings.php` to `settings.local.php`

      ```php
      $databases['default']['default'] = array (
        'database' => 'drupal_glidejs',
        'username' => 'root',
        'password' => 'root',
        'prefix' => '',
        'host' => 'localhost',
        'port' => '3306',
        'isolation_level' => 'READ COMMITTED',
        'driver' => 'mysql',
        'namespace' => 'Drupal\\mysql\\Driver\\Database\\mysql',
        'autoload' => 'core/modules/mysql/src/Driver/Database/mysql/',
      );
      ```

   3. Uncomment this part of code

      ```php
      if (file_exists($app_root . '/' . $site_path . '/settings.local.php')) {
      	include $app_root . '/' . $site_path . '/settings.local.php';
      }
      ```

5. 



