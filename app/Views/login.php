<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Perpustakaan | </title>

    <!-- Bootstrap -->
    <link href="<?= base_url('public/gm') ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('public/gm') ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url('public/gm') ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= base_url('public/gm') ?>/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url('public/gm') ?>/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="<?= base_url('auth') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <h1>Login Form</h1>

                        <?php if (!empty(session()->getFlashdata('error'))) : ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><?= session()->getFlashdata('error') ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <script>
                                window.setTimeout(function() {
                                    $(".alert").fadeTo(500, 0).slideUp(500, function() {
                                        $(this).remove();
                                    });
                                }, 2000);
                            </script>
                        <?php endif ?>

                        <div>
                            <input type="text" class="form-control" name="email" placeholder="Username">
                        </div>
                        <div>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div>
                            <button class="btn btn-round btn-secondary">Login</button>
                        </div>
                        <div class="clearfix"></div>

                        <div class="separator">
                            <div class="clearfix"></div>

                            <div>
                                <h1><i class="fa fa-book"></i> Perpustakaan </h1>
                                <p>Created By Alifianda</p>
                            </div>
                        </div>
                        <form>
                </section>
            </div>

        </div>
    </div>
</body>

</html>