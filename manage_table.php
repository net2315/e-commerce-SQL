<?php
require 'config.php';

$table = $_GET['table'] ?? null;
if (!$table) {
    die("Table non spécifiée.");
}

// Obtenir les colonnes de la table
$columns = $pdo->query("DESCRIBE $table")->fetchAll(PDO::FETCH_COLUMN);
$data = $pdo->query("SELECT * FROM $table")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion de <?= ucfirst($table) ?></title>
</head>
<body>
<h1>Gestion de la table : <?= ucfirst($table) ?></h1>

<table border="1">
    <tr>
        <?php foreach ($columns as $column): ?>
            <th><?= $column ?></th>
        <?php endforeach; ?>
        <th>Actions</th>
    </tr>

    <?php foreach ($data as $row): ?>
        <tr>
            <?php foreach ($columns as $column): ?>
                <td><?= htmlspecialchars($row[$column]) ?></td>
            <?php endforeach; ?>
            <td>
                <a href="edit_row.php?table=<?= $table ?>&id=<?= $row['id'] ?>">Éditer</a>
                <a href="delete_row.php?table=<?= $table ?>&id=<?= $row['id'] ?>" onclick="return confirm('Confirmer la suppression ?');">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="add_row.php?table=<?= $table ?>">Ajouter un nouvel enregistrement</a>
<a href="index.php">Retour à la liste des tables</a>
</body>
</html>

