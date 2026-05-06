<?php

namespace App\Services;

class Censurator
{
    const BAN_WORDS = ['tartine', 'madeleine', 'boulot', 'pain au chocolat'];

    public function purify(string $text) {

        $textTab = explode(' ', $text);

        for ($i = 0; $i < count($textTab); $i++) {
            if (in_array($textTab[$i], self::BAN_WORDS)) {
                $textTab[$i] = str_repeat('*', strlen($textTab[$i]));
            }
        }

        return implode(' ', $textTab);

//        return str_ireplace(self::BAN_WORDS, $text, '*******');
//        return preg_replace();
    }
}
