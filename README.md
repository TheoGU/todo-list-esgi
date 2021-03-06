## Project
Création d'une plateforme en Laravel sous lando afin de mettre en avant la mise en place de plusieurs tests avec PHPUnit.

## Installation

  

You must install Lando (and Docker 2.x.x).

  
[https://docs.lando.dev/basics/installation.html#system-requirements](https://docs.lando.dev/basics/installation.html#system-requirements)

Create .env from example.

`cp .env.example .env`

Replace environment variables.

    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=
    APP_DEBUG=true
    APP_URL=https://todolist.lndo.site
    
    LOG_CHANNEL=stack
    LOG_LEVEL=debug
    
    DB_CONNECTION=mysql
    DB_HOST=database
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=laravel
    DB_PASSWORD=laravel
    
    BROADCAST_DRIVER=log
    CACHE_DRIVER=file
    QUEUE_CONNECTION=sync
    SESSION_DRIVER=database
    SESSION_LIFETIME=120
    
    MEMCACHED_HOST=127.0.0.1
    
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379
    
    MAIL_MAILER=smtp
    MAIL_HOST=mailhog
    MAIL_PORT=1025
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS=null
    MAIL_FROM_NAME="${APP_NAME}"
    
    AWS_ACCESS_KEY_ID=
    AWS_SECRET_ACCESS_KEY=
    AWS_DEFAULT_REGION=us-east-1
    AWS_BUCKET=
    
    PUSHER_APP_ID=
    PUSHER_APP_KEY=
    PUSHER_APP_SECRET=
    PUSHER_APP_CLUSTER=mt1
    
    MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
    MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

Generate app key.

`lando artisan key:generate`

Run migrations.

`lando artisan migrate`

## Start

`lando start`

## Tests

`lando artisan test`