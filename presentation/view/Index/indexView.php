<?php
$vars["home-view"] = true;
include_once 'presentation/public/header.php';
?>

<div class="container my-4">
    <div class="jumbotron">
        <h1 class="display-4">Administración Asada Herediana</h1>
        <div class="row">
            <div class="col-md-6 d-flex justify-content-md-start justify-content-center">
                <a href="https://unac.or.cr/"><i class="fa fa-home"></i>Visitar página de la UNAC</a>
            </div>
            <div class="col-md-6 d-flex justify-content-md-end justify-content-center">
                <?php
                if (isset($_SESSION['id'])) {
                    echo 'Usuario: ' . $_SESSION['name'] . ' ' . $_SESSION['firstLastName'] . ' ' . $_SESSION['secondLastName'];
                }
                ?>
            </div>
        </div>
        <hr class="my-2">
        <?php
        if (isset($_SESSION['id']) && count($vars['employeesOnMonthBirthday']) != 0) {
            ?>
            <p style="margin: 0"><i class="fa fa-birthday-cake" style="color: #03A9F4"></i> Cumpleaños del mes:</p>
            <?php
            foreach ($vars['employeesOnMonthBirthday'] as $employee) {
                ?>
                <p style="margin: 0">
                    <?= $employee['name'] . ' ' . $employee['firstLastName'] . ' ' . $employee['secondLastName']; ?>
                    <i class="fa fa-calendar-day"></i> Día: <?= date_format(date_create($employee['birthdate']), 'd'); ?>
                </p>
                <?php
            }
        }
        ?>
        <p class="my-2">
            <i class="fa fa-dollar-sign"></i><strong> Cambio</strong>:
            Compra = <?php echo Util::getExchangeRate(Util::PURCHASE); ?>
            Venta = <?php echo Util::getExchangeRate(Util::SALE); ?>
        </p>
    </div>
</div>

<?php
include_once 'presentation/public/footer.php';
