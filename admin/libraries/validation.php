<?php
function is_username($username)
{
    $partten = "/^[A-Za-z0-9_\.]{6,32}$/";
    if (!preg_match($partten, $username, $matchs))
        return FALSE;
    return true;
}
function is_email($email)
{
    $partten = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
    if (!preg_match($partten, $email, $matchs))
        return FALSE;
    return true;
}

function is_password($password)
{
    $partten = "/^[A-Za-z0-9_\.!@#$%^&*()]{6,32}$/";
    if (!preg_match($partten, $password, $matchs))
        return FALSE;
    return true;
}
function is_phonenumber($phonenumber)
{
    $parrten = "/^(09|08|03|01[2|6|8|9])+([0-9]{8})$/";
    if (!preg_match($parrten, $phonenumber, $matchs))
        return FALSE;
    return true;
}
function set_value($label_field)
{
    global $$label_field;
    if (!empty($$label_field)) return $$label_field;
}

function form_error($label_field)
{
    global $error;
    if (!empty($error[$label_field])) return "<p class='error'> {$error[$label_field]} </p>";
}
function form_success($label_field)
{
    global $success;
    if (!empty($success[$label_field])) return "<p class='success'> {$success[$label_field]} </p>";
}
