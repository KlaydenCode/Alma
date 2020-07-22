#FROM php:7.3-apache
#RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
#COPY ./src /var/www/html/
#EXPOSE 80
#CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

FROM php:7.3-apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
#Install git
RUN apt-get update
RUN apt-get install -y git
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
#ENTRYPOINT mysqld --initialize --user=db_user &&
#ENTRYPOINT mysqld --default-authentication-plugin=mysql_native_password --verbose
#Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=. --filename=composer
RUN mv composer /usr/local/bin/
COPY ./src /var/www/html/
EXPOSE 80
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
