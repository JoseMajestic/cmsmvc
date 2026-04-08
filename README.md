# CMS MVC Dragon Ball Saga

Un sistema de gestión de contenido (CMS) desarrollado con PHP, arquitectura MVC, MySQL y MaterializeCSS. Proyecto educativo para el módulo de Desarrollo de Aplicaciones Web (DAW) del curso 2025-2026.

## Características

### Frontend
- **Diseño responsive** con MaterializeCSS
- **10 noticias con imágenes** (4 para home, 1 inactiva)
- **Formulario de contacto** con validación JavaScript
- **Página Acerca de** con información del proyecto
- **Página 404** personalizada con tema Dragon Ball
- **Footer con navegación** completa
- **Botón "Volver atrás"** en noticias individuales

### Backend
- **Panel de administración** con estilos personalizados
- **Gestión de noticias** (crear, editar, eliminar)
- **Gestión de usuarios** con permisos
- **Sistema de autenticación** seguro
- **CSS personalizado** para administración

### Técnico
- **PHP 8+** con Programación Orientada a Objetos
- **Arquitectura MVC** limpia y escalable
- **MySQL** con PDO para conexión segura
- **Composer** para gestión de dependencias
- **URLs amigables** con .htaccess
- **SEO Friendly** con estructura semántica

## Instalación

### Requisitos
- PHP 8.0 o superior
- MySQL 5.7 o superior
- Apache con mod_rewrite
- Composer

### Pasos

1. **Clonar el repositorio**
```bash
git clone https://github.com/JoseMajestic/cmsmvc.git
cd cmsmvc
```

2. **Instalar dependencias**
```bash
composer install
```

3. **Configurar base de datos**
- Crear base de datos `cmsmvc`
- Importar el archivo `sqls/cmsmvc.sql`
- Importar las noticias con `sqls/insertar_10_noticias.sql`

4. **Configurar servidor**
- Apuntar el document root a la carpeta `public/`
- Asegurar que mod_rewrite está activo

5. **Acceder a la aplicación**
- Frontend: `http://localhost/public/`
- Administración: `http://localhost/public/admin/`
  - Usuario: `admin`
  - Contraseña: `admin123`

## Estructura del Proyecto

```
cmsmvc/
|-- controller/          # Controladores MVC
|   |-- AppController.php
|   |-- NovaController.php
|   |-- UsuarioController.php
|-- model/              # Modelos MVC
|   |-- Nova.php
|   |-- Usuario.php
|-- view/               # Vistas MVC
|   |-- app/           # Vistas frontend
|   |-- admin/         # Vistas administración
|-- helper/             # Clases auxiliares
|   |-- DbHelper.php
|   |-- ViewHelper.php
|-- public/             # Directorio público
|   |-- css/          # Estilos CSS
|   |-- js/           # JavaScript
|   |-- img/          # Imágenes
|   |-- index.php     # Entry point
|-- sqls/              # Scripts SQL
|-- composer.json      # Dependencias PHP
|-- .htaccess         # Configuración Apache
```

## Funcionalidades

### Frontend
- **Home**: Noticias destacadas con imágenes
- **Novas**: Listado completo de noticias
- **Acerca de**: Información del proyecto
- **Contacto**: Formulario con validación
- **404**: Página de error personalizada

### Administración
- **Dashboard**: Panel de control principal
- **Gestión de Noticias**: CRUD completo
- **Gestión de Usuarios**: Administración de usuarios
- **Permisos**: Sistema de roles (novas, usuarios)

## Tecnologías Utilizadas

- **Backend**: PHP 8+, MySQL, PDO
- **Frontend**: HTML5, CSS3, JavaScript, MaterializeCSS
- **Arquitectura**: MVC (Modelo-Vista-Controlador)
- **Herramientas**: Composer, Git

## Autor

Desarrollado por **Jose Makina de Guerra** como proyecto educativo para el curso **DAWM2026**.

## Licencia

Este proyecto es de uso educativo y demostrativo.

## Contribuciones

Las contribuciones son bienvenidas. Por favor, crea un fork del proyecto y envía un pull request.

---

**Nota**: Este es un proyecto educativo para demostrar conocimientos de desarrollo web con PHP y arquitectura MVC.
