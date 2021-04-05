<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Sửa trang</h3>
                </div>
            </div>

            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="title">Trang</label>
                        <?php echo form_error('category') ?>
                        <input type="text" name="category" id="title" value="<?php echo $page['category'] ?>">

                        <label for="title">Tiêu đề</label>
                        <?php echo form_error('page_title') ?>
                        <input type="text" name="title" id="title" value="<?php echo $page['page_title'] ?>">

                        <label for="title">Slug ( Friendly_url )</label>
                        <?php echo form_error('slug') ?>
                        <input type="text" name="slug" id="slug" value="<?php echo $page['slug'] ?>">
                        <label for="desc">Mô tả</label>
                        <?php echo form_error('page_content') ?>
                        <textarea name="desc" id="desc" class="ckeditor"><?php echo $page['page_content'] ?></textarea>

                        <label for="page_status">Trạng thái</label>
                        <select name="page_status" id="page_status">
                            <option value="0">--Trạng thái trang--</option>
                            <option value="1" <?php if($page['page_status'] == 1) echo "selected = 'selected'" ?>>Chờ xét duyệt</option>
                            <option value="2" <?php if($page['page_status'] == 2) echo "selected= = 'selected'" ?>>Đã đăng</option>
                            <option value="3" <?php if($page['page_status'] == 3) echo "selected= = 'selected'" ?>>Trong thùng rác</option>
                        </select>

                        <button type="submit" name="btn_edit_post" id="btn-submit">Sửa trang</button>
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