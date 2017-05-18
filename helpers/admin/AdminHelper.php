<?php
/**
 * Created by PhpStorm.
 * User: User 50
 * Date: 17.01.2017
 * Time: 10:25
 */

namespace app\helpers\admin;


class AdminHelper
{
    public static function pre($mixed_data)
    {
        print '<pre style="white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -o-pre-wrap; background: #faf8f0; border: 1px solid silver; 
                    padding: 2px; font-weight: normal; font-family: Monospace, Courier">';
                print_r($mixed_data);
        print '</pre>';
    }
    public static function code($mixed_data)
    {
        print '<code style=" display: block; padding: 0.5em 1em; border: 1px solid #bebab0;">';
        print_r($mixed_data);
        print '</code>';
    }
}