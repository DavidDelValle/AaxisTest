# AaxisTest
API Rest Symfony

------------------------------------
Local requirements: 
-
Php 8.2

Composer

Docker Compose





-
Steps for local environment:
-

cd AaxisTest 

composer install

docker compose up -d 

php bin/console doctrine:database:create

php bin/console doctrine:migrations:migrate

php bin/console doctrine:database:create

php bin/console doctrine:migrations:migrate




Details: This Development it is not finished, we have some troubles with the postgre connection between

doctrine and composer.json, so we don't test the APIS. But we create the Controller with the required

functions and the Entity. We don't have to much time so the authentication point we cannot do it.

Greetings.
