# Drupal 11 with Glide.js

This is a [Drupal](https://www.drupal.org/home) project bootstrapped with [Composer](https://getcomposer.org).

## Description

It's a practice project to create a slider or a carousel with glide.js.
The project contains:

1. Create a usb theme base on `bootstrap5` and set it as a default theme.
2. Install three-party libraries `Glide.js` and set it up.
3. Create custom formatter for image slider and video slider.

## Development Environment

* MacOS Sequoia 15.0.1
* MAMP PRO 7.1
  * Apache 2.4.58
  * PHP 8.3.10
  * MySQL 8.0.35

## Technologies used 

* Drupal 11.05
* Composer 2.8.1
* drush 13.3
* bootstrap5
* oomphinc/composer-installers-extender
* glidejs--glide

## Steps

1. Create a initial Drupal project using composer ([Using Composer to Install Drupal and Manage Dependencies](https://www.drupal.org/docs/develop/using-composer/manage-dependencies)).

   ```bash
   composer create-project drupal/recommended-project drupal_glidejs
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

5. Install drush

   ```bash
   composer require --dev drush/drush
   ```

6. Create a new sub theme base on [bootstrap5](https://www.drupal.org/project/bootstrap5).

   1. Install bootstrap5 and enable it

      ```bash
      composer require 'drupal/bootstrap5:^4.0'
      drush theme:enable bootstrap5
      ```

   2. Within CMS, navigate to Appearance -> settings -> Bootstrap5 -> sub theme and create a new sub theme.

   3. Setup new sub theme as a default theme.

7. Install [Glide.js](https://glidejs.com/) and set it up on the project. 

   1. Install [composer-installers-extender](https://github.com/oomphinc/composer-installers-extender) that allows any package to be installed to a directory other than the default `vendor` directory within a project on a package-by-package basis.

      ```bash
      composer require oomphinc/composer-installers-extender
      ```

      Note: if you skip this step the libraries will not be installed in `web/libraries` folder but in the default vendor folder.

   2. Add Asset Packagist to the "repositories" section of your project's root composer.json. 

      ```json
      "repositories": [
      		...
      		{
      				"type": "composer",
              "url": "https://asset-packagist.org"
      		}
          ...
      ],
      ```

   3. Register npm assets as new "installer types" in the "extra" section of composer.json and also register them in "installer-paths" as part of the types of assets to be saved in the `web/libraries` folder.

      ```json
      "extra": {
      		...
      		"installer-types": ["npm-asset"],
      		"installer-paths": {
      						...
                  "web/libraries/{$name}": [
                      "type:drupal-library",
                      "type:npm-asset"
                  ],
                  ...
          },
          ...
      },
      ```

   4. install packages from npm-asset

      ```bash
      composer require npm-asset/glidejs--glide
      ```

   5. Edit `drupal_glidejs.libraries.yml` and add `glidejs--glide` on it.

      ```yml
      glidejs--glide:
        version: 1.0
        css:
          theme:
            /libraries/glidejs--glide/dist/css/glide.core.min.css: {}
            /libraries/glidejs--glide/dist/css/glide.theme.min.css: {}
        js:
          /libraries/glidejs--glide/dist/glide.min.js: {}
        dependencies:
          - core/jquery
      ```

   6. Edit `drupal_glidejs.info.yml` add `glidejs--glide` under `libraries`.

      ```yml
      ...
      libraries:
      	...
        - drupal_glidejs/glidejs--glide
      ...
      ```

8. Create a custom image formatter and a custom video formatter on the custom module. Reference site below

   1. [Create a custom field formatter](https://www.drupal.org/docs/creating-custom-modules/creating-custom-field-types-widgets-and-formatters/create-a-custom-field-formatter)

## Issues facing

1. Glide.js is working well, but the video field formatter is still having problems, will figure it out later on.