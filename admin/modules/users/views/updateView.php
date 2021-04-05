<?php get_header();

?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=users&controller=team&action=addUser" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar('users'); ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">

                <div class="section-detail">
                    <?php echo form_success('success') ?>
                    <form action="" method="POST">
                        <label for="display-name">Tên hiển thị</label>
                        <input type="text" name="fullname" id="display-name" value="<?php echo $info_user['fullname'] ?>">

                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" placeholder="admin" readonly="readonly" value="<?php echo $info_user['username'] ?>">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" readonly="readonly" value="<?php echo $info_user['email'] ?>">
                        <label for="tel">Số điện thoại</label>
                        <?php echo form_error('phonenumber'); ?>
                        <input type="tel" name="phonenumber" id="tel" value="<?php echo $info_user['phonenumber'] ?>">

                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address"><?php echo $info_user['address'] ?></textarea>
                        <?php
                        if (user_role() == 1) {
                        ?>
                            <?php echo form_error('role'); ?>
                            <select name="role" id="">
                                <option value="0">-----Quyền hạn-----</option>
                                <option value="1" <?php if ($info_user['role'] == 1) echo "selected = 'selected'" ?>>Quản lý</option>
                                <option value="2" <?php if ($info_user['role'] == 2) echo "selected = 'selected'" ?>>Biên tâp viên</option>
                                <option value="3" <?php if ($info_user['role'] == 3) echo "selected = 'selected'" ?>>Cộng tác viên</option>
                            </select>
                        <?php
                        }
                        ?>
                        <button type="submit" name="btn_update" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .error {
        color: red;
        font-style: italic;
        font-size: 14px;
        font-weight: 500;
    }
    .success{
        color: #3498db;
        font-size: 18px;
        font-style: italic;
    }
</style>
<?php get_footer(); ?>