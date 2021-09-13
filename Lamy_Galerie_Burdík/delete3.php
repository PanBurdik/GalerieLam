<?php

if (empty($_GET['id'])) {
    die('nebylo predano id');
}

require_once 'db.php';

$sql = 'SELECT * FROM fotky WHERE id = :id';
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':id' => $_GET['id']
]);
$dbFile = $stmt->fetch();

if ($dbFile === null) {
    die('neplatne id soubory');
}

// smazani z db

$sql = 'DELETE FROM fotky WHERE id = :id';
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':id' => $_GET['id']
]);


// smazani ze souboru

$path = 'files/' . $dbFile['id'] . '.' . $dbFile['extension'];
unlink($path);

$id_folder = $dbFile['id_slozka'];
header("Location: Fotky.php?id=$id_folder");