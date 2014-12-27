#! /bin/bash
case $1 in
    install)
        sudo apt-get -y install php5 php5-cgi php5-xdebug apache2
        mkdir ./bin
        curl -sS https://getcomposer.org/installer | php -- --install-dir=bin
        php bin/composer.phar install
        ;;
    test)
        cat <<EOF > ./test_config.ini
[verse1]
path = "./tests/verse1"
refresh = 3
random = true

[verse2]
path = "./tests/verse2"
refresh = 5
random = true

[verse3]
path = "./tests/verse3"
refresh = 4
random = true

[verse4]
path = "./tests/verse4"
refresh = 2
random = true

[verse5]
path = "./tests/verse5"
refresh = 4
random = true
EOF
        vendor/phpunit/phpunit/phpunit --colors --coverage-html coverage -c tests/phpunit-conf.xml tests/*.php
    ;;
    images)
        # dl dummy images: folder/color/number of images
        declare -a exts
        exts=("png" "gif" "jpeg" "jpg")
        for set in "verse1/c7041e/2" "verse2/23c706/3" \
                   "verse3/0e04c9/6" "verse4/871087/1" \
                   "verse5/151515/10" "painting/c7041e/25";
        do
            IFS=/ read folder color number <<< $set
            rm -fr ./tests/$folder;
            mkdir ./tests/$folder;
            for num in `seq 1 $number`;
            do
                ext=${exts[$(($num % 4))]};
                url="http://dummyimage.com/800x600/$color.$ext?text=$folder-$num";
                file="./tests/$folder/img_$num.$ext";
                wget $url -O $file;
                # echo "wget -o $file $url";
            done
        done
esac
