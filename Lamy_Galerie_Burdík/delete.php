<?php

if (empty($_GET['id'])){
    die('!!Nezadaný identifikátor!!');
}


require_once 'db.php';

$sql = 'SELECT * FROM fotky WHERE id_slozka = :id';
$stmt = $conn->prepare($sql);
$result = $stmt->execute([
    ':id' => $_GET['id']
]);
$images = $stmt->fetchAll();

if($images == !null){

    foreach ($images as $img){

        $sql = 'DELETE FROM fotky WHERE id = :id';
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([
            ':id' => $img['id']
        ]);

        $delete_path = 'files/' . $img['id'] . '.' . $img['extension'];
        unlink($delete_path);

    }
}



$id_folder = $_GET['id'];
header("Location: Fotky.php?id=$id_folder");
