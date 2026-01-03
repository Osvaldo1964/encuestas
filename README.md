# Sistema de Encuestas y Votaciones

Este repositorio contiene el código fuente para el **Sistema de Encuestas**, una aplicación web integral diseñada para la recolección, administración y análisis de datos de encuestas y reportes electorales.

## Estructura del Proyecto

El proyecto está dividido en dos componentes principales y el sitio público:

### 1. Aplicación Principal (`app-encuestas`)
Contiene el frontend y la lógica de negocio de la interfaz administrativa.
- **Tecnologías:** PHP, HTML5, CSS3 (Tema Custom Viridian), JavaScript (Vanilla + DataTables).
- **Funcionalidades Clave:**
  - Login seguro.
  - Módulo de **Registro de Encuestas**: Formulario dinámico con validación estricta y soporte para preguntas compuestas.
  - Módulo de **Informes (Infencuestas)**: 
    - Tablas dinámicas con pivoteo de datos para ver respuestas por columna.
    - Exportación a Excel y PDF.
    - **Edición integrada:** Permite modificar las respuestas de los encuestados directamente desde el reporte.

### 2. API Backend (`api-encuestas`)
Provee los endpoints para la comunicación de datos.
- **Tecnologías:** PHP (Estructura MVC RESTful).
- **Funcionalidades:**
  - Autenticación y manejo de sesiones.
  - CRUD de encuestas y respuestas.
  - Recepción de PQRs desde la Landing Page.

### 3. Landing Page (`root`)
El punto de entrada público para el sistema.
- **Ubicación:** `index.php` en la raíz.
- **Características:** Diseño responsivo, información corporativa y formulario de contacto.

## Requisitos de Instalación

1. **Servidor Web:** Apache (recomendado XAMPP/Laragon en Windows).
2. **Base de Datos:** MySQL / MariaDB.
3. **PHP:** Versión 7.4 o superior.

## Configuración Inicial

1. **Base de Datos:**
   - Importe el archivo `db-encuestas.sql` en su gestor de base de datos.
   
2. **Conexión:**
   - Verifique y configure las credenciales de base de datos en los archivos de configuración de la API y la App (usualmente en `Config/Config.php` o `Libraries/Core/Conexion.php`).

3. **Despliegue Local:**
   - Asegúrese de que el proyecto esté alojado en la raíz de su servidor local o configure un Virtual Host.
   - URL Base sugerida: `http://localhost/encuestas/`

## Estado del Proyecto

El estado actual del desarrollo y las tareas pendientes se detallan en el archivo [PROJECT_STATUS.md](./PROJECT_STATUS.md).

### Resumen de Estado (Enero 2026)
- **Diseño:** Paleta de colores unificada (Viridian `#40826D`).
- **Módulos Activos:** 
  - Login.
  - Registro de Encuestas.
  - Informe de Encuestas (con Edición Integrada).
  - Gráficos de Encuestas.
- **En Desarrollo:** Reporte InfRegistro.

## Contribución

Por favor, revise `PROJECT_STATUS.md` antes de comenzar nuevas tareas para evitar duplicidad de esfuerzos.
