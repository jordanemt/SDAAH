<?php
$session = Session::singleton();
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <title>Departamento Administrativo</title>
        <meta charset="utf-8"/>
        <meta name="description" content="Departamento Administrativo - Asada Herediana" />
        <meta name="viewport" content="width=device-width,initial-scale=1"/>
        <link rel="icon" type="image/x-icon" href="presentation/public/img/icon.png"/>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/b-1.6.5/r-2.2.6/sc-2.0.3/sl-1.3.1/datatables.min.css"/>

        <link href="presentation/public/css/site.css" rel="stylesheet" type="text/css"/>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.12.4/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.datatables.net/v/bs4/dt-1.10.22/b-1.6.5/r-2.2.6/sc-2.0.3/sl-1.3.1/datatables.min.js"></script>

        <script src="presentation/public/js/script.js" type="text/javascript"></script>
        <script src="presentation/public/js/login.js" type="text/javascript"></script>
        <script src="presentation/public/js/messages.js" type="text/javascript"></script>
        <script src="presentation/public/js/user.js" type="text/javascript"></script>
        <script src="presentation/public/js/position.js" type="text/javascript"></script>
        <script src="presentation/public/js/employee.js" type="text/javascript"></script>
        <script src="presentation/public/js/deduction.js" type="text/javascript"></script>
        <script src="presentation/public/js/payment.js" type="text/javascript"></script>
        <script src="presentation/public/js/vacation.js" type="text/javascript"></script>
        <script src="presentation/public/js/liquidation.js" type="text/javascript"></script>
        <script src="presentation/public/js/bonus.js" type="text/javascript"></script>
        <script src="presentation/public/js/incometax.js" type="text/javascript"></script>
        <script src="presentation/public/js/param.js" type="text/javascript"></script>
    </head>

    <body class="d-none">
        <div class="body-content">
            <nav class="navbar sticky-top navbar-expand-lg navbar-dark" style="background-color: #03A9F4">
                <a class="navbar-brand" href="?controller=index">
                    <!--<img alt="Administración" src="/presentation/public/img/logo.png" height="75"/>-->
                    Administración
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars" style="color: white"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <?php
                    if (!isset($_SESSION['id'])) {
                        ?>

                        <ul class="navbar-nav mr-auto">
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <a class="btn btn-outline-light my-2 my-sm-0" href="?controller=login" type="submit">Iniciar Sesión</a>
                        </form>

                        <?php
                    } else {
                        ?>

                        <ul class="navbar-nav mr-auto">
                            <?php
                            if ($session->validRole(Session::$_ADMIN)) {
                                ?>

                                <li class="nav-item <?php
                                if (strcasecmp($vars['viewName'], 'user') === 0) {
                                    echo "active";
                                }
                                ?>">
                                    <a class="nav-link" href="?controller=user">Usuarios</a>
                                </li>

                                <?php
                            }
                            ?>

                            <li class="nav-item <?php
                            if (strcasecmp($vars['viewName'], 'employee') === 0) {
                                echo "active";
                            }
                            ?>">
                                <a class="nav-link" href="?controller=employee">Empleados</a>
                            </li>
                            <li class="nav-item <?php
                            if (strcasecmp($vars['viewName'], 'position') === 0) {
                                echo "active";
                            }
                            ?>">
                                <a class="nav-link" href="?controller=position">Puestos</a>
                            </li>

                            <?php
                            if ($session->validRole(Session::$_ADMIN)) {
                                ?>

                                <li class="nav-item dropdown <?php
                                if (strcasecmp($vars['viewName'], 'parameters') === 0) {
                                    echo "active";
                                }
                                ?>">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Parámetros
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="?controller=param">Generales</a>
                                        <a class="dropdown-item" href="?controller=incomeTax">Tramos Imp. Renta</a>
                                        <a class="dropdown-item" href="?controller=deduction">Catálogo de Deducciones</a>
                                    </div>
                                </li>

                                <?php
                            }
                            ?>

                            <li class="nav-item dropdown <?php
                            if (strcasecmp($vars['viewName'], 'payroll') === 0) {
                                echo "active";
                            }
                            ?>">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Nómina
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="?controller=payroll">Quincenal</a>
                                    <a class="dropdown-item" href="?controller=payroll&action=monthlyView">Mensual</a>
                                    <a class="dropdown-item" href="?controller=payroll&action=provisionReportView">Reporte de Provisiones de Ley</a>
                                    <a class="dropdown-item" href="?controller=payroll&action=bankReportView">Reporte Bancario</a>
                                </div>
                            </li>
                            <?php
                            if ($session->validRole(Session::$_DIGITIZER)) {
                                ?>

                                <li class="nav-item dropdown <?php
                                if (strcasecmp($vars['viewName'], 'vacation') === 0) {
                                    echo "active";
                                }
                                ?>">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Vacaciones
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="?controller=vacation">Calcular</a>
                                        <a class="dropdown-item" href="?controller=vacation&action=detail">Detalle</a>
                                    </div>
                                </li>

                                <?php
                            }
                            ?>
                            <?php
                            if ($session->validRole(Session::$_DIGITIZER)) {
                                ?>

                                <li class="nav-item <?php
                                if (strcasecmp($vars['viewName'], 'liquidation') === 0) {
                                    echo "active";
                                }
                                ?>">
                                    <a class="nav-link" href="?controller=liquidation">Liquidaciones</a>
                                </li>

                                <?php
                            }
                            ?>
                            <li class="nav-item <?php
                            if (strcasecmp($vars['viewName'], 'bonus') === 0) {
                                echo "active";
                            }
                            ?>">
                                <a class="nav-link" href="?controller=bonus">Aguinaldos</a>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <ul class="navbar-nav mr-auto">
                                <li class="<?php
                                if (strcasecmp($vars['viewName'], 'profile') === 0) {
                                    echo "active";
                                }
                                ?>">
                                    <a class="nav-link" href="?controller=user&action=profileView"><i class="fa fa-user-circle"></i> Perfil</a>
                                </li>
                            </ul>
                            <a class="btn btn-outline-light my-2 my-sm-0" href="#" onclick="logout();" type="submit">Salir</a>
                        </form>

                        <?php
                    }
                    ?>
                </div>
            </nav>
