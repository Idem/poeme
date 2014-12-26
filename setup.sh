#! /bin/bash
case $1 in
    install)
        sudo apt-get -y install php5 php5-xdebug
        mkdir ./bin
        curl -sS https://getcomposer.org/installer | php -- --install-dir=bin
        php bin/composer.phar install
        ;;
esac
