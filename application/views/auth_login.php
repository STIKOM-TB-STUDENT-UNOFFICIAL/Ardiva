<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ardiva</title>
    <link rel="shortcut icon" href="<?=base_url("assets/compiled/svg/favicon.svg")?>" type="image/x-icon">
    <link rel="stylesheet" href="<?=base_url("assets/compiled/css/app.css")?>">
    <link rel="stylesheet" href="<?=base_url("assets/compiled/css/app-dark.css")?>">
    <link rel="stylesheet" href="<?=base_url("assets/compiled/css/auth.css")?>">
</head>

<body>
    <script src="<?=base_url("assets/static/js/initTheme.js")?>"></script>
    <div id="auth" class="d-flex justify-content-center align-items-center vh-100">
        <div class="row w-100">
            <div class="col-lg-4 col-md-8 col-12 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h1 class="auth-title">Ardiva</h1>
                        </div>
                        <form action="<?= base_url('login/proses'); ?>" method="post">
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input name="username" type="text" class="form-control form-control-lg" placeholder="Username"
                                    required>
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input name="password" type="password" class="form-control form-control-lg" placeholder="Password"
                                    required>
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-lg btn-block shadow">Log in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>