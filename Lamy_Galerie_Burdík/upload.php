<?php

if (!isset($_POST['title'])) {
    die('chyba odeslání formuláře');
}

$allowedMineTypes = [
    'image/jpeg',
    'image/png',
    'image/gif',
    'image/jpg',
];

$fileMineType = $_FILES['file']['type'];
if (!in_array($fileMineType, $allowedMineTypes)){
    die('Nepovolený formát soubory'.$fileMineType);
}

require_once 'db.php';

$filename = $_FILES['file']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

$sql = 'INSERT INTO fotky 
        SET original_name = :name, extension = :ext, title = :title, created_at = now(), id_slozka = :id_slozka';
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':name' => $filename,
    ':ext' => $ext,
    ':title' => $_POST['title'],
    ':id_slozka' => $_GET['slozky']
]);

$lastID = $conn->lastInsertId();

$tmpPath = $_FILES['file']['tmp_name'];
$destPath = 'files/' . $lastID . '.' . $ext;

move_uploaded_file($tmpPath, $destPath);

$id_folder = $_GET['slozky'];
header("Location: Fotky.php?id=$id_folder");