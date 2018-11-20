# Translate

This is extremely small and simple but yet powerful library to add localization to your app. It's as powerful as it's simple.

The basic idea consist of storing translations right in the PHP code and access them by calling static methods. Every translated phrase is stored under unique string key with naming convention for methods and properties. Simple translations which may have only named placeholders to be replaced with some values are stored in static properties. Complex translations which may vary depending on passed arguments are defined in static methods. To not to load all translations into the memory at once - split it on different classes and group by topic.

## Advantages

 * IDE friendly. Code analysis will highlight errors and allow code completion. Renaming phrase key can be performed in all places at once with smart IDE like PhpStorm.
 * Support of any features of any language (for example, complex plurals in Russian language).
 * No special translation files and programs to update them.
