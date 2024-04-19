<?php
session_start();
if(! isset($_GET["idcoment"])){
header("Location: ./base.php");
exit();
}

$user = $_SESSION["user"];
$idComent=$_GET["idcoment"];
include("conexion.php");
$sql = "SELECT * FROM phpdb.coments as C left join users as U on U.id=C.idUser join chapters as A on A.id=C.idChapter where C.idChapter=".$idComent.";";

$result = $conn->query($sql);
// Fetch the results
$rowsComent = $result->fetchAll(PDO::FETCH_ASSOC);
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
  <link rel="stylesheet" href="assets/css/deco2.css">
  
</head>
<body>
  <div id="mandarinas">
    <h1>Capítulos Dragon Ball</h1>
    <div class="peras">
    <p>Bienvenido, <?php echo $user; ?></p>
    <a href="addChapter.php" class="add">Añadir capítulo</a>
    <a class="salite" href="base.php">volver</a>
    </div>
    
  </div>
  <hr>

  <hr>
  <h1>Comentarios capítulo</h1>
  
    
    <?php
    foreach ($rowsComent as $row) {
      $coment = '<br><div class="father" id="'.$row["id"].'">
  <div class="child">
      <div class="nieto">
        <p class="usuario">'.$row["name"].':</p>
        <p>'.$row["coment"].'</p>
          
      </div>
  </div>
  
    </div> 
</div>';

      echo $coment;
    }

    ?>

  

  <hr>


</body>

</html>