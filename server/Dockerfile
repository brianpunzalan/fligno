FROM php:7.2-apache

ENV PROJECT_PATH=/var/www/html/public \
    PROJECT_URL=localhost \
		APACHE_RUN_USER=www-data \
    APACHE_RUN_GROUP=www-data \
		COMPOSER_ALLOW_SUPERUSER=1

COPY . /var/www/html

WORKDIR /var/www/html

# Update
RUN apt-get update && apt-get install git -y

# Create folder for binaries
RUN mkdir bin

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
	php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
	php composer-setup.php --install-dir=bin && \
	php -r "unlink('composer-setup.php');"

COPY ./.env /var/www/html

COPY ./composer.json /var/www/html

COPY ./package.json /var/www/html

COPY ./apache-vhost.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R $APACHE_RUN_USER:$APACHE_RUN_GROUP $PROJECT_PATH

RUN php bin/composer.phar install

RUN ["service", "apache2", "start"]

ENTRYPOINT [ "php", "artisan" ]
CMD ["serve"]