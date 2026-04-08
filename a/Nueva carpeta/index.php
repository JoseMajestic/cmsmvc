<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportFlow | Tienda Deportiva</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            color-scheme: dark;
        }
        body {
            font-family: 'Space Grotesk', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            scroll-behavior: smooth;
            background: radial-gradient(circle at top, #0f172a, #020617 55%);
        }
        .glass {
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(248, 250, 252, 0.08);
        }
        .category-overlay,
        .app-overlay {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 60;
        }
        .category-overlay.active,
        .app-overlay.active {
            display: flex;
        }
        .overlay-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(2, 6, 23, 0.75);
            backdrop-filter: blur(6px);
        }
        .overlay-panel {
            position: relative;
            width: min(1200px, 92vw);
            max-height: 90vh;
            overflow-y: auto;
            padding: 2.5rem;
            border-radius: 2rem;
        }
        .close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.5rem;
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 999px;
            border: 1px solid rgba(248, 250, 252, 0.12);
        }
        .product-card {
            transition: transform 0.28s ease, border-color 0.28s ease;
        }
        .product-card:hover {
            transform: translateY(-6px);
            border-color: #fb923c;
        }
        @media (max-width: 768px) {
            nav .top-form {
                display: none;
            }
        }
    </style>
</head>
<body class="text-slate-100">
    <nav class="fixed inset-x-0 top-0 z-50">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between glass rounded-3xl mt-4">
            <a href="#" class="text-2xl font-bold tracking-tight flex items-center gap-2">
                <span class="text-white">SPORT</span><span class="text-orange-400">FLOW</span>
            </a>
            <div class="hidden md:flex items-center gap-8 text-sm uppercase tracking-[0.3em]">
                <a href="#inicio" class="hover:text-orange-300 transition">Inicio</a>
                <a href="#categorias" class="hover:text-orange-300 transition">Colecciones</a>
                <a href="html/seleccion.html" class="hover:text-orange-300 transition">Selección</a>
            </div>
            <form class="top-form hidden lg:flex items-center gap-2 bg-slate-900/80 rounded-full pl-4 pr-1 py-1 text-slate-400">
                <input type="email" placeholder="Tu email" class="bg-transparent border-none focus:outline-none text-sm placeholder-slate-500">
                <button type="button" data-newsletter-open class="bg-orange-500 hover:bg-orange-400 text-xs font-semibold rounded-full px-4 py-2 text-white">Unirme</button>
            </form>
            <div class="flex items-center gap-3">
                <button type="button" data-cart-open class="relative bg-slate-900/60 hover:bg-slate-900 text-white p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                        <path d="M3 6h18" />
                        <path d="M16 10a4 4 0 0 1-8 0" />
                    </svg>
                    <span id="cart-count" class="absolute -top-1 -right-1 bg-orange-500 text-white text-[10px] rounded-full w-5 h-5 flex items-center justify-center font-semibold">0</span>
                </button>
            </div>
        </div>
    </nav>

    <main class="pt-36" id="inicio">
        <header class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-sm tracking-[0.6em] text-orange-300 mb-6">COLECCIÓN 2025</p>
                <h1 class="text-5xl md:text-6xl font-semibold leading-tight mb-6">Rinde al máximo con equipamiento pensado para dominar cada disciplina.</h1>
                <p class="text-lg text-slate-300 mb-10">Catálogo premium de running, training y yoga con drops limitados, envíos en 24h y asesoría personalizada.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="#categorias" class="bg-orange-500 hover:bg-orange-400 text-white px-8 py-4 rounded-full font-semibold">Explorar categorías</a>
                    <button data-newsletter-open class="rounded-full border border-slate-600 px-8 py-4 font-semibold hover:border-white">Recibir novedades</button>
                </div>
            </div>
            <div class="relative">
                <img class="rounded-[40px] border border-slate-800 shadow-[0_35px_120px_rgba(15,23,42,0.8)]" src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=1600&auto=format&fit=crop" alt="Atleta entrenando" />
                <div class="absolute -bottom-6 -left-4 glass px-6 py-4 rounded-3xl max-w-xs">
                    <p class="text-sm uppercase tracking-[0.4em] text-orange-300">Oferta express</p>
                    <p class="font-semibold text-2xl" id="hero-countdown">--:--:--</p>
                    <p class="text-xs text-slate-400">Aplica a todos los productos destacados</p>
                </div>
            </div>
        </header>

        <section id="categorias" class="max-w-6xl mx-auto px-6 mt-28">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <p class="text-sm tracking-[0.6em] text-orange-300">COLECCIONES</p>
                    <h2 class="text-4xl font-semibold">Elige la energía que quieres liberar</h2>
                </div>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                <button data-category-trigger="running" class="group relative overflow-hidden rounded-[32px] h-[420px]">
                    <img src="https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?q=80&w=1600&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="Running" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/60 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 text-left">
                        <p class="text-sm tracking-[0.5em] text-orange-300">COLECCIÓN</p>
                        <h3 class="text-3xl font-semibold">RUNNING</h3>
                    </div>
                </button>
                <button data-category-trigger="training" class="group relative overflow-hidden rounded-[32px] h-[420px]">
                    <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1600&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="Training" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/60 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 text-left">
                        <p class="text-sm tracking-[0.5em] text-orange-300">COLECCIÓN</p>
                        <h3 class="text-3xl font-semibold">TRAINING</h3>
                    </div>
                </button>
                <button data-category-trigger="yoga" class="group relative overflow-hidden rounded-[32px] h-[420px]">
                    <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=1600&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="Yoga" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/60 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 text-left">
                        <p class="text-sm tracking-[0.5em] text-orange-300">COLECCIÓN</p>
                        <h3 class="text-3xl font-semibold">YOGA</h3>
                    </div>
                </button>
            </div>
        </section>

        <section class="max-w-6xl mx-auto px-6 mt-28 grid lg:grid-cols-[2fr,1fr] gap-8">
            <div class="glass rounded-[40px] p-10">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <p class="text-sm tracking-[0.6em] text-orange-300">DROP SEMANAL</p>
                        <h3 class="text-3xl font-semibold">Ofertas vibrantes</h3>
                    </div>
                    <button data-category-trigger="running" class="px-6 py-3 rounded-full border border-slate-600 hover:border-orange-400">Ver running</button>
                </div>
                <div class="grid sm:grid-cols-2 gap-6">
                    <article class="product-card border border-slate-800 rounded-3xl overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1200&auto=format&fit=crop" alt="Zapatilla Alpha" class="h-56 w-full object-cover">
                        <div class="p-6 space-y-3">
                            <p class="text-sm text-orange-300">Running</p>
                            <h4 class="text-2xl font-semibold">Alpha Run Pro</h4>
                            <p class="text-slate-400 text-sm">Amortiguación reactiva y upper sin costuras para ritmos altos.</p>
                            <div class="flex items-center justify-between">
                                <span class="text-3xl font-semibold text-white">129€</span>
                                <span class="text-sm text-slate-400" data-countdown="run-alpha">--:--:--</span>
                            </div>
                        </div>
                    </article>
                    <article class="product-card border border-slate-800 rounded-3xl overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=1200&auto=format&fit=crop" alt="Set Training" class="h-56 w-full object-cover">
                        <div class="p-6 space-y-3">
                            <p class="text-sm text-orange-300">Training</p>
                            <h4 class="text-2xl font-semibold">Set Training Forge</h4>
                            <p class="text-slate-400 text-sm">Prendas técnicas con paneles de ventilación zonificada.</p>
                            <div class="flex items-center justify-between">
                                <span class="text-3xl font-semibold text-white">89€</span>
                                <span class="text-sm text-slate-400" data-countdown="trn-forge">--:--:--</span>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="glass rounded-[40px] p-10 flex flex-col justify-between">
                <div>
                    <p class="text-sm tracking-[0.5em] text-orange-300">REGISTRO</p>
                    <h3 class="text-3xl font-semibold mb-6">Acceso anticipado y drops sorpresa</h3>
                    <p class="text-slate-400 mb-6">Recibe avisos cada vez que abrimos cupos limitados o lanzamos combinaciones exclusivas.</p>
                </div>
                <button data-newsletter-open class="bg-white text-slate-900 font-semibold rounded-full py-4">Unirme ahora</button>
            </div>
        </section>

        <footer class="max-w-6xl mx-auto px-6 py-16 text-sm text-slate-500 flex flex-col sm:flex-row gap-4 justify-between mt-24 border-t border-slate-800">
            <p>© 2025 SportFlow. Todos los derechos reservados.</p>
            <div class="flex gap-6 text-white">
                <a href="#" class="hover:text-orange-300">Instagram</a>
                <a href="#" class="hover:text-orange-300">YouTube</a>
                <a href="#" class="hover:text-orange-300">TikTok</a>
            </div>
        </footer>
    </main>

    <!-- Category Overlays -->
    <div id="running-overlay" class="category-overlay">
        <div class="overlay-backdrop" data-overlay-close></div>
        <section class="overlay-panel glass">
            <button class="close-btn" data-overlay-close aria-label="Cerrar">×</button>
            <header class="mb-10">
                <p class="text-sm tracking-[0.6em] text-orange-300">RUNNING</p>
                <h2 class="text-4xl font-semibold">Colección Velocity 24/25</h2>
                <p class="text-slate-400">Livianos, responsivos y listos para romper marcas personales.</p>
            </header>
            <div id="running-products" class="grid md:grid-cols-2 gap-6"></div>
        </section>
    </div>

    <div id="training-overlay" class="category-overlay">
        <div class="overlay-backdrop" data-overlay-close></div>
        <section class="overlay-panel glass">
            <button class="close-btn" data-overlay-close aria-label="Cerrar">×</button>
            <header class="mb-10">
                <p class="text-sm tracking-[0.6em] text-orange-300">TRAINING</p>
                <h2 class="text-4xl font-semibold">Programa Forge</h2>
                <p class="text-slate-400">Capas técnicas diseñadas para soportar sesiones de fuerza intensas.</p>
            </header>
            <div id="training-products" class="grid md:grid-cols-2 gap-6"></div>
        </section>
    </div>

    <div id="yoga-overlay" class="category-overlay">
        <div class="overlay-backdrop" data-overlay-close></div>
        <section class="overlay-panel glass">
            <button class="close-btn" data-overlay-close aria-label="Cerrar">×</button>
            <header class="mb-10">
                <p class="text-sm tracking-[0.6em] text-orange-300">YOGA</p>
                <h2 class="text-4xl font-semibold">Zen Flow Studio</h2>
                <p class="text-slate-400">Texturas suaves, agarre superior y estética minimalista.</p>
            </header>
            <div id="yoga-products" class="grid md:grid-cols-2 gap-6"></div>
        </section>
    </div>

    <!-- Cart Overlay -->
    <div id="cart-overlay" class="app-overlay">
        <div class="overlay-backdrop" data-overlay-close></div>
        <section class="overlay-panel glass max-w-3xl w-full">
            <button class="close-btn" data-overlay-close aria-label="Cerrar">×</button>
            <header class="mb-8">
                <p class="text-sm tracking-[0.6em] text-orange-300">CARRITO</p>
                <h2 class="text-4xl font-semibold">Inventario seleccionado</h2>
                <p class="text-slate-400">Revisa cantidades y ajusta antes de confirmar.</p>
            </header>
            <div id="cart-items" class="space-y-4"></div>
            <div class="mt-8 flex items-center justify-between text-lg">
                <span>Total</span>
                <strong id="cart-total" class="text-2xl font-semibold">0 €</strong>
            </div>
            <button class="w-full mt-6 bg-orange-500 hover:bg-orange-400 rounded-full py-4 font-semibold disabled:opacity-40" id="checkout-btn" disabled>Proceder al pago</button>
        </section>
    </div>

    <!-- Product Detail Modal -->
    <div id="product-modal" class="app-overlay">
        <div class="overlay-backdrop" data-overlay-close></div>
        <article class="overlay-panel glass max-w-3xl w-full grid md:grid-cols-2 gap-8">
            <button class="close-btn" data-overlay-close aria-label="Cerrar">×</button>
            <div>
                <img id="modal-img" src="" alt="" class="rounded-2xl object-cover w-full h-full">
            </div>
            <div class="space-y-4">
                <p id="modal-category" class="text-sm tracking-[0.5em] text-orange-300"></p>
                <h3 id="modal-title" class="text-3xl font-semibold"></h3>
                <p id="modal-description" class="text-slate-400"></p>
                <p class="text-3xl font-semibold" id="modal-price"></p>
                <div>
                    <p class="text-sm text-orange-300">Oferta termina en</p>
                    <p class="font-mono text-lg" id="modal-countdown">--:--:--</p>
                </div>
            </div>
        </article>
    </div>

    <!-- Newsletter Overlay -->
    <div id="newsletter-overlay" class="app-overlay">
        <div class="overlay-backdrop" data-overlay-close></div>
        <section class="overlay-panel glass max-w-2xl w-full">
            <button class="close-btn" data-overlay-close aria-label="Cerrar">×</button>
            <header class="mb-8">
                <p class="text-sm tracking-[0.6em] text-orange-300">BOLETÍN</p>
                <h2 class="text-4xl font-semibold">Regístrate para drops exclusivos</h2>
                <p class="text-slate-400">Inspirado en tu formulario original, adaptado para la barra superior.</p>
            </header>
            <form class="grid gap-4" autocomplete="on">
                <label class="text-sm text-slate-300">Nombre
                    <input type="text" name="nombre" class="mt-2 w-full rounded-2xl bg-slate-900/70 border border-slate-700 px-4 py-3" placeholder="Tu nombre">
                </label>
                <label class="text-sm text-slate-300">Correo electrónico
                    <input type="email" name="email" class="mt-2 w-full rounded-2xl bg-slate-900/70 border border-slate-700 px-4 py-3" placeholder="tu@email.com">
                </label>
                <label class="text-sm text-slate-300">Disciplina favorita
                    <select class="mt-2 w-full rounded-2xl bg-slate-900/70 border border-slate-700 px-4 py-3">
                        <option>Running</option>
                        <option>Training</option>
                        <option>Yoga</option>
                    </select>
                </label>
                <button type="submit" class="mt-4 bg-orange-500 hover:bg-orange-400 rounded-full py-3 font-semibold">Guardar registro</button>
            </form>
        </section>
    </div>

    <script>
        const products = {
            running: [
                { id: 'run-1', title: 'Zapatilla Alpha Run', cat: 'Running', size: '40-45', price: 129, img: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1600&auto=format&fit=crop', description: 'Espuma de retorno rápido y suela con agarre multi terreno para ritmos de 3:30-5:00 min/km.' },
                { id: 'run-2', title: 'Cortavientos Pulse', cat: 'Running', size: 'S-XL', price: 69, img: 'https://images.unsplash.com/photo-1508107222753-0c2f6ecbc242?q=80&w=1600&auto=format&fit=crop', description: 'Protección ultraligera contra viento y lluvia ligera con paneles reflectivos 360º.' },
                { id: 'run-3', title: 'Mallas Endurance', cat: 'Running', size: 'XS-L', price: 49, img: 'https://images.unsplash.com/photo-1539185441755-769473a23570?q=80&w=1600&auto=format&fit=crop', description: 'Compresión gradual para retrasar la fatiga y bolsillos traseros para geles.' },
                { id: 'run-4', title: 'Reloj GPS Speed', cat: 'Accessories', size: 'Única', price: 199, img: 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1600&auto=format&fit=crop', description: 'Seguimiento multibanda con métricas avanzadas de carga de entrenamiento.' }
            ],
            training: [
                { id: 'trn-1', title: 'Camiseta Tech Fit', cat: 'Training', size: 'M-XXL', price: 29, img: 'https://images.unsplash.com/photo-1581009146145-b5ef03a7403f?q=80&w=1600&auto=format&fit=crop', description: 'Tejido con microperforaciones para expulsar el calor durante superseries.' },
                { id: 'trn-2', title: 'Guantes Lightning', cat: 'Accessories', size: 'S-L', price: 22, img: 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=1600&auto=format&fit=crop', description: 'Refuerzos en palma y agarre antideslizante para dominadas y pesos libres.' },
                { id: 'trn-3', title: 'Jogger Cargo Sport', cat: 'Training', size: 'S-XL', price: 44, img: 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=1600&auto=format&fit=crop', description: 'Corte tapered con paneles elásticos para movilidad completa.' },
                { id: 'trn-4', title: 'Zapatilla Gym Master', cat: 'Training', size: '38-46', price: 95, img: 'https://images.unsplash.com/photo-1556906781-9a412961c28c?q=80&w=1600&auto=format&fit=crop', description: 'Base estable con drop mínimo para levantamientos pesados.' }
            ],
            yoga: [
                { id: 'yog-1', title: 'Mat Antideslizante', cat: 'Yoga', size: 'Standard', price: 54, img: 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=1600&auto=format&fit=crop', description: 'Textura dual para agarre seguro en posturas avanzadas.' },
                { id: 'yog-2', title: 'Top Yoga Comfort', cat: 'Yoga', size: 'XS-L', price: 32, img: 'https://images.unsplash.com/photo-1518310383802-640c2de311b2?q=80&w=1600&auto=format&fit=crop', description: 'Soporte medio con tirantes cruzados y costuras planas.' },
                { id: 'yog-3', title: 'Bloque de Corcho', cat: 'Yoga', size: 'Única', price: 18, img: 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?q=80&w=1600&auto=format&fit=crop', description: 'Corcho premium, borde redondeado para uso cómodo en ajustes.' },
                { id: 'yog-4', title: 'Malla Seamless Zen', cat: 'Yoga', size: 'S-M', price: 39, img: 'https://images.unsplash.com/photo-1447452030438-6e9ce8772739?q=80&w=1600&auto=format&fit=crop', description: 'Estructura seamless que evita marcas y acompaña cada estiramiento.' }
            ]
        };

        const featuredCountdowns = {
            'run-alpha': null,
            'trn-forge': null
        };

        const cart = new Map();
        const globalDeadline = new Date(Date.now() + 1000 * 60 * 60 * 24 * 2);
        const deadlines = {};
        Object.values(products).flat().forEach(prod => deadlines[prod.id] = globalDeadline);
        featuredCountdowns['run-alpha'] = globalDeadline;
        featuredCountdowns['trn-forge'] = globalDeadline;

        const categoryButtons = document.querySelectorAll('[data-category-trigger]');
        const newsletterTriggers = document.querySelectorAll('[data-newsletter-open]');
        const overlays = document.querySelectorAll('.category-overlay, .app-overlay');

        categoryButtons.forEach(btn => btn.addEventListener('click', () => openCategory(btn.dataset.categoryTrigger)));
        newsletterTriggers.forEach(btn => btn.addEventListener('click', () => openOverlay('newsletter-overlay')));
        document.querySelectorAll('[data-cart-open]').forEach(btn => btn.addEventListener('click', () => openOverlay('cart-overlay')));
        document.body.addEventListener('click', handleOverlayClick);

        function handleOverlayClick(event) {
            const addBtn = event.target.closest('[data-add]');
            if (addBtn) {
                addToCart(addBtn.dataset.add);
                return;
            }
            const removeBtn = event.target.closest('[data-remove]');
            if (removeBtn) {
                removeFromCart(removeBtn.dataset.remove);
                return;
            }
            const detailBtn = event.target.closest('[data-detail]');
            if (detailBtn) {
                openProductModal(detailBtn.dataset.detail);
                return;
            }
            const closeTrigger = event.target.closest('[data-overlay-close]');
            if (closeTrigger) {
                closeAllOverlays();
            }
        }

        function renderProducts(category) {
            const container = document.getElementById(`${category}-products`);
            container.innerHTML = products[category].map(productCard).join('');
        }

        function productCard(product) {
            const quantity = cart.get(product.id)?.qty || 0;
            return `
                <article class="product-card border border-slate-800 rounded-3xl overflow-hidden flex flex-col bg-slate-950/60" data-product="${product.id}">
                    <div class="relative h-56 overflow-hidden">
                        <img src="${product.img}" alt="${product.title}" class="w-full h-full object-cover" loading="lazy">
                        <button class="absolute top-4 right-4 bg-white/90 text-slate-900 text-xs font-semibold px-3 py-1 rounded-full" data-detail="${product.id}">Ver detalle</button>
                    </div>
                    <div class="p-6 space-y-4 flex-1 flex flex-col">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm text-orange-300 uppercase tracking-[0.4em]">${product.cat}</p>
                                <h3 class="text-2xl font-semibold">${product.title}</h3>
                                <p class="text-slate-400 text-sm">Tallas: ${product.size}</p>
                            </div>
                            <span class="text-3xl font-semibold">${product.price}€</span>
                        </div>
                        <div class="mt-auto">
                            <p class="text-xs uppercase tracking-[0.4em] text-slate-500">Oferta termina en</p>
                            <p class="font-mono text-lg text-orange-300" data-countdown="${product.id}">--:--:--</p>
                        </div>
                        <div class="flex items-center justify-between pt-2">
                            <div class="flex items-center gap-3 bg-slate-900/70 rounded-full px-4 py-2">
                                <button class="text-xl" data-remove="${product.id}">−</button>
                                <span data-qty="${product.id}" class="text-xl font-semibold">${quantity}</span>
                                <button class="text-xl" data-add="${product.id}">+</button>
                            </div>
                            <button class="text-sm uppercase tracking-[0.4em] text-slate-400 hover:text-white" data-detail="${product.id}">Detalles</button>
                        </div>
                    </div>
                </article>`;
        }

        function addToCart(productId) {
            const allProducts = Object.values(products).flat();
            const product = allProducts.find(p => p.id === productId);
            if (!product) return;
            const current = cart.get(productId) || { product, qty: 0 };
            current.qty += 1;
            cart.set(productId, current);
            syncCartUI();
        }

        function removeFromCart(productId) {
            if (!cart.has(productId)) return;
            const current = cart.get(productId);
            current.qty -= 1;
            if (current.qty <= 0) {
                cart.delete(productId);
            } else {
                cart.set(productId, current);
            }
            syncCartUI();
        }

        function syncCartUI() {
            document.querySelectorAll('[data-category-trigger]').forEach(btn => {
                const category = btn.dataset.categoryTrigger;
                const overlay = document.getElementById(`${category}-overlay`);
                if (overlay.classList.contains('active')) {
                    renderProducts(category);
                }
            });
            updateCartBadge();
            renderCart();
        }

        function updateCartBadge() {
            const count = Array.from(cart.values()).reduce((acc, item) => acc + item.qty, 0);
            document.getElementById('cart-count').textContent = count;
        }

        function renderCart() {
            const container = document.getElementById('cart-items');
            const entries = Array.from(cart.values());
            if (!entries.length) {
                container.innerHTML = '<p class="text-slate-400">Tu carrito está vacío. Añade piezas desde las categorías.</p>';
                document.getElementById('cart-total').textContent = '0 €';
                document.getElementById('checkout-btn').setAttribute('disabled', 'disabled');
                return;
            }
            container.innerHTML = entries.map(({ product, qty }) => `
                <div class="flex items-center justify-between border border-slate-800 rounded-2xl p-4">
                    <div class="flex items-center gap-4">
                        <img src="${product.img}" alt="${product.title}" class="w-16 h-16 rounded-xl object-cover">
                        <div>
                            <p class="text-sm uppercase tracking-[0.4em] text-orange-300">${product.cat}</p>
                            <p class="text-xl font-semibold">${product.title}</p>
                            <p class="text-slate-400 text-sm">${product.price} € • Talla ${product.size}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button data-remove="${product.id}" class="px-3 py-1 border border-slate-700 rounded-full">−</button>
                        <span class="text-xl font-semibold">${qty}</span>
                        <button data-add="${product.id}" class="px-3 py-1 border border-slate-700 rounded-full">+</button>
                    </div>
                </div>`).join('');
            const total = entries.reduce((acc, entry) => acc + entry.product.price * entry.qty, 0);
            document.getElementById('cart-total').textContent = `${total.toFixed(2)} €`;
            document.getElementById('checkout-btn').removeAttribute('disabled');
        }

        function openCategory(category) {
            renderProducts(category);
            openOverlay(`${category}-overlay`);
        }

        function openOverlay(id) {
            closeAllOverlays();
            const overlay = document.getElementById(id);
            if (!overlay) return;
            overlay.classList.add('active');
            document.documentElement.style.overflow = 'hidden';
        }

        function closeAllOverlays() {
            overlays.forEach(ov => ov.classList.remove('active'));
            document.documentElement.style.overflow = '';
        }

        function openProductModal(productId) {
            const allProducts = Object.values(products).flat();
            const product = allProducts.find(p => p.id === productId);
            if (!product) return;
            document.getElementById('modal-img').src = product.img;
            document.getElementById('modal-img').alt = product.title;
            document.getElementById('modal-category').textContent = product.cat;
            document.getElementById('modal-title').textContent = product.title;
            document.getElementById('modal-description').textContent = product.description;
            document.getElementById('modal-price').textContent = `${product.price} €`;
            document.getElementById('modal-countdown').dataset.product = product.id;
            openOverlay('product-modal');
        }

        function updateCountdowns() {
            const now = Date.now();
            document.querySelectorAll('[data-countdown]').forEach(el => {
                const id = el.dataset.countdown;
                const target = deadlines[id] || featuredCountdowns[id];
                if (!target) return;
                const diff = target - now;
                if (diff <= 0) {
                    el.textContent = 'Se terminó la oferta';
                    return;
                }
                const hours = Math.floor(diff / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                el.textContent = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            });
        }

        setInterval(updateCountdowns, 1000);
        updateCountdowns();

        document.getElementById('hero-countdown').dataset.countdown = 'hero';
        deadlines['hero'] = globalDeadline;
        document.querySelector('[data-countdown="run-alpha"]').textContent = '--:--:--';
        document.querySelector('[data-countdown="trn-forge"]').textContent = '--:--:--';

    </script>
</body>
</html>
