FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      git && \
      docker-php-ext-install pdo_mysql && \
      docker-php-ext-install bcmath && \
      docker-php-ext-install gd && \
      docker-php-ext-install zip && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

WORKDIR /var/www

## Install cron and supervisor
#RUN apt-get update && apt-get -y install cron supervisor && \
#    apt-get clean && \
#    rm -rf /var/lib/apt/lists/*
#
## Copy crontab file to the cron directory
#COPY ./_docker/app/crontab.txt /etc/cron.d/crontab
#
## Give execution rights on the cron job
#RUN chmod 0644 /etc/cron.d/crontab
#
## Apply cron job
#RUN crontab /etc/cron.d/crontab
#
## Create log file to be able to run tail
#RUN touch /var/log/cron.log
#
## Start the cron service and keep it running in the foreground
#CMD ["cron", "-f"]
#
#CMD php artisan queue:work & sleep 10s && php artisan notifications:send-daily
#
#WORKDIR /var/www
