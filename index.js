const express = require('express');
const db = require('./db'); // Connexion à la base SQL
const path = require('path');

const app = express();
app.set('view engine', 'ejs');          // Utiliser EJS pour les templates
app.set('views', path.join(__dirname, 'views')); // Dossier des templates
app.use(express.static('public'));     // Dossier des fichiers statiques

// Route principale
app.get('/', (req, res) => {
  res.render('index', { titre: 'Accueil' });
});

// Route pour afficher les utilisateurs
app.get('/utilisateurs', (req, res) => {
  const sql = 'SELECT * FROM utilisateurs';
  db.query(sql, (err, results) => {
    if (err) {
      console.error(err);
      res.status(500).send('Erreur de base de données');
      return;
    }
    res.render('utilisateurs', { utilisateurs: results });
  });
});

// Lancer le serveur
const PORT = 3000;
app.listen(PORT, () => {
  console.log(`Serveur démarré sur http://localhost:${PORT}`);
});
