<html>

<head>
    <title>he thong dieu huong co ban</title>
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <a href="" id="logo">UNITOP</a>
            <div id="user-login">
                <?php
                if (!empty($_SESSION['is_login'])) {
                    echo "<p>Xin chao <strong>{$_SESSION['user_login']}</strong>(<a href='?mod=users&action=logout'>Dang xuat</a>)</p>";
                } else {
                    echo "<a href='?mod=users&action=reg'>Dang ky</a>|<a href='?mod=users&action=login'>dang nhap</a>";
                }
                ?>


            </div>
            <ul id="main-menu">
                <li><a href="?page=home">Trang chu</a></li>
                <li><a href="?page=about">Gioi thieu</a></li>
                <li><a href="?page=news">Tin tuc</a></li>
                <li><a href="?page=product">San pham</a></li>
                <li><a href="?page=contact">Lien he</a></li>
            </ul>
        </div>
        <!-- end-header -->