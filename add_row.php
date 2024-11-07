<?php
require 'config.php';

$table = $_GET['table'] ?? null;
if (!$table) {
    die("Table non spécifiée.");
}

$columns = $pdo->query("DESCRIBE $table")->fetchAll(PDO::FETCH_COLUMN);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values = [];
    $placeholders = [];
    foreach ($columns as $column) {
        if ($column !== 'id') {
            $values[] = $_POST[$column];
            $placeholders[] = "?";
        }
    }

    $query = "INSERT INTO $table (" . implode(", ", array_slice($columns, 1)) . ") VALUES (" . implode(", ", $placeholders) . ")";
    $stmt = $pdo->prepare($query);
    $stmt->execute($values);
    header("Location: manage_table.php?table=$table");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un enregistrement - <?= ucfirst($table) ?></title>
</head>
<body>
<h1>Ajouter un enregistrement dans <?= ucfirst($table) ?></h1>
<form method="POST">
    <?php foreach ($columns as $column): ?>
        <?php if ($column !== 'id'): ?>
            <label><?= ucfirst($column) ?> :</label>
            <input type="text" name="<?= $column ?>"><br>
        <?php endif; ?>
    <?php endforeach; ?>
    <button type="submit">Ajouter</button>
</form>
<a href="manage_table.php?table=<?= $table ?>">Retour</a>
</body>
</html>

