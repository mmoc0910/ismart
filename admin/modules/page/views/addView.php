<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm trang</h3>
                </div>
            </div>
            
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                    <label for="title">Trang</label>
                        <?php echo form_error('category'); ?>
                        <input type="text" name="category" id="title" value="<?php echo set_value('category'); ?>">

                        <label for="title">Tiêu đề</label>
                        <?php echo form_error('title'); ?>
                        <input type="text" name="title" id="title" value="<?php echo set_value('title'); ?>">

                        <label for="title">Slug ( Friendly_url )</label>
                        <?php echo form_error('slug'); ?>
                        <input type="text" name="slug" id="slug" value="<?php echo set_value('slug'); ?>">
                        <label for="desc">Mô tả</label>
                        <?php echo form_error('desc'); ?>
                        <textarea name="desc" id="desc" class="ckeditor"><?php echo set_value('desc'); ?></textarea>


                        <button type="submit" name="btn_add_post" id="btn-submit">Thêm mới</button>
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
</style>
<?php get_footer() ?>