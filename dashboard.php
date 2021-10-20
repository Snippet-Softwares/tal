<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        session_destroy();
        header("location: ../tal/");
        exit();
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TAL - Dashboard</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="assets/css/app.min.css" rel="stylesheet">
        <link rel="Shortcut Icon"  href="favicons.png" type="image/x-icon">
        <style>
            .wrap{
                font-family: monotype corsiva;
                text-align: left;
            }
            .tank{
                margin:0 25px;
                display: inline-block;
            }
            body{
                margin: 0;
            }
        </style>
    </head>
    <body>
        <div class="app">
        <div class="layout">
            <div class="header">
                <div class="logo logo-dark">
                    <a>
                        <img src="favicons.png" class="img-fluid img-responsive mt-3 w-25" alt="Logo">
                        <img class="logo-fold w-100 mt-2 px-2 mb-2" src="favicons.png" alt="Logo">
                    </a>
                </div>
                <div class="logo logo-white">
                    <a>
                        <img src="favicons.png" class="img-fluid img-responsive mt-3 w-25" alt="Logo">
                        <img class="logo-fold w-100 mt-2 px-2 mb-2" src="favicons.png" alt="Logo">
                    </a>
                </div>
                <div class="nav-wrap">
                    <ul class="nav-left">
                        <li class="desktop-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        <li class="mobile-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        <li class="d-flex justify-content-right">
                            <header class="main-header">
                                <nav class="navbar">
                                    <div class="container" style="margin-left: 40vw;">
                                        <a href="." class="btn btn-success btn-sm navbar-brand">Refresh</a>
                                    </div>
                                </nav>
                            </header>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="side-nav">
                <div class="side-nav-inner">
                    <ul class="side-nav-menu scrollable mt-5">
                        <li class="nav-item open">
                            <a class="dropdown-toggle" href="dashboard.php">
                                <span class="icon-holder">
                                    <i class="anticon anticon-home"></i>
                                </span>
                                <span class="title">Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-toggle" href="heritage.php">
                                <span class="icon-holder">
                                    <i class="anticon anticon-book"></i>
                                </span>
                                <span class="title">Reports</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-toggle" href="heritage.php">
                                <span class="icon-holder">
                                    <i class="anticon anticon-dashboard"></i>
                                </span>
                                <span class="title">Time</span>
                            </a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="dropdown-toggle" href="logout.php">
                                <span class="icon-holder">
                                    <i class="anticon anticon-lock"></i>
                                </span>
                                <span class="title">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="page-container">
                <div class="main-content">
                    <div class="col-md-11 offset-col-1">
                        <div class="page-loader"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <label style="margin-left: 100px; font-size: 20px; font-weight: bolder; margin-top: 50px; padding: 0 !important;">
                                        Tank 1
                                    </label>
                                    <div class="tank waterTankHere1"></div>
                                </div>
                                <div class="col">
                                    <label style="margin-left: 100px; font-size: 20px; font-weight: bolder; margin-top: 50px; padding: 0 !important;">
                                        Tank 2
                                    </label>
                                    <div class="tank waterTankHere2"></div>
                                </div>
                                <div class="col">
                                    <label style="margin-left: 100px; font-size: 20px; font-weight: bolder; margin-top: 50px; padding: 0 !important;">
                                        Tank 3
                                    </label>
                                    <div class="tank waterTankHere3"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label style="margin-left: 100px; font-size: 20px; font-weight: bolder; margin-top: 100px; padding: 0 !important;">
                                        Tank 4
                                    </label>
                                    <div class="tank waterTankHere4"></div>
                                </div>
                                <div class="col">
                                    <label style="margin-left: 100px; font-size: 20px; font-weight: bolder; margin-top: 100px; padding: 0 !important;">
                                        Tank 5
                                    </label>
                                    <div class="tank waterTankHere5"></div>
                                </div>
                                <div class="col">
                                    <label style="margin-left: 100px; font-size: 20px; font-weight: bolder; margin-top: 100px; padding: 0 !important;">
                                        Tank 6
                                    </label>
                                    <div class="tank waterTankHere6"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label style="margin-left: 100px; font-size: 20px; font-weight: bolder; margin-top: 100px; padding: 0 !important;">
                                        Tank 7
                                    </label>
                                    <div class="tank waterTankHere7"></div>
                                </div>
                                <div class="col">
                                    <!--<label style="margin-left: 100px; font-size: 20px; font-weight: bolder; margin-top: 100px; padding: 0 !important;">
                                        Tank 8
                                    </label>
                                    <div class="tank waterTankHere8"></div>-->
                                </div>
                                <div class="col">
                                    <!--<label style="margin-left: 100px; font-size: 20px; font-weight: bolder; margin-top: 100px; padding: 0 !important;">
                                        Tank 9
                                    </label>
                                    <div class="tank waterTankHere8"></div>-->
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="footer-content">
                        <p class="m-b-0">Copyright &copy; <?php echo date("Y"); ?> TAL</p>
                    </div>
                </footer>
            </div>
        </div>
    </div>


    <!-- <script src="assets/js/jquery.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/js/vendors.min.js"></script>
    <script src="assets/vendors/chartjs/Chart.min.js"></script>
    <script src="assets/js/pages/dashboard-default.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script src="waterTank.js"></script>
    
    <script>
        $(document).ready(function() {
            $('.waterTankHere1').waterTank({
                width: 230,
                height: 300,
                color: '#8bd0ec',
                level: 0
            }).on('click', function(event) {
                $.ajax({
                    type: 'POST',
                    url: 'tank1.php',
                    success: function(data) {
                        if (isNaN(data)) {
                            // do not update the tank animation
                        }
                        else {
                            $('.waterTankHere1').waterTank({
                                level: data
                            });
                        }
                    }
                });
            });
            $('.waterTankHere2').waterTank({
                width: 230,
                height: 300,
                color: '#8bd0ec',
                level: 0
            }).on('click', function(event) {
                $.ajax({
                    type: 'POST',
                    url: 'tank2.php',
                    success: function(data) {
                        if (isNaN(data)) {
                            // do not update the tank animation
                        }
                        else {
                            $('.waterTankHere2').waterTank({
                                level: data
                            });
                        }
                    }
                });
            });
            $('.waterTankHere3').waterTank({
                width: 230,
                height: 300,
                color: '#8bd0ec',
                level: 0
            }).on('click', function(event) {
                $.ajax({
                    type: 'POST',
                    url: 'tank3.php',
                    success: function(data) {
                        if (isNaN(data)) {
                            // do not update the tank animation
                        }
                        else {
                            $('.waterTankHere3').waterTank({
                                level: data
                            });
                        }
                    }
                });
            });
            $('.waterTankHere4').waterTank({
                width: 230,
                height: 300,
                color: '#8bd0ec',
                level: 0
            }).on('click', function(event) {
                $.ajax({
                    type: 'POST',
                    url: 'tank4.php',
                    success: function(data) {
                        if (isNaN(data)) {
                            // do not update the tank animation
                        }
                        else {
                            $('.waterTankHere4').waterTank({
                                level: data
                            });
                        }
                    }
                });
            });
            $('.waterTankHere5').waterTank({
                width: 230,
                height: 300,
                color: '#8bd0ec',
                level: 0
            }).on('click', function(event) {
                $.ajax({
                    type: 'POST',
                    url: 'tank5.php',
                    success: function(data) {
                        if (isNaN(data)) {
                            // do not update the tank animation
                        }
                        else {
                            $('.waterTankHere5').waterTank({
                                level: data
                            });
                        }
                    }
                });
            });
            $('.waterTankHere6').waterTank({
                width: 230,
                height: 300,
                color: '#8bd0ec',
                level: 0
            }).on('click', function(event) {
                $.ajax({
                    type: 'POST',
                    url: 'tank6.php',
                    success: function(data) {
                        if (isNaN(data)) {
                            // do not update the tank animation
                        }
                        else {
                            $('.waterTankHere6').waterTank({
                                level: data
                            });
                        }
                    }
                });
            });
            $('.waterTankHere7').waterTank({
                width: 230,
                height: 300,
                color: '#8bd0ec',
                level: 0
            }).on('click', function(event) {
                $.ajax({
                    type: 'POST',
                    url: 'tank7.php',
                    success: function(data) {
                        if (isNaN(data)) {
                            // do not update the tank animation
                        }
                        else {
                            $('.waterTankHere7').waterTank({
                                level: data
                            });
                        }
                    }
                });
            });
            $('.waterTankHere8').waterTank({
                width: 230,
                height: 300,
                color: '#8bd0ec',
                level: 0
            }).on('click', function(event) {
                $.ajax({
                    type: 'POST',
                    url: 'tank1.php',
                    success: function(data) {
                        if (isNaN(data)) {
                            // do not update the tank animation
                        }
                        else {
                            $('.waterTankHere8').waterTank({
                                level: 0
                            });
                        }
                    }
                });
            });
        });
        setInterval(function(){
           $('.waterTankHere1').trigger('click');
           $('.waterTankHere2').trigger('click');
           $('.waterTankHere3').trigger('click');
           $('.waterTankHere4').trigger('click');
           $('.waterTankHere5').trigger('click');
           $('.waterTankHere6').trigger('click');
           $('.waterTankHere7').trigger('click');
           $('.waterTankHere8').trigger('click');
        }, 2000);
    </script>
</body>
</html>