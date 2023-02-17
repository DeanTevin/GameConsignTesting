## <p color="mediumseagreen">Assignment Explanation</p>

For this assignment you can run the project by following the guide below. All endpoints are documented and tested using postman. I used laravel-boilerplate ([Click here for the official documentation](http://laravel-boilerplate.com)) as the base of the project. I also add the [Laravel Passport](https://laravel.com/docs/7.x/passport) to the project for authetication in API endpoint.

JSON Collection API: [Postman Collection](https://api.postman.com/collections/17778669-71e471d9-7693-404f-b10d-6d0b02a4a462?access_key=PMAT-01GSF6G167DT9Z80P4S5QFNYDF)

## <p color="orange"> How to Run Project </p>

#### 1. Clone the Project
`git clone https://github.com/DeanTevin/GameConsignTesting.git`

#### 2. Set Environment File
This package ships with a .env.example file in the root of the project.</br>
You must rename this file to just .env</br>
Note: Make sure you have hidden files shown on your system.

- ##### <u>Marvel API</u>
	Set the environment for `MARVEL_PUBLIC_KEY` and `MARVEL_PRIVATE_KEY` to your own designated keys from [Marvel Developer](https://developer.marvel.com/).

- ##### <u>SWAPI</u>
	Set the environment `SWAPI_KEY` to " " **(default)** || SWAPI DOES NOT REQUIRE ANY KEYS

- ##### <u color="tomato">Set To Production</u>
	Set .env parameter for `MARVEL_PRODUCTION` and `SWAPI_PRODUCTION` has boolean value. set this to true for **PRODUCTION** Environment 

#### 3. Run Composer Install and NPM Install
`composer install` || `npm install`

#### 4. Create Database
You must create your database on your server and on your .env file update the following lines:</br>

	DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=homestead
	DB_USERNAME=homestead
	DB_PASSWORD=secret`

Change these lines to reflect your new database settings.

#### 5. Run Artisan Commands
The first thing we are going to do is set the key that Laravel will use when doing encryption.
- `php artisan key:generate`</br>

You should see a green message stating your key was successfully generated. As well as you should see the APP_KEY variable in your .env file reflected. It's time to see if your database credentials are correct.

We are going to run the built in migrations to create the database tables:
- `php artisan migrate`

Now seed the database with:

- `php artisan db:seed`

You should get a message for each file seeded, you should see the information in your database tables.

## Laravel Boilerplate (Current: Laravel 7.*) ([Demo](https://demo.laravel-boilerplate.com))

[![Latest Stable Version](https://poser.pugx.org/rappasoft/laravel-boilerplate/v/stable)](https://packagist.org/packages/rappasoft/laravel-boilerplate)
[![Latest Unstable Version](https://poser.pugx.org/rappasoft/laravel-boilerplate/v/unstable)](https://packagist.org/packages/rappasoft/laravel-boilerplate) 
<br/>
[![StyleCI](https://styleci.io/repos/30171828/shield?style=plastic)](https://github.styleci.io/repos/30171828)
![Tests](https://github.com/rappasoft/laravel-boilerplate/workflows/Tests/badge.svg?branch=master)
<br/>
![GitHub contributors](https://img.shields.io/github/contributors/rappasoft/laravel-boilerplate.svg)
![GitHub stars](https://img.shields.io/github/stars/rappasoft/laravel-boilerplate.svg?style=social)e

### Demo Credentials

**User:** admin@admin.com  
**Password:** secret

### Official Documentation

[Click here for the official documentation](http://laravel-boilerplate.com)

### Slack Channel

Please join us in our Slack channel to get faster responses to your questions. Get your invite here: https://laravel-boilerplate.herokuapp.com

### Introduction

Laravel Boilerplate provides you with a massive head start on any size web application. Out of the box it has features like a backend built on CoreUI with Spatie/Permission authorization. It has a frontend scaffold built on Bootstrap 4. Other features such as Two Factor Authentication, User/Role management, searchable/sortable tables built on my [Laravel Livewire tables plugin](https://github.com/rappasoft/laravel-livewire-tables), user impersonation, timezone support, multi-lingual support with 20+ built in languages, demo mode, and much more.

### Issues

If you come across any issues please [report them here](https://github.com/rappasoft/laravel-boilerplate/issues).

### Contributing

Thank you for considering contributing to the Laravel Boilerplate project! Please feel free to make any pull requests, or e-mail me a feature request you would like to see in the future to Anthony Rappa at rappa819@gmail.com.

### Security Vulnerabilities

If you discover a security vulnerability within this boilerplate, please send an e-mail to Anthony Rappa at rappa819@gmail.com, or create a pull request if possible. All security vulnerabilities will be promptly addressed.

### Donations

If you would like to help the continued efforts of this project, any size [donations](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=JJWUZ4E9S9SFG&lc=US&item_name=Laravel%205%20Boilerplate&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted) are welcomed and highly appreciated.

### License

MIT: [http://anthony.mit-license.org](http://anthony.mit-license.org)
