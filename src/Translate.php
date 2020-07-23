<?php

declare(strict_types=1);

namespace gugglegum\I18n\Translate;

/**
 * Base class for your translation classes which you call to get translated phrase on some preselected language.
 */
abstract class Translate
{
    protected static $language;

    /**
     * Returns current language
     *
     * @return null|string
     */
    public static function getLanguage(): string
    {
        if (self::$language === null) {
            throw new TranslateException("Translate language is not defined");
        }
        return self::$language;
    }

    /**
     * Sets languages
     *
     * @param string $language
     */
    public static function setLanguage(string $language)
    {
        self::$language = $language;
    }

    /**
     * Redirects static calls from translate classes to concrete language classes.
     *
     * @param $name
     * @param $arguments
     * @return string
     */
    public static function __callStatic($name, $arguments): string
    {
        $languageClass = self::getLanguageClass();
        return call_user_func_array([$languageClass, $name], $arguments);
    }

    /**
     * Returns the name of concrete language class based on currently defined translation language.
     *
     * @return string
     */
    private static function getLanguageClass(): string
    {
        $class = get_called_class();
        $pos = strrpos($class, '\\');
        return substr_replace($class, '\\' . ucfirst(strtolower(self::getLanguage())), $pos, 0);
    }
}
