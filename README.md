<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
    </a>
</p>

## Appointment API - Gestión de Citas Médicas

Appointment es una API desarrollada en Laravel 11, orientada a la gestión integral de citas médicas. Este sistema está diseñado para simplificar y optimizar el proceso de administración de citas, brindando una solución completa que abarca la creación, actualización, visualización y cancelación de citas médicas.

Funcionalidades Clave:
Creación de Citas: Permite a los usuarios crear nuevas citas médicas de manera rápida y sencilla, asegurando que la información relevante sea registrada de forma precisa.
Actualización de Citas: Facilita la modificación de detalles de citas existentes, adaptándose a cambios en los horarios o en la información del paciente.
Visualización de Citas: Ofrece una interfaz clara y accesible para consultar citas programadas, proporcionando una visión general del calendario médico.
Cancelación de Citas: Permite a los usuarios cancelar citas de forma eficiente, gestionando las disponibilidades de manera adecuada.

## Características

- *Framework:* Laravel 11
- *Base de Datos:* MySQL
- *Autenticación:* Soporte para autenticación con tokens utilizando Laravel Sanctum o Passport.
- *Migraciones de Datos:* Administradas con las poderosas herramientas de migración de Laravel.
- *Estructura Escalable:* Sistema modular que facilita la extensión y mantenimiento.
- *Swagger:* Para documentacion del api

## Requisitos del Sistema

- PHP >= 8.1
- Composer
- MySQL
- Extensiones PHP requeridas: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath, Fileinfo

## Instalación

1. *Clona el repositorio:*

   bash
   git clone https://github.com/gamorenoo/citas-api-rest.git
   cd citas-api-rest
   composer install
   php artisan migrate
## Ejecucion de aplicacion
  php artisan serve

## Uso
**Endpoint:**
se puede usar Postman, Insomina o cualquier otra herramienta para probar servicios Rest
   bash
   Login de usuario POST http://127.0.0.1:8000/api/login
   Registro de usuarios POST http://127.0.0.1:8000/api/register