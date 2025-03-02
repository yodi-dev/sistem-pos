<?php

namespace App\Helpers;

class Format
{
    public static function rupiah($angka)
    {
        return number_format($angka, 0, ',', '.');
    }
}
