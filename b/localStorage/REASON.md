Imos ver como explicar a solución paso a paso, coma se estivésemos a pensar en voz alta mentres programamos. O importante é que entendades **por que** facemos cada cousa, non só **que** facemos.

---

## Como abordar o problema: un xestor de tarefas

O enunciado pide unha aplicación que:
- Mostre unha lista de tarefas.
- Permita engadir tarefas (cun formulario).
- Permita marcalas como completadas e eliminalas.
- Garde os datos no navegador (localStorage).
- Sexa accesible e responsiva.

### 1. Que necesitamos? Análise do problema

Antes de escribir unha liña de código, pensemos:

- **Datos:** Cada tarefa terá un nome, un estado (completada ou non) e un identificador único (para poder referirnos a ela).
- **Interfaz:** Un lugar para escribir a nova tarefa, un botón para engadir, e a lista onde aparecen.
- **Comportamento:** Cando alguén faga clic en "Completar", a tarefa debe riscarse e cambiar o seu estado. Cando faga clic en "Eliminar", debe desaparecer. Todo isto debe gardarse para que ao recargar a páxina, as tarefas sigan aí.
- **Extras (opcionais):** Filtros para ver todas, pendentes ou completadas.

Agora imos ver como levar isto á práctica, explicando cada decisión.

---

## Fase 1: Construír a base con HTML semántico

### Por que usamos etiquetas semánticas?

Cando facemos HTML, non é só para que se vexa bonito. É para que o navegador, os motores de busca e as ferramentas de accesibilidade (como lectores de pantalla) entendan a estrutura da páxina.

- `<header>`: Indica que aquí está a cabeceira da páxina. Normalmente leva o título.
- `<main>`: A zona principal do contido. Só pode haber unha por páxina.
- `<section>`: Agrupa contido relacionado. Usámola para separar o formulario, os filtros e a lista.
- `<footer>`: O pé de páxina.

Se usásemos todo con `<div>`, a páxina funcionaría, pero sería como unha casa sen habitacións diferenciadas: todo é un mesmo espazo. Os lectores de pantalla non saberían que é importante e que non.

### Por que asociamos o `<label>` co `<input>`?

No formulario temos:
```html
<label for="new-task">Nome da tarefa:</label>
<input type="text" id="new-task" ...>
```

O atributo `for` do label coincide co `id` do input. Isto fai que:
- Se fas clic no texto "Nome da tarefa:", o cursor vaise directamente ao campo de texto. Isto é bo para usabilidade, especialmente en móbiles.
- Os lectores de pantalla len o label cando o usuario chega ao input, así saben que teñen que escribir alí.

### Por que poñemos `required` e `aria-required="true"`?

- `required` é un atributo HTML5 que impide enviar o formulario se o campo está baleiro. Isto é validación do lado do cliente, e funciona sen JavaScript.
- `aria-required="true"` é un atributo ARIA que lles di aos lectores de pantalla que este campo é obrigatorio. Aínda que `required` xa fai que o navegador impida o envío, non todos os lectores de pantalla o anuncian automaticamente. Así garantimos accesibilidade.

### Por que usamos `aria-live`?

```html
<div aria-live="polite" id="announcer" class="visually-hidden"></div>
```

Isto é unha rexión "viva". Cando cambiemos o texto dentro deste div, os lectores de pantalla anunciarán ese cambio ao usuario. Úsase para notificar, por exemplo, "Tarefa engadida" ou "Tarefa eliminada". A clase `visually-hidden` fai que non se vexa visualmente, pero os lectores de pantalla si o len.

### Por que poñemos `class="visually-hidden"` nalgúns títulos?

```html
<h2 id="form-heading" class="visually-hidden">Engadir nova tarefa</h2>
```

Este título non o vemos na pantalla, pero está para que os lectores de pantalla poidan identificar a sección. O atributo `aria-labelledby` no `<section>` apunta a este título, dando un nome á sección. É como poñer etiquetas invisibles que só len as máquinas.

---

## Fase 2: Dar estilo con CSS responsivo

### Por que usamos Flexbox?

Flexbox é ideal para maquetar elementos nunha soa dirección (fila ou columna). No formulario queremos que o input e o botón estean en fila, pero que se adapten. Con `display: flex` e `flex-wrap: wrap`, conseguimos que en pantallas grandes estean en horizontal e en pequenas se apilen.

### Por facemos unha media query para móbil?

```css
@media (max-width: 600px) {
    .task-item {
        flex-direction: column;
    }
}
```

Nun móbil, a pantalla é estreita. Se deixamos os botóns ao lado do texto, poden non caber. Ao poñer `flex-direction: column`, cada tarefa convértese nun bloque vertical: o nome enriba e os botóns debaixo. Así é máis usable.

### Por que estilamos o `:focus`?

```css
.task-actions .complete-btn:focus {
    outline: 2px solid #1e8449;
}
```

Cando un usuario navega co teclado (usando a tecla TAB), os elementos que reciben o foco deben ter un indicador visual. Por defecto, os navegadores poñen un bordo azul, pero ás veces non se ve ben. Nós reforzámolo cun outline para que quede claro onde está o foco. Isto é accesibilidade pura.

### Por que eliximos estas cores?

Comprobamos que o contraste entre o texto e o fondo sexa suficiente. Por exemplo, texto branco sobre fondo azul escuro (`#3498db` e branco) ten bo contraste. Se usásemos amarelo claro sobre branco, sería ilexible. Hai ferramentas como a extensión Lighthouse de Google que nos avisan se o contraste é insuficiente.

---

## Fase 3: Dar vida con JavaScript

### Por que gardamos as tarefas nun array de obxectos?

```javascript
let tasks = [];
// Cada tarefa: { id: "12345", name: "Mercar pan", completed: false }
```

Usamos un array porque é doado de percorrer e modificar. Cada tarefa é un obxecto porque ten varias propiedades (nome, estado, id). O id é importante para identificar unha tarefa de forma única, xa que pode haber dúas co mesmo nome.

### Por que usamos `localStorage`?

Porque queremos que as tarefas persistan entre recargas da páxina. O localStorage garda datos no ordenador do usuario, en forma de texto. Convertemos o array a texto con `JSON.stringify()` para gardalo, e cando o recuperamos, facemos `JSON.parse()` para volver a ter un array.

É unha solución sinxela sen necesidade de backend.

### Por que facemos `renderTasks()` cada vez que cambia algo?

A función `renderTasks()` encárgase de pintar a lista na pantalla segundo os datos actuais e o filtro escollido. Chamámola despois de:
- Engadir tarefa
- Cambiar estado
- Eliminar tarefa
- Cambiar filtro

Isto asegura que a vista reflicta sempre o estado actual. É o patrón "reactivo" básico: os datos son a fonte de verdade, e a vista é un reflexo deles.

### Por que usamos `preventDefault()` no formulario?

```javascript
taskForm.addEventListener('submit', (e) => {
    e.preventDefault();
    // ...
});
```

Cando un formulario se envía, por defecto o navegador recarga a páxina (ou vai a outra URL). Nós non queremos iso, queremos quedar na mesma páxina e engadir a tarefa con JavaScript. `preventDefault()` cancela o comportamento por defecto.

### Por que creamos unha función `announce`?

```javascript
function announce(message) {
    announcer.textContent = message;
    setTimeout(() => { announcer.textContent = ''; }, 2000);
}
```

Esta función mete unha mensaxe no div con `aria-live`. Os lectores de pantalla lean ese texto automaticamente. Despois de 2 segundos, limpámolo para que non se acumulen mensaxes. É unha forma de comunicar cambios a persoas con discapacidade visual.

### Por que usamos `dataset` nos botóns de filtro?

```html
<button data-filter="all">Todas</button>
```

O atributo `data-*` permite gardar información personalizada no HTML. En JavaScript, accedemos con `btn.dataset.filter`. É máis limpo que usar `id` ou `class` para este propósito.

---

## Fase 4: Accesibilidade e usabilidade final

### Por que revisamos a orde do foco?

Cando prememos TAB, o cursor debe moverse na orde lóxica: primeiro o campo de texto, despois o botón de engadir, despois os filtros, e despois os botóns de cada tarefa. No noso HTML, esta orde é natural, pero se usásemos `float` ou posicións absolutas, podería desordenarse. Por iso usamos Flexbox, que mantén a orde do DOM.

### Por que poñemos `aria-label` nos botóns?

```html
<button aria-label="Eliminar tarefa: Mercar pan">Eliminar</button>
```

Os lectores de pantalla len o texto do botón. Se só di "Eliminar", o usuario pode non saber que tarefa vai eliminar. Con `aria-label` engadimos contexto extra. É invisible visualmente, pero os lectores de pantalla len "Eliminar tarefa: Mercar pan".

### Por que comprobamos o contraste?

Un usuario con baixa visión pode non ver texto claro sobre fondo claro. Ferramentas como Lighthouse dan unha puntuación de contraste. No noso CSS, asegurámonos de que as cores cumpran as directrices WCAG (polo menos 4.5:1 para texto normal).

---

## Conclusión: o porqué de todo

Cada decisión que tomamos ten un motivo:
- **Semántica**: para que as máquinas entendan.
- **Accesibilidade**: para que persoas con discapacidade poidan usar a web.
- **Responsividade**: para que funcione en móbiles.
- **Persistencia**: para que os datos non se perdan.
- **Código limpo**: para que sexa fácil de modificar e entender.

Non hai un único camiño, pero este é un camiño que cumpre todos os requisitos (e ademais é didáctico). O importante é que vos acostumedes a preguntar: "Por que fago isto? Que problema resolve?" Así deixaredes de ser "copy-paste" e empezaredes a ser programadores de verdade.