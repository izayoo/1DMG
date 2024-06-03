# 1DMG Assessment | Restful API

## Installation

  * Run `composer update` to download project dependencies
  * Run `cp env .env` to copy env file template
  * Add/Replace these values in the `.env` file:
    * CI_ENVIRONMENT = development
    * indexPage = ''
    * app.baseURL = '{your local environment url}'
    * database.default.hostname = {your mysql hostname}
    * database.default.database = {your mysql database} 
    * database.default.username = {your mysql username}
    * database.default.password = {your mysql password}
    * database.default.DBDriver = MySQLi
    * database.default.DBPrefix =
    * database.default.port = 3306
    * JWT_SECRET = {your JWT secret key}
  * Run `php spark migrate` to run migrations

> _** You may run `node -e "console.log(require('crypto').randomBytes(32).toString('hex'))"` in your terminal to create a random JWT secret key_
