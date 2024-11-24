<?php

declare(strict_types=1);

namespace Manychois\Views;

/**
 * Helper class for creating HTML nodes.
 */
final class HtmlTagHelper
{
    public const NAMESPACE = 'http://www.w3.org/1999/xhtml';

    public readonly \DOMDocument $ownerDocument;

    /**
     * Initializes a new instance of HtmlTagHelper.
     *
     * @param \DOMDocument $ownerDocument The owner document.
     */
    public function __construct(\DOMDocument $ownerDocument)
    {
        $this->ownerDocument = $ownerDocument;
    }

    /**
     * Creates a comment.
     *
     * @param string|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMComment The created comment.
     */
    public function comment(string|iterable|\Closure|null $inner = null): \DOMComment
    {
        $data = $inner instanceof \Closure ? $inner($this) : $inner;
        if ($data === null) {
            $data = '';
        } elseif (\is_iterable($data)) {
            $concatenated = '';
            foreach ($data as $item) {
                if ($item === null) {
                    continue;
                }

                if (!\is_string($item)) {
                    throw new \InvalidArgumentException(\sprintf('Invalid object type: %s.', \get_debug_type($item)));
                }

                $concatenated .= $item;
            }
            $data = $concatenated;
        } elseif (!\is_string($data)) {
            throw new \InvalidArgumentException(\sprintf('Invalid object type: %s.', \get_debug_type($data)));
        }

        $comment = $this->ownerDocument->createComment($data);
        \assert($comment !== false);

        return $comment;
    }

    /**
     * Create an element.
     *
     * @param string                                                       $tag   The tag name.
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created element.
     */
    public function element(
        string $tag,
        array $attrs = [],
        string|\DOMNode|iterable|\Closure|null $inner = null
    ): \DOMElement {
        $element = $this->ownerDocument->createElementNS(self::NAMESPACE, $tag);
        foreach ($attrs as $name => $value) {
            if ($value === null || $value === false) {
                continue;
            }
            if ($value === true) {
                $value = '';
            }
            $element->setAttribute($name, $value);
        }

        $children = $inner instanceof \Closure ? $inner($this) : $inner;
        if (!\is_iterable($children)) {
            $children = [$children];
        }
        foreach ($children as $item) {
            if (\is_string($item)) {
                $element->appendChild($this->ownerDocument->createTextNode($item));
            } elseif ($item instanceof \DOMNode) {
                $element->appendChild($item);
            } elseif ($item === null) {
                continue;
            } else {
                throw new \InvalidArgumentException(\sprintf('Invalid object type: %s.', \get_debug_type($item)));
            }
        }

        return $element;
    }

    #region auto generated code

    /**
     * Create an `<a>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<a>` element.
     */
    public static function a(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('a', $attrs, $inner);
    }

    /**
     * Create an `<abbr>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<abbr>` element.
     */
    public static function abbr(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('abbr', $attrs, $inner);
    }

    /**
     * Create an `<address>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<address>` element.
     */
    public static function address(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('address', $attrs, $inner);
    }

    /**
     * Create an `<area>` element.
     *
     * @param array<string,null|bool|string> $attrs The attributes.
     *
     * @return \DOMElement The created `<area>` element.
     */
    public static function area(array $attrs = []): \DOMElement
    {
        return self::element('area', $attrs);
    }

    /**
     * Create an `<article>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<article>` element.
     */
    public static function article(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('article', $attrs, $inner);
    }

    /**
     * Create an `<aside>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<aside>` element.
     */
    public static function aside(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('aside', $attrs, $inner);
    }

    /**
     * Create an `<audio>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<audio>` element.
     */
    public static function audio(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('audio', $attrs, $inner);
    }

    /**
     * Create a `<b>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<b>` element.
     */
    public static function b(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('b', $attrs, $inner);
    }

    /**
     * Create a `<base>` element.
     *
     * @param array<string,null|bool|string> $attrs The attributes.
     *
     * @return \DOMElement The created `<base>` element.
     */
    public static function base(array $attrs = []): \DOMElement
    {
        return self::element('base', $attrs);
    }

    /**
     * Create a `<bdi>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<bdi>` element.
     */
    public static function bdi(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('bdi', $attrs, $inner);
    }

    /**
     * Create a `<bdo>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<bdo>` element.
     */
    public static function bdo(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('bdo', $attrs, $inner);
    }

    /**
     * Create a `<blockquote>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<blockquote>` element.
     */
    public static function blockquote(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('blockquote', $attrs, $inner);
    }

    /**
     * Create a `<body>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<body>` element.
     */
    public static function body(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('body', $attrs, $inner);
    }

    /**
     * Create a `<br>` element.
     *
     * @param array<string,null|bool|string> $attrs The attributes.
     *
     * @return \DOMElement The created `<br>` element.
     */
    public static function br(array $attrs = []): \DOMElement
    {
        return self::element('br', $attrs);
    }

    /**
     * Create a `<button>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<button>` element.
     */
    public static function button(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('button', $attrs, $inner);
    }

    /**
     * Create a `<canvas>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<canvas>` element.
     */
    public static function canvas(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('canvas', $attrs, $inner);
    }

    /**
     * Create a `<caption>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<caption>` element.
     */
    public static function caption(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('caption', $attrs, $inner);
    }

    /**
     * Create a `<cite>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<cite>` element.
     */
    public static function cite(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('cite', $attrs, $inner);
    }

    /**
     * Create a `<code>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<code>` element.
     */
    public static function code(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('code', $attrs, $inner);
    }

    /**
     * Create a `<col>` element.
     *
     * @param array<string,null|bool|string> $attrs The attributes.
     *
     * @return \DOMElement The created `<col>` element.
     */
    public static function col(array $attrs = []): \DOMElement
    {
        return self::element('col', $attrs);
    }

    /**
     * Create a `<colgroup>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<colgroup>` element.
     */
    public static function colgroup(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('colgroup', $attrs, $inner);
    }

    /**
     * Create a `<data>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<data>` element.
     */
    public static function data(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('data', $attrs, $inner);
    }

    /**
     * Create a `<datalist>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<datalist>` element.
     */
    public static function datalist(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('datalist', $attrs, $inner);
    }

    /**
     * Create a `<dd>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<dd>` element.
     */
    public static function dd(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('dd', $attrs, $inner);
    }

    /**
     * Create a `<del>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<del>` element.
     */
    public static function del(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('del', $attrs, $inner);
    }

    /**
     * Create a `<details>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<details>` element.
     */
    public static function details(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('details', $attrs, $inner);
    }

    /**
     * Create a `<dfn>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<dfn>` element.
     */
    public static function dfn(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('dfn', $attrs, $inner);
    }

    /**
     * Create a `<dialog>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<dialog>` element.
     */
    public static function dialog(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('dialog', $attrs, $inner);
    }

    /**
     * Create a `<div>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<div>` element.
     */
    public static function div(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('div', $attrs, $inner);
    }

    /**
     * Create a `<dl>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<dl>` element.
     */
    public static function dl(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('dl', $attrs, $inner);
    }

    /**
     * Create a `<dt>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<dt>` element.
     */
    public static function dt(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('dt', $attrs, $inner);
    }

    /**
     * Create an `<em>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<em>` element.
     */
    public static function em(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('em', $attrs, $inner);
    }

    /**
     * Create an `<embed>` element.
     *
     * @param array<string,null|bool|string> $attrs The attributes.
     *
     * @return \DOMElement The created `<embed>` element.
     */
    public static function embed(array $attrs = []): \DOMElement
    {
        return self::element('embed', $attrs);
    }

    /**
     * Create a `<fieldset>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<fieldset>` element.
     */
    public static function fieldset(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('fieldset', $attrs, $inner);
    }

    /**
     * Create a `<figcaption>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<figcaption>` element.
     */
    public static function figcaption(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('figcaption', $attrs, $inner);
    }

    /**
     * Create a `<figure>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<figure>` element.
     */
    public static function figure(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('figure', $attrs, $inner);
    }

    /**
     * Create a `<footer>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<footer>` element.
     */
    public static function footer(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('footer', $attrs, $inner);
    }

    /**
     * Create a `<form>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<form>` element.
     */
    public static function form(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('form', $attrs, $inner);
    }

    /**
     * Create a `<h1>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<h1>` element.
     */
    public static function h1(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('h1', $attrs, $inner);
    }

    /**
     * Create a `<h2>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<h2>` element.
     */
    public static function h2(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('h2', $attrs, $inner);
    }

    /**
     * Create a `<h3>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<h3>` element.
     */
    public static function h3(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('h3', $attrs, $inner);
    }

    /**
     * Create a `<h4>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<h4>` element.
     */
    public static function h4(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('h4', $attrs, $inner);
    }

    /**
     * Create a `<h5>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<h5>` element.
     */
    public static function h5(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('h5', $attrs, $inner);
    }

    /**
     * Create a `<h6>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<h6>` element.
     */
    public static function h6(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('h6', $attrs, $inner);
    }

    /**
     * Create a `<head>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<head>` element.
     */
    public static function head(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('head', $attrs, $inner);
    }

    /**
     * Create a `<header>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<header>` element.
     */
    public static function header(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('header', $attrs, $inner);
    }

    /**
     * Create a `<hr>` element.
     *
     * @param array<string,null|bool|string> $attrs The attributes.
     *
     * @return \DOMElement The created `<hr>` element.
     */
    public static function hr(array $attrs = []): \DOMElement
    {
        return self::element('hr', $attrs);
    }

    /**
     * Create a `<html>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<html>` element.
     */
    public static function html(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('html', $attrs, $inner);
    }

    /**
     * Create an `<i>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<i>` element.
     */
    public static function i(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('i', $attrs, $inner);
    }

    /**
     * Create an `<iframe>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<iframe>` element.
     */
    public static function iframe(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('iframe', $attrs, $inner);
    }

    /**
     * Create an `<img>` element.
     *
     * @param array<string,null|bool|string> $attrs The attributes.
     *
     * @return \DOMElement The created `<img>` element.
     */
    public static function img(array $attrs = []): \DOMElement
    {
        return self::element('img', $attrs);
    }

    /**
     * Create an `<input>` element.
     *
     * @param array<string,null|bool|string> $attrs The attributes.
     *
     * @return \DOMElement The created `<input>` element.
     */
    public static function input(array $attrs = []): \DOMElement
    {
        return self::element('input', $attrs);
    }

    /**
     * Create an `<ins>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<ins>` element.
     */
    public static function ins(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('ins', $attrs, $inner);
    }

    /**
     * Create a `<kbd>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<kbd>` element.
     */
    public static function kbd(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('kbd', $attrs, $inner);
    }

    /**
     * Create a `<label>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<label>` element.
     */
    public static function label(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('label', $attrs, $inner);
    }

    /**
     * Create a `<legend>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<legend>` element.
     */
    public static function legend(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('legend', $attrs, $inner);
    }

    /**
     * Create a `<li>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<li>` element.
     */
    public static function li(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('li', $attrs, $inner);
    }

    /**
     * Create a `<link>` element.
     *
     * @param array<string,null|bool|string> $attrs The attributes.
     *
     * @return \DOMElement The created `<link>` element.
     */
    public static function link(array $attrs = []): \DOMElement
    {
        return self::element('link', $attrs);
    }

    /**
     * Create a `<main>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<main>` element.
     */
    public static function main(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('main', $attrs, $inner);
    }

    /**
     * Create a `<map>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<map>` element.
     */
    public static function map(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('map', $attrs, $inner);
    }

    /**
     * Create a `<mark>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<mark>` element.
     */
    public static function mark(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('mark', $attrs, $inner);
    }

    /**
     * Create a `<meta>` element.
     *
     * @param array<string,null|bool|string> $attrs The attributes.
     *
     * @return \DOMElement The created `<meta>` element.
     */
    public static function meta(array $attrs = []): \DOMElement
    {
        return self::element('meta', $attrs);
    }

    /**
     * Create a `<meter>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<meter>` element.
     */
    public static function meter(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('meter', $attrs, $inner);
    }

    /**
     * Create a `<nav>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<nav>` element.
     */
    public static function nav(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('nav', $attrs, $inner);
    }

    /**
     * Create a `<noscript>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<noscript>` element.
     */
    public static function noscript(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('noscript', $attrs, $inner);
    }

    /**
     * Create an `<object>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<object>` element.
     */
    public static function object(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('object', $attrs, $inner);
    }

    /**
     * Create an `<ol>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<ol>` element.
     */
    public static function ol(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('ol', $attrs, $inner);
    }

    /**
     * Create an `<optgroup>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<optgroup>` element.
     */
    public static function optgroup(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('optgroup', $attrs, $inner);
    }

    /**
     * Create an `<option>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<option>` element.
     */
    public static function option(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('option', $attrs, $inner);
    }

    /**
     * Create an `<output>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<output>` element.
     */
    public static function output(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('output', $attrs, $inner);
    }

    /**
     * Create a `<p>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<p>` element.
     */
    public static function p(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('p', $attrs, $inner);
    }

    /**
     * Create a `<param>` element.
     *
     * @param array<string,null|bool|string> $attrs The attributes.
     *
     * @return \DOMElement The created `<param>` element.
     */
    public static function param(array $attrs = []): \DOMElement
    {
        return self::element('param', $attrs);
    }

    /**
     * Create a `<picture>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<picture>` element.
     */
    public static function picture(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('picture', $attrs, $inner);
    }

    /**
     * Create a `<pre>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<pre>` element.
     */
    public static function pre(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('pre', $attrs, $inner);
    }

    /**
     * Create a `<progress>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<progress>` element.
     */
    public static function progress(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('progress', $attrs, $inner);
    }

    /**
     * Create a `<q>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<q>` element.
     */
    public static function q(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('q', $attrs, $inner);
    }

    /**
     * Create a `<rp>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<rp>` element.
     */
    public static function rp(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('rp', $attrs, $inner);
    }

    /**
     * Create a `<rt>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<rt>` element.
     */
    public static function rt(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('rt', $attrs, $inner);
    }

    /**
     * Create a `<ruby>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<ruby>` element.
     */
    public static function ruby(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('ruby', $attrs, $inner);
    }

    /**
     * Create a `<s>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<s>` element.
     */
    public static function s(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('s', $attrs, $inner);
    }

    /**
     * Create a `<samp>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<samp>` element.
     */
    public static function samp(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('samp', $attrs, $inner);
    }

    /**
     * Create a `<script>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<script>` element.
     */
    public static function script(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('script', $attrs, $inner);
    }

    /**
     * Create a `<section>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<section>` element.
     */
    public static function section(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('section', $attrs, $inner);
    }

    /**
     * Create a `<select>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<select>` element.
     */
    public static function select(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('select', $attrs, $inner);
    }

    /**
     * Create a `<slot>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<slot>` element.
     */
    public static function slot(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('slot', $attrs, $inner);
    }

    /**
     * Create a `<small>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<small>` element.
     */
    public static function small(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('small', $attrs, $inner);
    }

    /**
     * Create a `<source>` element.
     *
     * @param array<string,null|bool|string> $attrs The attributes.
     *
     * @return \DOMElement The created `<source>` element.
     */
    public static function source(array $attrs = []): \DOMElement
    {
        return self::element('source', $attrs);
    }

    /**
     * Create a `<span>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<span>` element.
     */
    public static function span(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('span', $attrs, $inner);
    }

    /**
     * Create a `<strong>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<strong>` element.
     */
    public static function strong(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('strong', $attrs, $inner);
    }

    /**
     * Create a `<style>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<style>` element.
     */
    public static function style(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('style', $attrs, $inner);
    }

    /**
     * Create a `<sub>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<sub>` element.
     */
    public static function sub(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('sub', $attrs, $inner);
    }

    /**
     * Create a `<summary>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<summary>` element.
     */
    public static function summary(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('summary', $attrs, $inner);
    }

    /**
     * Create a `<sup>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<sup>` element.
     */
    public static function sup(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('sup', $attrs, $inner);
    }

    /**
     * Create a `<table>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<table>` element.
     */
    public static function table(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('table', $attrs, $inner);
    }

    /**
     * Create a `<tbody>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<tbody>` element.
     */
    public static function tbody(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('tbody', $attrs, $inner);
    }

    /**
     * Create a `<td>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<td>` element.
     */
    public static function td(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('td', $attrs, $inner);
    }

    /**
     * Create a `<template>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<template>` element.
     */
    public static function template(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('template', $attrs, $inner);
    }

    /**
     * Create a `<textarea>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<textarea>` element.
     */
    public static function textarea(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('textarea', $attrs, $inner);
    }

    /**
     * Create a `<tfoot>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<tfoot>` element.
     */
    public static function tfoot(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('tfoot', $attrs, $inner);
    }

    /**
     * Create a `<th>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<th>` element.
     */
    public static function th(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('th', $attrs, $inner);
    }

    /**
     * Create a `<thead>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<thead>` element.
     */
    public static function thead(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('thead', $attrs, $inner);
    }

    /**
     * Create a `<time>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<time>` element.
     */
    public static function time(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('time', $attrs, $inner);
    }

    /**
     * Create a `<title>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<title>` element.
     */
    public static function title(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('title', $attrs, $inner);
    }

    /**
     * Create a `<tr>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<tr>` element.
     */
    public static function tr(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('tr', $attrs, $inner);
    }

    /**
     * Create a `<track>` element.
     *
     * @param array<string,null|bool|string> $attrs The attributes.
     *
     * @return \DOMElement The created `<track>` element.
     */
    public static function track(array $attrs = []): \DOMElement
    {
        return self::element('track', $attrs);
    }

    /**
     * Create an `<u>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<u>` element.
     */
    public static function u(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('u', $attrs, $inner);
    }

    /**
     * Create an `<ul>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<ul>` element.
     */
    public static function ul(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('ul', $attrs, $inner);
    }

    /**
     * Create a `<var>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<var>` element.
     */
    public static function var(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('var', $attrs, $inner);
    }

    /**
     * Create a `<video>` element.
     *
     * @param array<string,null|bool|string>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<video>` element.
     */
    public static function video(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return self::element('video', $attrs, $inner);
    }

    /**
     * Create a `<wbr>` element.
     *
     * @param array<string,null|bool|string> $attrs The attributes.
     *
     * @return \DOMElement The created `<wbr>` element.
     */
    public static function wbr(array $attrs = []): \DOMElement
    {
        return self::element('wbr', $attrs);
    }

    #endregion auto generated code
}
