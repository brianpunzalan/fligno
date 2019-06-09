# Fligno App

Simple Web Application built with Laravel + React.

## Get Started

To start the containers, enter the following:
> option `-d` to run in background

For Dev
```
docker-compose -f dev-docker-compose.yml up -d
```

For Prod
```
docker-compose -f prod-docker-compose.yml up -d
```

To stop the containers, enter the following
```
docker-compose -f <docker-file> down
```

If you have changed the Dockerfiles on one of the services, please rebuild the images with the following command:
```
docker-compose build
```

To execute commands on the server, enter the following
```
docker run -it --rm fligno_server <command>
```
Example:
```
docker run -it --rm fligno_server php artisan list
```

To start development initially, please start the apache2 server, migrate and seed the database
```
docker exec -it fligno_server php artisan migrate:fresh
docker exec -it fligno_server php artisan db:seed
```
If the storage folder was still not linked to public folder, enter the following (this is to show images)
```
docker exec -it fligno_server php artisan storage:link
```

### Note
Please use sample `.env.example` on fligno_server container. Also please check the following links below

	phpmyadmin: localhost:8888
		username: root
		password: test123
	fligno_admin: localhost:8080
		email: admin@fligno.com
		password: test123
	fligno_server: localhost:9090
		email: admin@fligno.com
		password: test123