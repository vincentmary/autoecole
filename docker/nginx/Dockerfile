# nginx/Dockerfile
FROM nginx

RUN apt-get update && apt-get install -y \
    vim

COPY symfony.conf /etc/nginx/conf.d
