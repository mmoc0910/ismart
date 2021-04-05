<?php
function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'validation');
}
function indexAction()
{
    $list_users = get_list_users();

    $data['list_users'] = $list_users;
    load_view('teamIndex', $data);
}
function deleteAction()
{
    $id = (int)$_GET['user_id'];
    if ($_SESSION['role'] == 1) {
        delete_user($id);
    }

    redirect("?mod=users&controller=team&action=index");
}
function editAction()
{
    $id = (int)$_GET['user_id'];
    // echo $id;
    global $error, $success, $phonenumber;
    //ktra quyeefn edit
    if (user_role() == 1) {
        if (isset($_POST['btn_update'])) {
            $error = array();
            $success = array();

            $fullname = $_POST['fullname'];

            #ktra phonenumber
            if (empty($_POST['phonenumber'])) {
                $error['phonenumber'] = "! Bạn chưa nhập số điện thoại";
            } else {
                if (!is_phonenumber($_POST['phonenumber'])) {
                    $error['phonenumber'] = "! Bạn chưa nhập đúng định dạng số điện thoại";
                } else {
                    $phonenumber = $_POST['phonenumber'];
                }
            }

            $address = $_POST['address'];
            #ktra quyeefn
            if (empty($_POST['role'])) {
                $error['role'] = "! Bạn chưa nhập quyền thành viên admin";
            } else {
                $role = $_POST['role'];
            }
            //cap nhat thong tin
            if (empty($error)) {
                $data = array(
                    'fullname' => $fullname,
                    'phonenumber' => $phonenumber,
                    'address' => $address,
                    'role' => $role,
                    'update_date' => time()
                );
                // show_array($data);
                update_user_by_id($id, $data);
                $success['success'] = "@ Bạn đã cập nhật tài khoản thành công @";
            }
        }
        //load lai thong tin cu
        $info_user = get_user_by_id($id);
        // show_array($info_user);
        $data['info_user'] = $info_user;
        load_view('update', $data);
    } else {
        redirect("?mod=users&controller=team");
    }
}
function actionAction()
{
    //ktra quyeefn
    if (user_role() == 1) {
        if (isset($_POST['sm_action'])) {
            if (isset($_POST['checkItem']) && isset($_POST['actions']) == 1) {


                $list_id = implode(',', $_POST['checkItem']);
                delete_users_group($list_id);
                redirect("?mod=users&controller=team");
            }
        }
    } else {
        redirect("?mod=users&controller=team");
    }
}
function addUserAction()
{
    if (user_role() == 1) {
        global $error, $fullname, $username, $email, $phonenumber, $password;
        if (isset($_POST['btn_add'])) {
            // echo "ok";
            #validayion form
            $error = array();
            $fullname = $_POST['fullname'];
            #ktra username
            if (empty($_POST['username'])) {
                $error['username'] = "! Bạn chưa nhập tên đăng nhập";
            } else {
                if (!is_username($_POST['username'])) {
                    $error['username'] = "! Tên đăng nhập gồm 6 ký tự";
                } else {
                    $username = $_POST['username'];
                }
            }
            #ktra email
            if (empty($_POST['email'])) {
                $error['email'] = "! Bạn chưa nhập email";
            } else {
                if (!is_email($_POST['email'])) {
                    $error['email'] = "! Bạn chưa nhập đúng định dạng email";
                } else {
                    $email = $_POST['email'];
                }
            }
            #ktra so đien thoại
            if (empty($_POST['phonenumber'])) {
                $error['phonenumber'] = "! Bạn chưa nhập số điện thoại";
            } else {
                if (!is_phonenumber($_POST['phonenumber'])) {
                    $error['phonenumber'] = "! Bạn chưa nhập đúng định dạng số điện thoại";
                } else {
                    $phonenumber = $_POST['phonenumber'];
                }
            }
            #ktra mkhau
            if (empty($_POST['password'])) {
                $error['password'] = "! Bạn chưa nhập mật khẩu";
            } else {
                if (!is_password($_POST['password'])) {
                    $error['password'] = "! Bạn chưa nhập đúng định dạng mật khẩu";
                } else {
                    $password = md5($_POST['password']);
                }
            }
            #dia chi
            $address = $_POST['address'];
            #ktra role
            if (empty($_POST['role'])) {
                $error['role'] = "! Bạn chưa chọn quyền của thành viên";
            } else {
                $role = $_POST['role'];
            }

            #add thong tin ng dung
            if (empty($error)) {
                if (!check_user($username, $email, $password)) {
                    $data = array(
                        'fullname' => $fullname,
                        'username' => $username,
                        'email' => $email,
                        'password' => $password,
                        'created_date' => time(),
                        'phonenumber' => $phonenumber,
                        'address' => $address,
                        'role' => $role
                    );
                    add_user($data);
                    redirect("?mod=users&controller=team");
                } else {
                    $error['acount'] = "! Tên đăng nhập, email, pasword đã tồn tại trong hệ thống";
                }
            }
        }
        load_view('add');
    } else {
        redirect("?mod=users&controller=team");
    }
}
