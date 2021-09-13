<?php

if (empty($_GET['id'])){
    die('!!Nezadaný identifikátor!!');
}

require_once 'db.php';

$sql = 'SELECT * FROM fotky WHERE id = :id';
$stmt = $conn->prepare($sql);
$result = $stmt->execute([
    ':id' => $_GET['id']
]);
$images = $stmt->fetch();


    $n = $images['likes'] +1;

    $sql ='UPDATE fotky SET likes = :likes WHERE id = :id';
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([
        ':id' => $_GET['id'],
        ':likes' => $n
    ]);

    $id = $_GET['id'];
    header("Location: close_photo.php?id=$id");




