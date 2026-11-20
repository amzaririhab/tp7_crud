<?php
$host="localhost";
$user="root";
$password="";
$database="tp7_crud";
try {
    $connexion = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>