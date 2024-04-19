<?php
// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión a la base de datos
    include("conexion.php");

    // Obtener los datos del formulario
    $title = $_POST["title"];
    $publication = $_POST["publicacion"];
    $synopsis = $_POST["synopsis"];


    // Procesar la imagen
    $image = $_FILES["image"]["name"];
    $target_dir = "assets/img/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar si la imagen es real o falsa
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }


    // Verificar el tamaño de la imagen
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Permitir ciertos formatos de archivo
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Verificar si $uploadOk está configurado en 0 por un error
    if ($uploadOk == 0) {
        echo "Tu archivo no se ha subido.";
        // Si todo está bien, intenta subir el archivo
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            //echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
            // Preparar la consulta SQL para insertar los datos en la tabla de películas
            $sql = "INSERT INTO chapters (title, publication, synopsis, image) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(1, $title);
            $stmt->bindParam(2, $publication);
            $stmt->bindParam(3, $synopsis);
            $stmt->bindParam(4, $image);

            // Ejecutar la consulta
            try {
                $stmt->execute();
                echo "Capítulo añadido";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            // Cerrar la conexión
            $conn = null;
        } else {
            echo "Hubo un error al subir el archivo.";
        }
    }
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
        <h1 class="mt-5 mb-4">Añade un nuevo capítulo</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="publication" class="form-label">Fecha de publicación</label>
                <input type="date" class="form-control" id="publicacion" name="publicacion" required>
            </div>
            <div class="mb-3">
                <label for="synopsis" class="form-label">Sinopsis</label>
                <textarea class="form-control" id="synopsis" name="synopsis"  required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Añadir</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>