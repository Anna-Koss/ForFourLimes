FROM php:7.3-fpm

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    vim \
    git \
    rename \
    procps \
    librabbitmq-dev \
    openssh-client && \
    curl -s https://getcomposer.org/installer > composer-setup.php && \
    php composer-setup.php --install-dir=/usr/bin --filename=composer && \
     # php extensions
    docker-php-ext-install -j$(nproc) pdo_mysql bcmath sockets zip

WORKDIR /home/test/