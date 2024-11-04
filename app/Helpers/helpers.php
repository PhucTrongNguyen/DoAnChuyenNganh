<?php

use Stichoza\GoogleTranslate\GoogleTranslate;

if (! function_exists('translateText')) {
    function translateText($text, $locale = null) {
        $locale = $locale ?: session('locale', 'en');
        $tr = new GoogleTranslate($locale);
        $tr->setOptions(['verify' => false]); // Bỏ qua xác minh SSL
        return $tr->translate($text);
    }
}
