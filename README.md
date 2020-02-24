# Municipio Headless Boilerplate

Boilerplate for a headless setup of Wordpress with Municipio

## How to install

1. Create project with Composer
   ```bash
   composer create-project municipio/municipio-boilerplate-headless <folder>
   ```
2. Update package name, author and description in _composer.json_ and
   _package.json_.
3. Duplicate all example files in /config and update them to match your setup.
4. Create your empty database.
5. Run `valet link`.
6. Run `valet open` and then the Wordpress install wizard.

### Install and activate ACF Pro

1. Create a .env file and add your ACF Pro key.
2. Install ACF Pro:
   ```bash
   composer require "advanced-custom-fields/advanced-custom-fields-pro":"*"
   ```
3. Activate the ACF Pro plugin:
   ```bash
   wp plugin activate advanced-custom-fields-pro
   ```
