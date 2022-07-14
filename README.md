<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Simple api for simple bank
This project contains simple api to manage simple bank
# This simple api doesnt have authorization but ...
If you want to have authoraziation check this link:</br>
<a href="https://github.com/Moein100/simpleapi2" target="_blank">simple api with simple bank with authorization</a>
## Initialize
First run `composer install`.</br>
Then config your database in `.env` file.</br>
after that generate key for your laravel application using: `php artisan key:generate`.</br>
Then use `php artisan migrate:fresh --seed` to create tables and pre-populate them.</br>
`php artisan serve` and there you have it!
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
## Test
you can run the tests by using `php artisan test`.</br>
and if you faced with the error including this cocept that "there is no "unit" folder" you have to make the `Unit` folder inside `test` directory and then run:
`php artisan test`
