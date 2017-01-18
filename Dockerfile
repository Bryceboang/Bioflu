FROM php:7.0-cli
COPY . /usr/src/biofluapp
WORKDIR /usr/src/biofluapp
CMD [ "php", "./index.php" ]