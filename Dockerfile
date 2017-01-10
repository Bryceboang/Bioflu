FROM registry.ng.bluemix.net/ibmnode:latest

ADD . /php
WORKDIR /php


EXPOSE 443
EXPOSE 80
EXPOSE 3000