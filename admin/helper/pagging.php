<?php
function get_pagging($num_page, $page, $url = '?')
{
    if ($num_page > 1) {
        $str_pagging = "<ul id='list-paging' class='fl-right'>";
        if ($page > 1) {
            $page_prev = $page - 1;
            $str_pagging .= "<li><a href = '{$url}&page={$page_prev}'><</a></li>";
        }
        for ($i = 1; $i <= $num_page; $i++) {
            $active = '';
            if ($i == $page) $active = "class = 'active'";
            $str_pagging .= "<li><a {$active} href='{$url}&page={$i}'' title=''>{$i}</a></li>";
        }
        if ($page < $num_page) {
            $page_next = $page + 1;
            $str_pagging .= "<li><a href = '{$url}&page={$page_next}'>></a></li>";
        }
        $str_pagging .= "</ul>";
        echo $str_pagging;
    }
}
