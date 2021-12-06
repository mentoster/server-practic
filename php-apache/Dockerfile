FROM php:apache
RUN apt-get update
RUN apt-get install git -y
# install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
# RUN apt-get install php-gd
# Install php extensions
RUN apt-get update -y && apt-get install -y sendmail libpng-dev
RUN docker-php-ext-install mysqli

RUN apt-get update -yqq && apt-get -f install -yyq wget

# download helper script
RUN wget -q -O /usr/local/bin/install-php-extensions https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions \
    || (echo "Failed while downloading php extension installer!"; exit 1)

# install all required extensions
RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && install-php-extensions \
    gd \
    ;


RUN pecl install redis && docker-php-ext-enable redis
#  allow write
RUN chown -R www-data:www-data /var/www/html/

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY ./conf/php-conf.ini $PHP_INI_DIR/conf.d/

ENV APACHE_DOCUMENT_ROOT /home/public_html

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN sed -i -E 's/Listen\s+80([^0-9]|$)/Listen 8001\1/g' /etc/apache2/ports.conf /etc/apache2/sites-available/*.conf /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf /etc/apache2/sites-enabled/*.conf

# RUN htpasswd -c -b /home/public_html/.htpasswd admin 1234

RUN sed -i -E 's/(VirtualHost\s+.+)\:80([^0-9]|$)/\1:8001\2/g' /etc/apache2/ports.conf /etc/apache2/sites-available/*.conf /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf /etc/apache2/sites-enabled/*.conf

# install GD
RUN composer require intervention/image
# install charts
RUN composer require consoletvs/charts "7.*"
