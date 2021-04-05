<html>

<head>
    <title>trang dang nhap</title>

    <link rel="stylesheet" href="public/css/import/reset.css">
    <link rel="stylesheet" href="public/css/import/login.css">
</head>

<body>

    <div id="wp-form-login">
        <h1>Dang nhap</h1>
        <form action="" method="POST" id="form-login">
            <input type="text" name="username" id="username" value="<?php echo set_value('username') ?>" placeholder="username">
            <?php echo form_error('username'); ?>
            <input type="password" name="password" id="password" placeholder="password" id="">
            <?php echo form_error('password'); ?>
            <input type="submit" name="btn_login" id="btn_login" value="Dang nhap">
            <?php echo form_error('error_login') ?>
            <input type="checkbox" name="remember_me"> Ghi nho dang nhap
        </form>
        <a href="?mod=users&action=reset">Quên mật khẩu</a><a href="?mod=users&action=reg">|Đăng ký</a>
    </div>
</body>

</html>