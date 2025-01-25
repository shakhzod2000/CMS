<?php
// cms -Ind*Cq-d5No.!h(

try {
    $pdo = new PDO('mysql:host=localhost;dbname=cms;charset=utf8mb4', 'cms', '-Ind*Cq-d5No.!h(', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}

catch (PDOException $e) {
    //var_dump($e->get_Message());
    echo 'Problem occured with database connection.';
    die();
}

return $pdo;