prerequiestes
PHP, Apache, Mysql installed on Linux server or xampp fow windows
php 7.1.3 or above
git 
Clone the Project git clone --branch master https://github.com/Harishporwal18/guestbook.git
change directory to new guestbook directory and run composer install(composer will install all the dependecies)
open .env and add database connection and name.
DATABASE_URL="mysql://root:@127.0.0.1:3306/book?serverVersion=5.7"
run the command to create database php bin/console doctrine:create:database
run the below command for create all 
