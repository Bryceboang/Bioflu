FROM php:7.0-apache
COPY . /usr/src/biofluapp
WORKDIR /usr/src/biofluapp
CMD [ "php", "./index.php" ]