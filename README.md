# Epigra Full Stack Developer Assigment

## Table of Contents

-   [About](#about)
-   [Dependencies](#dependencies)
-   [Installing](#getting_started)
-   [Usage](#usage)
-   [Api Documentation](#api)

## About <a name = "about"></a>

Set up a full-stack structure and present it via the
web user interface. Using laravel for backend as api , using vue.js ,vuetify and vuex for frontend.

## Dependencies <a name = "dependencies"></a>

-   Laravel Ui with vue
-   Darkaonline/l5-swagger
-   Vuetify
-   Vuex
-   Axios
-   Vue-router
-   Vuex-persist
-   Vee-validate

## Installing <a name = "getting_started"></a>

### Backend

-   Clone the git repository: `git clone https://github.com/canbulgay/epigra.git`
-   Modify the `.env` file configure your database settings.
-   Install project dependencies with `composer install`
-   Attach a fresh application key to the project with `php artisan key:generate`
-   Run the migrations and seed the database `php artisan migrate --seed`

### Frontend

```
npm install
```

```
npm run watch
```

## Usage <a name = "usage"></a>

When you have finished all the installations, you need to activate the schedule to send a request to the space X api every 3 minutes.

```
php artisan schedule:work
```

When the artisan command is run which in `getAllDataFromSpaceXCommand`, the data from the space x API is synchronized to the database with the `capsule` and `mission` models.

When the artisan command is finished, the `DbSyncDoneEvent` is triggered with the incoming data. The `SendNotificationToAdmin` connected to the event notifies the admin that the synchronization is complete with a `SyncTaskDoneNotification`.And The `SyncCompletedLogListener` logs the data from event using the spacelog channel.

## Api Documentation <a name = "api"></a>

I used `Darkaonline/l5-swagger` to generate api documentation. You can access it from `http://localhost/api/documentation` while the project is running.

If you cannot access the documentation, type this command in the console

```
php artisan l5-swagger:generate
```
