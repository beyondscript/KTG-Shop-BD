<p align="center">
	<img src="https://github.com/beyondscript/KTG-Shop-BD/blob/main/public/images/icon/logo_minimised.webp" width="60" height="60" margin-left="auto" margin-right="auto" alt="Logo">
	<br>
	KTG Shop BD
</p>

## About KTG Shop BD

KTG Shop BD is an e-commerce based multi-vendor web application which was designed by using HTML, CSS and JavaScript and developed by using PHP and Laravel framework.

This website was built for learning Laravel E-commerce based Mult-vendor web application.

## How to use?

<strong>Step - 1:</strong>
<br>
Download or clone the repository

<strong>Step - 2:</strong>
<br>
Intall all the dependencies by running these commands "composer update" and "npm install"

<strong>Step - 3:</strong>
<br>
Copy the .env.example file from root directory to root directory then rename the copied file to .env

<strong>Step - 4:</strong>
<br>
Generate new application key by running the command "php artisan key:generate"

<strong>Step - 5:</strong>
<br>
Create a new database and import the laravelmultiauth.sql file

<strong>Step - 6:</strong>
<br>
Add the database details in the .env file by editing the .env file like below:

DB_DATABASE=database_name
<br>
DB_USERNAME=database_user_name
<br>
DB_PASSWORD=database_user_password

<strong>Step - 7:</strong>
<br>
Create a new email account and add the email account details in the .env file by editing the .env file like below:

MAIL_MAILER=smtp
<br>
MAIL_HOST=email_account_host.com
<br>
MAIL_PORT=465
<br>
MAIL_USERNAME=email_account_user_name
<br>
MAIL_PASSWORD=email_account_password
<br>
MAIL_ENCRYPTION=ssl
<br>
MAIL_FROM_ADDRESS=email_account
<br>
MAIL_FROM_NAME="${APP_NAME}"

<strong>Step - 8:</strong>
<br>
Add the application name in the .env file by editing the .env file like below:

APP_NAME="your_app_name"

<strong>Step - 9:</strong>
<br>
Add the application url in the .env file by editing the .env file like below:

APP_URL=your_application_url

<strong>Step - 10:</strong>
<br>
Add your company's email in the .env file by editing the .env file like below:

APP_EMAIL=your_company's_email

<strong>Step - 11:</strong>
<br>
Add your company's phone in the .env file by editing the .env file like below:

APP_PHONE=your_company's_phone

<strong>Step - 12:</strong>
<br>
Add your company's address in the .env file by editing the .env file like below:

APP_ADDRESS="your_company's_address"

<strong>Step - 13:</strong>
<br>
Add TinyPNG credentials in the .env file by editing the .env file like below:

TINIFY_API_KEY=tiny_png_api_key

<strong>Step - 14:</strong>
<br>
Build the assets by running the command "npm run build"

<strong>Step - 15:</strong>
<br>
Delete the node_modules folder from the root directory

## Note

<strong>Admin Credentials:</strong>
<br>
Admin email is: admin@gmail.com
<br>
Admin password is: 12345678

<strong>You must have to setup cron job for this project because this project has some features that relies on cron job. If you do not setup cron job for this project then this project will not be fully functional.</strong>

## When a problem is found?

Do not hesitate to message me when you found any problem.
<br>
<a href="https://www.facebook.com/engrmdnafiulislam/">Facebook</a>
<br>
<a href="https://www.instagram.com/engrmdnafiulislam/">Instagram</a>
