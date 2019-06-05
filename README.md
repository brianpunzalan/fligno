# Fligno App

Simple Web Application built with Laravel + React.

## Get Started

To start the containers, enter the following:
> option `-d` to run in background
```
docker-compose up -d
```

To stop the containers, enter the following
```
docker-compose down
```

If you have changed the Dockerfiles on one of the services, please rebuild the images with the following command:
```
docker-compose build
```

To execute Artisan commands, enter the following
```
docker run -it --rm fligno_server <command>
```
Example:
```
docker run -it --rm fligno_server list
```
is equal to
```
php artisan list
```