Step 1 prerequisites   
		a. PHP, Apache, Mysql installed on Linux server or xampp fow windows   
		b. php 7.1.3 or above   
		c. git    
Step 2   
		Clone the Project git clone --branch master https://github.com/Harishporwal18/guestbook.git   
		Change directory to new guestbook directory and run composer install(composer will install all the dependecies)   
		open .env and add database connection and name.   
		DATABASE_URL="mysql://root:@127.0.0.1:3306/book?serverVersion=5.7"   
		run the command to create database php bin/console doctrine:create:database    
		php bin/console doctrine:schema:update
	run the below command to run all migrations    
	 php bin/console make:migration php bin/console doctrine:migrations:migrate    
	 Step 3     
	 Create Admin user with fixtures
	    php bin/console make:fixtures    
			2.	php bin/console doctrine:fixtures:load --append
			
			
	 
