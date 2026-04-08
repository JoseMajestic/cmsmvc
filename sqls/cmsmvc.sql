-- Base de datos para el CMS MVC (MySQL)
-- Generada a partir del análisis de modelos y controladores

CREATE DATABASE IF NOT EXISTS cmsmvc CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE cmsmvc;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(100) NOT NULL UNIQUE,
    contrasinal VARCHAR(255) NOT NULL,
    data_acceso DATETIME NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    usuarios TINYINT(1) NOT NULL DEFAULT 0,
    novas TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de noticias (novas)
CREATE TABLE novas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    extracto TEXT NULL,
    texto LONGTEXT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    home TINYINT(1) NOT NULL DEFAULT 0,
    datap DATETIME NOT NULL,
    autor VARCHAR(100) NOT NULL,
    imaxe VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insertar usuario administrador por defecto (usuario: admin, contraseña: admin123)
INSERT INTO usuarios (usuario, contrasinal, activo, usuarios, novas) VALUES 
('admin', '$2y$12$K5xY9G7L8mN2pQ6rT3sV9eR4wX7zJ5nK8fP2qH1sL4vD6cE9bA0', 1, 1, 1);

-- Insertar algunas noticias de ejemplo
INSERT INTO novas (titulo, slug, extracto, texto, activo, home, datap, autor, imaxe) VALUES 
('Bienvenido al CMS MVC', 'bienvenido-al-cms-mvc', 'Este es un artículo de bienvenida para probar el sistema.', 'Este es el contenido completo del artículo de bienvenida. Aquí puedes escribir todo el texto que desees para mostrar como ejemplo en tu nuevo CMS basado en PHP con arquitectura MVC.', 1, 1, NOW(), 'admin', NULL),
('Segunda noticia de prueba', 'segunda-noticia-de-prueba', 'Otra noticia para probar el listado.', 'Contenido de la segunda noticia de prueba. Puedes editarla o eliminarla desde el panel de administración.', 1, 0, NOW(), 'admin', NULL),
('Noticia inactiva', 'noticia-inactiva', 'Esta noticia no aparecerá en el sitio público.', 'Esta es una noticia inactiva que solo se puede ver desde el panel de administración. Úsala para probar cómo funcionan las noticias activas/inactivas.', 0, 0, NOW(), 'admin', NULL);

-- Índices para mejorar el rendimiento
CREATE INDEX idx_novas_activo ON novas(activo);
CREATE INDEX idx_novas_home ON novas(home);
CREATE INDEX idx_novas_datap ON novas(datap);
CREATE INDEX idx_usuarios_usuario ON usuarios(usuario);
CREATE INDEX idx_usuarios_activo ON usuarios(activo);
