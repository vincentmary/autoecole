# php7-fpm/Dockerfile
FROM php:7.2-fpm

RUN apt-get update && apt-get install -y

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Europe/Paris /etc/localtime
RUN "date"

RUN pecl install xdebug-2.6.0 \
    && docker-php-ext-enable xdebug

# Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Europe/Paris /etc/localtime
RUN "date"

RUN echo 'zend_extension="/usr/local/lib/php/extensions/no-debug-non-zts-20170718/xdebug.so"' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_port=9000' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_enable=1' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_connect_back=1' >> /usr/local/etc/php/php.ini

WORKDIR /srv/www/autoecole
