# Code Igniter | Restful API Boilerplate

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
  * Run `php spark migrate` to run migrations


