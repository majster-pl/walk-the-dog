
  

<p  align="center"><a  href="https://walkthedog.info"  target="_blank"><img  src="https://github.com/majster-pl/walk-the-dog/blob/main/public/images/logo-full-rect_new.png?raw=true"  width="400"></a></p>

  

  

# Walk The Dog

  

  

Walk The Dog is an [open source](https://opensource.com/resources/what-open-source) project created by [Szymon Waliczek](https://waliczek.org/) to help people explore new places, where they can take their four-legged pets for a walk. This is a side project created in free time to upskill knowledge about [Laravel framework](https://laravel.com/) and at the same time create something useful, handy and accessible for everyone.

  

  

Version 1.0 was released in May 2022 and the source code is available on [github](https://github.com/majster-pl/walk-the-dog)

  
  

Link to the website [walkthedog.info](https://walkthedog.info)

  

## Get started

  

Clone repo

  

git clone https://github.com/majster-pl/walk-the-dog && cd walk-the-dog

  

install packages

  

composer install

npm install -s

Copy .env file

  

cp .env.example .env

Change .evn file with your db etc. Make sure you add:

  

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=

DB_DATABASE=

DB_USERNAME=

DB_PASSWORD=

NOCAPTCHA_SECRET="your_secret"

NOCAPTCHA_SITEKEY="your_site_key"

MAIL_MAILER=

MAIL_HOST=

MAIL_PORT=

MAIL_USERNAME=

MAIL_PASSWORD=

MAIL_ENCRYPTION=

MAIL_FROM_ADDRESS=

MAIL_FROM_NAME="${APP_NAME}"

  
  
  

Generate application key using command below and enter generated key to .env file.

  

php artisan key:generate

  

Setup folder permissions

  

`chmod -R 755 storage` `chmod -R 755 vendor`

  

Create link to storage/app/public folder

  

    php artisan storage:link


Migrate database with pre-set users (see /database/seeders/DatabaseSeeder.php for details and adjust before running this command or remove users from admin panel later)

    php artisan migrate:fresh --seed --seeder=DatabaseSeeder

  

## Running the project

To build and run **locally**:

  

npm dun dev

php artisan serve

website:
http://localhost:8000/
available logins (all passwords: **password**):
- email: user@walkthedog.com
- email: editor@walkthedog.com
- email: admin@walkthedog.com

admin panel:
http://localhost:8000/admin
user: admin
pass: admin
  

To build project for **production** run:

  

npm run build

Then upload project to the server.

