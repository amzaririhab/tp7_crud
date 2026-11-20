<?php
require_once '../database/connexion.php';

$sql = "SELECT m.*, f.titre AS formation_titre
        FROM modules m
        INNER JOIN formations f ON m.formation_id = f.id
        ORDER BY m.id DESC";
$stmt = $connexion->query($sql);
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <h2>Liste des Modules</h2>
        <div>
            <a href="../index.php" class="btn btn-secondary">Accueil</a>
            <a href="create.php" class="btn btn-success">+ Ajouter un module</a>
        </div>
    </div>

    <table class="table table-bordered table-striped bg-white">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Volume horaire</th>
                <th>Formation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($modules as $module): ?>
                <tr>
                    <td><?= (int)$module['id'] ?></td>
                    <td><?= htmlspecialchars($module['titre']) ?></td>
                    <td><?= (int)$module['volume_horaire'] ?> h</td>
                    <td><?= htmlspecialchars($module['formation_titre']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= (int)$module['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                        <a href="delete.php?id=<?= (int)$module['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce module ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>