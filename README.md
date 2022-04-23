# Installation 

#### ⚠ You need to have symfony and php 8 on your machine ⚠️️
___
## 1. Install dependencies :

When you have git clone.

```
~ composer install
```

And install asset 

```
~ php bin/console assets:install
```


## 2. Create .env.local

```
~ cp .env .env.local
```

## 3. Create database and data

In .env.local you uncomment the line who corresponding to your database system, comment other, and complete username password and database name

For MariaDB system follow this sentence :

  - If you have a password on your local db :

      ```
      DATABASE_URL="mysql://USERNAME:PASSWORD@127.0.0.1:3306/DB_NAME?serverVersion=mariadb-10.3.25&charset=utf8mb4"
      ```
  - If you don't have password on your local db :
      ```
      DATABASE_URL="mysql://USERNAME:@127.0.0.1:3306/DB_NAME?serverVersion=mariadb-10.3.25&charset=utf8mb4"
      ```


Now we can create database : 

```
~ php bin/console d:d:c
~ php bin/console d:m:m
```
Say yes at question.


For load data we use fixture : 

```
~ php bin/console d:f:l
```

At question "Do you want to continue?"
say YES

## 4. Now we go to configure email send

An email are sent on account creation and when you forgot your password
For this symfony need a little configuration 

On .env.local you find this:

```
###> symfony/mailer ###
# MAILER_DSN=null://null
###< symfony/mailer ###
```

Uncomment the line "MAILER_DSN=null://null"

Depending on service tout want to use you can check the [documentation](https://symfony.com/doc/current/mailer.html#using-a-3rd-party-transport).

In this project gmail is used for configure this line follow this sentence :

```
MAILER_DSN=gmail+smtp://EMAIL(with @gmail):PASSWORD@default
```

**AND On your gmail account you need to activate "Access to unsecure application"
on security page [follow this link](https://myaccount.google.com/u/2/security?hl=fr)**

## 5. Now you can start serve

In terminal in project folder

```
~ Symfony serve:start
```

## 6. Connect to default user.

```
Email : a@a.fr
Password : a
```
