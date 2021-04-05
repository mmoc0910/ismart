<?php get_header();

$on = 0;
$off = 0;
foreach ($list_users as &$user) {
    if ($user['is_active'] == 1) {
        $on++;
    } else {
        $off++;
    }

    $user['link_edit'] = "?mod=users&controller=team&action=edit&user_id={$user['user_id']}";
    $user['link_delete'] = "?mod=users&controller=team&action=delete&user_id={$user['user_id']}";
}
// show_array($list_users);
// show_array($_SERVER);
// echo $_SESSION['role'];

?>

<div id="main-content-wp" class="list-post-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=users&controller=team&action=addUser" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Nhóm quản trị</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar('users'); ?>
        <div id="content" class="fl-right">

            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(<?php echo count($list_users) ?>)</span></a> |</li>
                            <li class="publish"><a href="">Đang online <span class="count">(<?php echo $on ?>)</span></a> |</li>
                            <li class="pending"><a href="">Đang offline <span class="count">(<?php echo $off ?>)</span></a></li>
                            <!-- <li class="trash"><a href="">Thùng rác <span class="count">(0)</span></a></li> -->
                        </ul>

                    </div>
                    <form method="POST" action="?mod=users&controller=team&action=action" class="form-actions">
                        <div class="actions">

                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Bỏ vào thủng rác</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">

                        </div>

                        <?php
                        if (!empty($list_users)) {
                        ?>
                            <div class="table-responsive">
                                <table class="table list-table-wp">
                                    <thead>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="thead-text">STT</span></td>
                                            <td><span class="thead-text">Tên đăng nhập</span></td>
                                            <td><span class="thead-text">Họ và tên</span></td>
                                            <td><span class="thead-text">Email</span></td>
                                            <td><span class="thead-text">Số điện thoại</span></td>
                                            <td><span class="thead-text">Địa chỉ</span></td>
                                            <td><span class="thead-text">Trạng thái</span></td>
                                            <td><span class="thead-text">Ngày đăng ký</span></td>
                                            <td><span class="thead-text">Ngày update</span></td>
                                            <td><span class="thead-text">Chức vụ</span></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $t = 0;
                                        foreach ($list_users as &$user) {
                                            $t++;
                                        ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $user['user_id'] ?>"></td>
                                                <td><span class="tbody-text"><?php echo $t; ?></h3></span>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="" title=""><?php echo $user['username'] ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="<?php echo $user['link_edit'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a name="<?php echo $user['link_delete'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $user['fullname'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $user['email'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $user['phonenumber'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $user['address'] ?></span></td>
                                                <td><span class="thead-text"><?php if ($user['is_active'] == 1) {
                                                                                    echo "Đang online";
                                                                                } else {
                                                                                    echo "Đang offline";
                                                                                }
                                                                                ?></span></td>
                                                <td><span class="thead-text"><?php echo date("d/m/Y", $user['created_date']) ?></span></td>
                                                <td><span class="thead-text"><?php if ($user['update_date'] != NULL) echo date("d/m/Y", $user['update_date']) ?></span></td>
                                                <td><span class="thead-text"><?php
                                                                                if ($user['role'] == 1) {
                                                                                    echo "Quản lý";
                                                                                } else if ($user['role'] == 2) {
                                                                                    echo "Biên tâp viên";
                                                                                } else if ($user['role'] == 3) {
                                                                                    echo "Cộng tác viên";
                                                                                }

                                                                                ?></span></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>

                                    </tbody>
                                    <!-- <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text">Tiêu đề</span></td>
                                    <td><span class="tfoot-text">Danh mục</span></td>
                                    <td><span class="tfoot-text">Trạng thái</span></td>
                                    <td><span class="tfoot-text">Người tạo</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
                                </tr>
                            </tfoot> -->
                                </table>
                            </div>
                        <?php
                        }
                        ?>
                    </form>
                </div>
            </div>
            <!-- <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <ul id="list-paging" class="fl-right">
                        <li>
                            <a href="" title="">
                                << /a>
                        </li>
                        <li>
                            <a href="" title="">1</a>
                        </li>
                        <li>
                            <a href="" title="">2</a>
                        </li>
                        <li>
                            <a href="" title="">3</a>
                        </li>
                        <li>
                            <a href="" title="">></a>
                        </li>
                    </ul>
                </div>
            </div> -->
        </div>
    </div>
</div>
<?php get_footer(); ?>