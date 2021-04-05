

<?php

use Symfony\Component\HttpFoundation\Cookie;

function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'validation');
    load('lib', 'email');
}

function indexAction()
{
    load_view('index');
}

function loginAction()
{
    // echo time();
    // echo date("d/m/Y h:m:s");
    global $error, $username, $password;
    if (isset($_POST['btn_login'])) {
        $error = array();

        #ktra username
        if (empty($_POST['username'])) {
            $error['username'] = "Ban chua nhap username!";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Ban nhap sai dinh dang username!";
            } else {
                $username = $_POST['username'];
            }
        }
        #ktra password
        if (empty($_POST['password'])) {
            $error['password'] = "Ban chua nhap password!";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Ban nhap sai dinh dang password!";
            } else {
                $password = md5($_POST['password']);
            }
        }
        #ktra dang nhap
        if (empty($error)) {
            if (check_login($username, $password)) {

                update_is_active_on($username);
                $check_role = check_role($username);
                $_SESSION['role'] = $check_role['role'];
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;
                if (isset($_POST['remember_me'])) {
                    setcookie('user_login', $username, time() + 3600);
                    setcookie('is_login', true, time() + 3600);
                }
                redirect("");
            } else {
                $error['error_login'] = "Tai khoarn khong ton tai!";
            }
        }
    }
    load_view('login');
}


function logoutAction()
{
    update_is_active_off($_SESSION['user_login']);
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("?mod=users&action=logout");
}


function updateAction()
{
    global $phonenumber, $error, $success;
    //B1: Tạo giao diện
    //B2: Load lại thông tin cũ 
    //B3: validation form
    //B4: cap nhat thong tin tai khoan
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
        if (empty($error)) {
            //update
            $data = array(
                'fullname' => $fullname,
                'address' => $address,
                'phonenumber' => $phonenumber,
                'update_date' => time()
            );
            // show_array($data);
            update_user(user_login(), $data);
            $success['success'] = "@ Bạn đã cập nhật tài khoản thành công @";
        }
    }
    $info_user = get_user_by_username(user_login());
    // show_array($info_user);
    $data['info_user'] = $info_user;
    load_view('update', $data);
}
function resetAction()
{
    global $error, $success, $pass_old, $confirm_pass, $pass_new;
    if (isset($_POST['btn_reset'])) {
        $error = array();
        $success = array();
        if (empty($_POST['pass_old'])) {
            $error['pass_old'] = "! Bạn chưa nhập mật khẩu";
        } else {
            if (!check_pass_old(user_login(), md5($_POST['pass_old']))) {
                $error['pass_old'] = "! Bạn nhập chưa đúng mật khẩu";
            } else {
                $pass_old = $_POST['pass_old'];
            }
        }

        #ktra mkhau 
        if (empty($_POST['pass_new'])) {
            $error['pass_new'] = "! Bạn chưa nhập mật khẩu mới";
        } else {
            if (!is_password($_POST['pass_new'])) {
                $error['pass_new'] = "! Bạn chưa nhập đúng định dạng mật khẩu mới";
            } else {
                $pass_new = $_POST['pass_new'];
            }
        }
        if (empty($_POST['confirm_pass'])) {
            $error['confirm_pass'] = "! Bạn chưa xác nhận mật khẩu";
        } else {
            if (!is_password($_POST['confirm_pass'])) {
                $error['confirm_pass'] = "! Bạn chưa nhập đúng định dạng ";
            } else {
                $confirm_pass = $_POST['confirm_pass'];
            }
        }

        if ($pass_new != $confirm_pass) {
            $error['confirm_pass'] = "! không trùng với mật khẩu mới vui lòng xác nhận lại mật khẩu";
        }
        if (empty($error)) {
            //update new pass
            $data = array(
                'password' => md5($pass_new),
                'update_date' => time()
            );
            update_new_pass(user_login(), $data);

            $success['new_pass'] = "Bạn đã cập nhật thành công tài khoản";
        }
    }
    load_view('reset');
}
