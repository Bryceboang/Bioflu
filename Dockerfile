FROM php:7.0-cli
COPY . /usr/src/bioflu
WORKDIR /usr/src/bioflu
CMD [ "php", "./index.php" ]
