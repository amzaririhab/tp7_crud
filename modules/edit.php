<?php
require_once '../database/connexion.php';

if (!isset($_GET['id'])) {
    die("ID du module non spécifié.");
}

$id = (int)$_GET['id'];

$stmt = $connexion->prepare("SELECT * FROM modules WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$module = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$module) {
    die("Module introuvable.");
}

$formations = $connexion->query("SELECT id, titre FROM formations ORDER BY titre")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    $titre = $_POST['titre'];
    $volume_horaire = $_POST['volume_horaire'];
    $formation_id = (int)$_POST['formation_id'];

    $sql = "UPDATE modules
            SET titre = :titre, volume_horaire = :volume_horaire, formation_id = :formation_id
            WHERE id = :id";
    $updateStmt = $connexion->prepare($sql);
    $updateStmt->bindParam(':titre', $titre);
    $updateStmt->bindParam(':volume_horaire', $volume_horaire);
    $updateStmt->bindParam(':formation_id', $formation_id, PDO::PARAM_INT);
    $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($updateStmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur lors de la modification du module.";
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
        <h2>Modifier un Module</h2>
        <a href="index.php" class="btn btn-secondary">Retour à la liste</a>
    </div>

    <form method="POST" class="card p-4 shadow-sm bg-white">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" id="titre" name="titre" class="form-control" value="<?= htmlspecialchars($module['titre']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="volume_horaire" class="form-label">Volume horaire (heures)</label>
            <input type="number" id="volume_horaire" name="volume_horaire" class="form-control" value="<?= (int)$module['volume_horaire'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="formation_id" class="form-label">Formation</label>
            <select id="formation_id" name="formation_id" class="form-select" required>
                <?php foreach ($formations as $formation): ?>
                    <option value="<?= (int)$formation['id'] ?>" <?= $formation['id'] == $module['formation_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($formation['titre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <button type="submit" name="submit" class="btn btn-warning">Modifier</button>
            <a href="index.php" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
</body>
</html>