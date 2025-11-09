

![logo](assets/Logo-espe.png)

### Arquitectura de software - Grupo 5  

## Integrantes


-  RODRIGUEZ BETTY
-  DOMINGUEZ OSCAR
-  VILLAMARIN VICTOR
-  GUAMIALAMA NICOLAS
-  POAQUIZA MARCO
-  TENEMAZA ALANIS


# 🏥 Microservicio de Gestión de Usuarios (Citas Médicas)

Este proyecto es un microservicio desarrollado en **Laravel** que implementa una **API RESTful** para gestionar usuarios (pacientes) dentro de un sistema de Citas Médicas. Utiliza el patrón **MVC** y **Laravel Sanctum** para la autenticación basada en tokens.

## 🗺️ Flujo de Trabajo

El desarrollo se organiza en fases asignadas a estudiantes:

1.  **Nicolás:** Configuración inicial del proyecto y la DB.
2.  **Betty:** Estructura de la Base de Datos y Seguridad (Sanctum).
3.  **Víctor:** Definición de Rutas API (Endpoints).
4.  **Valeria:** Lógica del Controlador (Implementación del CRUD).
5.  **Adrián:** Lógica de Validación (Form Requests).
6.  **Marco:** Autenticación (Login/Tokens) y Pruebas Finales.

---

## 🚀 1. Inicialización del Proyecto (Nicolás)

Estos comandos crean la base del proyecto Laravel y configuran el entorno de trabajo.

1.  **Crear el Proyecto Laravel:**
    ```bash
    composer create-project laravel/laravel microservicio-citas-medicas
    ```

2.  **Acceder al Directorio:**
    ```bash
    cd microservicio-citas-medicas
    ```

3.  **Configurar la Base de Datos:**
    Abrir y editar el archivo **`.env`** con las credenciales de su base de datos (Ejemplo):
    ![BD](assets/env.png)

---









### Microservicio de Gestión de Citas y Historial Médico

[USER_G5_AS]

Este proyecto es un microservicio Backend desarrollado en Laravel (PHP) con una arquitectura RESTful API. Su objetivo principal es gestionar la autenticación de usuarios (pacientes y doctores), la programación de citas médicas y el registro del historial clínico y tratamientos.

#### 🚀 Arquitectura y Diseño

El microservicio opera bajo un enfoque de API Versioning y Protección de Rutas.

- Tecnología Principal: Laravel (con PHP 8+).

- Autenticación: Laravel Sanctum (Token-based authentication) para asegurar todas las rutas sensibles.

- Versionamiento: Todas las rutas se agrupan bajo el prefijo /api/v1/.

- Roles: El sistema diferencia entre dos tipos de usuarios:

- Pacientes: Pueden registrarse, iniciar sesión y crear/listar sus propias citas.

- Doctores: Además de lo anterior, pueden crear, actualizar y eliminar entradas de historial médico y tratamientos.

#### Estructura de Endpoints (v1)
![Enpoinds](assets/ENPOINTS.png)




#### ⚙️ Configuración y Puesta en Marcha

Sigue estos pasos para levantar el microservicio en tu entorno local.

1. Instalación de Dependencias

## 1. Clona el repositorio
git clone [URL_DE_TU_REPOSITORIO](https://github.com/saoricoder/USER_G5_AS.git)> USER_G5_AS
cd USER_G5_AS

## 2. Instala las dependencias de PHP
```
composer install
```
## 3. Copia el archivo de configuración .env
```
cp .env.example .env
```
## 4. Genera la clave de aplicación
php artisan key:generate


#### 2. Configuración de Base de Datos

Asegúrse de configurar las variables de conexión a tu base de datos MySQL en el archivo .env.


![BD](assets/env.png)


![sin](assets/sinmigrar.png)

###  Migraciones y Seeders (Población de Datos)

Ejecuta las migraciones para crear las tablas y luego ejecuta los seeders para poblar los datos de prueba esenciales (usuarios, doctores, historial).

### Ejecuta las migraciones
```
php artisan migrate
```
![migraciones](assets/migraciones.png)
![alt text](assets/sepuesmigracion.png)
#### Ejecuta los seeders para poblar la base de datos
### Incluye: UsuarioSeeder, DoctorSeeder, HistoriaMedicaSeeder
```
php artisan db:seed
```
![seeders](assets/poblar seeders.png)
#### 4. Ejecución del Servidor

Inicia el servidor local de Laravel.

php artisan serve

![serve](assets/serve.png)


El microservicio estará accesible en: http://127.0.0.1:8000 

🔑 Datos de Acceso de Prueba (Seeders)

Utiliza las siguientes credenciales para probar la API con Postman o Insomnia. Todos los passwords son password.

![crearusuario](assets/creacionusuarios.png)

![login](assets/login.png)

doctora@test.com

Necesario para crear/ver Historial


paciente@test.com

Necesario para crear Citas

🔬 Endpoints Clave para Pruebas (Postman)

#### A. Autenticación (Público)

URL  http://127.0.0.1:8000/api/v1/

Método  POST

Descripción   REGISTRO

/api/v1/login


Obtener el token (e.g., usando doctora@test.com).

![alt text](assets/loginDoctor.png)



##### B. Gestión de Historial (Solo Doctor)

REQUISITO: Usar el Token de doctora@test.com en el Authorization: Bearer token Header.

URL http://127.0.0.1:8000/api/v1/historial/1

Método  GET

Descripción   LOGIN

/api/v1/historial/1



POST

Crea un nuevo registro de historia. Requiere paciente_id, sintomas, diagnostico.
![HISTORIA](assets/historial.png)






🧑‍💻 Contribuciones y Soporte

Para contribuciones o si encuentras algún problema de arquitectura, por favor revisa los siguientes archivos clave:
```
Rutas: routes/api.php
```
#### Controladores: 
. app/Http/Controllers/HistoriaMedicaController.php y app/Http/  . .Controllers/CitaController.php

#### Seeders: 
. database/seeders/HistoriaMedicaSeeder.php

![GET](assets/get.png)

## ⚙️ 2. Estructura y Dependencias (Betty)

**Nota:** Betty debe editar el archivo de migración preexistente (`database/migrations/*_create_users_table.php`) para añadir los campos específicos de Citas Médicas antes de migrar.

1.  **Ejecutar Migraciones:**
    ```bash
    php artisan migrate
    ```

2.  **Instalar Laravel Sanctum:**
    ```bash
    composer require laravel/sanctum
    php artisan vendor:publish --provider--"Laravel\Sanctum\SanctumServiceProvider"
    ```

---

## 🛠️ 3. Creación de Componentes (Víctor, Valeria, Adrián)

Estos comandos generan los archivos principales del patrón MVC (Controladores) y de Validación (Form Requests).

1.  **Crear Controladores API (Víctor):**
    ```bash
    php artisan make:controller UserController --api
    php artisan make:controller AuthController
    ```

2.  **Crear Form Requests (Adrián):**
    ```bash
    php artisan make:request StoreUserRequest
    php artisan make:request UpdateUserRequest
    ```

---

## ✅ 4. Puesta en Marcha y Pruebas (Marco)

Una vez que todos los archivos anteriores contengan el código de implementación, ejecute el servidor.

1.  **Iniciar el Servidor de Desarrollo:**
    ```bash
    php artisan serve
    ```

2.  **Endpoints Clave para Postman (Marco):**
    * **Login (Público):** `POST http://127.0.0.1:8000/api/login` (Retorna el **Bearer Token**).
    * **Crear Usuario (Protegido):** `POST http://127.0.0.1:8000/api/usuarios`
    * **Listar Usuarios (Protegido):** `GET http://127.0.0.1:8000/api/usuarios`
    * **Actualizar Usuario (Protegido):** `PUT/PATCH http://127.0.0.1:8000/api/usuarios/{id}`

    **Importante:** Todas las rutas del CRUD (`/api/usuarios`) requieren el encabezado `Authorization: Bearer TOKEN para funcionar.
