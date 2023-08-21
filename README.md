<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

Project Task Management Web Application
Laravel 10 Vue JS API 
Redmine


Steps to be followed
===============================
- Clone project code zip file from Repository
- Run command `Composer install`
- Run command `./vendor/bin/sail up`
- Run command `npm install`
- Run command `cp env.example .env`
- Run command `php artisan key:generate`
- Create mysql db / Set database mysql credentials in .env file
- Check the db connction using laravel tinker
- Do the require settings for enable rest api settings and generate access key and api url in redmine panel
- Set redmine api url and seceret access key & credentials in .env file for rest api 
- Extra feature:: Set database redmine mysql dev/stage server credentials in .env file if you have any dev/stag server
- You can switch databse between using a local database as `mysql` or `redmine` via env variable `DB_CONNECTION`
- Add VITE_API_URL=http://127.0.0.1/api in .env file for laravel vue js communication talk to each other
- Run command `php artisan migrate --seed`
- Run command `php artisan serve` if 
- Run command `npm run dev`
- Login into authentication based web application http://127.0.0.1:8000/login

# Features
- Switch database local mysql and redmine
- Pagination
- Quick searching
- Database design 
- Redmine API
- Docker
- Anonymous search filter feature without page reloding  

# Used Tech Stack:: 
• PHP
• MySQL
• Laravel 10 package used sail
• Vue.js vue axios for api call
• Docker dev environment 
• Redmine project & task management tool REST Api 

API::Redmine 
Create Issue
Get Issue
Delete Issue

Note::
============
My laravel task management application is for manage task/issues web application on daily bases.... 

Credentials for Admin / Register yourself through http://127.0.0.1:8000/login
============================
email = admin@gmail.com,
password = admin123
Implement a main page with a task search filter (without page reloading) and display the found tasks with pagination.
throgh vue js and local  mysql


php artisan serve

1. Set up Laravel and Docker through Laravel Sail package and add api url in .env file.
2. Design a database for storing tasks as an alternative to Redmine:
   (provide the ability to switch between using a local database or Redmine via env variables).
   Use examples of fields from Redmine tables (Issue, Project, Company).
3. Do not use third-party packages to work with Laravel-Redmine (only via API).

4. You can use Redmine running in Docker or create a test account at https://www.redmine.org/.
5. Implement a main page with a task search filter (without page reloading) and display the found tasks with pagination.
6. Implement task deletion.
7. Implement task creation.


- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
