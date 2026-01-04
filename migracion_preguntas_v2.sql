-- Limpiar preguntas existentes para esta encuesta (ID 2 según el volcado original)
-- ADVERTENCIA: Esto borrará las preguntas existentes de la encuesta 2.
-- Si prefieres agregar nuevas, comenta la siguiente línea.
DELETE FROM `bsurveys` WHERE `id_hsurvey_bsurvey` = 2;

-- Reiniciar el AUTO_INCREMENT si se desea (opcional, depende del gestor)
-- ALTER TABLE `bsurveys` AUTO_INCREMENT = 1;

-- Inserción de Preguntas Optimizadas para el Nuevo Sistema
INSERT INTO `bsurveys` (`id_hsurvey_bsurvey`, `order_bsurvey`, `name_bsurvey`, `type_bsurvey`, `detail_bsurvey`, `status_bsurvey`, `date_created_bsurvey`) VALUES
-- 1. Datos Básicos (Tipo 1: Texto)
(2, 1, 'NOMBRE DEL ENCUESTADO', 1, '', 'Activo', NOW()),
(2, 2, 'NUMERO MATRICULA', 1, '', 'Activo', NOW()),
(2, 3, 'NOMBRE DEL BARRIO', 1, '', 'Activo', NOW()),
(2, 4, 'DIRECCION', 1, '', 'Activo', NOW()),
(2, 5, 'NUMERO DE TELEFONO', 1, '', 'Activo', NOW()),
(2, 6, 'CORREO ELECTRONICO', 1, '', 'Activo', NOW()),
(2, 7, 'UBICACION - LATITUD', 1, '', 'Activo', NOW()),
(2, 8, 'UBICACION - LONGITUD', 1, '', 'Activo', NOW()),

-- 9. Personas en el hogar (Tipo 3: Radio)
(2, 9, 'CUANTAS PERSONAS RESIDEN EN EL HOGAR', 3, '[
    {"orden":"1","nombre":"1"},
    {"orden":"2","nombre":"2 A 3"},
    {"orden":"3","nombre":"4 A 5"},
    {"orden":"4","nombre":"6"},
    {"orden":"5","nombre":"MAS DE 6"}
]', 'Activo', NOW()),

-- 10. Nivel Socio Económico (Tipo 3: Radio)
(2, 10, 'NIVEL SOCIO ECONOMICO', 3, '[
    {"orden":"1","nombre":"estrato 1"},
    {"orden":"2","nombre":"estrato 2"},
    {"orden":"3","nombre":"estrato 3"},
    {"orden":"4","nombre":"comercial"},
    {"orden":"5","nombre":"institucional"}
]', 'Activo', NOW()),

-- 11. Frecuencia Servicio (Tipo 3: Radio)
(2, 11, 'FRECUENCIA DEL SERVICIO', 3, '[
    {"orden":"1","nombre":"diaria"},
    {"orden":"2","nombre":"2 dias a la semana"},
    {"orden":"3","nombre":"una vez a la semana"},
    {"orden":"4","nombre":"quincenal"},
    {"orden":"5","nombre":"mensual"}
]', 'Activo', NOW()),

-- 12. Almacenamiento (Tipo 3: Radio)
(2, 12, 'CUENTA CON SISTEMA DE ALMACENAMIENTO', 3, '[
    {"orden":"1","nombre":"si"},
    {"orden":"2","nombre":"no"}
]', 'Activo', NOW()),

-- 13. Tipo Almacenamiento (Tipo 3: Radio con "Otros" activo)
-- Se agregó "has_input": true a la opción OTROS para activar la caja de texto.
(2, 13, 'EN CASO AFIRMATIVO - ESCOJA EL TIPO', 3, '[
    {"orden":"1","nombre":"ALBERCA SUBTERRANEA"},
    {"orden":"2","nombre":"TANQUE ELEVADO"},
    {"orden":"3","nombre":"OTROS", "has_input": true}
]', 'Activo', NOW()),

-- 14. Capacidad (Tipo 5: Compuesta - Inputs múltiples)
-- Generará 3 inputs etiquetados Largo, Ancho, Alto
(2, 14, 'CAPACIDAD DE ALMACENAMIENTO', 5, '[
    {"orden":"largo","nombre":"largo"},
    {"orden":"ancho","nombre":"ancho"},
    {"orden":"alto","nombre":"alto"}
]', 'Activo', NOW()),

-- 15. Puntos Hidráulicos (Tipo 1: Texto/Numérico)
(2, 15, 'CANTIDAD DE PUNTOS HIDRAULICOS', 1, '', 'Activo', NOW()),

-- 16. Tipo Vivienda (Tipo 3: Radio con "Otros" activo)
(2, 16, 'EN QUE TIPO DE VIVIENDA RESIDE', 3, '[
    {"orden":"1","nombre":"CASA UNIFAMILIAR"},
    {"orden":"2","nombre":"APARTAMENTO"},
    {"orden":"3","nombre":"CASA LOTE"},
    {"orden":"4","nombre":"MEJORA"},
    {"orden":"5","nombre":"OTRO", "has_input": true}
]', 'Activo', NOW()),

-- 17. Tamaño (Tipo 1: Texto/Numérico)
(2, 17, 'TAMAÑO DEL INMUEBLE EN M2', 1, '', 'Activo', NOW()),

-- 18. Habitaciones (Tipo 3: Radio)
(2, 18, 'NUMERO DE HABITACIONES', 3, '[
    {"orden":"1","nombre":"UNA"},
    {"orden":"2","nombre":"DOS"},
    {"orden":"3","nombre":"TRES"},
    {"orden":"4","nombre":"MAS DE TRES"}
]', 'Activo', NOW()),

-- 19. Baños (Tipo 3: Radio)
(2, 19, 'NUMERO DE BAÑOS', 3, '[
    {"orden":"1","nombre":"UNO"},
    {"orden":"2","nombre":"DOS"},
    {"orden":"3","nombre":"TRES"},
    {"orden":"4","nombre":"MAS DE TRES"}
]', 'Activo', NOW()),

-- 20. Áreas Verdes (Tipo 3: Radio SI/NO)
-- Modificación: Se dividió la pregunta original. Ahora esta solo pregunta SI o NO.
(2, 20, 'POSEE AREAS VERDES COMO ANTEJARDIN O PATIO', 3, '[
    {"orden":"1","nombre":"SI"},
    {"orden":"2","nombre":"NO"}
]', 'Activo', NOW()),

-- 21. Detalle Áreas Verdes (Tipo 5: Compuesta)
-- Nueva pregunta desglozada para detalles Frente/Fondo.
(2, 21, 'DETALLE AREAS VERDES (M2)', 5, '[
    {"orden":"FRENTE","nombre":"FRENTE"},
    {"orden":"FONDO","nombre":"FONDO"}
]', 'Activo', NOW()),

-- 22. Uso Inmueble (Tipo 3: Radio con "Otros" activo)
-- Re-enumerado de 21 a 22
(2, 22, 'USO DEL INMUEBLE', 3, '[
    {"orden":"1","nombre":"RESIDENCIAL"},
    {"orden":"2","nombre":"COMERCIAL"},
    {"orden":"3","nombre":"INDUSTRIAL"},
    {"orden":"4","nombre":"INSTITUCIONAL"},
    {"orden":"5","nombre":"OTRO", "has_input": true}
]', 'Activo', NOW()),

-- 23. Instalación Medidor (Tipo 3: Radio)
-- Re-enumerado de 22 a 23
(2, 23, 'ESTA DE ACUERDO CON QUE SE LE INSTALE MEDIDOR', 3, '[
    {"orden":"1","nombre":"SI"},
    {"orden":"2","nombre":"NO"}
]', 'Activo', NOW());
