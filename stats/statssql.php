<?php

include '../bdd.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query(
        "SELECT idUtilisateur, nomSport 
        FROM Profil_Utilisateur
        LEFT JOIN sports ON idSport = sportFavoriUtilisateur
    ");

    $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $pdo->query(
        "SELECT ROUND(AVG(YEAR(dateNaissanceUtilisateur)), 0)
        FROM Profil_Utilisateur"
    );
     
    $anneeMoyenneNaissance = $stmt->fetchColumn();
    
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}


?>