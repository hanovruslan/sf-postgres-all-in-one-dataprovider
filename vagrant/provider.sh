#!/usr/bin/env bash

_has_docker () {
  dpkg -l docker-engine 1>/dev/null 2>&1
}
system_locale () {
  echo export LC_ALL=${locale}
  echo export LANG=${locale}
  echo export LANGUAGE=${locale}
} 1>> /etc/profile
default_locale () {
  echo LANGUAGE=${locale}
  echo LC_ALL=${locale}
  echo LANG=${locale}
  echo LC_TYPE=${locale}
} 1> /etc/default/locale
_locale () {
  system_locale \
  && default_locale \
  && apt-get -o Dpkg::Options::="--force-confold" install --reinstall locales
}
_docker_and_composer () {
  apt-key adv --keyserver ${apt_key_dsn} --recv-keys ${apt_key_recv} \
  && echo ${apt_source_string} > ${apt_docker_source_path} \
  && apt-get install -y \
    apt-transport-https \
    ca-certificates \
    curl \
  && apt-get update \
  && apt-get upgrade -y \
  && apt-get install -y --force-yes docker-engine="${docker_engine_version}" \
  && apt-mark hold docker-engine \
  && usermod -aG docker vagrant \
  && curl -L ${docker_compose_url} > ${docker_compose_path} \
  && chmod +x ${docker_compose_path}
}
_has_docker || { \
  _locale \
  && _docker_and_composer \
  && _env
}
