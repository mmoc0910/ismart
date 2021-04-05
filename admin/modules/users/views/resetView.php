<?php get_header(); ?>
<div id="main-content-wp" class="change-pass-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=users&controller=team&action=addUser" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Đổi mật khẩu</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar('users'); ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">

                    <form method="POST">
                        <label for="old-pass">Mật khẩu cũ</label>
                        <?php echo form_error('pass_old') ?>
                        <input type="password" name="pass_old" id="pass-old" value="<?php echo set_value('pass_old') ?>">
                        <label for="new-pass">Mật khẩu mới</label>
                        <?php echo form_error('pass_new') ?>
                        <input type="password" name="pass_new" id="pass-new" value="<?php echo set_value('pass_new') ?>">
                        <label for="confirm-pass">Xác nhận mật khẩu</label>
                        <?php echo form_error('confirm_pass') ?>
                        <input type="password" name="confirm_pass" id="confirm-pass" value="<?php echo set_value('confirm_pass') ?>">

                        <button type="submit" name="btn_reset" id="btn-submit">Cập nhật</button>
                        <?php echo form_success('new_pass') ?>
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
    }

    .success {
        color: #3498db;
        font-size: 16px;
    }
</style>
<?php get_footer(); ?>