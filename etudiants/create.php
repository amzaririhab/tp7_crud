<?php
require_once '../database/connexion.php';

$formations = $connexion->query("SELECT id, titre FROM formations ORDER BY titre")->fetchAll(PDO::FETCH_ASSOC);
$error = '';

if (isset($_POST['submit'])) {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $formation_id = (int)($_POST['formation_id'] ?? 0);

    if ($nom === '' || $prenom === '' || $email === '' || $formation_id <= 0) {
        $error = "Veuillez remplir tous les champs et choisir une formation.";
    } else {
        $sql = "INSERT INTO etudiants (nom, prenom, email, formation_id)
                VALUES (:nom, :prenom, :email, :formation_id)";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':formation_id', $formation_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            $error = "Erreur : " . $stmt->errorInfo()[2];
        }
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
        <h2>Ajouter un Étudiant</h2>
        <a href="index.php" class="btn btn-secondary">Retour à la liste</a>
    </div>
    <form method="POST" class="card p-4 shadow-sm bg-white">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" id="prenom" name="prenom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="formation_id" class="form-label">Formation</label>
            <select id="formation_id" name="formation_id" class="form-select" required>
                <option value="">-- Choisir une formation --</option>
                <?php foreach ($formations as $formation): ?>
                    <option value="<?= (int)$formation['id'] ?>">
                        <?= htmlspecialchars($formation['titre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <button type="submit" name="submit" class="btn btn-success">Enregistrer</button>
            <a href="index.php" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
</body>
</html>