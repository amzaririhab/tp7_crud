<?php
require_once '../database/connexion.php';

if (isset($_POST['titre']) && isset($_POST['duree_heures']) && isset($_POST['tarif'])) {
    $titre = $_POST['titre'];
    $duree_heures = $_POST['duree_heures'];
    $tarif = $_POST['tarif'];

    $sql = "INSERT INTO formations (titre, duree_heures, tarif) VALUES (:titre, :duree_heures, :tarif)";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':duree_heures', $duree_heures);
    $stmt->bindParam(':tarif', $tarif);
    $stmt->execute();

    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">        
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Ajouter une Formation</h2>
        <a href="index.php" class="btn btn-secondary">Retour à la liste</a>
    </div>
    <form method="POST" class="card p-4 shadow-sm bg-white">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" id="titre" name="titre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="duree_heures" class="form-label">Durée (heures)</label>
            <input type="number" id="duree_heures" name="duree_heures" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tarif" class="form-label">Tarif</label>
            <input type="number" step="0.01" id="tarif" name="tarif" class="form-control" required>
        </div>

        <div>
            <button type="submit" name="submit" class="btn btn-success">Enregistrer</button>
            <a href="index.php" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
</body>
</html>