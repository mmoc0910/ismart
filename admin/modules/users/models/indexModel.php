<?php
function update_user($username, $data)
{
    return db_update('tbl_user', $data, "`username` = '{$username}'");
}
function get_user_by_username($username)
{
    return db_fetch_row("SELECT * FROM `tbl_user` WHERE `username` = '{$username}'");
}
function exists_users($username, $email)
{
    $check_user = db_num_rows("SELECT * FROM `tbl_user` WHERE `username` = '{$username}' OR `email` = '{$email}'");
    if ($check_user > 0)
        return true;
    return false;
}
function check_pass_old($username, $pass_old)
{
    $check_pass_old = db_num_rows("SELECT * FROM `tbl_user` WHERE `password` = '{$pass_old}' AND `username` = '{$username}'");
    if ($check_pass_old > 0)
        return true;
    return FALSE;
}
function update_new_pass($username, $data)
{
    return db_update('tbl_user', $data, "`username` = '{$username}'");
}
function check_login($username, $password)
{
    $check_login = db_num_rows("SELECT * FROM `tbl_user` WHERE `username` = '{$username}' AND `password` = '{$password}'");

    if ($check_login > 0)
        return true;
    return FALSE;
}

function get_list_users()
{
    return db_fetch_array("SELECT * FROM `tbl_user` ");
}
function update_is_active_on($username)
{
    return db_update('tbl_user', array('is_active' => '1'), "`username` = '{$username}'");
}
function update_is_active_off($username)
{
    return db_update('tbl_user', array('is_active' => '0'), "`username` = '{$username}'");
}

function check_role($username)
{
    return db_fetch_row("SELECT `role` FROM `tbl_user` WHERE `username` = '{$username}'");
    // echo $check_role['role'];
}
function delete_user($id)
{
    return db_delete('tbl_user', "`user_id` = {$id}");
}
function get_user_by_id($id)
{
    return db_fetch_row("SELECT * FROM `tbl_user` WHERE `user_id` = {$id}");
}
function edit_user($id)
{
    // return db_update('tbl_user')
}
function update_user_by_id($id, $data)
{
    return db_update('tbl_user', $data, "`user_id` = {$id}");
}
function delete_users_group($list_id)
{
    return db_delete('tbl_user', "`user_id` IN ({$list_id})");
}
function add_user($data)
{
    return db_insert('tbl_user', $data);
}
function check_user($username, $email, $password)
{
    $check_user = db_num_rows("SELECT * FROM `tbl_user` WHERE `username` = '{$username}' OR `email` = '{$email}' OR `password` = '{$password}'");
    // echo $check_user;
    if ($check_user > 0)
        return true;
    return FALSE;
}
