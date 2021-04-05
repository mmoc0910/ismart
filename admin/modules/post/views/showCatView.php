<?php get_header(); ?>
<?php
foreach ($list_cat as &$item) {
    $item['delete_url'] = "?mod=post&action=deleteCat&cat_id={$item['cat_id']}";
    $item['edit_url'] = "?mod=post&action=editCat&cat_id={$item['cat_id']}";
}
?>
<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách danh mục</h3>
                    <a href="?mod=post&action=addCat" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">_ Chọn vào checkbox để lựa chọn tất cả</p>
                    <p id="desc" class="fl-left">_ Nếu muốn xóa danh mục cha bạn cần xóa hết các danh mục con của nó</p>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">

                    <p id="desc" class="fl-left">_ Nếu muốn xóa danh mục cha bạn cần xóa hết các danh mục con của nó</p>
                </div>
            </div>
            <?php
            if (isset($list_cat)) {
            ?>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <div class="table-responsive">

                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <!-- <td><input type="checkbox" name="checkAll" id="checkAll"></td> -->
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Tiêu đề</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian tạo</span></td>
                                        <td><span class="thead-text">Thời gian chỉnh sửa</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $t = 0;
                                    foreach ($list_cat as $cat) {
                                        $t++;
                                    ?>
                                        <tr>
                                            <!-- <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $cat['cat_id'] ?>"></td> -->
                                            <td><span class="tbody-text"><?php echo $t ?></h3></span>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo str_repeat('|___', $cat['level']) . $cat['cat_title'] ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="<?php echo $cat['edit_url']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a name="<?php echo $cat['delete_url']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $cat['creator']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo date("d/m/Y", $cat['created_date']); ?></span></td>
                                            <td><span class="tbody-text"><?php if ($cat['update_date'] != null) echo date("d/m/Y", $cat['update_date']); ?></span></td>
                                        </tr>

                                </tbody>
                            <?php
                                    }
                            ?>
                            </table>
                        </div>
                    </div>
                </div>

            <?php
            } else {
            ?>
                <div class="section" id="paging-wp">
                    <div class="section-detail clearfix">
                        <p id="desc" class="fl-left">Chưa có danh mục nào để hiển thị hãy thêm danh mục của bạn</p>

                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>