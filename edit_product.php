<?php
    session_start();
    include('conn.php');
    if (!isset($_SESSION['user'])) {
        echo "<META http-equiv='refresh' content='0;logout.php'>";
    }

    if (isset($_GET['p'])) {
        $cid = $_GET['p'];
    }
    else {
        echo '<META HTTP-EQUIV="refresh" content="0;URL=products.php">';
        exit();
    }

    if (isset($_POST['btnBtUpdate'])) {
        $catg = mysqli_real_escape_string($conn,$_POST['cat']);
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $desc = mysqli_real_escape_string($conn,$_POST['pdesc']);
        $img = mysqli_real_escape_string($conn,$_FILES['bimg']['name']);
        $timg = mysqli_real_escape_string($conn,$_FILES['bimg']['tmp_name']);

        if (isset($_FILES['bimg']['name']) && ($_FILES['bimg']['name'] != "" || $_FILES['bimg']['name'] != NULL)) {
            upload_b_image($conn,$catg,$name,$desc,$img,$timg);
        }
        else {
            $query = "update products set type = '".$catg."', name = '".$name."', descr = '".$desc."' where id = '".$cid."'";
            if(mysqli_query($conn, $query)) {
                echo "<script>window.alert('Product updated successfully');</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=products.php">';
            }
            else {
                echo "<script>window.alert('Sorry, there was an error updating product');</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=products.php">';
            }
        }
    }

    function upload_b_image($conn,$catg,$name,$desc,$img,$timg) {
        $uploadedFile = $timg; 
        $sourceProperties = getimagesize($uploadedFile);
        $newFileName = time();
        $dirPath = "../assets/img/product/";
        $ext = pathinfo($img, PATHINFO_EXTENSION);
        $imageType = $sourceProperties[2];
        $imageok = 0;

        switch ($imageType) {
            case IMAGETYPE_PNG:
                $imageSrc = imagecreatefrompng($uploadedFile); 
                $tmp = imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1],2);
                imagepng($tmp,$dirPath. $newFileName. "_joo.". $ext);
                break;
            case IMAGETYPE_JPEG:
                $imageSrc = imagecreatefromjpeg($uploadedFile); 
                $tmp = imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1],3);
                imagejpeg($tmp,$dirPath. $newFileName. "_joo.". $ext);
                break;
            case IMAGETYPE_GIF:
                $imageSrc = imagecreatefromgif($uploadedFile); 
                $tmp = imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1],3);
                imagegif($tmp,$dirPath. $newFileName. "_joo.". $ext);
                break;
            default:
                echo "<script>alert('Invalid image type!');</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=products.php">';
                break;
                exit();
        }

        try {
            move_uploaded_file($uploadedFile, $dirPath.$newFileName."_joo.".$ext);
            $imageok = 1;
        }
        catch (Exception $e) {
            $imageok = 0;
            echo "<script>window.alert('$e');</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=products.php">';
            exit();
        }

        if ($imageok == 1) {
            $res = mysqli_query($conn,"select * from products where id = '".$_GET['p']."'") or die(mysqli_error($conn));
            $ro = mysqli_fetch_assoc($res);
            $query = "delete from products where id = '".$_GET['p']."'";
            unlink("../assets/img/product/".$ro['img']);
            $query = "update products set type = '".$catg."', name = '".$name."', descr = '".$desc."', img = '".$newFileName."_joo.".$ext."' where id = '".$_GET['p']."'";
            if(mysqli_query($conn, $query)) {
                echo "<script>window.alert('Product created successfully');</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=products.php">';

            }
            else {
                echo "<script>window.alert('Sorry, there was an error creating product');</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=products.php">';
            }
        }
        else {
            echo "<script>alert('File upload failed');</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=products.php">';
            exit();
        }
    }

    function imageResize($imageSrc,$imageWidth,$imageHeight,$ban) {
        $newImageWidth  = 370;
        $newImageHeight = 370;
        $newImageLayer=imagecreatetruecolor($newImageWidth,$newImageHeight);
        imagecopyresampled($newImageLayer,$imageSrc,0,0,0,0,$newImageWidth,$newImageHeight,$imageWidth,$imageHeight);
        return $newImageLayer;
    }

    function gemType($type) {
        if ($type == "eag") {
            $type = "East African Gems";
        }
        else if ($type == "br") {
            $type = "Bridal";
        }
        else if ($type == "he") {
            $type = "High-End";
        }
        else if ($type == "fjc") {
            $type = "Fine Jewellery Collections";
        }
        else if ($type == "ge") {
            $type = "Gemstones";
        }
        else if ($type == "gi") {
            $type = "Gifts";
        }
        return $type;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>JOO & CO. THE JEWELLERY</title>
    <link rel="shortcut icon" href="assets/images/logo/favicon.png">
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="app">
        <div class="layout">
            <div class="header">
                <div class="logo logo-dark">
                    <a>
                        <img src="assets/images/logo/logo_big.png" class="img-fluid img-responsive mt-3 w-75" alt="Logo">
                        <img class="logo-fold w-100 mt-2 px-2 mb-2" src="assets/images/logo/favicon.png" alt="Logo">
                    </a>
                </div>
                <div class="logo logo-white">
                    <a>
                        <img src="assets/images/logo/logo_big.png" class="img-fluid img-responsive mt-3 w-75" alt="Logo">
                        <img class="logo-fold w-100 mt-2 px-2 mb-2" src="assets/images/logo/favicon.png" alt="Logo">
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
                            <a class="dropdown-toggle" href="dashboard.php">
                                <span class="icon-holder">
                                    <i class="anticon anticon-dashboard"></i>
                                </span>
                                <span class="title">Home</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown open">
                            <a class="dropdown-toggle" href="products.php">
                                <span class="icon-holder">
                                    <i class="fab fa-product-hunt"></i>
                                </span>
                                <span class="title">Jewellery</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown open">
                            <a class="dropdown-toggle" href="heritage.php">
                                <span class="icon-holder">
                                    <i class="anticon anticon-book"></i>
                                </span>
                                <span class="title">Heritage</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown open">
                            <a class="dropdown-toggle" href="retail.php">
                                <span class="icon-holder">
                                    <i class="anticon anticon-gift"></i>
                                </span>
                                <span class="title">Retail</span>
                            </a>
                        </li><hr>
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
                    <div class="row">
                        <div class="col-10">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data">
                                        <?php
                                            $result = mysqli_query($conn, "select * from products where id = '".$cid."'") or die(mysqli_error($conn));
                                            $row = mysqli_fetch_assoc($result);
                                        ?>
                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="cat">Product Category</label>
                                                    <select class="form-control" id="cat" name="cat" required>
                                                        <option value="<?php echo $row['type']; ?>"><?php echo gemType($row['type']); ?></option>
                                                        <option value="eag">East African Gems</option>
                                                        <option value="br">Bridal</option>
                                                        <option value="he">High-End</option>
                                                        <option value="fjc">Fine Jewellery Collections</option>
                                                        <option value="ge">Gemstones</option>
                                                        <option value="gi">Gifts</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label class="form-label" for="name">Product Name</label>
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Tanzanite" value="<?php echo $row['name']; ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col">
                                                <label class="form-label" for="bimg">Product Image</label>
                                                <input type="file" id="bimg" name="bimg" accept="image/*" onchange="loadFiles(event)" class="form-control">
                                            </div>
                                            <div class="col">
                                                <label class="form-label">Image Preview</label>
                                                <img id="outputs" class="img-fluid img-responsive w-75" src="../assets/img/product/<?php echo $row['img']; ?>" alt="Banner image" />
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col">
                                                <label class="form-label" for="pdesc">Product Description</label>
                                                <textarea class="form-control" rows="8" id="pdesc" name="pdesc" placeholder="Enter product description"><?php echo $row['descr']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-4 px-4">
                                            <input type="submit" class="btn btn-cart" name="btnBtUpdate" value="Update">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="footer-content">
                        <p class="m-b-0">Copyright &copy; <?php echo date("Y"); ?> Joo & Co.</p>
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
        var loadFiles = function(event) {
            var output = document.getElementById('outputs');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
        $('#data-table').DataTable();
    </script>
</body>
</html>