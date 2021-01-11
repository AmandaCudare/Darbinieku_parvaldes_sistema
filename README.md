<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Pamācībā
- Jāinstalē Git, kā arī Composer.
- Ar Git palīdzību lejuplādē uz datora "Darbinieku_parvaldes_sistema" repozitoriju.
- Lejuplādē Xampp 7.2.34 versiju, un svarīgi ir komponentēs izvēlēties phpMyAdmin, MySQL.
- Kad ieslēdz Xampp, uzspiest start pie Apache un MySQL.
- Jāatrod, kur datorā ir instalēts Xampp serveris, jānonāk "\xampp\htdocs" mapē un jāievieto lejuplādētā datorā Darbinieku_parvaldes_sistema"" mape un jāpārsauc mapi par "DPS".
- Ieejot tīmekļa pārlūkprogrammā ir jāieiet localhost - "http://localhost/phpmyadmin/index.php" ir jāizveido datubāze ar nosakumu "DPS".
- Šajā datubāzē jāizvēlas sadaļa "Privilages" un jāizvēlas ar "Username" - root un "Host name" - "localhost" un nospiest "Edit privileges". Šeit jānospiež "Change password". Šai parolei ir jāsakrīt ar .env faila "DB_PASSWORD" paroli.
- Var vai nu datora terminālē, vai arī Visual Studio Code terminālē(ja šis ir instalēts) ar cd funkcijas palīdzību nonākt "/xampp/htdocs/DPS" atrašanās vietā.
- Sākotnēji vajadzēs palaist datubāzi ar funkciju "php artisan migrate" terminālī. Tad terminālī "php artisan db:seed --class DatabaseSeeder", ja vēlās tikai administratoru, bet ja visas 3 lomas lietotājus sistēmā uzreiz, tad "php artisan db:seed --class UsersTableSeeder".
- Lai palaistu sistēmu tīmekļa lietotnē, tad jāieraksta terminālī funckija "php artisan serve" un ieraksta "Laravel development server started:" linku pārlūkprogrammā. Ja terminali aiztaisīs ciet, tad tīmekļa lietotne vairs nestrādās pārlūkprogrammā.


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

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

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

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
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
