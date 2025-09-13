# Proyecto Almacenes de Distribucion y Ventas

## Screenshot
<p align="center">
  <img width="900" src="https://cdn.laravue.dev/screenshot.png">
</p>

## Comensando instalacion

### Instalación 
#### Manual

```bash
# Clone the project and run composer
git clone https://github.com/fernandomendozaalborta/EDP_POLLOS_LARAVEL.git

# Ingresar al proyecto con el siguiente comando
cd EDP_POLLOS_LARAVEL

# Version de php 
php 8.1 a la version 8.4
# Instalar las librerias composer con el siguiente comando
composer install

# Migrar la informacion y sus datos con los siguientes comandos
php artisan migrate 
php artisan db:seed
#para volver atras migracion
php artisan migrate:rollback
# Instalar dependencias de node js
npm install
# develop
npm run dev # or npm run watch

# Build on production
npm run production
```
## Autor nueva Arquitectura
* Software Libre
