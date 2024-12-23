<?php
include 'bdd.php'; // Pour se connecter à la base de données

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Variables du formulaire récupérées grâce à GET (et dans accueil.php, method ="GET")
    $triListe = $_GET['triListe'] ?? null;
    $ordreTri = $_GET['ordreTri'] ?? 'asc';
    $filtreParRecherche = $_GET['barreDeRecherche'] ?? null;
    $filtreSport = $_GET['triSport'] ?? null;

    // Vérifier que la colonne existe
    $colonnesAutorisees = ['triNom' => 'nomUtilisateur', 'triPrénom' => 'prenomUtilisateur', 'triAge' => 'dateNaissanceUtilisateur'];
    $ordreAutorise = ['asc', 'desc'];

    $colonneTri = $colonnesAutorisees[$triListe] ?? null;
    $ordreTri = in_array($ordreTri, $ordreAutorise) ? $ordreTri : 'asc';

    // WHERE
    $conditions = [];
    $params = [];

    if ($filtreParRecherche) {
        $conditions[] = "(
        nomUtilisateur LIKE :recherche 
        OR prenomUtilisateur LIKE :recherche 
        OR emailUtilisateur LIKE :recherche 
        OR numAdresse LIKE :recherche 
        OR rueAdresse LIKE :recherche 
        OR codePostalAdresse LIKE :recherche 
        OR paysAdresse LIKE :recherche)";
        $params[':recherche'] = '%' . $filtreParRecherche . '%';
    }

    if ($filtreSport) {
        $conditions[] = "idSport = :sport";
        $params[':sport'] = $filtreSport;
    }

    $where = count($conditions) > 0 ? 'WHERE ' . implode(' AND ', $conditions) : '';

    // ORDER BY
    $orderBy = "";
    if ($colonneTri) {
        if ($colonneTri === 'dateNaissanceUtilisateur') {
            $orderBy = "ORDER BY $colonneTri " . ($ordreTri === 'asc' ? 'DESC' : 'ASC');
        } else {
            $orderBy = "ORDER BY $colonneTri $ordreTri";
        }
    }

    $stmt = $pdo->prepare(
        "SELECT 
                    profil_utilisateur.idUtilisateur, 
                    profil_utilisateur.nomUtilisateur, 
                    profil_utilisateur.prenomUtilisateur, 
                    profil_utilisateur.dateNaissanceUtilisateur, 
                    profil_utilisateur.emailUtilisateur, 
                    profil_utilisateur.photoUtilisateur, 
                    sports.nomSport, 
                    adresse.numAdresse, 
                    adresse.rueAdresse, 
                    adresse.codePostalAdresse, 
                    adresse.paysAdresse
                FROM profil_utilisateur
                LEFT JOIN sports ON sports.idSport = profil_utilisateur.sportFavoriUtilisateur
                LEFT JOIN adresse ON adresse.idAdresse = profil_utilisateur.idAdresse
                $where
                $orderBy
                ");
    $stmt->execute($params);
    $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
