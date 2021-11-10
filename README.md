# Frontend Web App Templating Project Laravel

## Prerequisites

If you don't already have an Apache local environment with PHP and MySQL, use one of the following links:

 - Windows: https://updivision.com/blog/post/beginner-s-guide-to-setting-up-your-local-development-environment-on-windows
 - Linux: https://howtoubuntu.org/how-to-install-lamp-on-ubuntu
 - Mac: https://wpshout.com/quick-guides/how-to-install-mamp-on-your-mac/

Also, you will need to install Composer: https://getcomposer.org/doc/00-intro.md   
And Laravel: https://laravel.com/docs/8.x/installation

## Installation

- [Clone project](https://github.com/mohpais/template-admin-laravel.git).
- Rename folder clone and open directory.
- Copy `.env.example` to `.env` and updated the configurations (mainly the database configuration)
- Install composer using `composer install`.
- Generate new key for app using `php artisan key:generate`.
- Run `php artisan migrate --seed` to create the database tables and seed the roles and users tables