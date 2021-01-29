<!DOCTYPE html>
<html lang="es">

    <head>
        <title>Departamento Administrativo</title>
        <meta charset="utf-8"/>
        <meta name="description" content="Departamento Administrativo - Asada Herediana" />
        <meta name="viewport" content="width=device-width,initial-scale=1"/>
        <!--<link rel="shortcut icon" type="image/x-icon" href="public/img/icono.ico"/>-->
        
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css"/>-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/b-1.6.5/r-2.2.6/sc-2.0.3/sl-1.3.1/datatables.min.css"/>

        <!--CSS-->
        <link href="presentation/public/css/site.css" rel="stylesheet" type="text/css"/>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js""></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js"></script>-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.12.4/dist/sweetalert2.all.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/b-1.6.5/r-2.2.6/sc-2.0.3/sl-1.3.1/datatables.min.js"></script>
        
        <!--JS-->
        <script src="presentation/public/js/script.js" type="text/javascript"></script>
        <script src="presentation/public/js/messages.js" type="text/javascript"></script>
    </head>

    <body>
        <div class="body-content">
            <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #08a5ff">
                <a class="navbar-brand" href="?controller=index">Administración</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item <?php if(isset($vars["user-view"])) {echo "active";} ?>">
                            <a class="nav-link" href="?controller=user">Usuarios</a>
                        </li>
                        <li class="nav-item <?php if(isset($vars["employee-view"])) {echo "active";} ?>">
                            <a class="nav-link" href="?controller=employee">Empleados</a>
                        </li>
                        <li class="nav-item <?php if(isset($vars["position-view"])) {echo "active";} ?>">
                            <a class="nav-link" href="?controller=position">Puestos</a>
                        </li>
                        <li class="nav-item dropdown <?php if(isset($vars["payroll-view"])) {echo "active";} ?>">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Nómina
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="?controller=payroll">Quincenal</a>
                                <a class="dropdown-item" href="?controller=payroll&action=monthlyView">Mensual</a>
                                <a class="dropdown-item" href="?controller=payroll&action=provisionReportView">Reporte de Proviciones de Ley</a>
                                <a class="dropdown-item" href="?controller=payroll&action=bncrReportView">Reporte del BNCR</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown <?php if(isset($vars["vacation-view"])) {echo "active";} ?>">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Vacaciones
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="?controller=vacation">Calcular</a>
                                <a class="dropdown-item" href="?controller=vacation&action=detail">Detalle</a>
                            </div>
                        </li>
                        <li class="nav-item <?php if(isset($vars["liquidation-view"])) {echo "active";} ?>">
                            <a class="nav-link" href="?controller=liquidation">Liquidaciones</a>
                        </li>
                        <li class="nav-item <?php if(isset($vars["bonus-view"])) {echo "active";} ?>">
                            <a class="nav-link" href="?controller=bonus">Aguinaldos</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <!--<button class="btn btn-outline-light my-2 my-sm-0" type="submit">Iniciar Sesión</button>-->
                        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Salir</button>
                    </form>
                </div>
            </nav>