let productos = [];

function formatearTiempo(segundosTotales) {
  const total = Math.max(0, Number(segundosTotales) || 0);
  const horas = Math.floor(total / 3600);
  const minutos = Math.floor((total % 3600) / 60);
  const segundos = total % 60;
  const hh = String(horas).padStart(2, '0');
  const mm = String(minutos).padStart(2, '0');
  const ss = String(segundos).padStart(2, '0');
  return `${hh}:${mm}:${ss}`;
}

function iniciarCuentaAtras() {
  const timerEl = document.getElementById('ofertas-timer');
  if (!timerEl) return;

  const duracion = 59 * 60 + 59;
  let restantes = duracion;

  if (window.__ofertasTimerIntervalId) {
    clearInterval(window.__ofertasTimerIntervalId);
  }

  const tick = () => {
    timerEl.textContent = formatearTiempo(restantes);
    restantes -= 1;
    if (restantes < 0) {
      restantes = duracion;
    }
  };

  tick();
  window.__ofertasTimerIntervalId = setInterval(tick, 1000);
}

function normalizarCategoria(categoria) {
  if (typeof categoria !== 'string') return '';
  return categoria.trim().toLowerCase();
}

function normalizarTalla(talla) {
  if (talla === null || talla === undefined) return '';
  return String(talla).trim().toUpperCase();
}

function formatearEUR(precioEUR) {
  const numero = Number(precioEUR);
  if (!Number.isFinite(numero)) return '';
  return new Intl.NumberFormat('es-ES', { style: 'currency', currency: 'EUR' }).format(numero);
}

function crearCard(producto) {
  const card = document.createElement('article');
  card.className = 'oferta-card';
  card.tabIndex = 0;

  card.addEventListener('click', () => abrirModal(producto));
  card.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      abrirModal(producto);
    }
  });

  if (producto.imagen) {
    const img = document.createElement('img');
    img.className = 'oferta-img';
    img.loading = 'lazy';
    img.decoding = 'async';
    img.src = producto.imagen;
    img.alt = producto.nombre;
    card.appendChild(img);
  }

  const body = document.createElement('div');
  body.className = 'oferta-body';

  const top = document.createElement('div');
  top.className = 'oferta-top';

  const h2 = document.createElement('h2');
  h2.textContent = producto.nombre;

  const precio = document.createElement('div');
  precio.className = 'oferta-precio';
  precio.textContent = formatearEUR(producto.precioEUR);

  top.appendChild(h2);
  top.appendChild(precio);

  const meta = document.createElement('div');
  meta.className = 'oferta-meta';

  const cat = document.createElement('span');
  cat.textContent = `Categoría: ${producto.categoria}`;

  const talla = document.createElement('span');
  talla.textContent = `Talla: ${producto.talla}`;

  meta.appendChild(cat);
  meta.appendChild(talla);

  body.appendChild(top);
  body.appendChild(meta);
  card.appendChild(body);

  return card;
}

function abrirModal(producto) {
  const modal = document.getElementById('ofertas-modal');
  const img = document.getElementById('ofertas-modal-img');
  const title = document.getElementById('ofertas-modal-title');
  const meta = document.getElementById('ofertas-modal-meta');
  const precio = document.getElementById('ofertas-modal-precio');
  const closeBtn = document.getElementById('ofertas-modal-close');

  if (!modal || !img || !title || !meta || !precio || !closeBtn) return;

  img.src = producto.imagen || '';
  img.alt = producto.nombre || '';
  title.textContent = producto.nombre || '';
  meta.textContent = `Categoría: ${producto.categoria} · Talla: ${producto.talla}`;
  precio.textContent = formatearEUR(producto.precioEUR);

  modal.hidden = false;
  closeBtn.focus();
}

function cerrarModal() {
  const modal = document.getElementById('ofertas-modal');
  if (!modal) return;
  modal.hidden = true;
}

function configurarModal() {
  const modal = document.getElementById('ofertas-modal');
  const closeBtn = document.getElementById('ofertas-modal-close');
  const backdrop = document.getElementById('ofertas-modal-backdrop');

  if (!modal || !closeBtn || !backdrop) return;

  closeBtn.addEventListener('click', cerrarModal);
  backdrop.addEventListener('click', cerrarModal);

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !modal.hidden) {
      cerrarModal();
    }
  });
}

function aplicarFiltros() {
  const categoriaSelect = document.getElementById('filtro-categoria');
  const tallaSelect = document.getElementById('filtro-talla');
  const grid = document.getElementById('ofertas-grid');
  const status = document.getElementById('ofertas-status');

  const categoria = normalizarCategoria(categoriaSelect.value);
  const talla = normalizarTalla(tallaSelect.value);

  const filtrados = productos.filter((p) => {
    const okCategoria = !categoria || normalizarCategoria(p.categoria) === categoria;
    const okTalla = !talla || normalizarTalla(p.talla) === talla;
    return okCategoria && okTalla;
  });

  grid.innerHTML = '';
  filtrados.forEach((p) => grid.appendChild(crearCard(p)));

  status.textContent = filtrados.length === 1 ? '1 producto' : `${filtrados.length} productos`;
}

async function cargarProductos() {
  const status = document.getElementById('ofertas-status');
  status.textContent = 'Cargando productos...';

  const respuesta = await fetch('../data/productos.json', { cache: 'no-store' });
  if (!respuesta.ok) {
    throw new Error(`Error cargando productos (${respuesta.status})`);
  }

  const datos = await respuesta.json();
  if (!Array.isArray(datos)) {
    throw new Error('Formato de productos.json inválido (se esperaba un array)');
  }

  productos = datos;
}

window.onload = async () => {
  const categoriaSelect = document.getElementById('filtro-categoria');
  const tallaSelect = document.getElementById('filtro-talla');
  const resetBtn = document.getElementById('ofertas-reset');
  const status = document.getElementById('ofertas-status');

  iniciarCuentaAtras();
  configurarModal();

  try {
    await cargarProductos();
    aplicarFiltros();
  } catch (e) {
    status.textContent = 'No se pudieron cargar las ofertas.';
    return;
  }

  categoriaSelect.addEventListener('change', aplicarFiltros);
  tallaSelect.addEventListener('change', aplicarFiltros);
  resetBtn.addEventListener('click', () => {
    categoriaSelect.value = '';
    tallaSelect.value = '';
    aplicarFiltros();
  });
};
