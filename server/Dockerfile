FROM php:7.2-apache

ENV PROJECT_PATH=/var/www/html/public \
    PROJECT_URL=localhost \
		APACHE_RUN_USER=www-data \
    APACHE_RUN_GROUP=www-data \
		PHP_INI_DIR=/usr/local/etc/php \
		COMPOSER_ALLOW_SUPERUSER=1

RUN mv /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

COPY . /var/www/html

WORKDIR /var/www/html

# Update and Install dependencies
RUN apt-get update && apt-get install -y \
	git \
	git-core \
	curl \
	build-essential \
	openssl \
	libssl-dev \
	libfreetype6-dev \
	libpng-dev \
	libwebp-dev \
	libjpeg62-turbo-dev \
	libgmp-dev

RUN curl -sL https://deb.nodesource.com/setup_8.x | bash -

RUN apt-get install nodejs -y

RUN docker-php-ext-install \
	pdo \
	pdo_mysql \
	gd
	# bcmath \
	# ctype \
	# openssl \
	# mbstring \
	# json \
	# tokenizer \
	# xml \
	# xmlreader \
	# xmlwriter \
	# ftp \
	# hash \
	# mysqli

# Check if NPM was installed
RUN npm -v

# Create folder for binaries
RUN mkdir bin

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
	php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
	php composer-setup.php --install-dir=bin && \
	php -r "unlink('composer-setup.php');"

COPY package.json /var/www/html

RUN npm install

COPY composer.json /var/www/html

RUN php bin/composer.phar install

COPY apache-vhost.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R $APACHE_RUN_USER:$APACHE_RUN_GROUP $PROJECT_PATH

RUN a2enmod rewrite

EXPOSE 80

ENTRYPOINT [ "php", "artisan" ]

CMD [ "serve" ]

EXPOSE 8000