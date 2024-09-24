<?php

namespace App\Classes\Helpers;


use Mockery\Exception;
use Symfony\Polyfill\Intl\Icu\Exception\MethodArgumentValueNotImplementedException;

class Money
{

    public static function AU(string | float |int | null $amount, $prefix = 'AU '): bool | string
    {
        if (is_null($amount)) {
            return '0.00';
        }

        $numberFormatter = new \NumberFormatter('en_AU', \NumberFormatter::CURRENCY);
        return $prefix . $numberFormatter->format($amount);
    }
    public static function CA(string | float |int | null $amount, $prefix = 'CAD '): bool | string
    {
        if (is_null($amount)) {
            return '0.00';
        }

        return $amount;
        try {
            $numberFormatter = new \NumberFormatter('en_CA', \NumberFormatter::CURRENCY);
            return $prefix . $numberFormatter->format($amount);

        } catch (MethodArgumentValueNotImplementedException $e) {
            return $amount;
        }

    }
}
