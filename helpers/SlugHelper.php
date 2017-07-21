<?php
/**
 * Created by PhpStorm.
 * User: User 50
 * Date: 17.01.2017
 * Time: 10:25
 */

namespace app\helpers;


class SlugHelper
{
    public static function latin($source)
    {
        $source = trim(mb_strtolower($source));
        $translateArray = [
            "ый" => "-y",
            "й" => "y",
            "ы" => "y-",
            "а" => "a",
            "б" => "b",
            "в" => "v",
            "г" => "g",
            "д" => "d",
            "е" => "e",
            "ё" => "-e-",
            "ж" => "j",
            "з" => "z",
            "и" => "i",
            "к" => "k",
            "л" => "l",
            "м" => "m",
            "н" => "n",
            "о" => "o",
            "п" => "p",
            "р" => "r",
            "с" => "s",
            "т" => "t",
            "у" => "u",
            "ф" => "f",
            "х" => "h",
            "ц" => "c",
            "ч" => "ch",
            "ш" => "sh",
            "щ" => "sch",
            "ъ" => "-",
            "ь" => "-",
            "э" => "e",
            "ю" => "yu",
            "я" => "ya",
            " " => "--",
            "." => "",
            "/" => "-",
            "_" => "-",
            "-" => "-"
        ];
        $source = preg_replace('#[^a-z0-9\-]#is', '', strtr($source, $translateArray));
        return trim(preg_replace('#-{2,}#is', '-', $source));
    }

    public static function mb_ucfirst($str, $encoding='UTF-8')
    {
        $str = mb_ereg_replace('^[\ ]+', '', $str);
        $str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
               mb_substr($str, 1, mb_strlen($str), $encoding);
        return $str;
    }
}
