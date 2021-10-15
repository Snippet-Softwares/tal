<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>TAL - Login</title>
        <link rel="shortcut icon" href="favicons.png" />
        <link href="assets/css/app.min.css" rel="stylesheet" />
    </head>

    <body>
        <div class="app">
            <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('bence.jpg');">
                <div class="d-flex flex-column justify-content-between w-100">
                    <div class="container d-flex h-100">
                        <div class="row align-items-center w-100">
                            <div class="col-md-7 col-lg-5 mx-auto m-h-auto">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between m-b-30">
                                            <img alt="" src="favicons.png" class="img-fluid img-responsive w-25">
                                            <h2 class="m-b-0">Sign In</h2>
                                        </div>
                                        <form method="POST" id="loginform">
                                            <div class="form-group">
                                                <label class="font-weight-semibold" for="userName">Username:</label>
                                                <div class="input-affix">
                                                    <i class="prefix-icon anticon anticon-user"></i>
                                                    <input type="email" class="form-control" id="user" name="user" placeholder="Username" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-semibold" for="password">Password:</label>
                                                <div class="input-affix m-b-10">
                                                    <i class="prefix-icon anticon anticon-lock"></i>
                                                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <p id="incresp" class="pt-1 pb-1 text-black" style="display: none; font-size: 20px;"></p>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <button class="btn btn-success btn-sm" id="btnLogin">Sign In</button>
                                                    <span class="font-size-13 text-muted">
                                                        <a class="float-right font-size-13 text-muted" href="#">Forgot Password?</a>
                                                    </span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="assets/js/vendors.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        <script type="text/javascript">
            $("#loginform").submit(function(event) {
                event.preventDefault();
                var values = $(this).serialize();
                document.getElementById('incresp').style.display = 'block';
                document.getElementById('incresp').style.color = 'black';
                document.getElementById('incresp').innerHTML = 'Loggin in...';
                $.ajax({
                    url: "login.php",
                    type: "post",
                    data: values ,
                    success: function (response) {
                        if (response == "login") {
                            document.getElementById('incresp').style.color = 'green';
                            document.getElementById('incresp').style.display = 'none';
                            document.getElementById('incresp').innerHTML = "Login success";
                            document.getElementById('incresp').style.display = 'block';
                            setTimeout(function() {
                                window.location.href = "dashboard.php";
                            }, 1000);
                        }
                        else {
                            document.getElementById('incresp').style.color = 'red';
                            document.getElementById('incresp').style.display = 'none';
                            document.getElementById('incresp').innerHTML = "Invalid login credentials";
                            document.getElementById('incresp').style.display = 'block';
                            setTimeout(function() {
                                $('#incresp').fadeOut('fast');
                                document.getElementById('user').value = '';
                                document.getElementById('pass').value = '';
                            }, 2500);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        window.location.href = "../tal/";
                    }
                });
            });
        </script>
    </body>
</html>