<?php
require_once '../database/connexion.php';

if (!isset($_GET['id'])) {
    die("ID de l'étudiant non spécifié.");
}

$id = (int)$_GET['id'];

$stmt = $connexion->prepare("SELECT * FROM etudiants WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {
    die("Étudiant introuvable.");
}

$formations = $connexion->query("SELECT id, titre FROM formations ORDER BY titre")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $formation_id = (int)$_POST['formation_id'];

    $sql = "UPDATE etudiants
            SET nom = :nom, prenom = :prenom, email = :email, formation_id = :formation_id
            WHERE id = :id";
    $updateStmt = $connexion->prepare($sql);
    $updateStmt->bindParam(':nom', $nom);
    $updateStmt->bindParam(':prenom', $prenom);
    $updateStmt->bindParam(':email', $email);
    $updateStmt->bindParam(':formation_id', $formation_id, PDO::PARAM_INT);
    $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($updateStmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur lors de la modification de l'étudiant.";
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
        <h2>Modifier un Étudiant</h2>
        <a href="index.php" class="btn btn-secondary">Retour à la liste</a>
    </div>

    <form method="POST" class="card p-4 shadow-sm bg-white">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" value="<?= htmlspecialchars($etudiant['nom']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" id="prenom" name="prenom" class="form-control" value="<?= htmlspecialchars($etudiant['prenom']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($etudiant['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="formation_id" class="form-label">Formation</label>
            <select id="formation_id" name="formation_id" class="form-select" required>
                <?php foreach ($formations as $formation): ?>
                    <option value="<?= (int)$formation['id'] ?>" <?= $formation['id'] == $etudiant['formation_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($formation['titre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" name="submit" class="btn btn-warning">Modifier</button>
    </form>
</div>
</body>
</html>