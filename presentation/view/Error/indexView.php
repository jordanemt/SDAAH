<?php
$vars["viewName"] = '';
include_once 'presentation/public/header.php';
?>

<div class="container my-4">
    <div class="row">
        <div class="col-md-12 text-center">
            <i class="fa fa-exclamation-triangle fa-10x" style="color: #ff0000"></i>
            <h2>¡Ha ocurrido un error!</h2>
            <p><strong><?= $vars['cod'] ?></strong><?= ' ' . $vars['msg'] ?></p>
        </div>
    </div>
</div>

<?php
include_once 'presentation/public/footer.php';
