<?php

declare(strict_types=1);

namespace gugglegum\I18n\Translate;

/**
 * Extended language class for Russian language
 */
class RussianLanguage extends Language
{
    /**
     * Returns one of three words depending on number. Unlike English language Russian is more complex. So word endings
     * associated with some number may vary not only if it 1 or more, but with much complex conditions. For example,
     * russian word "кошка" (cat) can have 3 forms depending on number: "1 кошка", "2 кошки", "5 кошек". This is not only
     * for this word, this is for most words in Russian. So simple comparing number with 1 will not work. Moreover
     * different words have different endings. And here is a complex rule to identify which ending should be used for
     * every number. For example, the ending for number 2 will be the same as for 3 and 4; the ending for 5 will be the
     * same as for numbers from 6 to 20; the ending for 1 will be the same as for 21, 31, 41, etc. But for all numbers
     * there's always only 3 types of endings. These forms conditionally named $one, $two and $five because these forms
     * are applicable for these numbers and intuitive.
     *
     * Usage example:
     *
     * public static function total_n_items(int $amount)
     * {
     *     return "Всего {$amount} " . self::plural($amount, "товар", "товара", "товаров");
     * }
     *
     *
     * @param int $number
     * @param string $one
     * @param string $two
     * @param string $five
     * @return string
     */
    protected function plural(int $number, string $one, string $two, string $five): string
    {
        if (($number - $number % 10) % 100 != 10) {
            if ($number % 10 == 1) {
                $result = $one;
            } elseif ($number % 10 >= 2 && $number % 10 <= 4) {
                $result = $two;
            } else {
                $result = $five;
            }
        } else {
            $result = $five;
        }
        return $result;
    }
}
