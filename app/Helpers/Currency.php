<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use NumberFormatter;
class Currency
{
    public function __invoke(...$params)
    {
        return static::format(...$params);
    }
    public static function format($amount,$currncy=null)
    {
        $baseCurrency = config('app.currency', 'USD');
        $formatter=new NumberFormatter(config('app.locale'),NumberFormatter::CURRENCY);
        if($currncy === null)
        {
            $currncy=Session::get(('currency_code') ,$baseCurrency);
        }
        if($currncy != $baseCurrency)
        {
            $rate = Cache::get('currency_rate'.$currncy ,1);
            $amount = $amount * $rate;
        }
        return $formatter->formatCurrency($amount,$currncy);
    }
}

?>
