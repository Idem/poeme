#! /bin/bash
case $1 in
    install)
        sudo apt-get -y install php5 php5-cgi php5-xdebug apache2
        mkdir ./bin
        curl -sS https://getcomposer.org/installer | php -- --install-dir=bin
        php bin/composer.phar install
        ;;
    test)
        vendor/phpunit/phpunit/phpunit --colors --coverage-html coverage -c tests/phpunit-conf.xml tests/*.php
    ;;
esac
