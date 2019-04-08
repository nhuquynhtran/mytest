<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Repo

Build a simple blog platform, that allow registered users could CRUD their posts and view others. Admin is required to publish users’ posts.

## Core features
- **Everyone could see list of posts and check their detail**
- **People could register for new account and login/logout to the system**
- **Registered users could CRUD their posts.**
- **Posts’ body understand markdown syntax and could render properly**
- **Admin could see a list of created posts**
- **Admin could publish or unpublish created posts**

## Optional features
- **Only published posts would be display in public listing page**
- **Admin could see highlighting unpublished posts in list of all posts**
- **Admin could filter/order posts by date or status**
- **Admin could schedule post publishing. E.g I want publish this post automatically in tomorrow 9AM**

## Getting started
To get a local version of this repo up and running, follow the below steps:

1. Setup environment
    - PHP 7.1  (check your bash with command line: php -v)
    - Composer, driver mysql for php7
    - Apache
    - Mysql setup on your local
2. Checkout this source code
3. Go to folder source code run “composer install”, you can view more https://laravel.com/docs/5.8
4. Run `php artisan migrate` to create new database to local mysql.
5. Run `php artisan db:seed` to generate admin account
6. Change  file .env to connect to mysql
7. Config v-host in apache for source code and update host file
8. Run `php artisan serve` and open url http://127.0.0.1:8000