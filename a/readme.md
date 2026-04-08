# J.Suarez Carpintero – Sitio Web Corporativo

## Descripción general

Sitio web estático para el taller **J.Suarez Carpintero**, especializado en mobiliario a medida, instalación y restauración de piezas de madera. La web actúa como carta de presentación digital con navegación clara, hero con imagen de taller, detalle de servicios, filosofía del taller y formulario de contacto con validación en cliente.

---

## Objetivos

- Comunicar el catálogo de servicios de carpintería de forma precisa y profesional.
- Mostrar la filosofía artesanal de José Suárez y su equipo, junto con imágenes reales de taller.
- Facilitar el contacto mediante un formulario validado con HTML5 + JS de Bootstrap.
- Mantener un diseño minimalista, responsive y alineado con la estética de carpintería contemporánea.

---

## Estructura del proyecto

```
/jsuarez-arquitecto
├── index.html
├── /html
│   ├── servicios.html
│   ├── sobrenosotros.html
│   └── contacto.html
├── /css
│   └── style.css
├── /js
│   └── form-validation.js
└── /assets
    └── /images
```

---

## Tecnologías

- **HTML5** para el marcado semántico.
- **Bootstrap 5 (CDN)** para layout y componentes.
- **CSS3** (archivo `css/style.css`) para ajustes de tipografía, hero e inputs con bordes rectos.
- **JavaScript vanilla** (`js/form-validation.js`) para validar nombre, email, teléfono, asunto y mensaje, mostrando estados `is-valid/is-invalid`.

---

## Contenido principal

- **Inicio**: hero con mensaje de carpintería, resumen de servicios y CTA hacia Servicios/Contacto.
- **Servicios**: grid de tarjetas con mobiliario residencial, carpintería comercial, restauración e instalación, usando imágenes locales.
- **Sobre nosotros**: descripción del taller, filosofía de trabajo y equipo.
- **Contacto**: formulario validado (nombre, email, teléfono, asunto, mensaje) + datos directos.

---

## Cómo usarlo

1. Clonar o descargar el directorio `jsuarez-arquitecto`.
2. Abrir `index.html` en un navegador moderno.
3. Navegar entre secciones mediante la barra superior o enlaces del hero.
4. Probar el formulario de contacto (solo validación local, sin backend).

El proyecto se organiza de forma sencilla y lógica:

- `index.html`: página principal con hero, resumen de servicios y CTAs.
- `html/servicios.html`: catálogo de servicios de carpintería.
- `html/sobrenosotros.html`: filosofía del taller y equipo.
- `html/contacto.html`: formulario validado y datos directos.
- `css/style.css`: ajustes visuales mínimos sobre Bootstrap.
- `js/form-validation.js`: validación de campos en el cliente.
- `assets/images/`: fotografías locales del taller y proyectos.

Esta estructura permite escalar el proyecto fácilmente y mantener una separación clara entre contenido y estilos.

---

## Decisiones de diseño

El diseño es minimalista y propio de un taller de carpintería contemporáneo:

- Bordes rectos y sin sombras decorativas para resaltar las formas.
- Paleta neutra con tonos cálidos que acompañan las texturas de madera.
- Uso exclusivo de componentes Bootstrap para mantener consistencia y mantenimiento simple.
- Formulario centrado con validación HTML5 + JS para asegurar datos de contacto fiables.

---

## Responsive y accesibilidad

La web es totalmente responsive gracias al sistema de grid de Bootstrap, adaptándose correctamente a escritorio, tablet y móvil.

Se han tenido en cuenta buenas prácticas básicas de accesibilidad:
- Uso correcto de etiquetas semánticas.
- Formularios con labels asociados.
- Jerarquía clara de encabezados.
- Inputs con validación nativa del navegador.

---

## Formulario de contacto

El formulario de contacto implementa validación en el lado del cliente mediante HTML5 y Bootstrap:

- Campos obligatorios correctamente marcados.
- Validación de email y teléfono.
- Feedback visual de campos válidos e inválidos.
- El formulario no envía datos reales, ya que el proyecto no incluye backend.

El objetivo es demostrar la lógica y la estructura de validación, no la implementación de un sistema de envío.

---

## Conclusión

Este proyecto demuestra la capacidad de:
- Estructurar correctamente un sitio web corporativo.
- Tomar decisiones técnicas justificadas.
- Priorizar claridad, orden y mantenibilidad.
- Aplicar buenas prácticas de desarrollo frontend sin sobreingeniería.

El resultado es una solución realista y defendible para un taller de carpintería moderno, lista para escalar o integrarse con servicios backend en el futuro.
