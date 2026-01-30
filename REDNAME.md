# Proyecto Laravel con Vagrant

Este repositorio contiene un proyecto **Laravel** listo para ejecutarse dentro de una **máquina virtual Vagrant** con Ubuntu 22.04, Apache, PHP 8.2 y MariaDB. El proyecto es una tienda de informática con **vista de cliente** (catálogo y carrito) y **vista de administrador** (gestión de productos y categorías).

---

## Requisitos

* [Vagrant](https://www.vagrantup.com/)
* [VirtualBox](https://www.virtualbox.org/)
* Git
* Composer (opcional, solo si quieres modificar el proyecto laravel fuera de Vagrant)

---

## Instalación y levantamiento del proyecto

1. **Clonar el repositorio**

```bash
git clone https://github.com/alesanram/asir_proyecto_Laravel.git
cd asir_proyecto_Laravel
```

2. **Levantar la máquina virtual con Vagrant**

```bash
vagrant up
```

> Esto hará automáticamente:
>
> * Actualiza el sistema.
> * Instala Apache, PHP 8.2 y MariaDB.
> * Copia el proyecto Laravel dentro de la VM.
> * Instala las dependencias del proyecto sin dev-dependencies.
> * Ejecuta las migraciones (`php artisan migrate`) para crear las tablas en la base de datos.
> * Configura Apache para servir el proyecto desde `/var/www/laravel/public`.

3. **Acceder al proyecto**

Abre tu navegador y visita:

```
http://localhost:8080
```

> Puedes cambiar el puerto donde se aloja el proyecto en tu máquina local editando el `Vagrantfile`.

---

## Configuración de base de datos

Por defecto:

* Nombre de la base de datos: `laravel_db`
* Usuario: `laravel_user`
* Contraseña: `qwerty`

> Estos datos pueden modificarse directamente en el archivo `.env` del proyecto Laravel.

---

## Configuración de usuario administrador

Por defecto:

* Email: `admin@example.com`
* Contraseña: `password`

> Puedes cambiar estos datos en el archivo `.env`.

---

## Provisionamiento y configuración de la máquina

* En Linux: se usa `provision.sh`.
* En Windows: se recomienda usar `provision_windows.sh`.

> En `provision.sh` también puedes cambiar:
>
> * El nombre y la contraseña del usuario de la máquina virtual (`NEW_USER` y `NEW_PASSWORD`). Por defecto: `usuario / qwerty`.

---

## Seeders incluidos

El proyecto incluye **3 seeders**:

1. `AdminUserSeeder` – Crea el usuario administrador.
2. `CategorySeeder` – Crea categorías de productos.
3. `ProductSeeder` – Crea productos de ejemplo.

> **Por defecto, todos los seeders se ejecutan automáticamente** al levantar la VM

Si no quieres los datos de prueba:

1. Comenta la línea global en `provision.sh`:

```bash
# php artisan db:seed
```

2. Luego puedes ejecutar manualmente solo los seeders que necesites descomentado los seeders individuales:

```bash
php artisan db:seed --class=AdminUserSeeder
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=ProductSeeder
```

---

## Permisos

* Todos los permisos de la carpeta del proyecto se ajustan automáticamente al usuario `www-data`.
* Carpetas importantes: `storage` y `bootstrap/cache`.

---

## Funcionalidades del proyecto

### Vista de cliente

* Catálogo de productos
* Carrito de compras con gestión de stock

### Vista de administrador

* Listado de productos y categorías
* Creación, edición y eliminación de productos y categorías
* Gestión de stock y precios

---

## Notas adicionales

* El proyecto está listo para **desarrollo** y pruebas locales.
* Se recomienda no cambiar manualmente los permisos de las carpetas dentro de la VM.
* Todos los comandos de Laravel (`artisan`) deben ejecutarse dentro de la VM usando `vagrant ssh` o configurando un alias.

---

