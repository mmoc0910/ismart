<html>

<head>
    <title>thiet lap mat khau</title>

    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/login.css">
</head>

<body>

    <div id="wp-form-login">
        <h1>Khoi phuc mat khau</h1>
        <form action="" method="POST" id="form-login">
           
            <input type="password" name="password" id="password" placeholder="password" id="">
            <?php echo form_error('password'); ?>
            <input type="submit" name="btn_new_pass" id="btn_login" value="Cap nhat mat khau">
            
        </form>
        <a href="?mod=users&action=login">Dang nhap</a><a href="?mod=users&action=reg">|Đăng ký</a>
    </div>
</body>

</html>