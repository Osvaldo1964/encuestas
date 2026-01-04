-- MIGRACIÓN DE RESPUESTAS - SCRIPT CORREGIDO CON IDs REALES
-- Este script asume que la tabla `answers` contiene datos con los IDs de pregunta "viejos"
-- y los actualizará a los "nuevos" IDs que me acabas de pasar.

-- 1. CREACIÓN DE LA RESPUESTA PARA LA NUEVA PREGUNTA 21 (ID 33 - Detalle Áreas Verdes)
-- Extraemos la info del JSON de la respuesta original ID 35 (que era la p20 vieja).
INSERT INTO `answers` (`id_hsurvey_answer`, `sequence_answer`, `id_bsurvey_answer`, `order_answer`, `type_answer`, `detail_answer`, `date_created_answer`, `date_updated_answer`)
SELECT 
    `id_hsurvey_answer`,
    `sequence_answer`,
    33, -- Nuevo ID para "DETALLE AREAS VERDES"
    21, -- Nuevo Orden
    5,  -- Tipo
    -- Limpieza del JSON para dejar solo FRENTE y FONDO
    REPLACE(
        REPLACE(
            REPLACE(`detail_answer`, '{"SI NO":"SI",', '{'),
            '{"SI NO":"NO",', '{'
        ),
        '{"SI NO":"SI NO",', '{'
    ),
    `date_created_answer`,
    NOW()
FROM `answers`
WHERE `id_bsurvey_answer` = 35; -- ID Viejo de Areas Verdes

-- 2. CORRECCIÓN DE LA PREGUNTA ÁREAS VERDES ORIGINAL (Viejo ID 35 -> Nuevo ID 32)
-- Primero limpiamos el contenido para que sea solo SI/NO
UPDATE `answers`
SET 
    `detail_answer` = CASE 
        WHEN `detail_answer` LIKE '%"SI NO":"SI"%' THEN 'SI'
        WHEN `detail_answer` LIKE '%"SI NO":"NO"%' THEN 'NO'
        ELSE 'NO'
    END,
    `type_answer` = 3 -- Ahora es Radio
WHERE `id_bsurvey_answer` = 35;

-- 3. MAPEO MASIVO DE IDs VIEJOS A NUEVOS
-- Actualizamos `id_bsurvey_answer` basándonos en tu tabla de equivalencias.

-- Pregunta 1 (Viejo 1 -> Nuevo 13)
UPDATE `answers` SET `id_bsurvey_answer` = 13 WHERE `id_bsurvey_answer` = 1;
-- Pregunta 2 (Viejo 6 -> Nuevo 14)
UPDATE `answers` SET `id_bsurvey_answer` = 14 WHERE `id_bsurvey_answer` = 6;
-- Pregunta 3 (Viejo 7 -> Nuevo 15)
UPDATE `answers` SET `id_bsurvey_answer` = 15 WHERE `id_bsurvey_answer` = 7;
-- Pregunta 4 (Viejo 8 -> Nuevo 16)
UPDATE `answers` SET `id_bsurvey_answer` = 16 WHERE `id_bsurvey_answer` = 8;
-- Pregunta 5 (Viejo 9 -> Nuevo 17)
UPDATE `answers` SET `id_bsurvey_answer` = 17 WHERE `id_bsurvey_answer` = 9;
-- Pregunta 6 (Viejo 10 -> Nuevo 18)
UPDATE `answers` SET `id_bsurvey_answer` = 18 WHERE `id_bsurvey_answer` = 10;
-- Pregunta 7 (Viejo 11 -> Nuevo 19)
UPDATE `answers` SET `id_bsurvey_answer` = 19 WHERE `id_bsurvey_answer` = 11;
-- Pregunta 8 (Viejo 12 -> Nuevo 20)
UPDATE `answers` SET `id_bsurvey_answer` = 20 WHERE `id_bsurvey_answer` = 12;
-- Pregunta 9 (Viejo 16 -> Nuevo 21) *** Ojo: El orden saltaba en la vieja
UPDATE `answers` SET `id_bsurvey_answer` = 21 WHERE `id_bsurvey_answer` = 16;
-- Pregunta 10 (Viejo 14 -> Nuevo 22)
UPDATE `answers` SET `id_bsurvey_answer` = 22 WHERE `id_bsurvey_answer` = 14;
-- Pregunta 11 (Viejo 15 -> Nuevo 23)
UPDATE `answers` SET `id_bsurvey_answer` = 23 WHERE `id_bsurvey_answer` = 15;
-- Pregunta 12 (Viejo 13 -> Nuevo 24)
UPDATE `answers` SET `id_bsurvey_answer` = 24 WHERE `id_bsurvey_answer` = 13;
-- Pregunta 13 (Viejo 17 -> Nuevo 25)
UPDATE `answers` SET `id_bsurvey_answer` = 25 WHERE `id_bsurvey_answer` = 17;
-- Pregunta 14 (Viejo 18 -> Nuevo 26)
UPDATE `answers` SET `id_bsurvey_answer` = 26 WHERE `id_bsurvey_answer` = 18;
-- Pregunta 15 (Viejo 19 -> Nuevo 27)
UPDATE `answers` SET `id_bsurvey_answer` = 27 WHERE `id_bsurvey_answer` = 19;
-- Pregunta 16 (Viejo 31 -> Nuevo 28)
UPDATE `answers` SET `id_bsurvey_answer` = 28 WHERE `id_bsurvey_answer` = 31;
-- Pregunta 17 (Viejo 32 -> Nuevo 29)
UPDATE `answers` SET `id_bsurvey_answer` = 29 WHERE `id_bsurvey_answer` = 32;
-- Pregunta 18 (Viejo 33 -> Nuevo 30)
UPDATE `answers` SET `id_bsurvey_answer` = 30 WHERE `id_bsurvey_answer` = 33;
-- Pregunta 19 (Viejo 34 -> Nuevo 31)
UPDATE `answers` SET `id_bsurvey_answer` = 31 WHERE `id_bsurvey_answer` = 34;

-- Pregunta 20 (Viejo 35 -> Nuevo 32)
-- NOTA IMPORTANTISIMA: Arriba ya procesamos los datos del ID 35. Ahora solo lo movemos al ID nuevo.
UPDATE `answers` SET `id_bsurvey_answer` = 32 WHERE `id_bsurvey_answer` = 35;

-- Pregunta 22 (Viejo 36 -> Nuevo 34) (USO INMUEBLE)
UPDATE `answers` SET `id_bsurvey_answer` = 34 WHERE `id_bsurvey_answer` = 36;

-- Pregunta 23 (Viejo 37 -> Nuevo 35) (MEDIDOR)
UPDATE `answers` SET `id_bsurvey_answer` = 35 WHERE `id_bsurvey_answer` = 37;

