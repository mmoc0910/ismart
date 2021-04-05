<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar();
        $list_cat = data_tree(db_fetch_array("SELECT * FROM `tbl_post_cat`"));
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="title">Tiêu đề</label>
                        <?php echo form_error('post_title') ?>
                        <input type="text" name="title" id="title" value="<?php echo  set_value('post_title') ?>">

                        <label for="title">Slug ( Friendly_url )</label>
                        <?php echo form_error('slug') ?>
                        <input type="text" name="slug" id="slug" value="<?php echo  set_value('slug') ?>">

                        <label for="desc">Mô tả</label>
                        <?php echo form_error('post_content') ?>
                        <textarea name="post_content" id="desc" class="ckeditor"><?php echo  set_value('post_content') ?></textarea>

                        <label>Hình ảnh</label>
                        <?php echo form_error('upload_file') ?>
                        <?php echo form_success('success') ?>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb">
                            <!-- <input type="submit" name="btn_upload_thumb" value="Upload" id="btn-upload-thumb"> -->
                            <img src="<?php if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
                                            echo "public/images/uploads/posts/{$_FILES['file']['name']}";
                                        } else {
                                            echo "public/images/img-thumb.png";
                                        } ?>">
                        </div>
                        <label>Danh mục cha</label>
                        <?php echo form_error('cat_id'); ?>
                        <select name="cat_id[]">
                            <option value="">-- Chọn danh mục --</option>
                            <?php
                            foreach ($list_cat as $cat) {
                            ?>
                                <option value="<?php echo $cat['cat_id'] ?>"><?php echo str_repeat("|--", $cat['level']) . $cat['cat_title'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <button type="submit" name="btn_add" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php get_footer(); ?>