# 🪵 CarpinPro — Backend API

API REST del sistema de conexión entre clientes y carpinteros, desarrollada con **Laravel 11** y autenticación basada en tokens mediante **Laravel Sanctum**.

---

## 📋 Tabla de contenidos

- [Descripción del proyecto](#-descripción-del-proyecto)
- [Tecnologías utilizadas](#-tecnologías-utilizadas)
- [Arquitectura](#-arquitectura)
- [Modelos y relaciones](#-modelos-y-relaciones)
- [Almacenamiento de imágenes](#-almacenamiento-de-imágenes)
- [Endpoints de la API](#-endpoints-de-la-api)
- [Requisitos previos](#-requisitos-previos)
- [Instalación y puesta en marcha](#-instalación-y-puesta-en-marcha)
- [Variables de entorno](#-variables-de-entorno)
- [Comandos útiles](#-comandos-útiles)
- [Roles de usuario](#-roles-de-usuario)

---

## 📖 Descripción del proyecto

**CarpinPro** es una plataforma que conecta **clientes** que buscan servicios de carpintería con **carpinteros** que ofrecen sus servicios. El backend expone una API REST que permite:

- Registrar usuarios y carpinteros con verificación de correo.
- Explorar perfiles de carpinteros con ubicación geográfica (lat/lng → dirección real vía Nominatim).
- Crear y gestionar contratos de servicio entre clientes y carpinteros.
- Dejar reseñas y calificaciones al finalizar un trabajo.
- Publicar un catálogo de productos por carpintero.
- Administrar toda la plataforma a través de rutas de administrador protegidas.
- Servir imágenes (perfiles, trabajos, productos) almacenadas directamente en el servidor.

---

## 🛠 Tecnologías utilizadas

| Tecnología | Versión | Rol |
|---|---|---|
| PHP | ^8.2 | Lenguaje base |
| Laravel | ^11.9 | Framework principal |
| Laravel Sanctum | ^4.0 | Autenticación basada en tokens |
| PostgreSQL | — | Base de datos principal |
| Laravel Storage (public disk) | — | Almacenamiento de imágenes en el servidor |
| Nominatim (OpenStreetMap) | — | Geocodificación inversa (coordenadas → dirección) |
| SMTP (Gmail) | — | Envío de correos de verificación |
| Laravel Pail | ^1.1 | Visor de logs en tiempo real |
| PHPUnit | ^11.0 | Testing |

---

## 🏗 Arquitectura

El proyecto sigue el **patrón de Servicios** para desacoplar la lógica de negocio de los controladores.

```
app/
├── Http/
│   ├── Controllers/       # Reciben la petición y delegan al servicio
│   │   ├── AuthController.php
│   │   ├── TrabajadorController.php
│   │   ├── ContratoController.php
│   │   ├── ReseñaController.php
│   │   ├── ProductoController.php
│   │   └── AdminController.php
│   └── Middleware/
│       └── AdminMiddleware.php    # Verifica rol de administrador
│
├── Models/                # Modelos Eloquent con sus relaciones
│   ├── User.php
│   ├── Trabajador.php
│   ├── Contrato.php
│   ├── Reseña.php
│   ├── Calificacion.php
│   └── Producto.php
│
└── Services/              # Toda la lógica de negocio
    ├── AuthService.php
    ├── TrabajadorService.php
    ├── ContratoService.php
    ├── ReseñaService.php
    ├── ProductoService.php
    └── AdminService.php

storage/
└── app/
    └── public/            # Archivos servidos públicamente
        ├── profile_pictures/    # Fotos de perfil de usuarios
        ├── imagesTrabajador/    # Galería de fotos del carpintero (hasta 5)
        └── productos/           # Imágenes de productos del catálogo
```

---

## 🗂 Modelos y relaciones

```
User ─────────────────┐
 │                    │
 │ hasOne             │ belongsTo
 ▼                    ▼
Trabajador ─── hasMany ──► Contrato ◄── belongsTo ── User
 │                              │
 │ hasMany                      │ hasOne
 ▼                              ▼
Producto                      Reseña
                                 │
                                 │ hasOne
                                 ▼
                            Calificacion
```

- Un **User** puede ser cliente o convertirse en **Trabajador** (carpintero).
- Un **Contrato** vincula a un cliente (User) con un carpintero (Trabajador).
- Una **Reseña** sólo puede crearse una vez finalizado un contrato.
- La **Calificacion** forma parte de la reseña y contiene el puntaje final.
- Un **Trabajador** puede listar **Productos** en su catálogo.

---

## 🖼 Almacenamiento de imágenes

Las imágenes **se almacenan directamente en el servidor** usando el disco `public` de Laravel Storage. Esto significa que los archivos viven dentro del proyecto en:

```
storage/app/public/
```

y se sirven públicamente a través del enlace simbólico en:

```
public/storage/
```

### Tipos de imágenes manejadas

| Tipo | Carpeta en storage | Quién la sube |
|---|---|---|
| Foto de perfil de usuario | `profile_pictures/` | Al registrarse o actualizar perfil |
| Galería del carpintero (hasta 5 fotos) | `imagesTrabajador/` | Al crear o actualizar perfil de carpintero |
| Imagen de producto | `productos/` | Al crear o actualizar un producto |
| Fotos adjuntas a reseña | `resenas/` | Al dejar una reseña de un trabajo |

### Cómo funcionan las URLs de imágenes

Cuando la API devuelve datos con imágenes, las rutas se transforman automáticamente a **URLs públicas completas**. Por ejemplo:

```
profile_pictures/foto.jpg  →  http://localhost:8000/storage/profile_pictures/foto.jpg
```

> ⚠️ **Importante:** Para que las imágenes sean accesibles, el enlace simbólico de storage debe estar creado. Ver paso 6 de la instalación.

---

## 📡 Endpoints de la API

La URL base es `http://localhost:8000/api`.

### 🔓 Rutas públicas

| Método | Endpoint | Descripción |
|---|---|---|
| `GET` | `/ping` | Health check |
| `POST` | `/register` | Registro de usuario (acepta foto de perfil) |
| `POST` | `/login` | Inicio de sesión (devuelve Bearer Token) |
| `POST` | `/verify-email` | Verificación de correo con código de 4 dígitos |
| `GET` | `/user/{id}` | Obtener datos de un usuario |
| `GET` | `/userTrabajador/{id}` | Verificar si un usuario es carpintero |
| `GET` | `/trabajador` | Listar todos los carpinteros (con rating promedio) |

### 🔐 Rutas protegidas (requieren `Authorization: Bearer {token}`)

**Autenticación**

| Método | Endpoint | Descripción |
|---|---|---|
| `GET` | `/user` | Datos del usuario autenticado |
| `POST` | `/logout` | Cerrar sesión (invalida el token) |
| `POST` | `/user/{id}` | Actualizar perfil de usuario (acepta nueva foto) |

**Trabajadores**

| Método | Endpoint | Descripción |
|---|---|---|
| `POST` | `/trabajador` | Registrar perfil de carpintero (con hasta 5 imágenes) |
| `GET` | `/trabajador/{id}` | Obtener carpintero por ID |
| `PATCH` | `/trabajador/{id}/info` | Actualizar datos del carpintero |
| `POST` | `/trabajador/{id}/images` | Actualizar imágenes del carpintero |

**Contratos**

| Método | Endpoint | Descripción |
|---|---|---|
| `GET` | `/contrato` | Listar todos los contratos |
| `POST` | `/contrato` | Crear un contrato |
| `GET` | `/contrato/{trabajador_id}/{cliente_id}` | Contratos entre un carpintero y cliente específicos |
| `GET` | `/contrato/{trabajador_id}` | Contratos de un carpintero |
| `PUT` | `/contrato/{id}` | Actualizar contrato completo |
| `PATCH` | `/contrato/{id}/status` | Cambiar estado (`pendiente`, `aceptado`, `rechazado`, etc.) |
| `DELETE` | `/contrato/{id}` | Eliminar contrato |

**Reseñas**

| Método | Endpoint | Descripción |
|---|---|---|
| `POST` | `/resenia` | Crear reseña (acepta imágenes adjuntas) |
| `GET` | `/resenia/trabajador/{id}` | Reseñas de un carpintero |
| `GET` | `/resenia/user/{id}` | Reseñas de un usuario |
| `GET` | `/resenia/{id}` | Obtener reseña por ID |

**Productos**

| Método | Endpoint | Descripción |
|---|---|---|
| `GET` | `/productos` | Listar todos los productos |
| `POST` | `/productos` | Crear producto (acepta imagen) |
| `GET` | `/productos/{id}` | Productos de un carpintero específico |
| `PUT` | `/productos/{id}` | Actualizar producto |
| `DELETE` | `/productos/{id}` | Eliminar producto |

### 🛡 Rutas de administrador (`/admin/*`)

> Requieren token **+ rol `admin`**.

| Método | Endpoint | Descripción |
|---|---|---|
| `GET` | `/admin/dashboard` | Estadísticas generales de la plataforma |
| `GET` | `/admin/users` | Listar todos los usuarios |
| `DELETE` | `/admin/users/{id}` | Eliminar usuario (no permite eliminar admins) |
| `GET` | `/admin/carpinteros` | Listar todos los carpinteros |
| `DELETE` | `/admin/carpinteros/{id}` | Eliminar carpintero (borra sus imágenes del storage) |
| `GET` | `/admin/productos` | Listar todos los productos |
| `DELETE` | `/admin/productos/{id}` | Eliminar producto (borra su imagen del storage) |
| `GET` | `/admin/reseñas` | Listar todas las reseñas |
| `DELETE` | `/admin/reseñas/{id}` | Eliminar reseña (borra imágenes y calificación) |
| `GET` | `/admin/contratos` | Listar todos los contratos |
| `DELETE` | `/admin/contratos/{id}` | Eliminar contrato (borra reseña e imágenes en cascada) |

---

## ✅ Requisitos previos

Asegúrate de tener instalado en tu máquina:

- **PHP** >= 8.2 con la extensión `pdo_pgsql` habilitada
- **Composer** >= 2.x
- **Node.js** >= 18.x y **npm**
- **PostgreSQL** >= 14 corriendo localmente

---

## 🚀 Instalación y puesta en marcha

### 1. Clonar el repositorio

```bash
git clone <url-del-repositorio>
cd ProyectoDeGradoBE
```

### 2. Instalar dependencias PHP

```bash
composer install
```

### 3. Instalar dependencias Node

```bash
npm install
```

### 4. Configurar el entorno

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configurar la base de datos PostgreSQL

Edita el `.env` con tus credenciales de PostgreSQL:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=ProyectoGrado
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

Crea la base de datos en PostgreSQL si no existe:

```bash
psql -U tu_usuario -c "CREATE DATABASE \"ProyectoGrado\";"
```

### 6. Ejecutar las migraciones

```bash
php artisan migrate
```

> Para poblar la base de datos con datos de prueba:
> ```bash
> php artisan db:seed
> ```

### 7. Crear el enlace simbólico para el storage de imágenes

Este paso es **obligatorio** para que las imágenes subidas sean accesibles públicamente:

```bash
php artisan storage:link
```

Esto crea el enlace `public/storage → storage/app/public`.

### 8. Configurar el correo (opcional en desarrollo)

El sistema usa SMTP (Gmail por defecto) para enviar códigos de verificación. En el `.env` configura:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu_correo@gmail.com
MAIL_PASSWORD=tu_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tu_correo@gmail.com
```

> En desarrollo puedes cambiar `MAIL_MAILER=log` para que los correos se escriban en los logs sin necesidad de SMTP real.

### 9. Levantar el servidor

```bash
composer run dev
```

Este comando arranca simultáneamente:
- 🟢 **Servidor Laravel** en `http://localhost:8000`
- ⚙️ **Cola de trabajos** para tareas en background
- 📋 **Visor de logs** en tiempo real (Laravel Pail)
- ⚡ **Vite** para assets

---

## 🔧 Variables de entorno

| Variable | Descripción |
|---|---|
| `APP_NAME` | Nombre de la aplicación (`CarpinPro`) |
| `APP_ENV` | Entorno (`local` o `production`) |
| `APP_URL` | URL base del servidor backend |
| `APP_KEY` | Clave de cifrado (generada con `artisan key:generate`) |
| `DB_CONNECTION` | Motor de base de datos → `pgsql` |
| `DB_HOST` | Host de PostgreSQL (por defecto `127.0.0.1`) |
| `DB_PORT` | Puerto de PostgreSQL (por defecto `5432`) |
| `DB_DATABASE` | Nombre de la base de datos |
| `DB_USERNAME` | Usuario de PostgreSQL |
| `DB_PASSWORD` | Contraseña de PostgreSQL |
| `FILESYSTEM_DISK` | Disco de archivos → `local` (las imágenes van a `storage/app/public`) |
| `QUEUE_CONNECTION` | Driver de colas → `database` |
| `MAIL_MAILER` | Driver de correo (`smtp` en prod, `log` en dev) |
| `CURRENT_APP` | URL del frontend para CORS (`http://localhost:5173/`) |

---

## 📜 Comandos útiles

```bash
# Levantar el servidor completo en modo desarrollo
composer run dev

# Ejecutar solo el servidor HTTP
php artisan serve

# Ejecutar migraciones
php artisan migrate

# Revertir y re-ejecutar todas las migraciones (⚠️ borra los datos)
php artisan migrate:fresh

# Revertir, re-ejecutar y sembrar datos de prueba
php artisan migrate:fresh --seed

# Crear/recrear el enlace simbólico del storage
php artisan storage:link

# Ver todas las rutas registradas
php artisan route:list

# Limpiar caché de configuración
php artisan config:clear

# Ejecutar tests
php artisan test
```

---

## 👥 Roles de usuario

| Rol | Descripción | Acceso |
|---|---|---|
| `user` | Usuario regular / cliente | Rutas protegidas con Sanctum |
| `admin` | Administrador de la plataforma | Todas las rutas, incluyendo `/admin/*` |

> Un usuario con rol `user` puede convertirse en **Trabajador** (carpintero) al registrar su perfil vía `POST /api/trabajador`. Los dos roles no son excluyentes: un carpintero sigue siendo un `user` con un perfil de trabajador asociado.

---

## 📄 Licencia

Este proyecto fue desarrollado como Proyecto de Grado. Todos los derechos reservados.
