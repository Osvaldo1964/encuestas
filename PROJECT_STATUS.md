# Estado del Proyecto - Sistema de Encuestas

## Última Actualización: 07 de Enero de 2026

### 1. Diseño y Estética (UI/UX)
**Estado:** Actualizado a Paleta Viridian (`#40826D`).
- **Login:** Meta etiqueta `theme-color` y estados de botones corregidos.
- **Global:** Versión de CSS actualizada para refrescar caché.

### 2. Landing Page (Sitio Web Principal)
**Estado:** ¡Creado! (`index.php` en raíz).
- **Ruta:** `http://localhost/encuestas/`
- **Secciones:** Hero, Servicios, Empresa, PQR (Formulario), Acceso Admin.
- **Diseño:** Alineado con tema Viridian.

### 3. Módulo de Registro (`Registro`)
**Estado:** ¡Finalizado y Optimizado!
- **Diseño (UI):** 
  - Rediseño estilo "Hoja Compacta" centrada para mejor legibilidad.
  - Separación del selector de encuestas en tarjeta independiente.
  - Tipografía refinada y uso de clases CSS semánticas para evitar estilos inline.
- **Experiencia (UX):**
  - **Flujo Secuencial:** Al guardar, se mantiene la encuesta seleccionada para permitir una captura de datos rápida y continua.
  - **Foco Automático:** El cursor se posiciona automáticamente en el primer campo tras guardar.
  - **Inputs Dinámicos:** Los campos "Otro" se habilitan/deshabilitan correctamente según la selección.

### 4. Módulo de Informes (`Infencuestas`)
**Estado:** Funcional, Seguro y Completo.
- **Acciones y Permisos:**
  - Inyección de permisos (`r, w, u, d`) desde PHP hacia la vista JS.
  - Botón **Editar**: Solo visible si el usuario tiene permiso de actualización (`u_permiso`).
  - Botón **Eliminar**: Implementado y solo visible si tiene permiso de borrado (`d_permiso`).
  - Validación de seguridad en Backend API para el endpoint de eliminación.
- **Funcionalidad:**
  - Migración de datos, filtros y exportación (Excel/PDF) testeados.

### 5. Auditoría y Refactorización Técnica (API & Core)
**Estado:** ¡Optimizado!
- **Estandarización API:** Todos los controladores nuevos (`Registro`, `Infencuestas`, `Grafencuestas`) unificados para usar el helper `jsonResponse()` (headers y estructura consistente).
- **CORS Global:** Implementado manejo centralizado de peticiones PREFLIGHT (`OPTIONS`) en `Libraries/Core/Controllers.php`, solucionando problemas de CORS en toda la API por herencia.
- **Sesiones:** Unificado el manejo de sesiones en Frontend usando `sessionUser()` helper.

### 6. Módulo de Gráficos (`Grafencuestas`)
**Estado:** ¡Finalizado!
- **Funcionalidad:**
  - Visualización interactiva con Chart.js (Barras, Pastel, Donas, etc.).
  - Filtros dinámicos por Encuesta y Pregunta.
  - Exportación a CSV e Impresión de gráficos.

### 7. Módulo Especiales (`Especiales`)
**Estado:** ¡Completado y Refinado! (Enero 2026)
- **Funcionalidad:**
  - Gestión completa (CRUD) de la tabla `especiales`.
  - **Formulario Inteligente:** 
    - Todos los campos de texto libre convertidos a Selects controlados (Habitantes, Usos, Baños, etc.).
    - Lógica JS para campos dependientes ("Otro", "Zonas Verdes -> Frente/Fondo").
  - **UI/UX:** Diseño "Compacto" (font 0.75rem), Modal con scroll interno y botones centrados.
  - **Base de Datos:** Optimización de tipos de datos (`INT` -> `VARCHAR`) y limpieza de inconsistencias (`RESID--`).
  - **Seguridad:** Integrado con sistema de permisos (ID Módulo: 9).

## Tareas Pendientes / Próximos Pasos (Enero 2026)
1. **Validación PQR:** Asegurar que el endpoint `/Contacto/enviar` en la API esté operativo.
2. **Reporte InfRegistro:** Implementación del reporte de auditoría de registros.
