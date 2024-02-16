<?php
namespace App\Helpers;
class TerbilangHelper
{
    public static function terbilang($number)
{
    $bilangan = array(
        '', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh',
        'sebelas', 'dua belas', 'tiga belas', 'empat belas', 'lima belas', 'enam belas', 'tujuh belas', 'delapan belas', 'sembilan belas'
    );
    if ($number < 20) {
        return $bilangan[$number];
    } elseif ($number < 100) {
        return $bilangan[floor($number / 10)] . ' puluh ' . $bilangan[$number % 10];
    } elseif ($number < 200) {
        return 'seratus ' . self::terbilang($number - 100);
    } elseif ($number < 1000) {
        return $bilangan[floor($number / 100)] . ' ratus ' . self::terbilang($number % 100);
    } elseif ($number < 2000) {
        return 'seribu ' . self::terbilang($number - 1000);
    } elseif ($number < 1000000) {
        return self::terbilang(floor($number / 1000)) . ' ribu ' . self::terbilang($number % 1000);
    } elseif ($number < 1000000000) {
        return self::terbilang(floor($number / 1000000)) . ' juta ' . self::terbilang($number % 1000000);
    } elseif ($number < 1000000000000) {
        return self::terbilang(floor($number / 1000000000)) . ' milyar ' . self::terbilang($number % 1000000000);
    } elseif ($number < 1000000000000000) {
        return self::terbilang(floor($number / 1000000000000)) . ' trilyun ' . self::terbilang($number % 1000000000000);
    } else {
        return '';
    }
}

}