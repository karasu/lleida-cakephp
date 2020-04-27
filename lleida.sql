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

INSERT INTO `estudis`(`codi`, `nom`) VALUES ('EINF1C', 'Educació infantil de 1r cicle');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('EINF2C', 'Educació infantil de 2n cicle');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('EPRI', 'Educació primària');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('EE', 'Educació especial');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('IFE', 'Itineraris formatius específics');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('ESO', 'Educació secundària obligatòria');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('BATX', 'Batxillerat');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('AA01', 'Curs d’accés als cicles formatius de grau mitjà');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('CFPM', 'Cicles formatius professionals de grau mitjà');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('PPAS', 'Curs de preparació a la prova d’accés de cicles formatius professionals de grau superior');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('AA03', 'Curs d’accés als cicles formatius de grau superior');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('CFPS', 'Cicles formatius professionals de grau superior');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('PFI', 'Programes de formació i inserció');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('PA01', 'Cicles formatius d’arts de grau mitjà');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('CFAM', 'Cicles formatius d’arts plàstiques i disseny de grau mitjà');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('PA02', 'Cicles formatius d’arts de grau superior');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('CFAS', 'Cicles formatius d’arts plàstiques i disseny de grau superior');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('ESDI', 'Ensenyaments superiors de disseny');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('ADR', 'Ensenyaments superiors d’art dramàtic');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('CRBC', 'Ensenyaments superiors de conservació i restauració de bens culturals');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('IDI', 'Ensenyaments d’idiomes');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('DANE', 'Escoles de dansa (no reglat)');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('DANP', 'Grau professional de dansa');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('DANS', 'Grau superior de dansa');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('MUSE', 'Escoles de música (no reglat)');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('MUSP', 'Grau professional de música');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('MUSS', 'Grau superior de música');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('TEGM', 'Tècnics esportius de grau mitjà');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('TEGS', 'Tècnics esportius de grau superior');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('ESTR', 'Ensenyaments estrangers');
INSERT INTO `estudis`(`codi`, `nom`) VALUES ('ADULTS', 'Formació de persones adultes');
