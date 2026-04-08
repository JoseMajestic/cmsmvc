// JavaScript personalizado para DragonBall Saga CMS

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar componentes de MaterializeCSS
    var sidenavElems = document.querySelectorAll('.sidenav');
    var sidenavInstances = M.Sidenav.init(sidenavElems);
    
    // Inicializar select
    var selectElems = document.querySelectorAll('select');
    var selectInstances = M.FormSelect.init(selectElems);
    
    // Inicializar textarea
    var textareaElems = document.querySelectorAll('textarea');
    var textareaInstances = M.Textarea.init(textareaElems);
    
    // Inicializar modales
    var modalElems = document.querySelectorAll('.modal');
    var modalInstances = M.Modal.init(modalElems);
    
    // Animación suave al hacer scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Efecto parallax sutil en el header
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const header = document.querySelector('main header');
        if (header) {
            header.style.transform = `translateY(${scrolled * 0.3}px)`;
        }
    });
    
    // Validación del formulario de contacto
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (validateContactForm()) {
                // Simular envío del formulario
                submitContactForm();
            }
        });
    }
});

// Función de validación del formulario de contacto
function validateContactForm() {
    const nombre = document.getElementById('nombre');
    const email = document.getElementById('email');
    const asunto = document.getElementById('asunto');
    const mensaje = document.getElementById('mensaje');
    const terminos = document.getElementById('terminos');
    
    let isValid = true;
    
    // Validar nombre
    if (nombre.value.trim().length < 2) {
        showError(nombre, 'El nombre debe tener al menos 2 caracteres');
        isValid = false;
    } else {
        clearError(nombre);
    }
    
    // Validar email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value)) {
        showError(email, 'Introduce un email válido');
        isValid = false;
    } else {
        clearError(email);
    }
    
    // Validar asunto
    if (asunto.value.trim().length < 3) {
        showError(asunto, 'El asunto debe tener al menos 3 caracteres');
        isValid = false;
    } else {
        clearError(asunto);
    }
    
    // Validar mensaje
    if (mensaje.value.trim().length < 10) {
        showError(mensaje, 'El mensaje debe tener al menos 10 caracteres');
        isValid = false;
    } else {
        clearError(mensaje);
    }
    
    // Validar términos
    if (!terminos.checked) {
        showError(terminos, 'Debes aceptar los términos y condiciones');
        isValid = false;
    } else {
        clearError(terminos);
    }
    
    return isValid;
}

// Función para mostrar errores
function showError(field, message) {
    field.classList.add('invalid');
    
    // Buscar o crear el elemento de error
    let errorElement = field.parentNode.querySelector('.error-message');
    if (!errorElement) {
        errorElement = document.createElement('span');
        errorElement.className = 'error-message red-text';
        field.parentNode.appendChild(errorElement);
    }
    
    errorElement.textContent = message;
    errorElement.style.display = 'block';
}

// Función para limpiar errores
function clearError(field) {
    field.classList.remove('invalid');
    
    const errorElement = field.parentNode.querySelector('.error-message');
    if (errorElement) {
        errorElement.style.display = 'none';
    }
}

// Función para enviar el formulario
function submitContactForm() {
    const formData = new FormData(document.getElementById('contactForm'));
    
    // Simular envío (en producción esto sería una llamada AJAX real)
    console.log('Enviando formulario:', Object.fromEntries(formData));
    
    // Mostrar modal de confirmación
    const modal = M.Modal.getInstance(document.getElementById('confirmModal'));
    modal.open();
    
    // Limpiar formulario
    document.getElementById('contactForm').reset();
    
    // Limpiar errores
    document.querySelectorAll('.invalid').forEach(field => {
        clearError(field);
    });
}

// Función para animación de carga de imágenes
function lazyLoadImages() {
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
}

// Inicializar lazy loading
lazyLoadImages();