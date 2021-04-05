<?php
function add_post($data)
{
    return db_insert('tbl_page', $data);
}
function get_list_page()
{
    return db_fetch_array("SELECT * FROM `tbl_page` ");
}
function delete_page_by_list_id($list_id)
{
    return db_delete('tbl_page', "`page_id` IN ({$list_id})");
}
function approved_page_by_list_id($list_id)
{
    return db_update('tbl_page', array('page_status' => '1'), "`page_id` IN ({$list_id})");
}
function put_trash_by_list_id($list_id)
{
    return db_update('tbl_page', array('page_status' => '3'), "`page_id` IN ({$list_id})");
}
function get_list_page_by_status($page_status)
{
    return db_fetch_array("SELECT * FROM `tbl_page` WHERE `page_status` = {$page_status}");
}
function delete_page_by_id($page_id)
{
    return db_delete('tbl_page', "`page_id` = {$page_id}");
}
function  get_page_by_id($page_id)
{
    return db_fetch_row("SELECT * FROM `tbl_page` WHERE `page_id` = {$page_id}");
}
function update_page_by_id($data, $page_id)
{
    return db_update('tbl_page', $data, "`page_id` = {$page_id}");
}
function get_page($start = 1, $num_per_page = 2, $where = '')
{
    if (!empty($where))
        $where = "WHERE {$where}";
    return db_fetch_array("SELECT * FROM `tbl_page` {$where} LIMIT {$start},{$num_per_page}");
}
// function get_users($start = 1, $num_per_page = 10, $where = '')
// {
//     if (!empty($where))
//         $where = "WHERE {$where}";
//     $list_users = db_fetch_array("SELECT * FROM `tbl_user` {$where} LIMIT {$start},{$num_per_page}");
//     return $list_users;
// }
