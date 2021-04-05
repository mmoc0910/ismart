<?php get_header();

?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <!-- <a href="?mod=users&controller=team&action=addUser" title="" id="add-new" class="fl-left">Thêm mới</a> -->
            <h3 id="index" class="fl-left">Thêm tài khoản admin</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar('users'); ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">

                <div class="section-detail">
                    <?php echo form_success('success') ?>
                    <?php echo form_error('acount') ?>
                    <form action="" method="POST">
                        <label for="display-name">Họ và tên</label>
                        <input type="text" name="fullname" id="display-name" value="<?php echo set_value('fullname') ?>">

                        <label for="username">Tên đăng nhập</label>
                        <?php echo form_error('username') ?>
                        <input type="text" name="username" id="username" value="<?php echo set_value('username') ?>">

                        <label for="email">Email</label>
                        <?php echo form_error('email'); ?>
                        <input type="email" name="email" id="email" value="<?php echo set_value('email') ?>">
                        <label for="tel">Số điện thoại</label>
                        <?php echo form_error('phonenumber'); ?>
                        <input type="tel" name="phonenumber" id="tel" value="<?php echo set_value('phonenumber') ?>">

                        <label for="password">Mật khẩu</label>
                        <?php echo form_error('password'); ?>
                        <input type="password" name="password" id="password" value="">
                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address"><?php echo set_value('address') ?></textarea>

                        <?php echo form_error('role'); ?>
                        <select name="role" id="">
                            <option value="0">-----Quyền hạn-----</option>
                            <option value="1" <?php if (isset($_POST['role']) && $_POST['role'] == 1) echo "selected = 'selected'" ?>>Quản lý</option>
                            <option value="2" <?php if (isset($_POST['role']) && $_POST['role'] == 2) echo "selected = 'selected'" ?>>Biên tâp viên</option>
                            <option value="3" <?php if (isset($_POST['role']) && $_POST['role'] == 3) echo "selected = 'selected'" ?>>Cộng tác viên</option>
                        </select>

                        <button type="submit" name="btn_add" id="btn-submit">Thêm mới</button>
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

    .success {
        color: #3498db;
        font-size: 18px;
        font-style: italic;
    }

    #index {
        margin-left: 150px;
    }

    #username {
        cursor: auto;
        background: none;
    }

    #password {
        display: block;
        padding: 5px 10px;
        border: 1px solid #ddd;
        width: 35%;
        margin-bottom: 15px;
    }
</style>
<?php get_footer(); ?>