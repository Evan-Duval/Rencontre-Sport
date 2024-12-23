<?php
$nom = $_POST['nomUtilisateur'] ?? null;
$prenom = $_POST['prenomUtilisateur'] ?? null;
$dateNaissance = $_POST['dateNaissanceUtilisateur'] ?? null;
$email = $_POST['emailUtilisateur'] ?? null;
$photo = $_POST['photoUtilisateur'] ?? null;
$sportFavori = $_POST['sportFavoriUtilisateur'] ?? null;

$numAdresse = $_POST['numAdresse'] ?? null;
$rueAdresse = $_POST['rueAdresse'] ?? null;
$codePostalAdresse = $_POST['codePostalAdresse'] ?? null;
$paysAdresse = $_POST['paysAdresse'] ?? null;

include '../bdd.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare(
        "INSERT INTO Adresse
        (numAdresse, rueAdresse, codePostalAdresse, paysAdresse)
        VALUES (:numAdresse, :rueAdresse, :codePostalAdresse, :paysAdresse)"
    );
    $stmt->execute([
        ':numAdresse' => $numAdresse,
        ':rueAdresse' => $rueAdresse,
        ':codePostalAdresse' => $codePostalAdresse,
        ':paysAdresse' => $paysAdresse
    ]);
    $idAdresse = $pdo->lastInsertId();

    $stmt = $pdo->prepare(
        "INSERT INTO Profil_Utilisateur 
        (nomUtilisateur, prenomUtilisateur, dateNaissanceUtilisateur, emailUtilisateur, photoUtilisateur, sportFavoriUtilisateur, idAdresse) 
        VALUES (:nom, :prenom, :dateNaissance, :email, :photo, :sportFavori, :idAdresse)"
    );
    $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':dateNaissance' => $dateNaissance,
        ':email' => $email,
        ':photo' => $photo,
        ':sportFavori' => $sportFavori,
        ':idAdresse' => $idAdresse
    ]);

    echo "Inscription terminée. Vous serez redirigé vers l'accueil dans 2 secondes...";

    header(header: "refresh:2;url=../accueil.php");
    exit;
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
