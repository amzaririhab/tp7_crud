<?php
require_once '../database/connexion.php';

$sql = "SELECT e.*, f.titre AS formation_titre
        FROM etudiants e
        INNER JOIN formations f ON e.formation_id = f.id
        ORDER BY e.id DESC";
$stmt = $connexion->query($sql);
$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <h2>Liste des Étudiants</h2>
        <div>
            <a href="../index.php" class="btn btn-secondary">Accueil</a>
            <a href="create.php" class="btn btn-success">+ Ajouter un étudiant</a>
        </div>
    </div>

    <table class="table table-bordered table-striped bg-white">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Formation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etudiants as $etudiant): ?>
                <tr>
                    <td><?= (int)$etudiant['id'] ?></td>
                    <td><?= htmlspecialchars($etudiant['nom']) ?></td>
                    <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
                    <td><?= htmlspecialchars($etudiant['email']) ?></td>
                    <td><?= htmlspecialchars($etudiant['formation_titre']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= (int)$etudiant['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                        <a href="delete.php?id=<?= (int)$etudiant['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet étudiant ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>