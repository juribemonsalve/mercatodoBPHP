<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Introducción
Este es un proyecto formativo realizado como parte del Bootcamp PHP en colaboración con la empresa Evertec. El objetivo principal de este proyecto es adquirir nuevos conocimientos sobre el lenguaje PHP a través del framework Laravel.



# Reto (BOOTCAMP PHP)

El administrador de MercaTodo necesita un sistema que le permita realizar la venta de sus
productos de mercadería online. El sistema deberá permitir registrar cada producto así
como también administrar las cuentas de sus clientes, quienes también deberán
identificarse para realizar compras de los artículos de mercadería.

Para el administrador de MercaTodo es sumamente importante que el sistema le permita
realizar pagos online y generar reportes que sirvan de apoyo para tomar decisiones.
También es indispensable que el sistema cuente con opciones para administrar productos
de manera masiva.

## Configuraciones a tener en cuenta:

   - En el archivo .env de tu proyecto, es importante configurar los siguientes valores:

   - Configuración de la base de datos:

Ejemplo:
makefile
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mercatodo
DB_USERNAME=root
DB_PASSWORD=

   - Configuración de la autenticación con Placetopay:

Configura los datos previamente brindados para la autenticación con Placetopay. Por ejemplo:

PLACETOPAY_LOGIN=your_login
PLACETOPAY_TRANKEY=your_trankey
PLACETOPAY_URL=your_url

Configuración de registro de usuarios con Mailtrap:

   - Utiliza Mailtrap para el registro de usuarios. Por ejemplo:

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=uribemonsalvejuan@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

## Uso de API REST (POSTMAN)
Para utilizar la API REST en Postman, realiza la siguiente configuración previa:

1. Headers:
   - Key: Accept
   - Value: application/json

Realizar el inicio de sesión:
- Método: POST
- URL: http://127.0.0.1:8000/api/auth/login
- En el body (raw), utiliza los siguientes datos:
  {
    "email": "admin@mercatodo.com",
    "password": "password"
  }
- Guarda el token y utilízalo en la sección "Authorization" con el tipo "Bearer Token".

Listar los Productos:
- Método: GET
- URL: http://127.0.0.1:8000/api/products/index

Listar un producto específico:
- Método: GET
- URL: http://127.0.0.1:8000/api/product/show/1

Actualizar un producto específico:
- Método: PUT
- URL: http://127.0.0.1:8000/api/product/update/1
- Ejemplo de modificación:
  {
    "name": "Auriculares de prueba",
    "description": "El producto es excelente",
    "price": 111111,
    "quantity": 44,
    "category_id": 1,
    "status": "active"
  }
- 
Eliminar un producto especiico:
- Método: GET
- URL: http://127.0.0.1:8000/api/product/delete/1


Ejecutar Test existente:
- php artisan test --testsuite=Feature
