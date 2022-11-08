docker build -t micro-image:1.0 .
chmod 777 -R .
docker run -v /home/brittny/micro_access/userfiles:/var/www/html/userfiles --name micro-access -d -p 80:80 micro-image:3.0


/home/tdr/CIHM-Meta

localhost


sudo add-apt-repository ppa:ondrej/php
sudo apt install php8.1
sudo apt install php8.1-gd php8.1-intl php8.1-mbstring php8.1-zip php8.1-bcmath php8.1-dom php8.1-simplexml php8.1-curl
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
composer self-update --2
composer require composer-runtime-api/poc
composer create-project microweber/microweber micro_access dev-master 

sudo kill -9 `sudo lsof -t -i:80` && sudo docker stop $(docker ps -a -q) && docker rm $(docker ps -a -q)