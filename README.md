# leisureCenter_Api
A simple exemple of a leisure center Api build with API Platfom.

## Installation

Start by cloning the repository with the following command :

```
$ git clone https://github.com/Siv-tspab/leisureCenter_Api.git
```
Then:
```
$ composer install
```

Once it's done, you have to configure and create the dataBase, and then import the data. For this exemple I've use mariadb as database :


### 1. Database

Replace that line into the `.env` file
```
DATABASE_URL="postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=13&charset=utf8"
```
with some thing like (depending on your own database configuration):
```
DATABASE_URL="mysql://root@127.0.0.1:3306/leisurecenter?serverVersion=mariadb-10.4.17"
```
Then you can run create the database:
```
$ php bin/console doctrine:database:create
```
Once it's creat, import the `leisurecenter.sql` into your database.


### 2. JWT KEYS
Now you have to generate jwt keypairs for the authentification on secure routes:
```
$ php bin/console lexik:jwt:generate-keypair
```
It should generate a `/jwt` folder into the `/config` folder with 2 files: `pivate.pem` and `public.pem`.

### 3. API KEYS
Last thing to do into the `.env` file your own api keys for OpenWeathermap and MapBox like this:
```
OWM_API_KEY="xXXXXXXXXXXXxxxxxXXxxXXxXXXXXXXXX"
MB_API_KEY="xx.XXXXXxxxxXXXxxXxXXXxXxxxXXxXxXXxXXXXxxXXXxXxxXxxXXXxxxXXXxXX.XxXxxxXxxxxXXXXxxXX"
```

## How it's work

* You can have access to a swagger on `http://{{your_localhost}}/api`
* Some route are secured by a bearer, you can login on `http://{{your_localhost}}/api/login` with a default user : 
  * username: samsepiol@mail.com
  * password: 0000
*  `http://{{your_localhost}}/apidoc.json` give you the json of the entites schemas.
