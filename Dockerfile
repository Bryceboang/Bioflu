FROM php:7.0-apache
COPY . /usr/src/bioflu
WORKDIR /usr/src/bioflu
CMD [ "php", "./index.php" ]