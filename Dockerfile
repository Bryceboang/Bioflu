FROM registry.ng.bluemix.net/ibmnode:latest

RUN apt-get -y install wget

RUN chmod 777 /opt

RUN echo "Creating directory structures"

# Expose the ports we're interested in
EXPOSE 80
EXPOSE 443
EXPOSE 3000

CMD ["/bin/sh", "-c", "while true; do echo '('; date; echo ')'; sleep 15; done"]
