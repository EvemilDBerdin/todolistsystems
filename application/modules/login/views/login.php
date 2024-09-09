<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/uploads/Berdin.ico') ?>">
    <title><?= $title ?></title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/adminwrap/" />
    <link href="<?= base_url('assets/adminwrap/') ?>node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/adminwrap/') ?>css/pages/login-register-lock.css" rel="stylesheet">
    <link href="<?= base_url('assets/adminwrap/') ?>css/style.css" rel="stylesheet">
    <link href="<?= base_url('assets/adminwrap/') ?>css/colors/default.css" id="theme" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/adminwrap/') ?>node_modules/sweetalert2/dist/sweetalert2.min.css">
</head>

<body class="card-no-border">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">TODO LIST SYSTEM</p>
        </div>
    </div>
    <section id="wrapper">
        <div class="login-register"
            style="background-image:url(http://localhost/todolist/assets/uploads/todo.jpg); height:100vh;">
            <div class="login-box card rounded">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginidForm" onsubmit="loginForm(event)">
                        <h3 class="box-title m-b-20">TODO LIST SYSTEM</h3>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="username" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password" placeholder="Password"
                                    required>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Log In</button>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <a href="javascript:void(0)" onclick="showRegisterForm()" class="font-bold">Register</a>
                        </div>
                    </form>
                    <form class="form-horizontal form-material" id="registeridForm" onsubmit="registrationForm(event)"
                        style="display: none;">
                        <h3 class="box-title m-b-20 font-weight-bold">TODO LIST SYSTEM</h3>
                        <h5 class="box-title m-b-20">Registration</h5>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="username" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password" placeholder="Password"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="phonenumber" placeholder="Phone Number"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="email" name="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Submit</button>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <a href="javascript:void(0)" onclick="showLoginForm()" class="font-bold">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="<?= base_url('assets/adminwrap/') ?>node_modules/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/adminwrap/') ?>node_modules/bootstrap/js/popper.min.js"></script>
    <script src="<?= base_url('assets/adminwrap/') ?>node_modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/adminwrap/') ?>node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $(".preloader").fadeOut();
            $('[data-toggle="tooltip"]').tooltip()
        });

        const loginForm = (e) => {
            e.preventDefault();
            let data = new FormData(e.currentTarget);
            sendAjax('<?= base_url('login/auth') ?>', data).then((res) => {
                swalRes(res.response, res.msg);
                return (res.response == 200) ? true : false;
            }).then((r) => {
                (r) && setTimeout(function () {
                    myReloadPage()
                }, 1500);
            });
        }
        const registrationForm = (e) => {
            e.preventDefault();
            let data = new FormData(e.currentTarget);
            sendAjax('<?= base_url('login/register') ?>', data).then((res) => {
                swalRes(res.response, res.msg);
                return (res.response == 200) ? true : false;
            }).then((r) => {
                (r) && setTimeout(function () {
                    myReloadPage()
                }, 1500);
            });
        }

        const showLoginForm = () => {
            $('#registeridForm').css("display", "none");
            $('#loginidForm').css("display", "block");
        }
        const showRegisterForm = () => {
            $('#registeridForm').css("display", "block");
            $('#loginidForm').css("display", "none");
        }

        /* useful function */
        function sendAjax(url, data = {}, isForm = false) {
            if (isForm) {
                return new Promise(function (myResolve, myReject) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        dataType: "json",
                        data: data,
                        async: false,
                        cache: false,
                        enctype: "multipart/form-data",
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            // loader(element.target, element.type)
                        },
                        success: function (res) {
                            myResolve(res); // when successful
                        },
                        error: function (err) {
                            myReject(err); // when error
                        },
                    });
                });

            } else {
                return new Promise(function (myResolve, myReject) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        dataType: "json",
                        data: data,
                        async: false,
                        processData: false,
                        contentType: false,
                        cache: false,
                        beforeSend: function () {
                            // loader(element.target, element.type)
                        },
                        success: function (res) {
                            myResolve(res); // when successful
                        },
                        error: function (err) {
                            myReject(err); // when error
                        },
                    });
                });
            }
        }

        const swalRes = (status, message) => {
            (status == 200) ? Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: message,
                showConfirmButton: false,
                timer: 1500
            }) : Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: message,
                showConfirmButton: false,
                timer: 1500
            })
        }

        const myReloadPage = () => {
            window.location = window.location;
        }

    </script>
    <script>
        var urls = `<?= base_url() ?>`;
    </script>
    <script src="<?= base_url('assets/global/') ?>global.js"></script>
</body>

</html>