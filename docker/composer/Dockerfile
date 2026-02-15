FROM composer:latest

WORKDIR /var/www/html

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN addgroup -g 1000 -S developer \
 && adduser -u 1000 -G developer -S -D -H developer

USER developer

ENTRYPOINT ["composer", "--ignore-platform-reqs"]