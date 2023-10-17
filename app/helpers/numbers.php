<?php

use App\Models\Currency;
use Illuminate\Support\Facades\Cookie;
use \Illuminate\Support\Facades\Auth;


if (!function_exists('formatCurrencyAmount')) {
    function formatCurrencyAmount($value)
    {
        if (is_string($value)) {
            $value = (float) $value;
        }

        if (!is_int($value)) {
            $array = explode('.', $value);
            $value = substr($value, 0, (strlen($array[0]) + 1 + preference('decimal_digits')));
        }

        $decimal_digits = preference('decimal_digits');
        if (preference('hide_decimal') == 1 && count(explode('.', $value)) == 1) {
            $decimal_digits = 0;
        }

        if (preference('thousand_separator') == '.') {
            return number_format((float) $value, $decimal_digits, ',', '.');
        }

        return number_format((float) $value, $decimal_digits, '.', ',');
    }
}

if (!function_exists('formatNumber')) {
    function formatNumber($value, $symbol = null)
    {
        $prefix = str_replace('/','', request()->route()->getPrefix());
        if($prefix == 'vendor'){
            $currency = !is_null(Auth::user()->vendorUser->vendor->currency) ? Auth::user()->vendorUser->vendor->currency : Currency::getDefault();
        }else if(Cookie::has('currency') && ($prefix !== 'admin')){
            $currency = Currency::where('name', Cookie::get('currency'))->first();
        } else {
            $currency = Currency::getAll()->where('id', preference('dflt_currency_id'))->first();
        }
        $value = convertPrice($value);

        $amount = formatCurrencyAmount($value);
        if (empty($symbol)) {
            $symbol = $currency->symbol;
        }
        if (preference('symbol_position') == 'before') {
            return $symbol . $amount;
        }
        return $amount . $symbol;
    }
}

if(!function_exists('convertPrice')){
    function convertPrice($value) {
        $currencyCourse = null;
        if($value == 0) return $value;
        if(empty($value)) return;

        $prefix = str_replace('/','', request()->route()->getPrefix());
        if($prefix == 'vendor'){
            $currencyModel = !is_null(Auth::user()->vendorUser->vendor->currency) ? Auth::user()->vendorUser->vendor->currency : Currency::getDefault();

        }else if(Cookie::has('currency') && ($prefix !== 'admin')){
            $currencyModel = Currency::where('name', Cookie::get('currency'))->first();
        }

        if(isset($currencyModel) && $currencyModel !== null) {
            $currencyCourse = Currency::getDefault()->courses->where('converted_currency', $currencyModel->name)->first();
            if(is_null($currencyCourse)|| !isset($currencyCourse) || empty($currencyCourse)) return $value;

            if(is_array($value)){
                foreach ($value as $valueKey => $valueItem){
                    $value[$valueKey] = round($valueItem * $currencyCourse->exchange_rate,2,PHP_ROUND_HALF_UP);
                }
            }else {
                $value = round($value * $currencyCourse->exchange_rate,2,PHP_ROUND_HALF_UP);
            }

        }
        return $value;
        }
}
if(!function_exists('convertPriceWithoutPercent')){
    function convertPriceWithoutPercent($value) {
        $currencyCourse = null;
        if($value == 0) return $value;
        if(empty($value)) return;

        $prefix = str_replace('/','', request()->route()->getPrefix());
        if($prefix == 'vendor'){
            $currencyModel = !is_null(Auth::user()->vendorUser->vendor->currency) ? Auth::user()->vendorUser->vendor->currency : Currency::getDefault();

        }else if(Cookie::has('currency') && ($prefix !== 'admin')){
            $currencyModel = Currency::where('name', Cookie::get('currency'))->first();
        }

        if(isset($currencyModel) && $currencyModel !== null) {
            $currencyCourse = Currency::getDefault()->courses->where('converted_currency', $currencyModel->name)->first();
            if(is_null($currencyCourse)|| !isset($currencyCourse) || empty($currencyCourse)) return $value;

            if(is_array($value)){
                foreach ($value as $valueKey => $valueItem){
                    $value[$valueKey] = round($valueItem * $currencyCourse->index_value,2,PHP_ROUND_HALF_UP);
                }
            }else {
                $value = round($value * $currencyCourse->index_value,2,PHP_ROUND_HALF_UP);
            }

        }
        return $value;
        }
}
if(!function_exists('convertPriceWhenVendorSaveProduct')){
    function convertPriceWhenVendorSaveProduct($value) {
        $currencyCourse = null;

        $prefix = str_replace('/','', request()->route()->getPrefix());
        if($prefix == 'vendor'){
            $currencyModel = !is_null(Auth::user()->vendorUser->vendor->currency) ? Auth::user()->vendorUser->vendor->currency : Currency::getDefault();

        }

        if(isset($currencyModel) && $currencyModel !== null) {
            $currencyCourse = $currencyModel->courses->where('converted_currency', Currency::getDefault()->name)->first();
            if(is_null($currencyCourse)|| !isset($currencyCourse) || empty($currencyCourse)) return $value;

                $value = round($value * $currencyCourse->exchange_rate,2,PHP_ROUND_HALF_UP);
        }
        return $value;
        }
}


if (!function_exists('validateNumbers')) {
    function validateNumbers($number)
    {
        if (preference('thousand_separator') == ".") {
            $number = str_replace(".", "", $number);
        } else {
            $number = str_replace(",", "", $number);
        }
        $number = floatval(str_replace(",", ".", $number));
        return $number;
    }
}



if (!function_exists('formatDecimal')) {
    function formatDecimal($value)
    {
        $decimal_digits = preference('decimal_digits');
        if (preference('hide_decimal') == 1 && count(explode('.', $value)) == 1) {
            $decimal_digits = 0;
        }
        return round($value, $decimal_digits);
    }
}
