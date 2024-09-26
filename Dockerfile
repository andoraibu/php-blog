FROM mysql:latest

ENV MYSQL_DATABASE php_blog


COPY ./sql /docker-entrypoint-initdb.d/