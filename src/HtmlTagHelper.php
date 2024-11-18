<?php

declare(strict_types=1);

namespace Manychois\Views;

use Manychois\Simdom\AbstractNode;
use Manychois\Simdom\Element;

/**
 * Helper class for creating HTML nodes.
 */
final class HtmlTagHelper
{
    /**
     * Create an element.
     *
     * @param string                                                     $tag   The tag name.
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created element.
     */
    public static function element(string $tag, array $attrs, string|AbstractNode|iterable|\Closure $inner): Element
    {
        $element = new Element($tag);
        foreach ($attrs as $name => $value) {
            $element->setAttr($name, \strval($value));
        }
        $resolved = $inner instanceof \Closure ? $inner() : $inner;
        if (\is_iterable($resolved)) {
            foreach ($resolved as $child) {
                if (!\is_string($child) && !($child instanceof AbstractNode)) {
                    throw new \InvalidArgumentException('Invalid inner content.');
                }

                $element->append($child);
            }
        } else {
            if (!\is_string($resolved) && !($resolved instanceof AbstractNode)) {
                throw new \InvalidArgumentException('Invalid inner content.');
            }
            $element->append($resolved);
        }

        return $element;
    }

    #region AutoCode

    /**
     * Create an `<a>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<a>` element.
     */
    public static function a(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('a', $attrs, $inner);
    }

    /**
     * Create an `<abbr>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<abbr>` element.
     */
    public static function abbr(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('abbr', $attrs, $inner);
    }

    /**
     * Create an `<address>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<address>` element.
     */
    public static function address(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('address', $attrs, $inner);
    }

    /**
     * Create an `<area>` element.
     *
     * @param array<string,string> $attrs The attributes.
     *
     * @return Element The created `<area>` element.
     */
    public static function area(array $attrs = []): Element
    {
        return self::element('area', $attrs, []);
    }

    /**
     * Create an `<article>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<article>` element.
     */
    public static function article(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('article', $attrs, $inner);
    }

    /**
     * Create an `<aside>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<aside>` element.
     */
    public static function aside(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('aside', $attrs, $inner);
    }

    /**
     * Create an `<audio>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<audio>` element.
     */
    public static function audio(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('audio', $attrs, $inner);
    }

    /**
     * Create a `<b>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<b>` element.
     */
    public static function b(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('b', $attrs, $inner);
    }

    /**
     * Create a `<base>` element.
     *
     * @param array<string,string> $attrs The attributes.
     *
     * @return Element The created `<base>` element.
     */
    public static function base(array $attrs = []): Element
    {
        return self::element('base', $attrs, []);
    }

    /**
     * Create a `<bdi>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<bdi>` element.
     */
    public static function bdi(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('bdi', $attrs, $inner);
    }

    /**
     * Create a `<bdo>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<bdo>` element.
     */
    public static function bdo(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('bdo', $attrs, $inner);
    }

    /**
     * Create a `<blockquote>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<blockquote>` element.
     */
    public static function blockquote(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('blockquote', $attrs, $inner);
    }

    /**
     * Create a `<body>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<body>` element.
     */
    public static function body(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('body', $attrs, $inner);
    }

    /**
     * Create a `<br>` element.
     *
     * @param array<string,string> $attrs The attributes.
     *
     * @return Element The created `<br>` element.
     */
    public static function br(array $attrs = []): Element
    {
        return self::element('br', $attrs, []);
    }

    /**
     * Create a `<button>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<button>` element.
     */
    public static function button(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('button', $attrs, $inner);
    }

    /**
     * Create a `<canvas>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<canvas>` element.
     */
    public static function canvas(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('canvas', $attrs, $inner);
    }

    /**
     * Create a `<caption>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<caption>` element.
     */
    public static function caption(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('caption', $attrs, $inner);
    }

    /**
     * Create a `<cite>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<cite>` element.
     */
    public static function cite(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('cite', $attrs, $inner);
    }

    /**
     * Create a `<code>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<code>` element.
     */
    public static function code(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('code', $attrs, $inner);
    }

    /**
     * Create a `<col>` element.
     *
     * @param array<string,string> $attrs The attributes.
     *
     * @return Element The created `<col>` element.
     */
    public static function col(array $attrs = []): Element
    {
        return self::element('col', $attrs, []);
    }

    /**
     * Create a `<colgroup>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<colgroup>` element.
     */
    public static function colgroup(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('colgroup', $attrs, $inner);
    }

    /**
     * Create a `<data>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<data>` element.
     */
    public static function data(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('data', $attrs, $inner);
    }

    /**
     * Create a `<datalist>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<datalist>` element.
     */
    public static function datalist(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('datalist', $attrs, $inner);
    }

    /**
     * Create a `<dd>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<dd>` element.
     */
    public static function dd(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('dd', $attrs, $inner);
    }

    /**
     * Create a `<del>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<del>` element.
     */
    public static function del(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('del', $attrs, $inner);
    }

    /**
     * Create a `<details>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<details>` element.
     */
    public static function details(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('details', $attrs, $inner);
    }

    /**
     * Create a `<dfn>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<dfn>` element.
     */
    public static function dfn(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('dfn', $attrs, $inner);
    }

    /**
     * Create a `<dialog>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<dialog>` element.
     */
    public static function dialog(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('dialog', $attrs, $inner);
    }

    /**
     * Create a `<div>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<div>` element.
     */
    public static function div(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('div', $attrs, $inner);
    }

    /**
     * Create a `<dl>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<dl>` element.
     */
    public static function dl(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('dl', $attrs, $inner);
    }

    /**
     * Create a `<dt>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<dt>` element.
     */
    public static function dt(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('dt', $attrs, $inner);
    }

    /**
     * Create an `<em>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<em>` element.
     */
    public static function em(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('em', $attrs, $inner);
    }

    /**
     * Create an `<embed>` element.
     *
     * @param array<string,string> $attrs The attributes.
     *
     * @return Element The created `<embed>` element.
     */
    public static function embed(array $attrs = []): Element
    {
        return self::element('embed', $attrs, []);
    }

    /**
     * Create a `<fieldset>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<fieldset>` element.
     */
    public static function fieldset(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('fieldset', $attrs, $inner);
    }

    /**
     * Create a `<figcaption>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<figcaption>` element.
     */
    public static function figcaption(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('figcaption', $attrs, $inner);
    }

    /**
     * Create a `<figure>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<figure>` element.
     */
    public static function figure(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('figure', $attrs, $inner);
    }

    /**
     * Create a `<footer>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<footer>` element.
     */
    public static function footer(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('footer', $attrs, $inner);
    }

    /**
     * Create a `<form>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<form>` element.
     */
    public static function form(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('form', $attrs, $inner);
    }

    /**
     * Create a `<h1>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<h1>` element.
     */
    public static function h1(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('h1', $attrs, $inner);
    }

    /**
     * Create a `<h2>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<h2>` element.
     */
    public static function h2(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('h2', $attrs, $inner);
    }

    /**
     * Create a `<h3>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<h3>` element.
     */
    public static function h3(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('h3', $attrs, $inner);
    }

    /**
     * Create a `<h4>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<h4>` element.
     */
    public static function h4(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('h4', $attrs, $inner);
    }

    /**
     * Create a `<h5>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<h5>` element.
     */
    public static function h5(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('h5', $attrs, $inner);
    }

    /**
     * Create a `<h6>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<h6>` element.
     */
    public static function h6(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('h6', $attrs, $inner);
    }

    /**
     * Create a `<head>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<head>` element.
     */
    public static function head(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('head', $attrs, $inner);
    }

    /**
     * Create a `<header>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<header>` element.
     */
    public static function header(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('header', $attrs, $inner);
    }

    /**
     * Create a `<hr>` element.
     *
     * @param array<string,string> $attrs The attributes.
     *
     * @return Element The created `<hr>` element.
     */
    public static function hr(array $attrs = []): Element
    {
        return self::element('hr', $attrs, []);
    }

    /**
     * Create a `<html>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<html>` element.
     */
    public static function html(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('html', $attrs, $inner);
    }

    /**
     * Create an `<i>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<i>` element.
     */
    public static function i(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('i', $attrs, $inner);
    }

    /**
     * Create an `<iframe>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<iframe>` element.
     */
    public static function iframe(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('iframe', $attrs, $inner);
    }

    /**
     * Create an `<img>` element.
     *
     * @param array<string,string> $attrs The attributes.
     *
     * @return Element The created `<img>` element.
     */
    public static function img(array $attrs = []): Element
    {
        return self::element('img', $attrs, []);
    }

    /**
     * Create an `<input>` element.
     *
     * @param array<string,string> $attrs The attributes.
     *
     * @return Element The created `<input>` element.
     */
    public static function input(array $attrs = []): Element
    {
        return self::element('input', $attrs, []);
    }

    /**
     * Create an `<ins>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<ins>` element.
     */
    public static function ins(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('ins', $attrs, $inner);
    }

    /**
     * Create a `<kbd>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<kbd>` element.
     */
    public static function kbd(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('kbd', $attrs, $inner);
    }

    /**
     * Create a `<label>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<label>` element.
     */
    public static function label(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('label', $attrs, $inner);
    }

    /**
     * Create a `<legend>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<legend>` element.
     */
    public static function legend(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('legend', $attrs, $inner);
    }

    /**
     * Create a `<li>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<li>` element.
     */
    public static function li(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('li', $attrs, $inner);
    }

    /**
     * Create a `<link>` element.
     *
     * @param array<string,string> $attrs The attributes.
     *
     * @return Element The created `<link>` element.
     */
    public static function link(array $attrs = []): Element
    {
        return self::element('link', $attrs, []);
    }

    /**
     * Create a `<main>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<main>` element.
     */
    public static function main(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('main', $attrs, $inner);
    }

    /**
     * Create a `<map>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<map>` element.
     */
    public static function map(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('map', $attrs, $inner);
    }

    /**
     * Create a `<mark>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<mark>` element.
     */
    public static function mark(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('mark', $attrs, $inner);
    }

    /**
     * Create a `<meta>` element.
     *
     * @param array<string,string> $attrs The attributes.
     *
     * @return Element The created `<meta>` element.
     */
    public static function meta(array $attrs = []): Element
    {
        return self::element('meta', $attrs, []);
    }

    /**
     * Create a `<meter>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<meter>` element.
     */
    public static function meter(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('meter', $attrs, $inner);
    }

    /**
     * Create a `<nav>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<nav>` element.
     */
    public static function nav(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('nav', $attrs, $inner);
    }

    /**
     * Create a `<noscript>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<noscript>` element.
     */
    public static function noscript(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('noscript', $attrs, $inner);
    }

    /**
     * Create an `<object>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<object>` element.
     */
    public static function object(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('object', $attrs, $inner);
    }

    /**
     * Create an `<ol>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<ol>` element.
     */
    public static function ol(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('ol', $attrs, $inner);
    }

    /**
     * Create an `<optgroup>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<optgroup>` element.
     */
    public static function optgroup(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('optgroup', $attrs, $inner);
    }

    /**
     * Create an `<option>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<option>` element.
     */
    public static function option(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('option', $attrs, $inner);
    }

    /**
     * Create an `<output>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<output>` element.
     */
    public static function output(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('output', $attrs, $inner);
    }

    /**
     * Create a `<p>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<p>` element.
     */
    public static function p(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('p', $attrs, $inner);
    }

    /**
     * Create a `<param>` element.
     *
     * @param array<string,string> $attrs The attributes.
     *
     * @return Element The created `<param>` element.
     */
    public static function param(array $attrs = []): Element
    {
        return self::element('param', $attrs, []);
    }

    /**
     * Create a `<picture>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<picture>` element.
     */
    public static function picture(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('picture', $attrs, $inner);
    }

    /**
     * Create a `<pre>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<pre>` element.
     */
    public static function pre(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('pre', $attrs, $inner);
    }

    /**
     * Create a `<progress>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<progress>` element.
     */
    public static function progress(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('progress', $attrs, $inner);
    }

    /**
     * Create a `<q>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<q>` element.
     */
    public static function q(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('q', $attrs, $inner);
    }

    /**
     * Create a `<rp>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<rp>` element.
     */
    public static function rp(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('rp', $attrs, $inner);
    }

    /**
     * Create a `<rt>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<rt>` element.
     */
    public static function rt(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('rt', $attrs, $inner);
    }

    /**
     * Create a `<ruby>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<ruby>` element.
     */
    public static function ruby(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('ruby', $attrs, $inner);
    }

    /**
     * Create a `<s>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<s>` element.
     */
    public static function s(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('s', $attrs, $inner);
    }

    /**
     * Create a `<samp>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<samp>` element.
     */
    public static function samp(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('samp', $attrs, $inner);
    }

    /**
     * Create a `<script>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<script>` element.
     */
    public static function script(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('script', $attrs, $inner);
    }

    /**
     * Create a `<section>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<section>` element.
     */
    public static function section(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('section', $attrs, $inner);
    }

    /**
     * Create a `<select>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<select>` element.
     */
    public static function select(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('select', $attrs, $inner);
    }

    /**
     * Create a `<slot>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<slot>` element.
     */
    public static function slot(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('slot', $attrs, $inner);
    }

    /**
     * Create a `<small>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<small>` element.
     */
    public static function small(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('small', $attrs, $inner);
    }

    /**
     * Create a `<source>` element.
     *
     * @param array<string,string> $attrs The attributes.
     *
     * @return Element The created `<source>` element.
     */
    public static function source(array $attrs = []): Element
    {
        return self::element('source', $attrs, []);
    }

    /**
     * Create a `<span>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<span>` element.
     */
    public static function span(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('span', $attrs, $inner);
    }

    /**
     * Create a `<strong>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<strong>` element.
     */
    public static function strong(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('strong', $attrs, $inner);
    }

    /**
     * Create a `<style>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<style>` element.
     */
    public static function style(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('style', $attrs, $inner);
    }

    /**
     * Create a `<sub>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<sub>` element.
     */
    public static function sub(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('sub', $attrs, $inner);
    }

    /**
     * Create a `<summary>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<summary>` element.
     */
    public static function summary(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('summary', $attrs, $inner);
    }

    /**
     * Create a `<sup>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<sup>` element.
     */
    public static function sup(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('sup', $attrs, $inner);
    }

    /**
     * Create a `<table>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<table>` element.
     */
    public static function table(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('table', $attrs, $inner);
    }

    /**
     * Create a `<tbody>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<tbody>` element.
     */
    public static function tbody(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('tbody', $attrs, $inner);
    }

    /**
     * Create a `<td>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<td>` element.
     */
    public static function td(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('td', $attrs, $inner);
    }

    /**
     * Create a `<template>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<template>` element.
     */
    public static function template(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('template', $attrs, $inner);
    }

    /**
     * Create a `<textarea>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<textarea>` element.
     */
    public static function textarea(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('textarea', $attrs, $inner);
    }

    /**
     * Create a `<tfoot>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<tfoot>` element.
     */
    public static function tfoot(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('tfoot', $attrs, $inner);
    }

    /**
     * Create a `<th>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<th>` element.
     */
    public static function th(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('th', $attrs, $inner);
    }

    /**
     * Create a `<thead>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<thead>` element.
     */
    public static function thead(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('thead', $attrs, $inner);
    }

    /**
     * Create a `<time>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<time>` element.
     */
    public static function time(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('time', $attrs, $inner);
    }

    /**
     * Create a `<title>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<title>` element.
     */
    public static function title(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('title', $attrs, $inner);
    }

    /**
     * Create a `<tr>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<tr>` element.
     */
    public static function tr(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('tr', $attrs, $inner);
    }

    /**
     * Create a `<track>` element.
     *
     * @param array<string,string> $attrs The attributes.
     *
     * @return Element The created `<track>` element.
     */
    public static function track(array $attrs = []): Element
    {
        return self::element('track', $attrs, []);
    }

    /**
     * Create an `<u>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<u>` element.
     */
    public static function u(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('u', $attrs, $inner);
    }

    /**
     * Create an `<ul>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<ul>` element.
     */
    public static function ul(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('ul', $attrs, $inner);
    }

    /**
     * Create a `<var>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<var>` element.
     */
    public static function var(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('var', $attrs, $inner);
    }

    /**
     * Create a `<video>` element.
     *
     * @param array<string,string>                                       $attrs The attributes.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $inner The inner content.
     *
     * @return Element The created `<video>` element.
     */
    public static function video(array $attrs = [], string|AbstractNode|iterable|\Closure $inner = []): Element
    {
        return self::element('video', $attrs, $inner);
    }

    /**
     * Create a `<wbr>` element.
     *
     * @param array<string,string> $attrs The attributes.
     *
     * @return Element The created `<wbr>` element.
     */
    public static function wbr(array $attrs = []): Element
    {
        return self::element('wbr', $attrs, []);
    }

    #endregion AutoCode
}
