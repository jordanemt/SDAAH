<?php
$vars["home-view"] = true;
include_once 'presentation/public/header.php';
?>

<div class="container my-4">
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-6 d-inline-block ">
                <h1 class="display-4" style="margin-bottom: 0">Asada Herediana</h1>
                <p style="margin-top: 0">Administración</p>

                <?php
                if (isset($_SESSION['id'])) { ?>
                    <p class="card-text">
                        <?php echo $_SESSION['name'] . ' ' . $_SESSION['firstLastName'] . ' ' . $_SESSION['secondLastName']; ?>
                    </p>
                <?php
                }
                ?>

                <a class="d-inline" href="https://unac.or.cr/"><i class="fa fa-home"></i>Visitar página de la UNAC</a>
            </div>
            <div class="col-md-6 d-flex justify-content-md-center justify-content-center">
                
                <div class="col-md-6 d-flex align-content-center justify-content-start">
                    <img class="rounded float-right h-250" src="presentation/public/img/logo.png" style="width: 230px" alt="ASADA Herediana">
                </div>
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
