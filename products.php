<?php
    session_start();
    include('conn.php');

    if (!isset($_SESSION['user'])) {
        echo "<META http-equiv='refresh' content='0;logout.php'>";
    }

    if (isset($_GET['p'])) {
        $res = mysqli_query($conn,"select * from products where id = '".$_GET['p']."'") or die(mysqli_error($conn));
        $ro = mysqli_fetch_assoc($res);
        $query = "delete from products where id = '".$_GET['p']."'";
        $success = 0;
        try {
            mysqli_query($conn,$query) or die(mysqli_error($conn));
            $success = 1;
        }
        catch (Exception $e) {
            $success = 0;
            echo "<script>window.alert('$e');</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=products.php">';
            exit();
        }
        if ($success = 1) {
            unlink("../assets/img/product/".$ro['img']);
            echo "<script>alert('Product deleted successfully');</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=products.php">';
        }
    }

    if (isset($_POST['btnUpdate'])) {
        $catg = mysqli_real_escape_string($conn,$_POST['cat']);
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $descr = mysqli_real_escape_string($conn,$_POST['descr']);
        
        $dtsh_name = $_FILES['file']['name'];
        $dtsh_size = $_FILES['file']['size'];
        $dtsh_tmp = $_FILES['file']['tmp_name'];
        $dtsh_type = $_FILES['file']['type'];
        if($dtsh_size > 10097152) {
            echo "<script>document.getElementById('Datasheet size must be less than 2MB');</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=products.php">';
            exit();
        }

        $desired_dir = "../assets/img/products/";
        if(is_dir($desired_dir)==false) {
            mkdir("$desired_dir", 0700);
        }
        $dtsh_name = md5($dtsh_name.time());
        $dtsh_name = $dtsh_name.".jpg";
        if(is_dir("$desired_dir/".$dtsh_name)==false) {
            move_uploaded_file($dtsh_tmp,"$desired_dir/".$dtsh_name);
        }
        else {
            echo "<script>document.getElementById('File upload failed');</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=products.php">';
            exit();
        }

        if (isset($_POST['scat'])) {
            $subct = mysqli_real_escape_string($conn,$_POST['scat']);
        }
        else {
            $subct = "";
        }
        if(isset($_FILES['files'])) {
            $errors= array();
            $images= array();
            foreach($_FILES['files']['tmp_name'] as $key => $tmp_name) {
                $file_name = $key.$_FILES['files']['name'][$key];
                $file_size =$_FILES['files']['size'][$key];
                $file_tmp =$_FILES['files']['tmp_name'][$key];
                $file_type=$_FILES['files']['type'][$key];  
                if($file_size > 10097152) {
                    $errors[]='Image sizes must be less than 2MB';
                }
                $desired_dir="../assets/img/products/";
                if(empty($errors)==true) {
                    if(is_dir($desired_dir)==false) {
                        mkdir("$desired_dir", 0700);
                    }
                    $file_name = md5($file_name.time());
                    $file_name = $file_name.".jpg";
                    if(is_dir("$desired_dir/".$file_name)==false) {
                        move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
                        $images[] = $file_name;
                    }
                }
                else {
                    echo "<script>document.getElementById('response').innerHTML='print_r($errors)';</script>";
                }
            }
            if(empty($error)) {
                $img = "";
                for ($i=0; $i < count($images); $i++) { 
                    $img = $img.",".$images[$i];
                }
                $img = substr($img, 1);
                $query = "insert into products (type,name,subct,fsubct,img,dtsh,descr) values ('".$catg."','".$name."','".$subct."','','".$img."','".$dtsh_name."','".$descr."')";
                if(mysqli_query($conn, $query)) {
                    echo "<script>window.alert('Product added successfully');</script>";
                    echo '<META HTTP-EQUIV="refresh" content="0;URL=products.php">';

                }
                else {
                    echo "<script>window.alert('Sorry, there was an error adding product');</script>";
                    echo '<META HTTP-EQUIV="refresh" content="0;URL=products.php">';
                }
            }
            else {
                echo "<script>window.alert('Sorry, there was an error adding product');</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=products.php">';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hydrotech Hardware</title>
    <link rel="shortcut icon" href="../assets/img/fav.jpg">
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="app">
        <div class="layout">
            <div class="header">
                <div class="logo logo-dark">
                    <a>
                        <img src="../assets/img/logo.png" class="img-fluid img-responsive mt-3 w-75" alt="Logo">
                        <img class="logo-fold w-100 mt-2 px-2 mb-2" src="../assets/img/logo_sm.jpg" alt="Logo">
                    </a>
                </div>
                <div class="logo logo-white">
                    <a>
                        <img src="../assets/img/logo.png" class="img-fluid img-responsive mt-3 w-75" alt="Logo">
                        <img class="logo-fold w-100 mt-2 px-2 mb-2" src="../assets/img/logo_sm.jpg" alt="Logo">
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
                        <li>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#search-drawer">
                                <i class="anticon anticon-search"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="side-nav">
                <div class="side-nav-inner">
                    <ul class="side-nav-menu scrollable mt-5">
                        <li class="nav-item dropdown open">
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
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">New Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile_tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">All Products</a>
                        </li>
                    </ul>
                    <div class="tab-content m-t-15" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="col-md-10 offset-col-1">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data">
                                            <p id="response"></p>
                                            <div class="row mb-4">
                                                <div class="col">
                                                    <label class="form-label" for="name">Product Name</label>
                                                    <input type="text" name="name" id="name" class="form-control" placeholder="e.g PVC pipe" required>
                                                </div>
                                                <div class="col">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="cat">Product Category</label>
                                                        <select class="form-control" id="cat" name="cat" required>
                                                            <option value="">Choose type ...</option>
                                                            <option value="pipes">Pipes</option>
                                                            <option value="valves">Iron Valves</option>
                                                            <option value="rods">Welding Rods</option>
                                                            <option value="lift">Lifting Equipment</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="scat">Subcategory</label>
                                                        <select class="form-control" id="scat" name="scat" required>
                                                            <option value="">Choose type ...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col">
                                                    <label class="form-label" for="img">Product Image</label>
                                                    <input type="file" id="img" accept="image/*" name="files[]" multiple class="form-control mt-2 mb-4" onchange="loadFile(event)" required>
                                                </div>
                                                <div class="col">
                                                    <label class="form-label">Image Preview</label>
                                                    <img id="output" class="img-fluid img-responsive w-100" src="../assets/img/logo.png" alt="Banner image">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col">
                                                    <label class="form-label" for="img">Datasheet</label>
                                                    <input type="file" id="ds" accept="image/*" name="file" class="form-control mt-2 mb-4" onchange="loadFiles(event)" required>
                                                </div>
                                                <div class="col">
                                                    <label class="form-label">Datasheet Preview</label><br>
                                                    <img id="outputs" class="img-fluid img-responsive w-75" src="../assets/img/datasheet.jpg" alt="Banner image">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col">
                                                    <label class="form-label">Description</label>
                                                    <textarea class="form-control" name="descr" rows="8" placeholder="Product description"></textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-4 px-4">
                                                <input type="submit" class="btn btn-success" name="btnUpdate" value="Submit">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile_tab">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $count = 1;
                                            $jew = mysqli_query($conn,"select * from products") or die(mysql_error($conn));
                                            while ($jer = mysqli_fetch_assoc($jew)) { ?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo $jer['name']; ?></td>
                                                    <td>
                                                        <?php
                                                            if ($jer['type'] == "pipes") {
                                                                echo "Pipes";
                                                            }
                                                            else if ($jer['type'] == "valves") {
                                                                echo "Iron Valves";
                                                            }
                                                            else if ($jer['type'] == "rods") {
                                                                echo "Welding Rods";
                                                            }
                                                            else if ($jer['type'] == "lift") {
                                                                echo "Lifting Equipment";
                                                            }
                                                            else {
                                                                echo "&#8212;";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $jer['subct']; ?></td>
                                                    <td>
                                                        <img class="img-responsive w-100" src="<?php $img = explode(",", $jer['img']); echo '../assets/img/products/'.$img[0]; ?>">
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <a href="products.php?p=<?php echo $jer['id']; ?>" onclick="return confirm('Are you sure to delete this product?')" class="btn btn-danger btn-sm px-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                    <i class="anticon anticon-delete"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
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
                        <p class="m-b-0">Copyright &copy; <?php echo date("Y"); ?> Hydrotech Hardware</p>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="assets/js/vendors.min.js"></script>
    <script src="assets/vendors/chartjs/Chart.min.js"></script>
    <script src="assets/js/pages/dashboard-default.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        document.getElementById("scat").disabled = true;

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };

        var loadFiles = function(event) {
            var output = document.getElementById('outputs');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
        
        $('#data-table').DataTable();

        $('#cat').on('change', function() {
            $('#scat').html('');
            document.getElementById("scat").disabled = true;
            if($('#cat').val() == 'pipes') {
                document.getElementById("scat").disabled = false;
                $('#scat').append('<option value="">Choose type ...</option>');
                $('#scat').append('<option>PVC Pipes</option>');
                $('#scat').append('<option>Rubber Pipes</option>');
            }
            else if($('#cat').val() == 'valves') {
                document.getElementById("scat").disabled = false;
                $('#scat').append('<option value="">Choose type ...</option>');
                $('#scat').append('<option>Valve Type 1</option>');
                $('#scat').append('<option>Valve Type 2</option>');
                $('#scat').append('<option>Valve Type 3</option>');
                $('#scat').append('<option>Valve Type 4</option>');
            }
            else if($('#cat').val() == 'rods') {
                document.getElementById("scat").disabled = false;
                $('#scat').append('<option value="">Choose type ...</option>');
                $('#scat').append('<option>Cast Iron</option>');
                $('#scat').append('<option>Mig Wire</option>');
                $('#scat').append('<option>Mild Steel & Low Hydrogen</option>');
                $('#scat').append('<option>Stainless Steel/680</option>');
            }
            else if($('#cat').val() == 'lift') {
                document.getElementById("scat").disabled = false;
                $('#scat').append('<option value="">Choose type ...</option>');
                $('#scat').append('<option>ABLE Safety</option>');
                $('#scat').append('<option>Lifting & Hoisting Equipment</option>');
                $('#scat').append('<option>G80 Rigging Equipment</option>');
                $('#scat').append('<option>Material Handling Equipment</option>');
            }
            else {
                document.getElementById("scat").disabled = true;
                $('#scat').append('<option value="">Choose type ...</option>');
            }
        });
    </script>
</body>
</html>