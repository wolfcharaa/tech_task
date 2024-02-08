FROM php:8.2-fpm

ARG USER
ARG DB_HOST

#get latest composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#copying php configuration
RUN apt-get update --fix-missing && apt-get install -y \
    bash \
    libpq-dev \
    git

RUN docker-php-ext-install  \
    pdo_pgsql \
    sockets

RUN addgroup --gid 1000 $USER
RUN adduser --home /home/$USER --gid 1000 --uid 1000 --disabled-password $USER

USER $USER
RUN mkdir /home/$USER/www
WORKDIR /home/$USER/www

RUN git clone https://github.com/wolfcharaa/tech_task.git .
#RUN rm composer.lock
RUN cp .env .env.local
RUN sed -i -e "s/DATABASE_URL=/DATABASE_URL='$DB_HOST'/g" .env.local

RUN composer install

#ENTRYPOINT ["/bin/bash", "-c", "php bin/console doctrine:migrations:migarte --no-interaction"]