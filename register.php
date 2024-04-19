<?php
if(isset($_POST["email"])){
    include("conexion.php");
    $name=$_POST["name"];
    $email=$_POST["email"];
    $pass=$_POST["password"];
    
    $sql="INSERT INTO users (name,email,password) VALUES (?,?,?)";
    $pstm=$conn->prepare($sql);
    $pstm->bindParam(1,$name);
    $pstm->bindParam(2,$email);
    $pstm->bindParam(3,$pass);
    //var_dump($pstm);
    //exit();
    try{
       $pstm->execute();
    if($pstm->rowCount()>0){
        header("Location: ./");
        exit();
    }else{
        $error="No se ha podido crear el usuario";
    } 
    }catch(PDOException $e){
        $error="No se ha podido crear el usuario ".$e->getMessage();
    }
    

}
?>

<?php include("./templates/header.php"); ?>

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
                                        
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Regístrate</h5>
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="text" name="name" id="name" class="form-control form-control-lg" required />
                                        <label class="form-label" for="name">Nombre</label>
                                    </div>
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="email" name="email" id="email" class="form-control form-control-lg"  required/>
                                        <label class="form-label" for="form2Example17">Email</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" name="password" id="password" class="form-control form-control-lg password" />
                                        <label class="form-label" for="password">Contraseña</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" name="" id="repassword" class="form-control form-control-lg password" />
                                        <label class="form-label" for="repassword">Repite contraseña</label>
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit" id="btnRegister" disabled>Dale</button>
                                        <?php
                                        if (isset($error)) {
                                            echo "<p>" . $error . "</p>";
                                        }
                                        ?>
                                    </div>

                                    
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">¿Tienes una cuenta? <a href="./" style="color: #393f81;">Logéate</a></p>
                                    
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("./templates/footer.php"); ?>