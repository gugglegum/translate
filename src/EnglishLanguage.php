<?php

declare(strict_types=1);

namespace gugglegum\I18n\Translate;

/**
 * Extended language class for English language
 */
class EnglishLanguage extends Language
{
    /**
     * Returns one of two words depending on number.
     *
     * Usage example:
     *
     * public static function total_n_items(int $amount)
     * {
     *     return "Total {$amount} " . self::plural($amount, "item", "items");
     * }
     *
     * @param int $number
     * @param string $one
     * @param string $many
     * @return string
     */
    public static function plural(int $number, string $one, string $many): string
    {
        return $number === 1 ? $one : $many;
    }
}
