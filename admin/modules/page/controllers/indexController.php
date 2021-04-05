<?php

function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'validation');
}

function indexAction()
{
    global $num_per_page, $total_row, $start, $page;
    if (isset($_GET['sm_action'])) {
        $actions = (int)$_GET['actions'];
        $checkItem = $_GET['checkItem'];
        
        // echo $actions,
        // show_array($checkItem);
        $list_id = implode(',', $checkItem);
        
        // echo $list_item;
        if ($actions == 1) {
            approved_page_by_list_id($list_id);
        } else if ($actions == 2) {
            delete_page_by_list_id($list_id);
        } else if ($actions == 3) {
            put_trash_by_list_id($list_id);
        };
    }
    $num_per_page = 10;

    // echo $num_page;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;
    if (empty($_GET['page_status'])) {

        $total_row = count(get_list_page());
        $list_page = get_page($start, $num_per_page, '');

        // echo $num_page;
    } else {
        $page_status = $_GET['page_status'];
        // echo $page_status;

        $total_row = count(get_list_page_by_status($page_status));
        $list_page = get_page($start, $num_per_page, "`page_status` = {$page_status}");
    }
    $num_page = ceil($total_row / $num_per_page);

    // show_array($list_page);
    // echo $num_page;

    $data['page'] = $page;
    $data['list_page'] = $list_page;
    $data['num_page'] = $num_page;
    load_view('index', $data);
}

function addAction()
{
    global $error, $success, $title, $slug, $desc;
    if (isset($_POST['btn_add_post'])) {
        $error = array();
        #ktra category
        if (empty($_POST['category'])) {
            $error['category'] = "! Banj chưa nhập tên trang";
        } else {
            $category = $_POST['category'];
        }
        #tra title
        if (empty($_POST['title'])) {
            $error['title'] = "! Bạn chưa nhập tiêu đề";
        } else {
            $title = $_POST['title'];
        }
        #ktra slug
        if (empty($_POST['slug'])) {
            $error['slug'] = "! Bạn chưa nhập slug(Friendly_url)";
        } else {
            $slug = friendly_url($_POST['slug']);
        }
        #ktra content
        if (empty($_POST['desc'])) {
            $error['desc'] = "! Bạn chưa nhập mô tả trang";
        } else {
            $desc = $_POST['desc'];
        }
        if (empty($error)) {
            $data = array(
                'page_title' => $title,
                'category' => $category,
                'slug' => $slug,
                'page_content' => $desc,
                'creator' => user_login(),
                'created_date' => time()
            );
            add_post($data);
            // $success['cuccess'] = "@ Bạn đã thêm thành công @";
            redirect("?");
        }
    };
    load_view('add');
}

function editAction()
{
    $page_id = (int)$_GET['page_id'];
    global $error;
    if (isset($_POST['btn_edit_post'])) {
        $error = array();
        #ktra trang 
        if (empty($_POST['category'])) {
            $error['category'] = "! Bạn chưa nhập trang";
        } else {
            $category = $_POST['category'];
        }
        #ktra page_title
        if (empty($_POST['title'])) {
            $error['page_title'] = "! Bạn chưa nhập tiêu đề";
        } else {
            $page_title = $_POST['title'];
        }
        #ktra slug
        if (empty($_POST['slug'])) {
            $error['slug'] = "! Bạn chưa nhập slug(Friendly_url)";
        } else {
            $slug = friendly_url($_POST['slug']);
        }
        #ktra page_content
        if (empty($_POST['desc'])) {
            $error['page_content'] = "! Bạn chưa nhập mô tả trang";
        } else {
            $page_content = $_POST['desc'];
        }
        #ktra page status
        if (empty($_POST['page_status'])) {
            $error['post_status'] = "Bạn chưa chọn trạng thái bài viết";
        } else {
            $page_status = $_POST['page_status'];
        }
        if (empty($error)) {
            $data = array(
                'category' => $category,
                'page_title' => $page_title,
                'slug' => $slug,
                'page_content' => $page_content,
                'page_status' => $page_status
            );
            update_page_by_id($data, $page_id);
            redirect("?");
        }
    }
    // echo $page_id;
    $page = get_page_by_id($page_id);
    // show_array($page);
    $data['page'] = $page;
    load_view('edit', $data);
}
function deleteAction()
{
    $page_id = (int)$_GET['page_id'];
    echo $page_id;
    delete_page_by_id($page_id);
    redirect("?");
}
