FROM mysql:latest



ADD ./sql/queries.sql /docker-entrypoint-initdb.d