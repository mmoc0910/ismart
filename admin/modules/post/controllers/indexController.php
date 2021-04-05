<?php

function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'validation');
}

function indexAction()
{

    load_view('index');
}
function addAction()
{
    global $error, $success, $post_title, $slug, $post_content;
    if (isset($_POST['btn_add'])) {
        $error = array();
        $success = array();
        #ktra tieeu de bai viet
        if (empty($_POST['title'])) {
            $error['post_title'] = "! Bạn chưa nhập Tiêu đề";
        } else {
            $post_title = $_POST['title'];
        }
        #ktra slug(friendly_url)
        if (empty($_POST['slug'])) {
            $slug = friendly_url($_POST['title']);
        } else {
            $slug = friendly_url($_POST['slug']);
        }
        #ktra post_content
        if (empty($_POST['post_content'])) {
            $error['post_content'] = "! Bạn chưa nhập mô tả";
        } else {
            $post_content = $_POST['post_content'];
        }
        #ktra file upload

        if (isset($_FILES['file'])) {
            // show_array($_FILES);
            $upload_dir = 'public/images/uploads/posts/';
            //duong dan cua file sau khi upload
            $upload_file = $upload_dir . $_FILES['file']['name'];

            #xu ly upload dung file anh
            $type_allow = array('png', 'jpg', 'gif', 'jpeg');
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            // echo $type;
            if (!in_array(strtolower($type), $type_allow)) {
                $error['upload_file'] = "! Chỉ được upload file có định dạng png, jpg, gif, jpeg";
            } else {
                #upload file co kich thuoc cho phep (<20mb ~ 29.000.000 byte)
                $file_size = $_FILES['file']['size'];
                // echo $file_size;
                if ($file_size > 29000000) {
                    $error['upload_file'] = "! Chỉ được upload file bé hơn 20MB";
                }
                #kiem tra trung ten file tren he thong hay chua
                if (file_exists($upload_file)) {
                    // $error['file_exists'] = "file da to tai tren he thong";
                    //=====================
                    #xu ly doi ten file tu dong
                    //========================

                    #tao file moi
                    //ten file.duoi file

                    $file_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);

                    $new_file_name = $file_name . '-copy.';
                    $new_upload_file = $upload_dir . $new_file_name . $type;
                    // echo $fileName;
                    $k = 1;
                    while (file_exists($new_upload_file)) {

                        $new_file_name =  $file_name . "-copy({$k}).";
                        $k++;
                        $new_upload_file = $upload_dir . $new_file_name . $type;
                    }
                    $upload_file = $new_upload_file;
                }
            }


            if (empty($error)) {
                // echo "file khong bi loi";
                if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
                    $success['success'] = "@ Bạn đã upload file thành công @";
                } else {
                    $error['upload_file'] = "upload file không thành công";
                }
            }
        } else {
            $error['upload_file'] = "! Bạn chưa chọn file để upload";
        }
        #ktra parent_id
        if (empty($_POST['cat_id'])) {
            $error['cat_id'] = "! Bạn chưa chọn danh mục";
        } else {
            $cat_id = $_POST['cat_id'];
        }

        if (empty($error)) {
            echo "ok";
        }
    }







    load_view('add');
}
function showCatAction()
{
    $list_cat = data_tree(get_list_cat());
    $data['list_cat'] = $list_cat;
    load_view('showCat', $data);
}
function addCatAction()
{
    global $error, $success;
    if (isset($_POST['btn_add_cat'])) {
        $error = array();
        #ktra title
        if (empty($_POST['cat_title'])) {
            $error['cat_title'] = "! Bạn chưa nhập tên danh mục";
        } else {
            $cat_title = $_POST['cat_title'];
        }
        if (empty($_POST['slug'])) {
            $slug = friendly_url($_POST['cat_title']);
        } else {
            $slug = friendly_url($_POST['slug']);
        }
        if (empty($_POST['parent_id'])) {
            $parent_id = 0;
        } else {
            $parent_id = $_POST['parent_id'];
        }
        if (empty($error)) {
            $data = array(
                'cat_title' => $cat_title,
                'slug' => $slug,
                'creator' => user_login(),
                'created_date' => time(),
                'parent_id' => $parent_id
            );
            add_post_cat($data);
            $success['success'] = "@ Bạn đã thêm thành công @";
        }
    }
    $list_cat = data_tree(get_list_cat());
    $data['list_cat'] = $list_cat;
    load_view('addCat', $data);
}
function deleteCatAction()
{
    global $error;
    $error = array();
    $cat_id = (int)$_GET['cat_id'];
    check_parent_id($cat_id);
    if (check_parent_id($cat_id)) {
        redirect("?mod=post&action=showCat");
    } else {
        delete_cat($cat_id);
        redirect("?mod=post&action=showCat");
    }
}
function editCatAction()
{
    $cat_id = (int)$_GET['cat_id'];
    global $error, $success;
    if (isset($_POST['btn_edit_cat'])) {
        $error = array();
        #ktra title
        if (empty($_POST['cat_title'])) {
            $error['cat_title'] = "! Bạn chưa nhập tên danh mục";
        } else {
            $cat_title = $_POST['cat_title'];
        }
        if (empty($_POST['slug'])) {
            $slug = friendly_url($_POST['cat_title']);
        } else {
            $slug = friendly_url($_POST['slug']);
        }
        if (empty($_POST['parent_id'])) {
            $parent_id = 0;
        } else {
            $parent_id = $_POST['parent_id'];
        }
        if (empty($error)) {
            $data = array(
                'cat_title' => $cat_title,
                'slug' => $slug,
                'update_date' => time(),
                'parent_id' => $parent_id
            );
            edit_post_cat_by_cat_id($data, $cat_id);
            $success['success'] = "@ Bạn đã chỉnh sửa thành công @";
        }
    }


    $category = get_cat_by_cat_id($cat_id);
    // show_array($category);
    $data['category'] = $category;
    $list_cat = data_tree(get_list_cat());
    $data['list_cat'] = $list_cat;
    load_view('editCat', $data);
}
