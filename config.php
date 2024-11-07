<?php
$host = 'localhost';        // Adresse de ton serveur de base de données
$db = 'commerce';          // Nom de ta base de données
$user = 'root';             // Nom d'utilisateur MySQL
$pass = '';         // Mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
