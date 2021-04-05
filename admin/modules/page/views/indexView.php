<?php
// echo $page;
get_header();
// show_array($list_page);
$int = $page;
$list_pages = db_fetch_array("SELECT * FROM `tbl_page`");
// show_array($list_pages);
$m = 0;
$n = 0;
$x = 0;
foreach ($list_pages as &$page) {
    if ($page['page_status'] == 2) {
        $m++;
    } else if ($page['page_status'] == 1) {
        $n++;
    } else {
        $x++;
    }
};
foreach ($list_page as &$page) {
    $page['delete_page'] = "?mod=page&action=delete&page_id={$page['page_id']}";
    $page['edit_page'] = "?mod=page&action=edit&page_id={$page['page_id']}";
};
?>

<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách trang</h3>
                    <a href="?mod=page&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?">Tất cả <span class="count">(<?php echo count($list_pages) ?>)</span></a> |</li>
                            <li class="publish"><a href="?page_status='1'">Đã đăng <span class="count">(<?php echo $n;  ?>)</span></a> |</li>
                            <li class="pending"><a href="?page_status='2'">Chờ xét duyệt <span class="count">(<?php echo $m ?>)</span> |</a></li>
                            <li class="trash"><a href="?page_status='3'">Thùng rác <span class="count">(<?php echo $x ?>)</span></a></li>
                        </ul>
                        <!-- <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form> -->
                    </div>
                    <form method="GET" action="" class="form-actions">
                        <div class="actions">

                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Phê duyệt</option>
                                <option value="2">Xóa</option>
                                <option value="3">Bỏ vào thủng rác</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">

                        </div>
                        <?php
                        if (!empty($list_page)) {


                        ?>
                            <div class="table-responsive">
                                <table class="table list-table-wp">
                                    <thead>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="thead-text">STT</span></td>
                                            <td><span class="thead-text">Tên trang</span></td>
                                            <td><span class="thead-text">Tiêu đề</span></td>
                                            <td><span class="thead-text">Trạng thái</span></td>
                                            <td><span class="thead-text">Người tạo</span></td>
                                            <td><span class="thead-text">Thời gian</span></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $t = 0;
                                        foreach ($list_page as &$itam) {
                                            $t++;
                                        ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" value="<?php echo $itam['page_id']; ?>" class="checkItem"></td>
                                                <td><span class="tbody-text"><?php echo $t; ?></h3></span>
                                                <td><span class="tbody-text"><?php echo $itam['category']; ?></span></td>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="" title=""><?php echo $itam['page_title'] ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="<?php echo $itam['edit_page'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a name="<?php echo $itam['delete_page'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php if ($itam['page_status'] == 1) {
                                                                                    echo "Đã đăng";
                                                                                } else if ($itam['page_status'] == 2) {
                                                                                    echo "Chờ xét duyệt";
                                                                                } else if ($itam['page_status'] == 3) {
                                                                                    echo "Trong thùng rác";
                                                                                }
                                                                                ?></span></td>
                                                <td><span class="tbody-text"><?php echo $itam['creator']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo date("d/m/Y", $itam['created_date']); ?></span></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                    </form>

                </div>
            <?php
                        } else {
            ?>
                <p class="no-exist">Không có trang nào tồn tại</p>
                <style>
                    .no-exist {
                        color: #2ecc71;
                        font-size: 18px;
                        font-weight: bold;
                    }
                </style>
            <?php
                        }
            ?>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <?php
                    get_pagging($num_page, $int, '?');
                    ?>
                    <style>
                        #list-paging li a.active {
                            color: red;
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>