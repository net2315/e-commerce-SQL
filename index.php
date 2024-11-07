<?php
require 'config.php';

// Obtenir la liste des tables
$tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion de la Base de Données</title>
</head>
<body>
<h1>Gestion de la Base de Données</h1>
<ul>
    <?php foreach ($tables as $table) : ?>
        <li><a href="manage_table.php?table=<?= $table ?>"><?= ucfirst($table) ?></a></li>
    <?php endforeach; ?>
</ul>
</body>
</html>
