FROM php:apache

RUN apt-get update; \
 apt-get install -y libyaml-dev git zip

RUN pecl install yaml \
&& pecl install apcu \
&& docker-php-ext-enable yaml apcu opcache

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
&& php composer-setup.php --install-dir=/usr/local/bin --filename=composer\
&& php -r "unlink('composer-setup.php');"

RUN mkdir /app \
&& rm -r /var/www/html \
&& ln -s /app/public /var/www/html

ENV PATH="/app/bin:/app/vendor/bin${PATH}"
WORKDIR /app

#RUN curl -sS https://get.symfony.com/cli/installer | bash

#RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash \
#&& apt install symfony-cli -y

#RUN symfony check:requirements

