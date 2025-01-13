<?php

declare(strict_types=1);

namespace Manychois\Views;

use Dom\Comment;
use Dom\Element;
use Dom\HTMLDocument;
use Dom\Node;

/**
 * Helper class for creating HTML nodes.
 *
 * @phpstan-type SimpleContent string|Node|null
 * @phpstan-type ContentClosure \Closure(self):(SimpleContent|iterable<SimpleContent>)
 * @phpstan-type Content SimpleContent|iterable<SimpleContent>|ContentClosure
 * @phpstan-type CommentContent \Closure(self):string|iterable<string|null>|null
 */
final class HtmlTagHelper
{
    public readonly HTMLDocument $ownerDocument;

    /**
     * Initializes a new instance of HtmlTagHelper.
     *
     * @param HTMLDocument $ownerDocument The owner document.
     */
    public function __construct(HTMLDocument $ownerDocument)
    {
        $this->ownerDocument = $ownerDocument;
    }

    /**
     * Creates a comment.
     *
     * @param string|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Comment The created comment.
     *
     * @phpstan-param string|iterable<string|null>|CommentContent|null $inner
     */
    public function comment(string|iterable|\Closure|null $inner = null): Comment
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
                    throw new \TypeError(\sprintf('Invalid type: %s.', \get_debug_type($item)));
                }

                $concatenated .= $item;
            }
            $data = $concatenated;
        } elseif (!\is_string($data)) {
            throw new \TypeError(\sprintf('Invalid type: %s.', \get_debug_type($data)));
        }

        return $this->ownerDocument->createComment($data);
    }

    /**
     * Create an element.
     *
     * @param string                                               $tag   The tag name.
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created element.
     *
     * @phpstan-param Content $inner
     */
    public function element(string $tag, array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        $element = $this->ownerDocument->createElement($tag);
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
            } elseif ($item instanceof Node) {
                $element->appendChild($item);
            } elseif ($item === null) {
                continue;
            } else {
                throw new \TypeError(\sprintf('Invalid type: %s.', \get_debug_type($item)));
            }
        }

        return $element;
    }

    // @codeCoverageIgnoreStart

    #region auto generated code

    /**
     * Create an `<a>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<a>` element.
     *
     * @phpstan-param Content $inner
     */
    public function a(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('a', $attrs, $inner);
    }

    /**
     * Create an `<abbr>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<abbr>` element.
     *
     * @phpstan-param Content $inner
     */
    public function abbr(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('abbr', $attrs, $inner);
    }

    /**
     * Create an `<address>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<address>` element.
     *
     * @phpstan-param Content $inner
     */
    public function address(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('address', $attrs, $inner);
    }

    /**
     * Create an `<area>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return Element The created `<area>` element.
     */
    public function area(array $attrs = []): Element
    {
        return $this->element('area', $attrs);
    }

    /**
     * Create an `<article>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<article>` element.
     *
     * @phpstan-param Content $inner
     */
    public function article(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('article', $attrs, $inner);
    }

    /**
     * Create an `<aside>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<aside>` element.
     *
     * @phpstan-param Content $inner
     */
    public function aside(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('aside', $attrs, $inner);
    }

    /**
     * Create an `<audio>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<audio>` element.
     *
     * @phpstan-param Content $inner
     */
    public function audio(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('audio', $attrs, $inner);
    }

    /**
     * Create a `<b>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<b>` element.
     *
     * @phpstan-param Content $inner
     */
    public function b(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('b', $attrs, $inner);
    }

    /**
     * Create a `<base>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return Element The created `<base>` element.
     */
    public function base(array $attrs = []): Element
    {
        return $this->element('base', $attrs);
    }

    /**
     * Create a `<bdi>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<bdi>` element.
     *
     * @phpstan-param Content $inner
     */
    public function bdi(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('bdi', $attrs, $inner);
    }

    /**
     * Create a `<bdo>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<bdo>` element.
     *
     * @phpstan-param Content $inner
     */
    public function bdo(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('bdo', $attrs, $inner);
    }

    /**
     * Create a `<blockquote>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<blockquote>` element.
     *
     * @phpstan-param Content $inner
     */
    public function blockquote(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('blockquote', $attrs, $inner);
    }

    /**
     * Create a `<body>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<body>` element.
     *
     * @phpstan-param Content $inner
     */
    public function body(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('body', $attrs, $inner);
    }

    /**
     * Create a `<br>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return Element The created `<br>` element.
     */
    public function br(array $attrs = []): Element
    {
        return $this->element('br', $attrs);
    }

    /**
     * Create a `<button>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<button>` element.
     *
     * @phpstan-param Content $inner
     */
    public function button(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('button', $attrs, $inner);
    }

    /**
     * Create a `<canvas>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<canvas>` element.
     *
     * @phpstan-param Content $inner
     */
    public function canvas(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('canvas', $attrs, $inner);
    }

    /**
     * Create a `<caption>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<caption>` element.
     *
     * @phpstan-param Content $inner
     */
    public function caption(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('caption', $attrs, $inner);
    }

    /**
     * Create a `<cite>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<cite>` element.
     *
     * @phpstan-param Content $inner
     */
    public function cite(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('cite', $attrs, $inner);
    }

    /**
     * Create a `<code>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<code>` element.
     *
     * @phpstan-param Content $inner
     */
    public function code(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('code', $attrs, $inner);
    }

    /**
     * Create a `<col>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return Element The created `<col>` element.
     */
    public function col(array $attrs = []): Element
    {
        return $this->element('col', $attrs);
    }

    /**
     * Create a `<colgroup>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<colgroup>` element.
     *
     * @phpstan-param Content $inner
     */
    public function colgroup(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('colgroup', $attrs, $inner);
    }

    /**
     * Create a `<data>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<data>` element.
     *
     * @phpstan-param Content $inner
     */
    public function data(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('data', $attrs, $inner);
    }

    /**
     * Create a `<datalist>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<datalist>` element.
     *
     * @phpstan-param Content $inner
     */
    public function datalist(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('datalist', $attrs, $inner);
    }

    /**
     * Create a `<dd>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<dd>` element.
     *
     * @phpstan-param Content $inner
     */
    public function dd(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('dd', $attrs, $inner);
    }

    /**
     * Create a `<del>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<del>` element.
     *
     * @phpstan-param Content $inner
     */
    public function del(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('del', $attrs, $inner);
    }

    /**
     * Create a `<details>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<details>` element.
     *
     * @phpstan-param Content $inner
     */
    public function details(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('details', $attrs, $inner);
    }

    /**
     * Create a `<dfn>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<dfn>` element.
     *
     * @phpstan-param Content $inner
     */
    public function dfn(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('dfn', $attrs, $inner);
    }

    /**
     * Create a `<dialog>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<dialog>` element.
     *
     * @phpstan-param Content $inner
     */
    public function dialog(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('dialog', $attrs, $inner);
    }

    /**
     * Create a `<div>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<div>` element.
     *
     * @phpstan-param Content $inner
     */
    public function div(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('div', $attrs, $inner);
    }

    /**
     * Create a `<dl>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<dl>` element.
     *
     * @phpstan-param Content $inner
     */
    public function dl(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('dl', $attrs, $inner);
    }

    /**
     * Create a `<dt>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<dt>` element.
     *
     * @phpstan-param Content $inner
     */
    public function dt(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('dt', $attrs, $inner);
    }

    /**
     * Create an `<em>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<em>` element.
     *
     * @phpstan-param Content $inner
     */
    public function em(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('em', $attrs, $inner);
    }

    /**
     * Create an `<embed>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return Element The created `<embed>` element.
     */
    public function embed(array $attrs = []): Element
    {
        return $this->element('embed', $attrs);
    }

    /**
     * Create a `<fieldset>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<fieldset>` element.
     *
     * @phpstan-param Content $inner
     */
    public function fieldset(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('fieldset', $attrs, $inner);
    }

    /**
     * Create a `<figcaption>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<figcaption>` element.
     *
     * @phpstan-param Content $inner
     */
    public function figcaption(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('figcaption', $attrs, $inner);
    }

    /**
     * Create a `<figure>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<figure>` element.
     *
     * @phpstan-param Content $inner
     */
    public function figure(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('figure', $attrs, $inner);
    }

    /**
     * Create a `<footer>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<footer>` element.
     *
     * @phpstan-param Content $inner
     */
    public function footer(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('footer', $attrs, $inner);
    }

    /**
     * Create a `<form>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<form>` element.
     *
     * @phpstan-param Content $inner
     */
    public function form(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('form', $attrs, $inner);
    }

    /**
     * Create a `<h1>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<h1>` element.
     *
     * @phpstan-param Content $inner
     */
    public function h1(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('h1', $attrs, $inner);
    }

    /**
     * Create a `<h2>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<h2>` element.
     *
     * @phpstan-param Content $inner
     */
    public function h2(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('h2', $attrs, $inner);
    }

    /**
     * Create a `<h3>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<h3>` element.
     *
     * @phpstan-param Content $inner
     */
    public function h3(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('h3', $attrs, $inner);
    }

    /**
     * Create a `<h4>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<h4>` element.
     *
     * @phpstan-param Content $inner
     */
    public function h4(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('h4', $attrs, $inner);
    }

    /**
     * Create a `<h5>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<h5>` element.
     *
     * @phpstan-param Content $inner
     */
    public function h5(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('h5', $attrs, $inner);
    }

    /**
     * Create a `<h6>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<h6>` element.
     *
     * @phpstan-param Content $inner
     */
    public function h6(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('h6', $attrs, $inner);
    }

    /**
     * Create a `<head>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<head>` element.
     *
     * @phpstan-param Content $inner
     */
    public function head(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('head', $attrs, $inner);
    }

    /**
     * Create a `<header>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<header>` element.
     *
     * @phpstan-param Content $inner
     */
    public function header(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('header', $attrs, $inner);
    }

    /**
     * Create a `<hr>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return Element The created `<hr>` element.
     */
    public function hr(array $attrs = []): Element
    {
        return $this->element('hr', $attrs);
    }

    /**
     * Create a `<html>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<html>` element.
     *
     * @phpstan-param Content $inner
     */
    public function html(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('html', $attrs, $inner);
    }

    /**
     * Create an `<i>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<i>` element.
     *
     * @phpstan-param Content $inner
     */
    public function i(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('i', $attrs, $inner);
    }

    /**
     * Create an `<iframe>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<iframe>` element.
     *
     * @phpstan-param Content $inner
     */
    public function iframe(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('iframe', $attrs, $inner);
    }

    /**
     * Create an `<img>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return Element The created `<img>` element.
     */
    public function img(array $attrs = []): Element
    {
        return $this->element('img', $attrs);
    }

    /**
     * Create an `<input>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return Element The created `<input>` element.
     */
    public function input(array $attrs = []): Element
    {
        return $this->element('input', $attrs);
    }

    /**
     * Create an `<ins>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<ins>` element.
     *
     * @phpstan-param Content $inner
     */
    public function ins(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('ins', $attrs, $inner);
    }

    /**
     * Create a `<kbd>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<kbd>` element.
     *
     * @phpstan-param Content $inner
     */
    public function kbd(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('kbd', $attrs, $inner);
    }

    /**
     * Create a `<label>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<label>` element.
     *
     * @phpstan-param Content $inner
     */
    public function label(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('label', $attrs, $inner);
    }

    /**
     * Create a `<legend>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<legend>` element.
     *
     * @phpstan-param Content $inner
     */
    public function legend(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('legend', $attrs, $inner);
    }

    /**
     * Create a `<li>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<li>` element.
     *
     * @phpstan-param Content $inner
     */
    public function li(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('li', $attrs, $inner);
    }

    /**
     * Create a `<link>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return Element The created `<link>` element.
     */
    public function link(array $attrs = []): Element
    {
        return $this->element('link', $attrs);
    }

    /**
     * Create a `<main>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<main>` element.
     *
     * @phpstan-param Content $inner
     */
    public function main(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('main', $attrs, $inner);
    }

    /**
     * Create a `<map>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<map>` element.
     *
     * @phpstan-param Content $inner
     */
    public function map(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('map', $attrs, $inner);
    }

    /**
     * Create a `<mark>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mark>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mark(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mark', $attrs, $inner);
    }

    /**
     * Create a `<meta>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return Element The created `<meta>` element.
     */
    public function meta(array $attrs = []): Element
    {
        return $this->element('meta', $attrs);
    }

    /**
     * Create a `<meter>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<meter>` element.
     *
     * @phpstan-param Content $inner
     */
    public function meter(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('meter', $attrs, $inner);
    }

    /**
     * Create a `<nav>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<nav>` element.
     *
     * @phpstan-param Content $inner
     */
    public function nav(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('nav', $attrs, $inner);
    }

    /**
     * Create a `<noscript>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<noscript>` element.
     *
     * @phpstan-param Content $inner
     */
    public function noscript(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('noscript', $attrs, $inner);
    }

    /**
     * Create an `<object>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<object>` element.
     *
     * @phpstan-param Content $inner
     */
    public function object(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('object', $attrs, $inner);
    }

    /**
     * Create an `<ol>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<ol>` element.
     *
     * @phpstan-param Content $inner
     */
    public function ol(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('ol', $attrs, $inner);
    }

    /**
     * Create an `<optgroup>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<optgroup>` element.
     *
     * @phpstan-param Content $inner
     */
    public function optgroup(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('optgroup', $attrs, $inner);
    }

    /**
     * Create an `<option>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<option>` element.
     *
     * @phpstan-param Content $inner
     */
    public function option(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('option', $attrs, $inner);
    }

    /**
     * Create an `<output>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<output>` element.
     *
     * @phpstan-param Content $inner
     */
    public function output(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('output', $attrs, $inner);
    }

    /**
     * Create a `<p>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<p>` element.
     *
     * @phpstan-param Content $inner
     */
    public function p(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('p', $attrs, $inner);
    }

    /**
     * Create a `<param>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<param>` element.
     *
     * @phpstan-param Content $inner
     */
    public function param(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('param', $attrs, $inner);
    }

    /**
     * Create a `<picture>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<picture>` element.
     *
     * @phpstan-param Content $inner
     */
    public function picture(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('picture', $attrs, $inner);
    }

    /**
     * Create a `<pre>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<pre>` element.
     *
     * @phpstan-param Content $inner
     */
    public function pre(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('pre', $attrs, $inner);
    }

    /**
     * Create a `<progress>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<progress>` element.
     *
     * @phpstan-param Content $inner
     */
    public function progress(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('progress', $attrs, $inner);
    }

    /**
     * Create a `<q>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<q>` element.
     *
     * @phpstan-param Content $inner
     */
    public function q(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('q', $attrs, $inner);
    }

    /**
     * Create a `<rp>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<rp>` element.
     *
     * @phpstan-param Content $inner
     */
    public function rp(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('rp', $attrs, $inner);
    }

    /**
     * Create a `<rt>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<rt>` element.
     *
     * @phpstan-param Content $inner
     */
    public function rt(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('rt', $attrs, $inner);
    }

    /**
     * Create a `<ruby>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<ruby>` element.
     *
     * @phpstan-param Content $inner
     */
    public function ruby(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('ruby', $attrs, $inner);
    }

    /**
     * Create a `<s>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<s>` element.
     *
     * @phpstan-param Content $inner
     */
    public function s(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('s', $attrs, $inner);
    }

    /**
     * Create a `<samp>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<samp>` element.
     *
     * @phpstan-param Content $inner
     */
    public function samp(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('samp', $attrs, $inner);
    }

    /**
     * Create a `<script>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<script>` element.
     *
     * @phpstan-param Content $inner
     */
    public function script(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('script', $attrs, $inner);
    }

    /**
     * Create a `<section>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<section>` element.
     *
     * @phpstan-param Content $inner
     */
    public function section(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('section', $attrs, $inner);
    }

    /**
     * Create a `<select>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<select>` element.
     *
     * @phpstan-param Content $inner
     */
    public function select(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('select', $attrs, $inner);
    }

    /**
     * Create a `<slot>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<slot>` element.
     *
     * @phpstan-param Content $inner
     */
    public function slot(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('slot', $attrs, $inner);
    }

    /**
     * Create a `<small>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<small>` element.
     *
     * @phpstan-param Content $inner
     */
    public function small(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('small', $attrs, $inner);
    }

    /**
     * Create a `<source>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return Element The created `<source>` element.
     */
    public function source(array $attrs = []): Element
    {
        return $this->element('source', $attrs);
    }

    /**
     * Create a `<span>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<span>` element.
     *
     * @phpstan-param Content $inner
     */
    public function span(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('span', $attrs, $inner);
    }

    /**
     * Create a `<strong>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<strong>` element.
     *
     * @phpstan-param Content $inner
     */
    public function strong(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('strong', $attrs, $inner);
    }

    /**
     * Create a `<style>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<style>` element.
     *
     * @phpstan-param Content $inner
     */
    public function style(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('style', $attrs, $inner);
    }

    /**
     * Create a `<sub>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<sub>` element.
     *
     * @phpstan-param Content $inner
     */
    public function sub(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('sub', $attrs, $inner);
    }

    /**
     * Create a `<summary>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<summary>` element.
     *
     * @phpstan-param Content $inner
     */
    public function summary(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('summary', $attrs, $inner);
    }

    /**
     * Create a `<sup>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<sup>` element.
     *
     * @phpstan-param Content $inner
     */
    public function sup(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('sup', $attrs, $inner);
    }

    /**
     * Create a `<table>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<table>` element.
     *
     * @phpstan-param Content $inner
     */
    public function table(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('table', $attrs, $inner);
    }

    /**
     * Create a `<tbody>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<tbody>` element.
     *
     * @phpstan-param Content $inner
     */
    public function tbody(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('tbody', $attrs, $inner);
    }

    /**
     * Create a `<td>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<td>` element.
     *
     * @phpstan-param Content $inner
     */
    public function td(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('td', $attrs, $inner);
    }

    /**
     * Create a `<template>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<template>` element.
     *
     * @phpstan-param Content $inner
     */
    public function template(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('template', $attrs, $inner);
    }

    /**
     * Create a `<textarea>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<textarea>` element.
     *
     * @phpstan-param Content $inner
     */
    public function textarea(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('textarea', $attrs, $inner);
    }

    /**
     * Create a `<tfoot>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<tfoot>` element.
     *
     * @phpstan-param Content $inner
     */
    public function tfoot(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('tfoot', $attrs, $inner);
    }

    /**
     * Create a `<th>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<th>` element.
     *
     * @phpstan-param Content $inner
     */
    public function th(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('th', $attrs, $inner);
    }

    /**
     * Create a `<thead>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<thead>` element.
     *
     * @phpstan-param Content $inner
     */
    public function thead(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('thead', $attrs, $inner);
    }

    /**
     * Create a `<time>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<time>` element.
     *
     * @phpstan-param Content $inner
     */
    public function time(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('time', $attrs, $inner);
    }

    /**
     * Create a `<title>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<title>` element.
     *
     * @phpstan-param Content $inner
     */
    public function title(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('title', $attrs, $inner);
    }

    /**
     * Create a `<tr>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<tr>` element.
     *
     * @phpstan-param Content $inner
     */
    public function tr(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('tr', $attrs, $inner);
    }

    /**
     * Create a `<track>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return Element The created `<track>` element.
     */
    public function track(array $attrs = []): Element
    {
        return $this->element('track', $attrs);
    }

    /**
     * Create an `<u>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<u>` element.
     *
     * @phpstan-param Content $inner
     */
    public function u(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('u', $attrs, $inner);
    }

    /**
     * Create an `<ul>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<ul>` element.
     *
     * @phpstan-param Content $inner
     */
    public function ul(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('ul', $attrs, $inner);
    }

    /**
     * Create a `<var>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<var>` element.
     *
     * @phpstan-param Content $inner
     */
    public function var(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('var', $attrs, $inner);
    }

    /**
     * Create a `<video>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<video>` element.
     *
     * @phpstan-param Content $inner
     */
    public function video(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('video', $attrs, $inner);
    }

    /**
     * Create a `<wbr>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return Element The created `<wbr>` element.
     */
    public function wbr(array $attrs = []): Element
    {
        return $this->element('wbr', $attrs);
    }

    #endregion auto generated code

    // @codeCoverageIgnoreEnd
}
