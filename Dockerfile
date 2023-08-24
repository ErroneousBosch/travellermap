FROM php:apache

RUN apt-get update; \
 apt-get install -y libyaml-dev git zip sqlite3

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

RUN sed -i 's#DocumentRoot /var/www/html#DocumentRoot /app/public \n <Directory /app/public>\n        AllowOverride None\n        Require all granted\n        FallbackResource /index.php\n   </Directory>#' /etc/apache2/sites-available/000-default.conf

#RUN curl -sS https://get.symfony.com/cli/installer | bash

#RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash \
#&& apt install symfony-cli -y

#RUN symfony check:requirements
    
