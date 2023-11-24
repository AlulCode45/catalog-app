<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="<?= base_url('css/adminlte.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/app.css') ?>">

    <link rel="stylesheet" href="<?= base_url('plugins/toastr/toastr.min.css') ?>">
</head>
<body>
    <div class="login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto mt-lg-5">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="font-weight-bold text-center mx-auto my-auto text-dark text-uppercase">LOGIN ADMIN</h4>
                        </div>
    
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="username">Username: </label>
                                    <input type="text" name="username" id="username" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password: </label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <button class="btn btn-primary w-100" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('plugins/toastr/toastr.min.js') ?>"></script>

    <?php if (session()->getFlashdata("error")): ?>
        <script>
            toastr.error("<?= session()->getFlashdata("error") ?>")
        </script>
    <?php elseif (session()->getFlashdata("success")): ?>
        <script>
            toastr.success("<?= session()->getFlashdata("success") ?>")
        </script>
    <?php endif ?>
</body>
</html>