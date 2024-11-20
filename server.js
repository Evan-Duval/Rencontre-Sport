const express = require('express');
const app = express();
const port = 3000; // Choisis un port

app.get('/', (req, res) => {
    res.send('Bienvenue sur mon site de rendez-vous sportifs !');
});

app.listen(port, () => {
    console.log(`Serveur démarré sur http://localhost:${port}`);
});

const mysql = require('mysql');

const db = mysql.createConnection({
    host: 'localhost',
    user: 'root', // Remplace par ton utilisateur MySQL
    password: '', // Ton mot de passe
    database: 'nom_de_ta_base' // Remplace par le nom de ta base
});

db.connect((err) => {
    if (err) {
        console.error('Erreur de connexion à MySQL :', err);
        return;
    }
    console.log('Connecté à la base MySQL');
});

app.get('/data', (req, res) => {
    db.query('SELECT * FROM table_exemple', (err, results) => {
        if (err) {
            res.status(500).send('Erreur lors de la récupération des données');
            return;
        }
        res.json(results);
    });
});

