<?php
namespace App\Helpers;

use NumberFormatter;

class CurrencyHelper {
    public static function formatCurrency($amount, $currency, $locale) {
        return (new NumberFormatter($locale, NumberFormatter::CURRENCY))->formatCurrency($amount, $currency);
    }
}
