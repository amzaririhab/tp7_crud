<?php
require_once '../database/connexion.php';

if (!isset($_GET['id'])) {
    die("ID du module non spécifié.");
}

$id = (int)$_GET['id'];

$sql = "DELETE FROM modules WHERE id = :id";
$stmt = $connexion->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    header("Location: index.php");
    exit();
} else {
    echo "Erreur lors de la suppression du module.";
}
?>