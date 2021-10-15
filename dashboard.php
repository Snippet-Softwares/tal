<html>
    <head>
        <meta charset="UTF-8">
        <title>TAL - Dashboard</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="assets/css/app.min.css" rel="stylesheet">
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
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
                                    <i class="anticon anticon-dashboard"></i>
                                </span>
                                <span class="title">Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-toggle" href="heritage.php">
                                <span class="icon-holder">
                                    <i class="anticon anticon-book"></i>
                                </span>
                                <span class="title">Times</span>
                            </a>
                        </li><hr>
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
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Tank levels</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile_tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Table View</a>
                        </li>
                    </ul>
                    <div class="tab-content m-t-15" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="col-md-10 offset-col-1">
                                <div class="page-loader"></div>
                                <div class="container">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <div class="wrap">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="tank waterTankHere1"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile_tab">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tank</th>
                                            <th>Litres</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $count = 1;
                                            require('conn.php');
                                            $jew = mysqli_query($conn,"select * from levels order by id desc limit 15") or die(mysql_error($conn));
                                            while ($jer = mysqli_fetch_assoc($jew)) { ?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td style="max-width: 100px;">Tank 1</td>
                                                    <td style="max-width: 100px;"><?php echo $jer['vol']; ?></td>
                                                </tr>
                                            <?php $count++; }
                                        ?>
                                    </tbody>
                                </table>
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
                    url: 'fetch.php',
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
        });
        setInterval(function(){
           $('.waterTankHere1').trigger('click');
        }, 2000);
    </script>
</body>
</html>