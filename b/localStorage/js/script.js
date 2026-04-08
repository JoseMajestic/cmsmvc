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