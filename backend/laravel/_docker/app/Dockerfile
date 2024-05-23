FROM php:8.2-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
      supervisor \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      cron \
      git && \
      docker-php-ext-install pdo_mysql && \
      docker-php-ext-install bcmath && \
      docker-php-ext-install gd && \
      docker-php-ext-install zip && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

COPY ./_docker/app/supervisor.ini /etc/supervisor/supervisord.conf
COPY ./_docker/app/supervisor.ini /etc/supervisor/conf.d/supervisord.conf

COPY ./_docker/app/crontab.txt /crontab.txt

RUN /usr/bin/crontab /crontab.txt

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin \

CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]
