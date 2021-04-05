<html>

<head>
    <title>trang dang nhap</title>

    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/login.css">
</head>

<body>

    <div id="wp-form-login">
        <h1>Đăng ký tài khoản</h1>
        <form action="" method="POST" id="form-login">
            <input type="text" name="fullname" id="username" value="<?php echo set_value('fullname') ?>" placeholder="fullname">
            <?php echo form_error('fullname'); ?>
            <input type="email" name="email" id="username" value="<?php echo set_value('email') ?>" placeholder="email">
            <?php echo form_error('email'); ?>
            <input type="text" name="username" id="username" value="<?php echo set_value('username') ?>" placeholder="username">
            <?php echo form_error('username'); ?>
            <input type="password" name="password" id="password" placeholder="password" id="">
            <?php echo form_error('password'); ?>
            <input type="submit" name="btn_reg" id="btn_login" value="Đăng ký">
            <?php echo form_error('acount'); ?>
            <?php if(!empty($success['reg'])) echo $success['reg'] ?>

        </form>
        <a href="?mod=users&action=login">Đăng nhập</a>
    </div>
</body>

</html>