LOAD DATA LOCAL INFILE 'C:/xampp/htdocs/encuestas/carga_resto.csv'
INTO TABLE especiales
CHARACTER SET utf8
FIELDS TERMINATED BY ';'
OPTIONALLY ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 LINES
(
    id_especial,
    matr_especial,
    susc_especial,
    medi_especial,
    barr_especial,
    dire_especial,
    lati_especial,
    long_especial,
    estr_especial,
    tele_especial,
    email_especial,
    habi_especial,
    frec_especial,
    defr_especial,
    alma_especial,
    tial_especial,
    deal_especial,
    larg_especial,
    anch_especial,
    alto_especial,
    punt_especial,
    vivi_especial,
    devi_especial,
    tama_especial,
    cuar_especial,
    bani_especial,
    zona_especial,
    fren_especial,
    fond_especial,
    usos_especial,
    inst_especial,
    estado_especial
)
SET id_especial = NULL; -- Esto permite que MySQL genere nuevos IDs autoincrementales, evitando colisiones. Si quieres usar los IDs del CSV, elimina esta línea.
