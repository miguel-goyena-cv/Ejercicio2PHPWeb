<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

$nombre;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST["nombre"];
    
    $mysqli = new mysqli('127.0.0.1', 'root', '', 'ejemplosphpweb');
    // ¡Oh, no! Existe un error 'connect_errno', fallando la conexión
    if ($mysqli->connect_errno) {
        // La conexión falló.
       // Mostramos mensaje al usuario
        echo "Lo sentimos, este sitio web está experimentando problemas.";
       // No se debe revelar información delicada
       // de todas formas, la información de errores se podría registrar
       echo "Error: Fallo al conectarse a MySQL debido a: \n";
       echo "Errno: " . $mysqli->connect_errno . "\n";
       echo "Error: " . $mysqli->connect_error . "\n";
        // salimos
        exit;
    }
    
    // Hago el insert del nombre, con la sesion
    $sesion = session_id();
    $sql = "INSERT INTO nombres (sesion, nombre)VALUES(?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ss', $sesion, $nombre);
    $stmt->execute();
    
}
?>
<h1>Gestión de Sesiones y Archivos en PHP</h1>
<form action="index.php" method="post">
    Nombre: <input type="text" name="nombre">
    <input type="submit" value="Enviar">
</form>

<?php

if (isset($nombre)){
    echo "<h3>Hola $nombre!!</h3>";
}

// Consulto la BBDD
//$query = "SELECT * FROM nombres";
//$result = mysqli_query($this->conn, $query);
//$nombres = $resultado->fetch_assoc();
//echo "<ul>";
//foreach ($nombre as $nombres) {
//    echo "<li>".$nombre[]
//
//}
//echo "</ul>";
    
?>
