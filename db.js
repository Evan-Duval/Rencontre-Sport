const mysql = require('mysql2');

// Configuration de la base SQL
const db = mysql.createConnection({
    host: 'localhost',        // Vérifie l'hôte
    user: 'root',             // Nom d'utilisateur
    password: 'root',   // Mot de passe
    database: 'siterencontre', // Nom de la base
    port: 3306                // Port par défaut pour MySQL
  });  

// Test de connexion
db.connect(err => {
  if (err) {
    console.error('Erreur de connexion :', err.message);
    return;
  }
  console.log('Connecté à la base de données MySQL.');
});

module.exports = db;
