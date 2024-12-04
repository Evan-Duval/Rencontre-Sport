<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportEvents</title>
    <link rel="stylesheet" href='accueilstyle.css'>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">S'inscrire</a></li>
                <li><a href="stats/statistiques.php">Statistiques</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>

            <form action="accueil.php" method="GET">
                <label for="triListe">Trier par</label>
                <select name="triListe" id="triListe">
                    <option value="">Aucun</option>
                    <option value="triNom">Noms</option>
                    <option value="triPrénom">Prénoms</option>
                    <option value="triAge">Âges</option>
                </select>

                <select name="ordreTri" id="ordreTri">
                    <option value="">Aucun Ordre</option>
                    <option value="asc">Croissant</option>
                    <option value="desc">Décroissant</option>
                </select>

                <label for="barreDeRecherche">Filtres :</label>
                <input type="text" name="barreDeRecherche" placeholder="Rechercher">
                <select name="triSport">
                    <option value="">Tous les sports</option>
                    <option value="1">Football</option>
                    <option value="2">Basket</option>
                    <option value="3">Tennis</option>
                    <option value="4">Rugby</option>
                    <option value="5">Escrime</option>
                </select>

                <button type="submit">Appliquer</button>
            </form> <br>

        </section>

        <table class="listeUtilisateurs">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Âge</th>
                    <th>Email</th>
                    <th>Sport Favoris</th>
                    <th>Adresse</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include 'sqlconnexions.php';

                foreach ($utilisateurs as $utilisateur): 
                    // Calculer l'âge à partir de la date de naissance
                    $dateNaissance = new DateTime($utilisateur['dateNaissanceUtilisateur']);
                    $aujourdhui = new DateTime();
                    $age = $aujourdhui->diff($dateNaissance)->y;
            ?>
            <tr>
                <td><?php echo htmlspecialchars($utilisateur['nomUtilisateur']); ?></td>
                <td><?php echo htmlspecialchars($utilisateur['prenomUtilisateur']); ?></td>
                <td><?php echo $age . ' ans'; ?></td>
                <td><?php echo htmlspecialchars($utilisateur['emailUtilisateur']); ?></td>
                <td><?php echo htmlspecialchars($utilisateur['nomSport']); ?></td>
                <td><?php echo htmlspecialchars(($utilisateur['numAdresse'] ?? '') . ' ' . ($utilisateur['rueAdresse'] ?? '') . ', ' . ($utilisateur['codePostalAdresse'] ?? '') . ' ' . ($utilisateur['paysAdresse'] ?? '')); ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; 2024 SportEvents</p>
    </footer>

</body>
</html>