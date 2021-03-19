<?php
$vars["home-view"] = true;
include_once 'presentation/public/header.php';
?>

<div class="container my-4">
    <div class="jumbotron">
        <h1 class="display-4">Administración Asada Herediana</h1>
        <p class="lead">
            <?php
            if (isset($_SESSION['id'])) {
                echo 'Bienvenido ' . $_SESSION['name'] . ' ' . $_SESSION['firstLastName'] . ' ' . $_SESSION['secondLastName'];
            }
            ?>
        </p>
        <hr class="my-4">
<!--        <p>...</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="?controller=session" type="submit">Iniciar Sesión</a>
        </p>-->
    </div>
</div>

<?php
include_once 'presentation/public/footer.php';
