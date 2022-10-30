FROM webdevops/php-nginx:8.1-alpine

ENV PROVISION_CONTEXT "development"

RUN docker-service-disable cron
RUN docker-service-disable postfix
RUN docker-service-disable ssh

ENV TZ=Europe/Lisbon
ENV VIRTUAL_HOST=app.docker
ENV WEB_DOCUMENT_ROOT=/app/frontend/web/
ENV WEB_DOCUMENT_INDEX=index.php
ENV CLI_SCRIPT="php yii"

ENV YII_DEBUG=true
ENV YII_ENV=docker
ENV MIGRATIONS_RUN=false
ENV CRONTAB_ENABLE=false

# Configure volume/workdir
WORKDIR /app/

# Remove Nginx max body size limit (we are defining it in nginx.conf)
RUN echo "# CLEARED #" > /opt/docker/etc/nginx/vhost.common.d/10-general.conf


EXPOSE 80/tcp
EXPOSE 8080/tcp
