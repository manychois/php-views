<?php

declare(strict_types=1);

namespace Manychois\Views;

/**
 * Escapes strings for different contexts.
 */
final class Esc
{
    /**
     * Escapes string for HTML attribute value.
     *
     * @param string $text     String to escape.
     * @param bool   $unquoted Set true if the attribute value will not be enclosed by quotes. In that case, whitespace
     *                         characters will be escaped.
     *
     * @return string Escaped string.
     */
    public static function attr(string $text, bool $unquoted = false): string
    {
        if ($unquoted) {
            $esc = \htmlspecialchars($text, \ENT_NOQUOTES | \ENT_SUBSTITUTE | \ENT_HTML5);
            $esc = \strtr($esc, [
                "\f" => '&#12;',
                "\n" => '&#10;',
                "\r" => '&#13;',
                "\t" => '&#9;',
                ' ' => '&#32;',
            ]);
        } else {
            $esc = \htmlspecialchars($text, \ENT_QUOTES | \ENT_SUBSTITUTE | \ENT_HTML5);
        }

        return $esc;
    }

    /**
     * Escapes string for CSS text.
     *
     * @param string $text String to escape.
     *
     * @return string Escaped string.
     */
    public static function css(string $text): string
    {
        return \strtr($text, [
            "'" => "\\'",
            "\n" => '\A',
            '"' => '\"',
            '\\' => '\\\\',
        ]);
    }

    /**
     * Escapes string for HTML text.
     *
     * @param string $text String to escape.
     *
     * @return string Escaped string.
     */
    public static function html(string $text): string
    {
        return \htmlspecialchars($text, \ENT_NOQUOTES | \ENT_SUBSTITUTE | \ENT_HTML5);
    }

    /**
     * Escapes string for JavaScript.
     *
     * @param string $text         String to escape.
     * @param bool   $templateMode Set true if the string is to be used as a template literal.
     *
     * @return string Escaped string.
     */
    public static function js(string $text, bool $templateMode = false): string
    {
        $text = \htmlspecialchars($text, \ENT_NOQUOTES | \ENT_SUBSTITUTE | \ENT_HTML5);
        if ($templateMode) {
            return \strtr($text, [
                '$' => '\\$',
                '\\' => '\\\\',
                '`' => '\\`',
            ]);
        }

        return \strtr($text, [
            "'" => "\\'",
            "\f" => '\f',
            "\n" => '\n',
            "\r" => '\r',
            "\t" => '\t',
            '"' => '\"',
            '\\' => '\\\\',
        ]);
    }

    /**
     * Escapes the URL part.
     *
     * @param string $text String to escape.
     *
     * @return string Escaped string.
     */
    public static function url(string $text): string
    {
        return \rawurlencode($text);
    }
}
