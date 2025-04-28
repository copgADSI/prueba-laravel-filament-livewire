## Paso a paso despliegue proyecto

[Para esta prueba se utilizó XAMPP en esta versión:](https://www.apachefriends.org/es/download.html)  
Además de Laravel 12, Filament 3.3 y Livewire 3.6

## Instalación del proyecto

### Instalación de dependencias
- Para instalar dependencias de PHP: `composer install`
- Para instalar dependencias del `package.json`: `npm install`

### Ejecución de comandos
- Para generar la key de la aplicación: `php artisan key:generate`
- Para ejecutar migraciones: `php artisan migrate`
- Para generar un enlace simbólico: `php artisan storage:link`
- Para ejecutar seeders: `php artisan db:seed`
- Para ejecutar las migraciones y seeders: `php artisan migrate:fresh --seed`
- Para ejecutar las pruebas (configurar `.env.testing` con las credenciales de MySQL): `php artisan test`
- Para ejecutar el servidor: `php artisan serve`
- Para ejecutar el servidor en modo desarrollo: `npm run dev`

## Credenciales admin de prueba en Filament (ejemplo http://127.0.0.1:8000/y/products)
- Correo: `admin@mail.com`
- Contraseña: `123456789`

## Imágenes
![Credenciales](https://github.com/copgADSI/prueba-laravel-filament-livewire/blob/main/public/images/login-admin.png)

![Test](https://github.com/copgADSI/prueba-laravel-filament-livewire/blob/main/public/images/test.png?raw=true)

![Productos](https://github.com/copgADSI/prueba-laravel-filament-livewire/blob/main/public/images/image.png)

![Productos públicos](https://github.com/copgADSI/prueba-laravel-filament-livewire/blob/main/public/images/public-products.png)

