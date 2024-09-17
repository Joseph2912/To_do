<?php

$host = 'localhost'; 
$dbname = 'todo_app'; 
$user = 'pmauser'; 
$password = '';

try {
    // Define $pdo como una variable global para que pueda ser accesible en otros archivos
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "Conectado a la db.";
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
?>
