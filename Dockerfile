FROM registry.ng.bluemix.net/ibmnode:latest

ADD . /node
WORKDIR /node

EXPOSE 443
EXPOSE 80
EXPOSE 3000
