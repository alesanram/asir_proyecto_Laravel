#!/usr/bin/env bash
set -e
export DEBIAN_FRONTEND=noninteractive

APP_DIR="/var/www/laravel"

echo "🔄 Actualizando índices..."
apt-get update -y >/dev/null 2>&1

echo "🌐 Instalando Apache..."
apt-get install -y apache2 >/dev/null 2>&1

echo "🐘 Instalando PHP 8.2..."
apt-get install -y software-properties-common >/dev/null 2>&1
add-apt-repository ppa:ondrej/php -y >/dev/null 2>&1
apt-get update -y >/dev/null 2>&1

apt-get install -y \
php8.2 php8.2-cli php8.2-common php8.2-mysql \
php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip php8.2-gd \
php8.2-bcmath \
unzip curl >/dev/null 2>&1

echo "🗄️ Instalando MariaDB..."
apt-get install -y mariadb-server mariadb-client >/dev/null 2>&1
systemctl start mariadb

echo "📦 Copiando proyecto Laravel..."
rm -rf $APP_DIR
mkdir -p /var/www
cp -R /vagrant/tec_shop $APP_DIR

cd $APP_DIR

echo "🗄️ Configurando base de datos..."
DB_NAME=$(grep DB_DATABASE .env | cut -d '=' -f2)
DB_USER=$(grep DB_USERNAME .env | cut -d '=' -f2)
DB_PASSWORD=$(grep DB_PASSWORD .env | cut -d '=' -f2)

mysql -e "CREATE DATABASE IF NOT EXISTS \`$DB_NAME\`;"
mysql -e "CREATE USER IF NOT EXISTS '$DB_USER'@'%' IDENTIFIED BY '$DB_PASSWORD';"
mysql -e "GRANT ALL PRIVILEGES ON \`$DB_NAME\`.* TO '$DB_USER'@'%';"
mysql -e "FLUSH PRIVILEGES;"

echo "🎼 Instalando Composer..."
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

export COMPOSER_ALLOW_SUPERUSER=1

echo "📦 Instalando dependencias..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "🔑 Generando APP_KEY..."
php artisan key:generate

echo "🗃️ Migraciones y seeders..."
php artisan migrate --force
php artisan db:seed

echo "📦 Storage link..."
php artisan storage:link

echo "⚙️ Configurando Apache..."
cat <<EOF >/etc/apache2/sites-available/laravel.conf
<VirtualHost *:80>
    DocumentRoot $APP_DIR/public
    <Directory $APP_DIR/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF

a2ensite laravel.conf
a2enmod rewrite
a2dissite 000-default.conf
systemctl reload apache2

echo "🔐 Permisos..."
chown -R www-data:www-data $APP_DIR
chmod -R 775 storage bootstrap/cache

echo "✅ Provisionamiento completado correctamente"
