<?php

declare(strict_types=1);

namespace gugglegum\I18n\Translate;

/**
 * Base class for your concrete language classes containing translated phrases.
 */
abstract class Language
{
    /**
     * Used in concrete language classes to mask magic methods. If real method not exists, this method returns value
     * from static property with the same name and makes replacements for macros. Use real methods only for complex
     * translations which cannot be solved with simple substitution of values.
     *
     * @param $name
     * @param $arguments
     * @return string
     */
    public static function __callStatic($name, $arguments)
    {
        $class = get_called_class();
        if (method_exists($class, $name)) {
            return call_user_func_array([$class, $name], $arguments);
        } elseif (property_exists($class, $name)) {
            if (array_key_exists(0, $arguments)) {
                return self::replaceMacro($class::$$name, $arguments[0]);
            } else {
                return $class::$$name;
            }
        } else {
            throw new TranslateException("Missing translation for key \"{$name}\"");
        }
    }

    /**
     * Replaces placeholders like "{username}" with concrete values from associative array.
     *
     * @param string $str           String with placeholders in curly braces
     * @param array $values         Associative array with values to be substituted
     * @return string
     */
    protected static function replaceMacro(string $str, array $values): string
    {
        $search = [];
        $replace = [];
        foreach ($values as $key => $value) {
            $search[] = '{' . $key . '}';
            $replace[] = $value;
        }
        return str_replace($search, $values, $str);
    }
}
