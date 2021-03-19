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
            <form id="form">
                <div class="form-group">
                    <label for="card">Cédula</label>
                    <input type="text" class="form-control" id="card" name="card" placeholder="Ingrese su identificación" minlength="9" maxlength="9" required>
                    <small id="passHelp" class="form-text text-muted">Digite la cédula con los ceros</small>
                </div>
                <div class="form-group">
                    <label for="pass">Contraseña</label>
                    <input type="password" class="form-control" id="pass" name="pass" minlength="6" maxlength="11" placeholder="Ingrese lo que se le solicita" required>
                    <small id="passHelp" class="form-text text-muted">Digite entre 6 a 11 carácteres</small>
                </div>
                <button id="submit-button" type="button" class="btn btn-primary" onclick="login();">Ingresar</button>
            </form>
        </div>
    </div>

</div>

<?php
include_once 'presentation/public/footer.php';
