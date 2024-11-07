<?php
require 'config.php';

$table = isset($_GET['table']) ? $_GET['table'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$table || !$id) {
    die("Table ou ID non spécifié.");
}

$stmt = $pdo->prepare("DELETE FROM $table WHERE id = ?");
$stmt->execute([$id]);
header("Location: manage_table.php?table=$table");
?>

