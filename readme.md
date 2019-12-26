## What Is This?

Rak Buku is An App For Manage Your Reading Life Style, You Can Bookmark, Wishlist, Dropped, Like, Dislike, Even Review Book That Already You Read.

Rak Buku has separated environment for Server-Side and Client-Side. And this Repo Is For Server-Side.

This Server-Side functionate as Web-Service that send data to Client-Side in JSON and Process Data From Client-Side. You Can Find Client-Side Repo In Here [Rak-Buku-Vue](https://github.com/IrhamMaulani/rak-buku-vue).

Technology Used for this server-side is PHP with Laravel Framework 5.8.27 version and MariaDB as Database.

## About Score

For Scoring, Rak-Buku used This

```sh
Formula

Weighted Rank (WR) = (v / (v + m)) * S + (m / (v + m)) * C
S = Average score for the Book(mean).
v = Number of votes for the Book= (Number of people scoring the Book).
m = Minimum votes/scores required to get a calculated score (currently 50 scores required).
C = The mean score across the entire Book DB.
```

For more Detailed Check syncAllScore function in ScoreService file

## How To Install

-   Install [Git](https://git-scm.com/) and [Composer](https://getcomposer.org/)
-   Start Your Development Environment (Xampp, Wampp, Lampp, Or Laragon)
-   Clone the project (git clone https://github.com/IrhamMaulani/rak-buku-web)
-   Go to the folder application using cd command on your cmd or terminal
-   Run composer install on your cmd or terminal
-   Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu
-   Create New Database in Your Local Development
-   Open your .env file and change the database name (DB_DATABASE) to database you named it before, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
-   By default, the username is root and you can leave the password field empty. (This is for Xampp) By default, the username is root and password is also root. (This is for Lamp)
-   Run php artisan key:generate
-   Run php artisan migrate
-   Run php artisan db:seed
-   Run php artisan storage:link
-   Run php artisan passport:install

Now you've done install Server-Side, Now for use you Need To go Client-Side and Install The Front-end [Rak-Buku-Vue](https://github.com/IrhamMaulani/rak-buku-vue).
