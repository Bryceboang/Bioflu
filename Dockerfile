FROM registry.ng.bluemix.net/ibmnode:latest

ADD . /node
WORKDIR /node
RUN npm install

EXPOSE 443
EXPOSE 80
EXPOSE 3000

ENTRYPOINT ["node", "/node/app.js"]
