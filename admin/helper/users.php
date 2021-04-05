<?php
function is_login()
{
    if (isset($_SESSION['is_login']))
        return true;
    return FALSE;
}
function user_login()
{
    if (!empty($_SESSION['user_login']))
        return $_SESSION['user_login'];
}
function user_role()
{
    if (!empty($_SESSION['role']))
        return $_SESSION['role'];
}
