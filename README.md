![enter image description here](https://nielsmartens-cv.netlify.app/kindfoxlogowhite.png)

1) clone this repository

`git clone https://github.com/NielsMartensGitH/Kindfox_daycare_app.git`

2) go to the app folder

`cd Kindfox_daycare_app`

3) install all the dependencies

`composer install`

4) create a .env file from example.env

`cp .env.example .env`

5) set APP_KEY value in .env file

`php artisan key:generate`

6) add database credentials in .env file

```console
to be filled variables:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kindfox_laravel
DB_USERNAME=root
DB_PASSWORD=
```

7) create mailtrap account , make a mailbox and add credentilas to .env file

to be filled variables:

```console
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
```

8) create pusher account and add credentials to .env file

to be filled variables:
```console
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=eu

```

9) go to https://www.attheminute.com/vapid-key-generator and generate PUBLIC KEY AND PRIVATE KEY , also add them to env file

to be filled variables:

```console
APID_PUBLIC_KEY=
VAPID_PRIVATE_KEY=
```

10) create a symbolic link to make stored data (like images) accessible from the web

`php artisan storage:link`

11) run migrations

`php artisan migrate`

12) run your app

`php artisan serve`
