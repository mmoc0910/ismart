<html>

<head>
    <title>trang dang nhap</title>

    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/login.css">
</head>

<body>

    <div id="wp-form-login">
        <h1>Lay lai mat khau</h1>
        <form action="" method="POST" id="form-login">
            <input type="email" name="email" id="username" value="<?php echo set_value('email') ?>" placeholder="username">
            <?php echo form_error('email') ?>

            <input type="submit" name="btn_send" id="btn_login" value="Gui yeu cau">
            <?php echo form_error('error_email') ?>

        </form>
        <a href="?mod=users&action=login">Dang nhap</a><a href="?mod=users&action=reg">|Đăng ký</a>
    </div>
</body>

</html>