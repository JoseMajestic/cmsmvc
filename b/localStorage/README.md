# **Modelo de solución de referencia** 

Esta solución implementa todas as funcionalidades esixidas na proba práctica, incluíndo as opcións extras como o filtrado e atributos ARIA para accesibilidade. Inclúe explicacións sobre as decisións técnicas e os criterios que se espera que os alumnos cumpran.

---

## Solución de referencia: "Xestor de Tarefas Persoal Interactivo"

### 1. Estrutura HTML semántica (arquivo `index.html`)

```html
<!DOCTYPE html>
<html lang="gl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xestor de Tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Xestor de Tarefas Persoal</h1>
    </header>

    <main>
        <!-- Formulario para engadir tarefas -->
        <section aria-labelledby="form-heading">
            <h2 id="form-heading" class="visually-hidden">Engadir nova tarefa</h2>
            <form id="task-form">
                <label for="new-task">Nome da tarefa:</label>
                <input type="text" id="new-task" name="new-task" placeholder="Ex: Mercar pan" required aria-required="true">
                <button type="submit">Engadir tarefa</button>
            </form>
        </section>

        <!-- Filtros (opcional, para puntuación extra) -->
        <section aria-labelledby="filter-heading">
            <h2 id="filter-heading" class="visually-hidden">Filtrar tarefas</h2>
            <div class="filters">
                <button type="button" data-filter="all" class="filter-btn active">Todas</button>
                <button type="button" data-filter="pending" class="filter-btn">Pendentes</button>
                <button type="button" data-filter="completed" class="filter-btn">Completadas</button>
            </div>
        </section>

        <!-- Lista de tarefas -->
        <section aria-labelledby="tasks-heading">
            <h2 id="tasks-heading">Lista de tarefas</h2>
            <ul id="task-list">
                <!-- As tarefas inxectaranse aquí con JavaScript -->
            </ul>
            <p id="empty-message" class="empty-message">Non hai tarefas. Engade unha nova!</p>
        </section>

        <!-- Rexión ARIA live para anunciar cambios a lectores de pantalla -->
        <div aria-live="polite" id="announcer" class="visually-hidden"></div>
    </main>

    <footer>
        <p>&copy; 2025 - Proba práctica</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
```

**Observacións sobre o HTML:**
- Uso de etiquetas semánticas: `<header>`, `<main>`, `<section>`, `<footer>`.
- Asociación correcta de `<label>` co `<input>` mediante o atributo `for` e o `id`.
- Atributos de accesibilidade: `aria-labelledby` para seccións, `aria-required="true"`, `aria-live="polite"` para notificar cambios a usuarios de lectores de pantalla.
- Clase `visually-hidden` para ocultar visualmente certos títulos que só precisan os lectores de pantalla (definida en CSS).

---

### 2. Estilos CSS con deseño responsivo (arquivo `style.css`)

```css
/* Estilos base */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f4f4f4;
    color: #333;
    padding: 1rem;
}

header, main, footer {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    margin-bottom: 1.5rem;
}

h1 {
    font-size: 1.8rem;
    color: #2c3e50;
}

/* Clase para ocultar visualmente pero manter accesible */
.visually-hidden {
    position: absolute;
    width: 1px;
    height: 1px;
    margin: -1px;
    padding: 0;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    border: 0;
}

/* Formulario */
#task-form {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

#task-form label {
    flex: 0 0 100%;
    font-weight: bold;
}

#task-form input {
    flex: 1 1 200px;
    padding: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 4px;
}

#task-form button {
    padding: 0.5rem 1rem;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

#task-form button:hover,
#task-form button:focus {
    background-color: #2980b9;
    outline: 2px solid #1a5276;
}

/* Filtros */
.filters {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.filter-btn {
    padding: 0.3rem 1rem;
    background-color: #ecf0f1;
    border: 1px solid #bdc3c7;
    border-radius: 20px;
    cursor: pointer;
}

.filter-btn.active {
    background-color: #2c3e50;
    color: white;
    border-color: #2c3e50;
}

.filter-btn:focus {
    outline: 2px solid #3498db;
    outline-offset: 2px;
}

/* Lista de tarefas */
#task-list {
    list-style: none;
    margin-bottom: 1rem;
}

.task-item {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem;
    background-color: #f9f9f9;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    margin-bottom: 0.5rem;
}

.task-item.completed .task-name {
    text-decoration: line-through;
    color: #7f8c8d;
}

.task-name {
    flex: 1 1 200px;
    word-break: break-word;
}

.task-actions {
    display: flex;
    gap: 0.5rem;
    margin-left: auto;
}

.task-actions button {
    padding: 0.3rem 0.8rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.task-actions .complete-btn {
    background-color: #27ae60;
    color: white;
}

.task-actions .complete-btn:hover,
.task-actions .complete-btn:focus {
    background-color: #229954;
    outline: 2px solid #1e8449;
}

.task-actions .delete-btn {
    background-color: #e74c3c;
    color: white;
}

.task-actions .delete-btn:hover,
.task-actions .delete-btn:focus {
    background-color: #c0392b;
    outline: 2px solid #a93226;
}

/* Mensaxe de lista baleira */
.empty-message {
    text-align: center;
    color: #95a5a6;
    font-style: italic;
}

/* Media query para móbil */
@media (max-width: 600px) {
    body {
        padding: 0.5rem;
    }

    header, main, footer {
        padding: 1rem;
    }

    .task-item {
        flex-direction: column;
        align-items: stretch;
    }

    .task-actions {
        margin-left: 0;
        justify-content: flex-end;
    }

    .task-name {
        text-align: center;
    }
}
```

**Criterios avaliados no CSS:**
- Uso de Flexbox para maquetación.
- Estilos de foco visibles (`:focus`) para navegación por teclado.
- Media query que reorganiza os elementos en móbil.
- Contraste de cores suficiente (pódese comprobar con ferramentas).

---

### 3. Lóxica JavaScript con persistencia e accesibilidade (arquivo `script.js`)

```javascript
// Variables globais
let tasks = [];
let currentFilter = 'all';

// Elementos do DOM
const taskForm = document.getElementById('task-form');
const taskInput = document.getElementById('new-task');
const taskList = document.getElementById('task-list');
const emptyMessage = document.getElementById('empty-message');
const filterButtons = document.querySelectorAll('.filter-btn');
const announcer = document.getElementById('announcer');

// Cargar tarefas do localStorage ao iniciar
function loadTasks() {
    const storedTasks = localStorage.getItem('tasks');
    if (storedTasks) {
        tasks = JSON.parse(storedTasks);
    } else {
        tasks = [];
    }
    renderTasks();
}

// Gardar tarefas no localStorage
function saveTasks() {
    localStorage.setItem('tasks', JSON.stringify(tasks));
}

// Renderizar tarefas segundo o filtro actual
function renderTasks() {
    let filteredTasks = tasks;
    if (currentFilter === 'pending') {
        filteredTasks = tasks.filter(task => !task.completed);
    } else if (currentFilter === 'completed') {
        filteredTasks = tasks.filter(task => task.completed);
    }

    if (filteredTasks.length === 0) {
        taskList.innerHTML = '';
        emptyMessage.style.display = 'block';
        // Anunciar a lectores de pantalla
        announce('Non hai tarefas que mostrar.');
    } else {
        emptyMessage.style.display = 'none';
        const fragment = document.createDocumentFragment();
        filteredTasks.forEach(task => {
            const li = document.createElement('li');
            li.className = `task-item ${task.completed ? 'completed' : ''}`;
            li.dataset.id = task.id;

            const span = document.createElement('span');
            span.className = 'task-name';
            span.textContent = task.name;

            const actionsDiv = document.createElement('div');
            actionsDiv.className = 'task-actions';

            // Botón completar (ou desfacer completado)
            const completeBtn = document.createElement('button');
            completeBtn.className = 'complete-btn';
            completeBtn.textContent = task.completed ? 'Desfacer' : 'Completar';
            completeBtn.setAttribute('aria-label', task.completed ? `Marcar como pendente: ${task.name}` : `Marcar como completada: ${task.name}`);
            completeBtn.addEventListener('click', () => toggleComplete(task.id));

            // Botón eliminar
            const deleteBtn = document.createElement('button');
            deleteBtn.className = 'delete-btn';
            deleteBtn.textContent = 'Eliminar';
            deleteBtn.setAttribute('aria-label', `Eliminar tarefa: ${task.name}`);
            deleteBtn.addEventListener('click', () => deleteTask(task.id));

            actionsDiv.appendChild(completeBtn);
            actionsDiv.appendChild(deleteBtn);
            li.appendChild(span);
            li.appendChild(actionsDiv);
            fragment.appendChild(li);
        });
        taskList.innerHTML = '';
        taskList.appendChild(fragment);
    }
    updateFilterButtons();
}

// Actualizar estilo dos botóns de filtro
function updateFilterButtons() {
    filterButtons.forEach(btn => {
        const filter = btn.dataset.filter;
        btn.classList.toggle('active', filter === currentFilter);
        btn.setAttribute('aria-pressed', filter === currentFilter);
    });
}

// Función para anunciar mensaxes a lectores de pantalla
function announce(message) {
    announcer.textContent = message;
    setTimeout(() => {
        announcer.textContent = ''; // Limpar despois de 2 segundos
    }, 2000);
}

// Engadir nova tarefa
function addTask(name) {
    if (!name.trim()) {
        announce('Non se pode engadir unha tarefa baleira.');
        return;
    }
    const newTask = {
        id: Date.now().toString(), // ID único baseado na data
        name: name.trim(),
        completed: false
    };
    tasks.push(newTask);
    saveTasks();
    renderTasks();
    announce(`Tarefa engadida: ${name}`);
}

// Cambiar estado completado/pendente
function toggleComplete(id) {
    const task = tasks.find(t => t.id === id);
    if (task) {
        task.completed = !task.completed;
        saveTasks();
        renderTasks();
        announce(task.completed ? `Tarefa completada: ${task.name}` : `Tarefa marcada como pendente: ${task.name}`);
    }
}

// Eliminar tarefa
function deleteTask(id) {
    const taskIndex = tasks.findIndex(t => t.id === id);
    if (taskIndex !== -1) {
        const taskName = tasks[taskIndex].name;
        tasks.splice(taskIndex, 1);
        saveTasks();
        renderTasks();
        announce(`Tarefa eliminada: ${taskName}`);
    }
}

// Cambiar filtro
function setFilter(filter) {
    currentFilter = filter;
    renderTasks();
    announce(`Mostrando tarefas: ${filter === 'all' ? 'todas' : filter === 'pending' ? 'pendentes' : 'completadas'}`);
}

// Eventos
taskForm.addEventListener('submit', (e) => {
    e.preventDefault(); // Impedir envío por defecto
    addTask(taskInput.value);
    taskInput.value = ''; // Limpar campo
    taskInput.focus(); // Devolver foco para mellor usabilidade
});

filterButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        setFilter(btn.dataset.filter);
    });
});

// Inicializar aplicación
loadTasks();

// Opcional: engadir listener para o botón "Limpar" se existise
```

**Criterios avaliados en JavaScript:**
- Uso de `localStorage` para persistencia.
- Creación dinámica de elementos DOM.
- Manexo de eventos (submit, click).
- Prevención do envío do formulario con `preventDefault()`.
- Uso de `setTimeout`? (só na función `announce`).
- Uso de `for...of`? (Aquí usamos `forEach` e `map`).
- Código limpo e comentado.
- Funcionalidade extra de filtrado implementada.

---

