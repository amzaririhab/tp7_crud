<?php
require_once '../database/connexion.php';

if (!isset($_GET['id'])) {
    die("ID de la formation non spécifié.");
}

$id = (int)$_GET['id'];

$stmt = $connexion->prepare("SELECT * FROM formations WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$formation = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$formation) {
    die("Formation introuvable.");
}

if (isset($_POST['submit'])) {
    $titre = $_POST['titre'];
    $duree_heures = $_POST['duree_heures'];
    $tarif = $_POST['tarif'];

    $sql = "UPDATE formations
            SET titre = :titre, duree_heures = :duree_heures, tarif = :tarif
            WHERE id = :id";
    $updateStmt = $connexion->prepare($sql);
    $updateStmt->bindParam(':titre', $titre);
    $updateStmt->bindParam(':duree_heures', $duree_heures);
    $updateStmt->bindParam(':tarif', $tarif);
    $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($updateStmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur lors de la modification de la formation.";
    }
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
        <h2>Modifier une Formation</h2>
        <a href="index.php" class="btn btn-secondary">Retour à la liste</a>
    </div>

    <form method="POST" class="card p-4 shadow-sm bg-white">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" id="titre" name="titre" class="form-control" value="<?= htmlspecialchars($formation['titre']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="duree_heures" class="form-label">Durée (heures)</label>
            <input type="number" id="duree_heures" name="duree_heures" class="form-control" value="<?= (int)$formation['duree_heures'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="tarif" class="form-label">Tarif</label>
            <input type="number" step="0.01" id="tarif" name="tarif" class="form-control" value="<?= htmlspecialchars($formation['tarif']) ?>" required>
        </div>

        <div>
            <button type="submit" name="submit" class="btn btn-warning">Modifier</button>
            <a href="index.php" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
</body>
</html>