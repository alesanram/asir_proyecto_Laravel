#!/usr/bin/env bash
set -e

APP_DIR="/var/www/laravel"
NEW_USER="usuario"
NEW_PASSWORD="qwerty"

echo "🔄 Actualizando sistema..."
apt-get update -y >/dev/null 2>&1 
apt upgrade -y >/dev/null 2>&1

echo "🌐 Instalando Apache..."
apt-get install -y apache2 >/dev/null 2>&1

echo "🐘 Instalando PHP 8.2..."
apt-get install -y software-properties-common >/dev/null 2>&1
add-apt-repository ppa:ondrej/php -y >/dev/null 2>&1
apt-get update -y >/dev/null 2>&1
apt-get install -y php8.2 php8.2-cli php8.2-common php8.2-mysql \
php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip php8.2-gd unzip curl >/dev/null 2>&1

echo "📦 Copiando proyecto Laravel..."
rm -rf $APP_DIR
mkdir -p /var/www
cp -R /vagrant/tec_shop $APP_DIR

DB_NAME=$(grep -oP '(?<=^DB_DATABASE=)[^#]+' $APP_DIR/.env)
DB_USER=$(grep -oP '(?<=^DB_USERNAME=)[^#]+' $APP_DIR/.env)
DB_PASSWORD=$(grep -oP '(?<=^DB_PASSWORD=)[^#]+' $APP_DIR/.env)
DB_PORT=$(grep -oP '(?<=^DB_PORT=)[^#]+' $APP_DIR/.env)
DB_HOST=$(grep -oP '(?<=^DB_HOST=)[^#]+' $APP_DIR/.env)

DB_PORT=${DB_PORT:-3306}
DB_HOST=${DB_HOST:-"127.0.0.1"}

echo "🗄️ Instalando MariaDB..."
apt install -y mariadb-server mariadb-client >/dev/null 2>&1

echo "🛠️ Configurando MariaDB..."

ufw allow $DB_PORT/tcp >/dev/null 2>&1

echo "🔧 Configurando puerto de MariaDB en $DB_PORT..."
sed -i "s/^#port\s*=\s*3306/port = $DB_PORT/" /etc/mysql/mariadb.conf.d/50-server.cnf

systemctl restart mariadb

mysql -e "CREATE DATABASE IF NOT EXISTS $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -e "CREATE USER IF NOT EXISTS '$DB_USER'@'$DB_HOST' IDENTIFIED BY '$DB_PASSWORD';"
mysql -e "GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'$DB_HOST';"
mysql -e "FLUSH PRIVILEGES;"

echo "🎼 Instalando Composer..."
EXPECTED_SIGNATURE="$(curl -s https://composer.github.io/installer.sig)"
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
ACTUAL_SIGNATURE="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"

if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]; then
  echo "❌ Firma de Composer inválida"
  rm composer-setup.php
  exit 1
fi

php composer-setup.php --install-dir=/usr/local/bin --filename=composer 
rm composer-setup.php

cd $APP_DIR

echo "📦 Instalando dependencias (sin dev)..."
# Permitir plugins como root
export COMPOSER_ALLOW_SUPERUSER=1

# Instalar dependencias sin dev y optimizando autoloader
composer install --no-dev --optimize-autoloader --quiet

echo "🔑 Generando APP_KEY..."
php artisan key:generate

echo "🗃️ Ejecutando migraciones..."
php artisan migrate --force

echo "🗃️ Ejecutando seeders..."
php artisan db:seed

#php artisan db:seed --class=AdminUserSeeder
#php artisan db:seed --class=CategorySeeder
#php artisan db:seed --class=ProductSeeder

echo "📦 Activando Storage..."
php artisan storage:link

echo "⚙️ Configurando Apache VirtualHost..."
cat <<EOF > /etc/apache2/sites-available/laravel.conf
<VirtualHost *:80>
    ServerName laravel.local
    DocumentRoot $APP_DIR/public

    <Directory $APP_DIR>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/laravel_error.log
    CustomLog \${APACHE_LOG_DIR}/laravel_access.log combined
</VirtualHost>
EOF

a2ensite laravel.conf
a2enmod rewrite
a2dissite 000-default.conf
systemctl restart apache2

echo "🔐 Ajustando permisos..."
chown -R www-data:www-data $APP_DIR
chmod -R 775 $APP_DIR/storage $APP_DIR/bootstrap/cache

echo "✅ Provisionamiento finalizado"
echo "🔄 Reiniciando el sistema..."
reboot


