#!/usr/bin/env bash

version=${COMPOSER_VERSION:-"1.4.2"}
user=${COMPOSER_USER:-"$(id -u)"}
group=${COMPOSER_GROUP:-"$(id -g)"}
COMPOSER_DIR=${COMPOSER_DIR:-"/app"}

echo "Current working directory: ${PWD}"

docker run --rm -ti \
  -v /usr/share/composer/cache:/composer/cache \
  -v /etc/passwd:/etc/passwd:ro \
  -v /etc/group:/etc/group:ro \
  -v "${PWD}":${COMPOSER_DIR} \
  -w ${COMPOSER_DIR:-"/app"} \
  -u "${user}":"${group}" \
  -e COMPOSER_DIR=${COMPOSER_DIR:-"/app"} \
  composer:"${version}" \
  "${@}"
