Ce projet nécessite un serveur Web ainsi qu'une base de données SQL.

Script SQL Utilisé : 

-- Création des tables
CREATE TABLE IF NOT EXISTS profil_utilisateur (
    idUtilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nomUtilisateur VARCHAR(50),
    prenomUtilisateur VARCHAR(50),
    dateNaissanceUtilisateur DATE,
    emailUtilisateur VARCHAR(100),
    photoUtilisateur VARCHAR(255),
    sportFavoriUtilisateur INT,
    idAdresse INT
);

CREATE TABLE IF NOT EXISTS sports (
    idSport INT AUTO_INCREMENT PRIMARY KEY,
    nomSport VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS adresse (
    idAdresse INT AUTO_INCREMENT PRIMARY KEY,
    numAdresse INT,
    rueAdresse VARCHAR(100),
    codePostalAdresse VARCHAR(10),
    paysAdresse VARCHAR(50)
);

-- Insertion de données exemple
INSERT INTO sports (nomSport) VALUES 
('Football'),
('Basketball'),
('Tennis'),
('Rugby'),
('Escrime');

INSERT INTO adresse (numAdresse, rueAdresse, codePostalAdresse, paysAdresse) VALUES 
(123, 'Rue de Paris', '75001', 'France'),
(45, 'Boulevard Haussmann', '75008', 'France'),
(89, 'Avenue des Champs-Élysées', '75008', 'France');
(12, 'Avenue du Près', '75009', 'France');
(50, 'Rue des Chats', '75002', 'France');

INSERT INTO profil_utilisateur (nomUtilisateur, prenomUtilisateur, dateNaissanceUtilisateur, emailUtilisateur, photoUtilisateur, sportFavoriUtilisateur, idAdresse) VALUES 
('Dupont', 'Jean', '1990-01-01', 'jean.dupont@example.com', 'photo1.jpg', 1, 1),
('Martin', 'Marie', '1995-05-15', 'marie.martin@example.com', 'photo2.jpg', 2, 2),
('Durand', 'Paul', '1988-10-20', 'paul.durand@example.com', 'photo3.jpg', 3, 3),
('Naul', 'Nina', '1988-10-20', 'nina.naul@example.com', 'photo3.jpg', 3, 3),
('Fouillit', 'Louis', '1988-10-20', 'louis.fouillit@example.com', 'photo2.jpg', 5, 3);

