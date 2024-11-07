<?php
require 'config.php';

$table = $_GET['table'] ?? null;
$id = $_GET['id'] ?? null;
if (!$table || !$id) {
    die("Table ou ID non spécifié.");
}

$columns = $pdo->query("DESCRIBE $table")->fetchAll(PDO::FETCH_COLUMN);
$stmt = $pdo->prepare("SELECT * FROM $table WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values = [];
    $placeholders = [];
    foreach ($columns as $column) {
        if ($column !== 'id') {
            $values[] = $_POST[$column];
            $placeholders[] = "$column = ?";
        }
    }

    $query = "UPDATE $table SET " . implode(", ", $placeholders) . " WHERE id = ?";
    $values[] = $id;
    $stmt = $pdo->prepare($query);
    $stmt->execute($values);
    header("Location: manage_table.php?table=$table");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Éditer l'enregistrement - <?= ucfirst($table) ?></title>
</head>
<body>
<h1>Éditer l'enregistrement dans <?= ucfirst($table) ?></h1>
<form method="POST">
    <?php foreach ($columns as $column): ?>
        <label><?= ucfirst($column) ?> :</label>
        <input type="text" name="<?= $column ?>" value="<?= htmlspecialchars($row[$column]) ?>"><br>
    <?php endforeach; ?>
    <button type="submit">Sauvegarder</button>
</form>
<a href="manage_table.php?table=<?= $table ?>">Retour</a>
</body>
</html>

