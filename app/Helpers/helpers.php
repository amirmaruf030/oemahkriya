<?php

namespace App\Helpers;

function mask_middle_characters($text)
{
    $words = explode(" ", $text);
    $result = [];

    foreach ($words as $word) {
        if (strlen($word) > 3) {
            $wordMiddle = substr($word, 1, -1);
            $wordMiddleMasked = str_repeat("*", strlen($wordMiddle));
            $wordMasked = $word[0] . $wordMiddleMasked . $word[strlen($word) - 1];
            array_push($result, $wordMasked);
        } else {
            array_push($result, $word);
        }
    }

    return implode(" ", $result);
}
