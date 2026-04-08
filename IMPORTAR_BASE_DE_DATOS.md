# Cómo importar la base de datos

## Opción 1: Usar HeidiSQL (recomendado en Laragon)

1. Abre **HeidiSQL** desde el menú de Laragon
2. Conéctate con:
   - Host: localhost
   - Usuario: root
   - Contraseña: (dejar en blanco)
   - Puerto: 3306
3. Haz clic derecho en la conexión y selecciona "Create new" > "Database"
4. Ponle el nombre `cmsmvc` y haz clic en "OK"
5. Selecciona la base de datos `cmsmvc`
6. Ve a **Tools** > **Import SQL file**
7. Selecciona el archivo `cmsmvc.sql` que está en la carpeta del proyecto
8. Haz clic en "Open" para ejecutar el script

## Opción 2: Usar línea de comandos

1. Abre PowerShell o terminal
2. Ve a la carpeta del proyecto:
   ```powershell
   cd e:\laragon\www
   ```
3. Ejecuta:
   ```powershell
   mysql -u root cmsmvc < cmsmvc.sql
   ```

## Opción 3: Usar phpMyAdmin (si lo tienes)

1. Abre phpMyAdmin desde Laragon
2. Crea una base de datos llamada `cmsmvc`
3. Selecciona la base de datos
4. Haz clic en "Importar"
5. Selecciona el archivo `cmsmvc.sql`
6. Haz clic en "Continuar"

## Usuario por defecto

Después de importar, puedes acceder al admin con:
- Usuario: `admin`
- Contraseña: `admin123`

## Verificar

Una vez importada, recarga la página `http://localhost/public` y debería funcionar sin errores de base de datos.
