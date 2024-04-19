<?php
session_start();
if(! isset($_GET["idcoment"])){
header("Location: ./base.php");
exit();
}
if (!isset($_SESSION["user"])) {
    header("Location ./");
    exit;
  }


// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión a la base de datos
    $user = $_SESSION["iduser"];
    $idComent=$_GET["idcoment"];
    include("conexion.php");

    // Obtener los datos del formulario
    $coment = $_POST["coment"];
    

    // Verificar si $uploadOk está configurado en 0 por un error
    
        
            //echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
            // Preparar la consulta SQL para insertar los datos en la tabla de películas
            $sql = "INSERT INTO coments (idChapter,idUser,coment) VALUES ($user,$idComent,?)";
            $stmt = $conn->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(1, $coment);
            

            // Ejecutar la consulta
            try {
                $stmt->execute();
                echo "Comentario añadido.";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            // Cerrar la conexión
            $conn = null;
        
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/deco.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <button onclick="window.location.href='base.php'">Cancelar</button>
    <div class="container">
        <h1 class="mt-5 mb-4">Añade un nuevo comentario</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Comentario</label>
                <textarea class="form-control" id="coment" name="coment"  required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Comentar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>