<?php

namespace Jasontuan\FigmaImport\Services;

use Jasontuan\FigmaImport\Services\Constants;

class Utility
{
    public static function hex2rgba($hex) {
        $hex = str_replace("#", "", $hex);

        switch (strlen($hex)) {
            case 3 :
                $r = hexdec(substr($hex, 0, 1).substr($hex, 0, 1));
                $g = hexdec(substr($hex, 1, 1).substr($hex, 1, 1));
                $b = hexdec(substr($hex, 2, 1).substr($hex, 2, 1));
                $a = 1;
                break;
            case 6 :
                $r = hexdec(substr($hex, 0, 2));
                $g = hexdec(substr($hex, 2, 2));
                $b = hexdec(substr($hex, 4, 2));
                $a = 1;
                break;
            case 8 :
                $a = hexdec(substr($hex, 0, 2)) / 255;
                $r = hexdec(substr($hex, 2, 2));
                $g = hexdec(substr($hex, 4, 2));
                $b = hexdec(substr($hex, 6, 2));
                break;
        }
        $rgba = array($r, $g, $b, $a);

        return 'rgba('.implode(', ', $rgba).')';
    }

    public static function rgba2hex($string) {
        $rgba  = array();
        $hex   = '';
        $regex = '#\((([^()]+|(?R))*)\)#';
        if (preg_match_all($regex, $string ,$matches)) {
            $rgba = explode(',', implode(' ', $matches[1]));
        } else {
            $rgba = explode(',', $string);
        }

        $rr = str_pad(dechex($rgba[0]), 2, "0", STR_PAD_LEFT);
        $gg = str_pad(dechex($rgba[1]), 2, "0", STR_PAD_LEFT);
        $bb = str_pad(dechex($rgba[2]), 2, "0", STR_PAD_LEFT);
        $aa = '';

        if (array_key_exists('3', $rgba)) {
            $aa = dechex($rgba['3'] * 255);
        }

        return strtoupper("#$aa$rr$gg$bb");
    }

    public static function formatColor(string $value)
    {
        $value = str_replace("rgb(", "rgba(", $value);
        if (preg_match(Constants\PATTERN_RGBA_VALUE, $value)) {
            return self::rgba2hex($value);
        }
        return $value;
    }
}
