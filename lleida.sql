USE lleida;

CREATE TABLE naturaleses (
    id INT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    UNIQUE KEY (nom)
) CHARSET=utf8mb4;

CREATE TABLE titularitats (
    id INT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    UNIQUE KEY (nom)
) CHARSET=utf8mb4;

CREATE TABLE delegacions (
    id INT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    UNIQUE KEY(nom)
) CHARSET=utf8mb4;

CREATE TABLE comarques (
    id INT PRIMARY KEY,
    delegacio_id INT NOT NULL,
    nom VARCHAR(255) NOT NULL,
    UNIQUE KEY(nom),
    FOREIGN KEY delegacio_key (delegacio_id) REFERENCES delegacions(id)
) CHARSET=utf8mb4;

CREATE TABLE municipis (
    id VARCHAR(5) PRIMARY KEY,
    comarca_id INT NOT NULL,
    nom VARCHAR(255) NOT NULL,
    UNIQUE KEY(nom),
    FOREIGN KEY comarca_key (comarca_id) REFERENCES comarques(id)
) CHARSET=utf8mb4;

CREATE TABLE districtes (
    id VARCHAR(2) PRIMARY KEY,
    municipi_id VARCHAR(5) NOT NULL,
    nom VARCHAR(255) NOT NULL,
    UNIQUE KEY(nom),
    FOREIGN KEY municipi_key (municipi_id) REFERENCES municipis(id)
) CHARSET=utf8mb4;

CREATE TABLE localitats (
    id VARCHAR(2) PRIMARY KEY,
    municipi_id VARCHAR(5) NOT NULL,
    nom VARCHAR(255),
    UNIQUE KEY(nom),
    FOREIGN KEY municipi_key2 (municipi_id) REFERENCES municipis(id)
) CHARSET=utf8mb4;

CREATE TABLE estudis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codi VARCHAR(8),
    nom VARCHAR(255),
    UNIQUE KEY(codi)
) CHARSET=utf8mb4;

CREATE TABLE centres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codi VARCHAR(8) NOT NULL,
    denominacio_completa VARCHAR(255) NOT NULL,
    naturalesa_id INT NOT NULL,
    titularitat_id INT NOT NULL,
    adreca VARCHAR(255) NOT NULL,
    codi_postal VARCHAR(5) NOT NULL,
    telefon VARCHAR(12) NOT NULL,
    fax VARCHAR(12) NOT NULL,
    municipi_id VARCHAR(5) NOT NULL,
    districte_id VARCHAR(2),
    localitat_id VARCHAR(2),
    zona_educativa VARCHAR(255),
    coordenades_utm_x FLOAT NOT NULL,
    coordenades_utm_y FLOAT NOT NULL,
    coordenades_geo_x FLOAT NOT NULL,
    coordenades_geo_y FLOAT NOT NULL,
    email_centre VARCHAR(255) NOT NULL,
    UNIQUE KEY (codi),
    FOREIGN KEY municipi_key3 (municipi_id) REFERENCES municipis(id),
    FOREIGN KEY districte_key (districte_id) REFERENCES districtes(id),
    FOREIGN KEY localitat_key (localitat_id) REFERENCES localitats(id),
    FOREIGN KEY naturalesa_key (naturalesa_id) REFERENCES naturaleses(id),
    FOREIGN KEY titularitat_key (titularitat_id) REFERENCES titularitats(id)
) CHARSET=utf8mb4;

CREATE TABLE estudis_centres (
    centre_id INT NOT NULL,
    estudi_id VARCHAR(255),
    PRIMARY KEY (centre_id, estudi_id)
) CHARSET=utf8mb4;
