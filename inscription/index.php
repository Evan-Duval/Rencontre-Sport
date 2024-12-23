<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inscriptionstyle.css">
    <title>SportEvents Inscription</title>
</head>
<body>
    <h1>Formulaire d'inscription</h1>
    <form action="traitement.php" method="post">
        <label for="nomUtilisateur">Nom :</label>
        <input type="text" id="nomUtilisateur" name="nomUtilisateur" required>

        <label for="prenomUtilisateur">Prénom :</label>
        <input type="text" id="prenomUtilisateur" name="prenomUtilisateur" required>

        <label for="dateNaissanceUtilisateur">Date de naissance :</label>
        <input type="date" id="dateNaissanceUtilisateur" name="dateNaissanceUtilisateur" required>

        <label for="emailUtilisateur">Email :</label>
        <input type="email" id="emailUtilisateur" name="emailUtilisateur" required>

        <label for="photoUtilisateur">Photo de profil :</label>
        <select id="photoUtilisateur" name="photoUtilisateur">
            <option value="photo1.jpg">Photo 1</option>
            <option value="photo2.jpg">Photo 2</option>
            <option value="photo3.jpg">Photo 3</option>
        </select>

        <label for="sportFavoriUtilisateur">Sport favori :</label>
        <select id="sportFavoriUtilisateur" name="sportFavoriUtilisateur" required>
        <?php
            include '../bdd.php';

            try {
                $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $pdo->query("SELECT idSport, nomSport FROM Sports");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['idSport']}'>{$row['nomSport']}</option>";
                }
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            ?>
        </select>

        <label>Veuillez renseigner votre Adresse :</label>  

        <label for="numAdresse">Numéro de Rue :</label>
        <input type="number" id="numAdresse" name="numAdresse" required> 

        <label for="rueAdresse">Rue :</label>
        <input type="text" id="rueAdresse" name="rueAdresse" required>

        <label for="codePostalAdresse">Code Postal :</label>
        <input type="number" id="codePostalAdresse" name="codePostalAdresse" required>

        <label for="paysAdresse">Pays :</label>
        <input type="text" id="paysAdresse" name="paysAdresse" required>

        <button type="submit">Soumettre</button>

        <!-- Fond animé -->
        <div class="animated-element left"></div>
        <div class="animated-element right"></div>

    </form>
</body>
</html>
