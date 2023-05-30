<?php

declare(strict_types=1);

namespace Manychois\Views;

/**
 * Provides methods for escaping strings for different contexts.
 */
class Esc
{
    /**
     * Escape string for HTML attribute value.
     * @param string $text String to escape.
     * @param bool $unquoted Set true if the attribute value will not be enclosed by quotes. In that case, whitespace
     *                       characters will be escaped.
     */
    public function attr(string $text, bool $unquoted = false): string
    {
        $esc = htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
        if ($unquoted) {
            $esc = strtr($esc, [
                ' ' => '&#32;',
                "\f" => '&#12;',
                "\r" => '&#13;',
                "\n" => '&#10;',
                "\t" => '&#9;',
            ]);
        }
        return $esc;
    }

    /**
     * Escape string for CSS text.
     * @param string $text String to escape.
     */
    public function css(string $text): string
    {
        return strtr($text, [
            '\\' => '\\\\',
            "\n" => '\A',
            '"' => '\"',
            "'" => "\\'",
        ]);
    }

    /**
     * Escape string for HTML text.
     * @param string $text String to escape.
     */
    public function html(string $text): string
    {
        return htmlspecialchars($text, ENT_SUBSTITUTE | ENT_HTML5);
    }

    /**
     * Escape string for JavaScript.
     * @param string $text String to escape.
     * @param bool $templateMode Set true if the string is to be used as a template literal.
     */
    public function js(string $text, bool $templateMode = false): string
    {
        if ($templateMode) {
            return strtr($text, [
                '\\' => '\\\\',
                '`' => '\\`',
                '$' => '\\$',
            ]);
        } else {
            return strtr($text, [
                '\\' => '\\\\',
                "\f" => '\f',
                "\r" => '\r',
                "\n" => '\n',
                "\t" => '\t',
                '"' => '\"',
                "'" => "\\'",
            ]);
        }
    }

    /**
     * Escape URL part.
     * @param string $text String to escape.
     */
    public function url(string $text): string
    {
        return rawurlencode($text);
    }
}
