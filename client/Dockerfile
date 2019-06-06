FROM node

RUN mkdir -p /server

WORKDIR /server

COPY ./package.json ./package.json

COPY ./ ./

RUN npm install

CMD ["npm", "start"]
