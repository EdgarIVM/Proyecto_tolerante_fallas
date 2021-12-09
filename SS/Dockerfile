FROM php:7.4-apache
RUN docker-php-ext-install mysqli
COPY /new /var/www/html 
EXPOSE 80
#80
#FROM php:7.4-apache
#COPY . /var/www/html/ss
#WORKDIR /var/www/html/ss
#RUN apt-get install php7.4-mysqli
#CMD [ "php", "./new/index.php" ]