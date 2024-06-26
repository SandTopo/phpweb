<?php
session_start();
include "prueba.php";
if (isset($_SESSION["user"])) {
    header("Location: base.php");
    exit();
}
if (isset($_POST["name"])) {

    include("conexion.php");
    $name = $_POST["name"];
    $password = $_POST["password"];
    $sql = "select * from users where name=? and password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$name);
    $stmt->bindParam(2,$password);
    $stmt->execute();
    if ($stmt->rowCount()>0) {
        $result=$stmt->fetchAll();
        $_SESSION["iduser"] = $result[0]["id"];
        $_SESSION["user"] = $name;
        $_SESSION["datos"] = "otros datos";
        header("Location: base.php");
        exit();
    } else {
        $error = "Nombre o contraseña incorrectos";
    }
}
?>
<?php include("./templates/header.php");?>

    <section class="vh-100" style="background-color: #cc4b00;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="assets/img/sushinchu.png" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form action="" method="post">

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0">Capítulos <br>Dragon Ball</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Logéate</h5>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="name" name="name" id="form2Example17" class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example17">Nombre</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" name="password" id="form2Example27" class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example27">Contraseña</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                            <?php
                                            if (isset($error)) {
                                                echo "<p>" . $error . "</p>";
                                            }
                                            ?>
                                        </div>

                                        
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">No tienes cuenta? <a href="register.php" style="color: #393f81;">Regístrate</a></p>
                                        
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
<?php include("./templates/footer.php");?>