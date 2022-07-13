<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Simple api for simple Bank 

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
# Simple api for simple bank
This project contains simple api to manage simple bank
## Initialize
First config your database in `.env` file.</br>
after that generate key for your laravel application using: `php artisan key:generate`.</br>
Then use `php artisan migrate:fresh --seed` to create tables and pre-populate them.
## Some discriptions
There are 6 api routes in this project.
```
Route::get('/getAllCustomers',[BankController::class,'allCustomers']);
Route::get('/getAllAccounts',[BankController::class,'allAcounts']);

Route::post('/CreateAccount/{customer}',[BankController::class,'create']); 
Route::post('/Transfer/from/{from}/to/{to}',[BankController::class,'transfer']);
Route::get('/getAccountAmount/{account}',[BankController::class,'getAmount']);
Route::get('/TransferHistory/{account}',[BankController::class,'history']);
```
### Let me explain the routes for you
#### Create Account
A customer can have many accounts so you can use `YOUR_APP_URL/api/CreateAccount/{customer}` to create a new account for a specefic customer.instead of `{customer}` you have to enter the coustomers id to assing that account to the entered customer.(we can easily change it to find the costomer by name or... but we are ok with id).</br>after making account using this route it will return the created account details in json format.
#### Transfer
You can transfer amounts between any two accounts, including those owned by different customers.you only need to use this route`YOUR_APP_URL/api/Transfer/from/{from}/to/{to}`</br>
Instead of `{from}` you have to put the account's id that you wanna transfer amount from and instead of `{to}` you have to put account's id that wanna recieve the amount.if any problem happens you will recieve a message in json format that says `it is not possible` and if everything goes well you will recieve a `success message`.
#### Get account's amount
You can get the amount of a specefic account by using `YOUR_APP_URL/api/getAccountAmount/{account}`.you have to us account's id in `{account}` and then you will get full data of that account including amount.
#### Transfer history
you can get the full history of transfering a specefic account by this route `YOUR_APP_URL/api/TransferHistory/{account}`. you only need to put account's id instead of `{account}`.then you will see full transfers history in json format like this:</br>
````````````````````````````````````
{
    "data": {
        "this_account_transfered": [
            {
                "transfererAccount_id": 1,
                "transferer_name": "Anibal Sporer",
                "recieverAccount_id": 2,
                "reciever_name": "Jermaine Terry",
                "amount": 10
            }
        ],
        "this_account_recieved": [
            {
                "recievedFromAccount_id": 2,
                "transferer_name": "Jermaine Terry",
                "recieverAccount_id": 1,
                "reciever_name": "Anibal Sporer",
                "amount": 12
            }
        ]
    }
}
````````````````````````````````````
You will see a "data" that includs "this_account_transfered" and "this_account_recieved".</br>
"this_account_transfered" includes the info about amount that has been transfered by this account.</br>
and "this_account_recieved" includes the info about amount that has been recieved by this account.
##Test
you can run the tests by using `php artisan test`.</br>
and if you faced with the error including this cocept that "there is no "unit" folder" you have to make the `Unit` folder inside `test` folder and then run:
`php artisan test`
