<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function print_tree($data)
{
    $str = "";
    foreach($data as $list)
    {
        $str .= "<li><input type='checkbox' value='".$list['nama']."'>"."<span>".$list['nama']."</span>";
        $subchild = print_tree($list['child']);
        if($subchild != '')
            $str .= "<ul>".$subchild."</ul>";
        $str .= "</li>";
    }
    return $str;
}