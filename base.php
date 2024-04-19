<?php
session_start();
if (!isset($_SESSION["user"])) {
  header("Location ./");
  exit;
}
$user = $_SESSION["user"];
include("conexion.php");
$sql = "select * from chapters";

$result = $conn->query($sql);
// Fetch the results
$rowsChapter = $result->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB Chapters</title>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <link href='//fonts.googleapis.com/css?family=Lobster&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="assets/css/deco.css">
  <!--<script th:src="{% static 'js/base.js' %}" ></script>-->
  <script>
    function openPopup() {
      window.open('prueba.html', 'sinopsis', 'width=200, height=200')
    }
  </script>
</head>

<body>
  <div id="mandarinas">
    <h1>Capítulos Dragon Ball</h1>
    <div class="peras">
      <p>Bienvenido, <?php echo $user; ?></p>
      <a href="addChapter.php" class="add">Añadir capítulo</a>
      <a class="salite" href="salir.php">Salir</a>
    </div>

  </div>
  <hr>

  <hr>

  <div class="container" id="fila1">
    <?php
    foreach ($rowsChapter as $row) {
      $chapter = '<br><div class="father" id="' . $row["id"] . '">
  <div class="child">
      <div class="nieto">
          <img src="assets/img/' . $row["image"] . '" alt="" width="225" height="330">
          <div class="hoverino" data-toggle="modal" data-target="#exampleModal' . $row["id"] . '">
              <h5 class="sinopsis">Leer sinopsis</h5>   
          </div>
      </div>
  </div>
  <h4>Capítulo' . $row["id"] . '</h4>
  <div class="modal" id="exampleModal' . $row["id"] . '" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Título: ' . $row["title"] . ' <br>Fecha de publicación: ' . $row["publication"] . ' </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ' . $row["synopsis"] . '
          </div>
          <div class="modal-footer">
            <a href="addComent.php?idcoment=' . $row["id"] . '">Añadir comentario</a>
            <button type="button" class="btn" data-dismiss="modal">Cerrar</button>
          </div>
          <a href="coments.php?idcoment=' . $row["id"] . '">ver comentarios</a>
          <div class="container2">

          </div>
        </div>
      </div>
    </div> 
</div>';

      echo $chapter;
    }

    ?>

  </div>

  <hr>


</body>

</html>