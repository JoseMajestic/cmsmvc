# `localStorage`

**`localStorage`** é un obxecto do navegador web que permite almacenar **datos de forma persistente** no equipo do usuario, asociados a un dominio específico.

### Características principais:

- **Persistencia:** Os datos non teñen caducidade. Permanecen gardados mesmo despois de pechar o navegador ou reiniciar o ordenador, ata que o usuario ou a aplicación os eliminen manualmente.

- **Capacidade:** Adoita ter un límite de **5-10 MB** por dominio.

- **Formato:** Só almacena **cadeas de texto (strings)**. Para gardar obxectos ou arrays, é necesario convertilos a JSON con `JSON.stringify()` e recuperalos con `JSON.parse()`.

- **Acceso:** É accesible e modificable mediante JavaScript no lado do cliente.

- **Seguridade:** Non é seguro para datos sensibles (contrasinais, información persoal) porque os datos están sen cifrar e vulnerables a ataques XSS.

### Exemplo básico:
```javascript
// Gardar
localStorage.setItem('nome', 'Ana');

// Recuperar
const nome = localStorage.getItem('nome'); // "Ana"

// Eliminar
localStorage.removeItem('nome');
```

**Uso común:** Preferencias de usuario (tema escuro/claro), estado de aplicacións (carrito da compra, tarefas pendentes), caché de datos sinxelos.


Cal é o nivel de persistencia de localStorage, cal a súa capacidade e usos?

 Imos por partes para entender ben o `localStorage`, xá que é unha ferramenta que usamos no noso xestor de tarefas e é fundamental no desenvolvemento web.

### 💾 Nivel de Persistencia: Para sempre (se ti queres)

O **nivel de persistencia** do `localStorage` é, basicamente, **indefinido**. Isto significa que os datos que gardas aquí **non teñen data de caducidade** .

*   **Non desaparecen** cando o usuario pecha a pestana do navegador.
*   **Non desaparecen** cando o usuario pecha o navegador por completo.
*   **Non desaparecen** ao reiniciar o ordenador.

Os datos almacenados en `localStorage` permanecen no dispositivo ata que **o usuario os borre manualmente** (ben sexa a través da configuración do navegador, ou mediante unha funcionalidade da túa propia aplicación web). É como un pequeno almacén privado que o teu sitio web ten no ordenador do usuario.

**⚠️ Comparativa rápida:**
É importante non confundilo co `sessionStorage`. Este último é como un **post-it temporal** que só existe mentres a pestana do navegador está aberta. En canto a pechas, o `sessionStorage` bórrase automaticamente. O `localStorage` é para datos que queremos que estean sempre dispoñibles, como as preferencias de tema escuro/claro ou, como no noso exemplo, a lista de tarefas pendentes.

### 💽 Capacidade: Canto podemos gardar?

Aquí a resposta non é un número único, senón un **rango orientativo** que depende do navegador que estea a usar o teu usuario. As cifras máis comúns que atoparás son:

| **Navegador / Contexto**                              | **Capacidade Aproximada**                                       |
| :---------------------------------------------------- | :-------------------------------------------------------------- |
| **Maioría dos navegadores** (Chrome, Firefox, Safari) | **5 - 10 MB** por dominio/orixe                                 |
| **Límite estándar** (segundo a documentación de MDN)  | **10 MiB** (repartidos entre `localStorage` e `sessionStorage`) |
| **Navegadores móbiles / casos extremos**              | Pode ser inferior, arredor de **2 MB**                          |

**Que significa isto na práctica?**
É un espazo perfecto para gardar **preferencias de usuario**, **estado de aplicacións sinxelas** (como o noso xestor de tarefas), ou **pequenas cachés de datos**. Non está deseñado para almacenar grandes volumes de información, como imaxes ou documentos grandes. Para iso, existen tecnoloxías máis potentes como **IndexedDB**, que pode xestionar xigabytes de datos .

### 🛠️ Usos prácticos: Para que serve realmente?

O `localStorage` é un cabalo de batalla para mellorar a experiencia do usuario. Aquí tes algúns dos seus usos máis comúns e útiles:

*   **Gardar preferencias do usuario:** É o exemplo máis clásico. Podes gardar o tema (escuro/claro), o idioma escollido, ou o tamaño da letra preferido para que, cando o usuario volva, a páxina se adapte automaticamente ás súas preferencias .
    ```javascript
    // Gardar a preferencia de tema
    localStorage.setItem('theme', 'dark');
    
    // Ao cargar a páxina, ler a preferencia e aplicala
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        document.body.classList.add(savedTheme);
    }
    ```

*   **Manter o estado dunha aplicación:** Exactamente o que fixemos no noso xestor de tarefas. Permite que a lista de tarefas, ou o progreso nun formulario de varios pasos, non se perda aínda que o usuario peche o navegador sen querer .

*   **Carrito da compra:** En moitas tendas online, os artigos que engades ao carrito gárdanse en `localStorage`. Así, se saes da páxina e volves máis tarde, os produtos seguen alí, listos para finalizar a compra .

*   **Caché de datos (avanzado):** Podes gardar respostas de APIs para non ter que facer a mesma petición ao servidor unha e outra vez, sempre que os datos non cambien con frecuencia. Isto acelera a túa páxina e reduce a carga no servidor .

### ⚠️ Limitacións importantes a ter en conta

Antes de lanzarte a usar `localStorage` para todo, é fundamental que coñezas as súas limitacións:

*   **Só almacena texto:** O `localStorage` só pode gardar **cadeas de texto (strings)**. Se queres gardar un obxecto ou un array (como a nosa lista de tarefas), tes que convertelo a texto usando `JSON.stringify()` ao gardalo, e despois convertelo de volta a obxecto con `JSON.parse()` ao lelo .
*   **Non é seguro para datos sensibles:** **NUNCA** gardes contrasinais, números de tarxeta de crédito ou información persoal moi sensible en `localStorage`. Os datos non están cifrados e son accesibles a través de JavaScript, o que os fai vulnerables a ataques **XSS (Cross-Site Scripting)** .
*   **Operacións síncronas:** As operacións de lectura e escritura en `localStorage` son **síncronas**. Isto significa que se intentas gardar ou ler unha cantidade de datos moi grande (acercándote ao límite), a páxina web pode quedar "bloqueada" por un momento, afectando ao rendemento e á experiencia do usuario .

En resumo, `localStorage` é unha ferramenta incriblemente útil e sinxela para **persistir pequenas cantidades de datos non sensibles** no navegador, mellorando a continuidade e a personalización da experiencia de usuario.