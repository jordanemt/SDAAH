<?php
include_once 'presentation/public/header.php';
?>

<div class="container d-flex justify-content-center">

    <div class="card border-primary m-5" style="min-width: 22rem;">
        <div class="card-header" style="background-color: #08a5ff; color: white">
            <h5 class="card-title text-center">Iniciar Sesión</h5>
        </div>
        <div class="card-body text-dark">
            <p class="text-center m-0"><i class="fa fa-user" style="font-size: 45px; color: lightgray"></i></p>
            <form>
                <div class="form-group">
                    <label for="card">Cédula</label>
                    <input type="text" class="form-control" id="card" aria-describedby="card" placeholder="Ingrese su identificación" maxlength="9">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" placeholder="Ingrese su contraseña" maxlength="25">
                </div>
                <button type="button" class="btn btn-primary" onclick="login();">Ingresar</button>
            </form>
        </div>
    </div>

</div>

<?php
include_once 'presentation/public/footer.php';
