

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
    //     load('helper','format');
    //     $list_users = get_list_users();
    // //    show_array($list_users);
    //     $data['list_users'] = $list_users;
    //     load_view('index', $data);
}

function loginAction()
{
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

function regAction()
{
    global $error, $fullname, $username, $password, $email;
    // echo send_mail('unitop123456@gmail.com', "pham xuan manh", 'kich hoat link', "<a href = 'http://localhost/unitop/back-end/lesson/section-28/projectmvc.vn/?mod=users&action=login'>link kich haot tai khoan</a>");
    if (isset($_POST['btn_reg'])) {
        $error = array();
        #ktra fullname

        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Ban chua nhap fullname !";
        } else {
            $fullname = $_POST['fullname'];
        }

        #ktra email

        if (empty($_POST['email'])) {
            $error['email'] = "Ban chua nhap email !";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Ban nhap sai dinh dang email !";
            } else {
                $email = $_POST['email'];
            }
        }

        #ktra username

        if (empty($_POST['username'])) {
            $error['username'] = "Ban chua nhap username !";
        } else {
            if (!is_username(($_POST['username']))) {
                $error['username'] = "Ban chua hap dung dinh dang username !";
            } else {
                $username = $_POST['username'];
            }
        }

        #kra password

        if (empty($_POST['password'])) {
            $error['password'] = "Ban chua nhap password !";
        } else {
            if (!is_password(($_POST['password']))) {
                $error['password'] = "Ban chua hap dung dinh dang password !";
            } else {
                $password = md5($_POST['password']);
            }
        }

        if (empty($error)) {
            #ktra trung username email
            if (!exists_users($username, $email)) {
                $active_token = md5($username . time());
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'active_token' => $active_token,
                    'reg_date' => time()
                );
                add_user($data);
                $link_active = base_url("?mod=users&action=active&active_token={$active_token}");
                $content = "<p>Xin chao ban {$fullname}}</p>
                <p>Ban da dang ky khoa hoc tren he thong unitop.vn nhan  vao link de kich hoat tai khoan: {$link_active}</p>
                <p>neu khong phai ban vui long bo qua email nay</p>
                <p>team support unitop.vn</p>";
                echo send_mail($email, $fullname, 'kich hoat tai khoan php master', $content);
                $success['reg'] = "Ban vui long check email de kich hoat tai khoan";
            } else {
                $error['acount'] = "username va email dac ton tai trong he thong !";
            }
        }
    }
    load_view('reg');
}
function activeAction()
{
    $active_token = $_GET['active_token'];
    $link_login = base_url("?mod=users&action=login");
    if (check_active_token($active_token)) {
        active_user($active_token);

        echo " Ban da kich hoat thanh cong , vui long click vao link de dang nhap: <a href='{$link_login}'>dang nhap<a>";
    } else {
        echo "yeu cau kich hoat khong hop le, hoac tai khoan da kich hoat truoc do, vui long click vao link de dang nhap: <a href='{$link_login}'>dang nhap<a>!";
    }
}
function logoutAction()
{
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("");
}
function resetAction()
{
    global $error, $email;
    @$reset_token = $_GET['reset_token'];
    if (!empty($reset_token)) {
        if (check_reset_token($reset_token)) {
            if (!empty($_POST['btn_new_pass'])) {
                $error = array();
                #ktra password
                if (empty($_POST['password'])) {
                    $error['password'] = "Ban chua nhap password !";
                } else {
                    if (!is_password(($_POST['password']))) {
                        $error['password'] = "Ban chua hap dung dinh dang password !";
                    } else {
                        $password = md5($_POST['password']);
                    }
                }

                #cap nhat mat khau
                if (empty($error)) {
                    $data = array(
                        'password' => $password
                    );
                    update_pass($data, $reset_token);
                    redirect("");
                }
            }
            load_view('newpass');
        } else {
            echo " yeu cau lay lai mat khau khong how le!";
        }
    } else {
        if (isset($_POST['btn_send'])) {
            $error = array();
            #ktra email
            if (empty($_POST['email'])) {
                $error['email'] = "Ban chua dang nhap email!";
            } else {
                if (!is_email($_POST['email'])) {
                    $error['email'] = "Ban chua nhap dung dinh dang email!";
                } else {
                    $email = $_POST['email'];
                }
            }

            if (empty($error)) {
                if (check_email($email)) {
                    $reset_token = md5($email . time());
                    $link = base_url("?mod=users&action=reset&reset_token={$reset_token}");
                    //cap nhap ma reset-token vao csdl
                    update_reset_token($email, $reset_token);

                    $content = "<p>Xin chao ban}</p>
                <p>Ban da gui yeu cau doi mat khau tai khoan tren he thong Unitop.vn</p>
                <p>Nhan vao link de doi mat khau: {$link}";
                    send_mail($email, '', 'Xac nhan doi mat khau!', $content);
                } else {
                    $error['error_email'] = "Email khong ton tai tren he thong!";
                }
            }
        }

        load_view('reset');
    }
}
