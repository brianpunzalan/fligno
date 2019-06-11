FROM node

# Update and install dev tools
RUN apt-get update && apt-get install -y \
	vim

RUN mkdir -p /server

WORKDIR /server

COPY ./package.json ./package.json

COPY ./ ./

RUN npm install

CMD ["npm", "start"]
