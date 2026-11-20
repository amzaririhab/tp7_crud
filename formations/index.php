<?php
require_once '../database/connexion.php';

$sql = "SELECT * FROM formations ORDER BY id DESC";
$stmt = $connexion->query($sql);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <h2>Liste des Formations</h2>
        <div>
            <a href="../index.php" class="btn btn-secondary">Accueil</a>
            <a href="create.php" class="btn btn-success">+ Ajouter une formation</a>
        </div>
    </div>

    <table class="table table-bordered table-striped bg-white">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Durée (heures)</th>
                <th>Tarif</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($formations as $formation): ?>
                <tr>
                    <td><?= (int)$formation['id'] ?></td>
                    <td><?= htmlspecialchars($formation['titre']) ?></td>
                    <td><?= (int)$formation['duree_heures'] ?> h</td>
                    <td><?= htmlspecialchars($formation['tarif']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= (int)$formation['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                        <a href="delete.php?id=<?= (int)$formation['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette formation ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>