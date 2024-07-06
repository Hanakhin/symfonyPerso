FROM php:8.3-fpm-alpine

# installation des extensions supplémentaire
RUN apk add --no-cache icu-dev \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-enable intl


# installation de composer dans le container
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# déclaration du repertoire de travail
WORKDIR /var/www/html