# GuestBook Application
## Step 1 Prerequisites   
		-  PHP, Apache, Mysql installed on Linux server or xampp fow windows   
		-  php 7.1.3 or above   
		-  download and install git    
## Step 2   
		- Clone the Project git clone --branch master https://github.com/Harishporwal18/guestbook.git   
		- Change directory to new guestbook directory and run composer install(composer will install all the dependencies)   
		- open .env and add database connection and name.   
		- DATABASE_URL="mysql://root:@127.0.0.1:3306/book?serverVersion=5.7"   
		- run the command to create database php bin/console doctrine:database:create  
		- php bin/console doctrine:schema:update --force
		 run the below command to run all migrations (For new repo database schema does the update, for changes in existing run migrations)   
		- php bin/console make:migration php bin/console doctrine:migrations:migrate    
## Step 3     
	 Create Admin user with fixtures   
	   - php bin/console doctrine:fixtures:load --append
## step 4
	Run the program
	-   php bin/console server:run Or  php bin/console server:start
	Run PHPUnit
	 - php ./vendor/bin/phpunit
 ## Application Screen
 
 `Login Screen
 - If you are existing user - Login with email and password
 ![image](https://user-images.githubusercontent.com/11938460/133545907-f2a03ab1-6930-460c-81f4-16a3ae3b1af5.png)

` Registration Screen
 - To Create a new Guest, you need to register 
  Create a login with email and password
  ![image](https://user-images.githubusercontent.com/11938460/133546002-07a55e64-1bdf-4741-8319-5e2442830006.png)

` Guest Screen
 - Logged in user can view the list of guest added
  ![image](https://user-images.githubusercontent.com/11938460/133546975-8148ed6c-8d5d-4f4d-892e-205af6b116a4.png)
 - User can add new Guest
  ![image](https://user-images.githubusercontent.com/11938460/133547035-e6ebda1b-c505-421d-8c86-8d8a4e4a1313.png)

` Admin user
- Login with Admin user to view the complete list of Guest
- Admin can approve and delete Guest entries
 ![image](https://user-images.githubusercontent.com/11938460/133547170-0e7462c2-5ed4-4c8a-a225-737c23f191b8.png)
 - Aprrove Guest
 ![image](https://user-images.githubusercontent.com/11938460/133547252-f006c8bb-25fa-4e65-b4d7-473b7541e4b6.png)
 - Delete Guest 
  ![image](https://user-images.githubusercontent.com/11938460/133581571-7501b9ae-e2d8-44a5-af48-ffaef61f080a.png)
