FROM node:15.1.0-alpine3.10

COPY . /usr/src/myapp
WORKDIR /usr/src/myapp

#RUN apt update && apt install git zip -y

RUN npm install
CMD node app.js