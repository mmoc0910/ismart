<?php
function add_user($data)
{
    return db_insert('tbl_user', $data);
}
function exists_users($username, $email)
{
    $check_user = db_num_rows("SELECT * FROM `tbl_user` WHERE `username` = '{$username}' OR `email` = '{$email}'");
    if ($check_user > 0)
        return true;
    return false;
}
function get_list_users()
{
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_by_id($id)
{
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}
function active_user($active_token)
{
    return db_update('tbl_user', array('is_active' => 1), "`active_token`= '{$active_token}'");
}
function check_active_token($active_token)
{
    $check = db_num_rows("SELECT * FROM `tbl_user` WHERE `active_token` = '{$active_token}' AND `is_active` = '0'");
    if ($check > 0)
        return true;
    return false;
}
function check_login($username, $password)
{
    $check_login = db_num_rows("SELECT * FROM `tbl_user` WHERE `username` = '{$username}' AND `password` = '{$password}'");

    if ($check_login > 0)
        return true;
    return FALSE;
}
function check_email($email)
{
    $check_email = db_num_rows("SELECT * FROM `tbl_user` WHERE `email` = '{$email}'");
    if ($check_email > 0) {
        return true;
        return FALSE;
    }
}
function update_reset_token($email, $reset_token)
{
    $data = array(
        'reset_pass_token' => $reset_token
    );
    return db_update('tbl_user', $data, "`email` = '{$email}'");
}
function check_reset_token($reset_token)
{
    $check_reset = db_fetch_row("SELECT * FROM `tbl_user` WHERE `reset_pass_token` = '{$reset_token}'");
    if ($check_reset > 0)
        return true;
    return FALSE;
}
function update_pass($data, $reset_token)
{
    return db_update('tbl_user', $data, "`reset_pass_token` = '{$reset_token}'");
}
