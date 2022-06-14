<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

### Steps

- Pull this repo to folder *htdocs* of Xampp.
- Go to the application folder on your cmd or terminal.
- Run:
```bash
composer install 
```
- Copy *.env.example* file to *.env* on the root folder.
- Reconfigure your *.env* file.
- Run:
```bash
php artisan key:generate
php artisan migrate
php artisan storage:link
```

Link Youtube Demo

```bash
https://youtu.be/oP1tDp9xoFY

https://youtu.be/Aodj__skbdE
```

(composer require nao-pon/flysystem-google-drive:~1.1) --cài package của google drive
(composer require google/apiclient) 

* Cần sửa hàm down() trong file 2022_02_17_175813_change_data_type_min_guest_max_guest_in_posts_table.php 
    khi muốn migrate:rollback: Đổi tinyInteger => smallInteger 