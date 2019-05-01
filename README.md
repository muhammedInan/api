# api
Bilemo project api rest
Web service exposing an API

Getting Started
You can download the project, or clone it with Git by using the green button "Clone or download". You can run it on your local machine for development and testing purposes.

Prerequisites
PHP 7.2
MySql 5.6.35
Apache

Installing
For installing the project, you have to clone or download it. For running it on your local machine, you can install MAMP (or WAMP for Windows), and put it in the htdocs (or www) file.

Execute the command composer update to update the dependancies.
Execute php bin/console doctrine:database:create and php bin/console doctrine:schema:update --force to create database and all the entities.
Run php bin/console doctrine:fixtures:load to load fixtures. Now, you can go on http://localhost/ and use the application !

Built With
Symfony 4.2 - PHP framework
JMSSerializerBundle - Easily serialize, and deserialize data of any complexity (supports XML, JSON, YAML)
Hateoas - A PHP library to support implementing representations for HATEOAS REST web services
NelmioAPIDocBundle - Generates documentation for your REST API from annotations
