FROM php:8.0-apache

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Install system dependencies
RUN apt-get --yes update && apt-get --yes upgrade \
    && apt-get --yes install -y --no-install-recommends \
		libmemcached-dev  \
		libfreetype6-dev \
		libxml2-dev \
        libxrender1 \
        libfontconfig \
        libxtst6 \
        libxi6 \
		libjpeg62-turbo-dev \
		libpng-dev \
		zlib1g-dev \
		libzip-dev \
		libz-dev \
		libpq-dev  \
		libsqlite3-dev  \
		libicu-dev \
		g++ \
		git \
		zip \
		libmcrypt-dev \
		libvpx-dev \
		libjpeg-dev \
		libpng-dev \
		bzip2 \
		wget \
		libexpat1-dev \
		libbz2-dev \
		libgmp3-dev \
		libldap2-dev \
		unixodbc-dev \
		libsnmp-dev \
		libpcre3-dev \
		libtidy-dev \
		libaspell-dev \
		locales \
		tar \
		less \
		nano \
		libcurl4-gnutls-dev \
		apt-utils \
		libxrender1 \
		unzip \
		libonig-dev \
		libldap2-dev \
		libxslt-dev \
		libwebp-dev \
		libc-client-dev \
		libkrb5-dev \
		libpspell-dev \
		librabbitmq-dev \
		librabbitmq4 \
    && phpModules=" \
                bcmath \
                bz2 \
                calendar \
                dom \
                exif \
                gd \
                gettext \
                gmp \
                imap \
                intl \
                ldap \
                mysqli \
                mbstring \
                opcache \
                pcntl \
                pdo_mysql \
                pdo_pgsql \
                pgsql \
                pspell \
                shmop \
                snmp \
                soap \
                sockets \
                sysvmsg \
                sysvsem \
                sysvshm \
                tidy \
                xsl \
                zip \
            " \
	&& docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp \
	&& docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
	&& docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-configure intl \
	&& docker-php-ext-install -j$(nproc) $phpModules \
	&& pecl install xdebug-3.0.0 \
	&& pecl install memcached-3.1.5 \
	&& pecl install redis-5.3.2 \
	&& pecl install apcu-5.1.19 \
	&& pecl install igbinary-3.1.6 \
	&& docker-php-ext-enable xdebug memcached redis apcu igbinary \
	&& apt-get clean \
	&& rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Set timezone
RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen

RUN apt-get update && apt-get install -y nodejs npm

# Get latest Composer
RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
   mv composer.phar /usr/local/bin/composer

# Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

# Install composer package


# Set memory limit
RUN echo "memory_limit=-1" > /usr/local/etc/php/conf.d/memory-limit.ini


RUN touch /usr/local/etc/php/conf.d/uploads.ini \
    && echo "upload_max_filesize = 64M;" >> /usr/local/etc/php/conf.d/uploads.ini \
	&& echo "post_max_size = 64M;" >> /usr/local/etc/php/conf.d/uploads.ini

RUN apt-get update \
    && apt-get install -y \
        curl \
        libxrender1 \
        libjpeg62-turbo \
        fontconfig \
        libxtst6 \
        xfonts-75dpi \
        xfonts-base \
        xz-utils
        
# Set working directory
WORKDIR /var/www
