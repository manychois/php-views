<?php
namespace Manychois\Views;

class Esc
{
    /**
     * Escape HTML string.
     * @param string $text 
     * @return string
     */
    public static function html(string $text) : string
    {
        return htmlspecialchars($text, ENT_HTML5);
    }

    /**
     * Escape string for JavaScript. Note that the result is enclosed by double quotes.
     * @param string $text
     * @return string
     */
    public static function js(string $text) : string
    {
        return json_encode($text);
    }

    /**
     * Escape URL part.
     * @param string $text 
     * @return string
     */
    public static function url(string $text) : string
    {
        return rawurlencode($text);
    }
}