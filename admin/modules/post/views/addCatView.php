<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới danh mục</h3>

                </div>
            </div>
            <div class="section" id="detail-page">
                <?php echo form_success('success'); ?>
                <div class="section-detail">
                    <form method="POST">
                        <label for="title">Tên danh mục</label>
                        <?php echo form_error('cat_title') ?>
                        <input type="text" name="cat_title" id="title">

                        <label for="slug">Slug ( Friendly_url )</label>
                        <?php echo form_error('slug') ?>
                        <input type="text" name="slug" id="slug">


                        <label>Danh mục cha</label>
                        <select name="parent_id">
                            <option value="0">-- Chọn danh mục --</option>

                            <?php
                            foreach ($list_cat as $cat) {
                            ?>
                                <option value="<?php echo $cat['cat_id'] ?>"><?php echo str_repeat('|---', $cat['level']) . $cat['cat_title'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <button type="submit" name="btn_add_cat" id="btn-submit">Thêm mới</button>
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
    }

    .success {
        color: #3498db;
        font-size: 16px;
    }
</style>
<?php get_footer(); ?>