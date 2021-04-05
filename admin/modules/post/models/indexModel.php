<?php

function add_post_cat($data)
{
    return db_insert("tbl_post_cat", $data);
}
function get_list_cat()
{
    return db_fetch_array("SELECT * FROM `tbl_post_cat`");
}
function get_cat_parent_by_cat_id($cat_id)
{
    return db_fetch_row("SELECT `parent_id` FROM `tbl_post_cat` WHERE `cat_id`");
}
function check_parent_id($cat_id)
{
    $check_parent_id = db_num_rows("SELECT * FROM `tbl_post_cat` WHERE `parent_id` = {$cat_id}");
    echo $check_parent_id;
    if ($check_parent_id > 0)
        return true;
    return FALSE;
}
function delete_cat($cat_id)
{
    return db_delete("tbl_post_cat", "`cat_id` = {$cat_id}");
}
function get_cat_by_cat_id($cat_id)
{
    return db_fetch_row("SELECT * FROM `tbl_post_cat` WHERE `cat_id` = {$cat_id}");
}
function edit_post_cat_by_cat_id($data, $cat_id)
{
    return db_update("tbl_post_cat", $data, "`cat_id` = {$cat_id}");
}
