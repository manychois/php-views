<?php

declare(strict_types=1);

namespace Manychois\Views;

/**
 * Helper class for creating HTML nodes.
 *
 * @phpstan-type SimpleContent string|\DOMNode|null
 * @phpstan-type ContentClosure \Closure(self):SimpleContent|iterable<SimpleContent>
 * @phpstan-type Content SimpleContent|iterable<SimpleContent>|ContentClosure
 * @phpstan-type CommentContent \Closure(self):string|iterable<string|null>|null
 */
final class HtmlTagHelper
{
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
     *
     * @phpstan-param string|iterable<string|null>|CommentContent|null $inner
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
                    throw new \TypeError(\sprintf('Invalid type: %s.', \get_debug_type($item)));
                }

                $concatenated .= $item;
            }
            $data = $concatenated;
        } elseif (!\is_string($data)) {
            throw new \TypeError(\sprintf('Invalid type: %s.', \get_debug_type($data)));
        }

        $comment = $this->ownerDocument->createComment($data);
        \assert($comment !== false);

        return $comment;
    }

    /**
     * Create an element.
     *
     * @param string                                                       $tag   The tag name.
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created element.
     *
     * @phpstan-param Content $inner
     */
    public function element(
        string $tag,
        array $attrs = [],
        string|\DOMNode|iterable|\Closure|null $inner = null
    ): \DOMElement {
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
            } elseif ($item instanceof \DOMNode) {
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
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<a>` element.
     *
     * @phpstan-param Content $inner
     */
    public function a(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('a', $attrs, $inner);
    }

    /**
     * Create an `<abbr>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<abbr>` element.
     *
     * @phpstan-param Content $inner
     */
    public function abbr(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('abbr', $attrs, $inner);
    }

    /**
     * Create an `<address>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<address>` element.
     *
     * @phpstan-param Content $inner
     */
    public function address(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('address', $attrs, $inner);
    }

    /**
     * Create an `<area>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return \DOMElement The created `<area>` element.
     */
    public function area(array $attrs = []): \DOMElement
    {
        return $this->element('area', $attrs);
    }

    /**
     * Create an `<article>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<article>` element.
     *
     * @phpstan-param Content $inner
     */
    public function article(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('article', $attrs, $inner);
    }

    /**
     * Create an `<aside>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<aside>` element.
     *
     * @phpstan-param Content $inner
     */
    public function aside(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('aside', $attrs, $inner);
    }

    /**
     * Create an `<audio>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<audio>` element.
     *
     * @phpstan-param Content $inner
     */
    public function audio(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('audio', $attrs, $inner);
    }

    /**
     * Create a `<b>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<b>` element.
     *
     * @phpstan-param Content $inner
     */
    public function b(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('b', $attrs, $inner);
    }

    /**
     * Create a `<base>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return \DOMElement The created `<base>` element.
     */
    public function base(array $attrs = []): \DOMElement
    {
        return $this->element('base', $attrs);
    }

    /**
     * Create a `<bdi>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<bdi>` element.
     *
     * @phpstan-param Content $inner
     */
    public function bdi(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('bdi', $attrs, $inner);
    }

    /**
     * Create a `<bdo>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<bdo>` element.
     *
     * @phpstan-param Content $inner
     */
    public function bdo(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('bdo', $attrs, $inner);
    }

    /**
     * Create a `<blockquote>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<blockquote>` element.
     *
     * @phpstan-param Content $inner
     */
    public function blockquote(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('blockquote', $attrs, $inner);
    }

    /**
     * Create a `<body>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<body>` element.
     *
     * @phpstan-param Content $inner
     */
    public function body(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('body', $attrs, $inner);
    }

    /**
     * Create a `<br>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return \DOMElement The created `<br>` element.
     */
    public function br(array $attrs = []): \DOMElement
    {
        return $this->element('br', $attrs);
    }

    /**
     * Create a `<button>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<button>` element.
     *
     * @phpstan-param Content $inner
     */
    public function button(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('button', $attrs, $inner);
    }

    /**
     * Create a `<canvas>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<canvas>` element.
     *
     * @phpstan-param Content $inner
     */
    public function canvas(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('canvas', $attrs, $inner);
    }

    /**
     * Create a `<caption>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<caption>` element.
     *
     * @phpstan-param Content $inner
     */
    public function caption(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('caption', $attrs, $inner);
    }

    /**
     * Create a `<cite>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<cite>` element.
     *
     * @phpstan-param Content $inner
     */
    public function cite(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('cite', $attrs, $inner);
    }

    /**
     * Create a `<code>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<code>` element.
     *
     * @phpstan-param Content $inner
     */
    public function code(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('code', $attrs, $inner);
    }

    /**
     * Create a `<col>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return \DOMElement The created `<col>` element.
     */
    public function col(array $attrs = []): \DOMElement
    {
        return $this->element('col', $attrs);
    }

    /**
     * Create a `<colgroup>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<colgroup>` element.
     *
     * @phpstan-param Content $inner
     */
    public function colgroup(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('colgroup', $attrs, $inner);
    }

    /**
     * Create a `<data>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<data>` element.
     *
     * @phpstan-param Content $inner
     */
    public function data(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('data', $attrs, $inner);
    }

    /**
     * Create a `<datalist>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<datalist>` element.
     *
     * @phpstan-param Content $inner
     */
    public function datalist(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('datalist', $attrs, $inner);
    }

    /**
     * Create a `<dd>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<dd>` element.
     *
     * @phpstan-param Content $inner
     */
    public function dd(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('dd', $attrs, $inner);
    }

    /**
     * Create a `<del>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<del>` element.
     *
     * @phpstan-param Content $inner
     */
    public function del(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('del', $attrs, $inner);
    }

    /**
     * Create a `<details>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<details>` element.
     *
     * @phpstan-param Content $inner
     */
    public function details(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('details', $attrs, $inner);
    }

    /**
     * Create a `<dfn>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<dfn>` element.
     *
     * @phpstan-param Content $inner
     */
    public function dfn(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('dfn', $attrs, $inner);
    }

    /**
     * Create a `<dialog>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<dialog>` element.
     *
     * @phpstan-param Content $inner
     */
    public function dialog(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('dialog', $attrs, $inner);
    }

    /**
     * Create a `<div>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<div>` element.
     *
     * @phpstan-param Content $inner
     */
    public function div(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('div', $attrs, $inner);
    }

    /**
     * Create a `<dl>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<dl>` element.
     *
     * @phpstan-param Content $inner
     */
    public function dl(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('dl', $attrs, $inner);
    }

    /**
     * Create a `<dt>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<dt>` element.
     *
     * @phpstan-param Content $inner
     */
    public function dt(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('dt', $attrs, $inner);
    }

    /**
     * Create an `<em>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<em>` element.
     *
     * @phpstan-param Content $inner
     */
    public function em(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('em', $attrs, $inner);
    }

    /**
     * Create an `<embed>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return \DOMElement The created `<embed>` element.
     */
    public function embed(array $attrs = []): \DOMElement
    {
        return $this->element('embed', $attrs);
    }

    /**
     * Create a `<fieldset>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<fieldset>` element.
     *
     * @phpstan-param Content $inner
     */
    public function fieldset(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('fieldset', $attrs, $inner);
    }

    /**
     * Create a `<figcaption>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<figcaption>` element.
     *
     * @phpstan-param Content $inner
     */
    public function figcaption(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('figcaption', $attrs, $inner);
    }

    /**
     * Create a `<figure>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<figure>` element.
     *
     * @phpstan-param Content $inner
     */
    public function figure(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('figure', $attrs, $inner);
    }

    /**
     * Create a `<footer>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<footer>` element.
     *
     * @phpstan-param Content $inner
     */
    public function footer(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('footer', $attrs, $inner);
    }

    /**
     * Create a `<form>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<form>` element.
     *
     * @phpstan-param Content $inner
     */
    public function form(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('form', $attrs, $inner);
    }

    /**
     * Create a `<h1>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<h1>` element.
     *
     * @phpstan-param Content $inner
     */
    public function h1(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('h1', $attrs, $inner);
    }

    /**
     * Create a `<h2>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<h2>` element.
     *
     * @phpstan-param Content $inner
     */
    public function h2(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('h2', $attrs, $inner);
    }

    /**
     * Create a `<h3>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<h3>` element.
     *
     * @phpstan-param Content $inner
     */
    public function h3(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('h3', $attrs, $inner);
    }

    /**
     * Create a `<h4>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<h4>` element.
     *
     * @phpstan-param Content $inner
     */
    public function h4(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('h4', $attrs, $inner);
    }

    /**
     * Create a `<h5>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<h5>` element.
     *
     * @phpstan-param Content $inner
     */
    public function h5(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('h5', $attrs, $inner);
    }

    /**
     * Create a `<h6>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<h6>` element.
     *
     * @phpstan-param Content $inner
     */
    public function h6(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('h6', $attrs, $inner);
    }

    /**
     * Create a `<head>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<head>` element.
     *
     * @phpstan-param Content $inner
     */
    public function head(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('head', $attrs, $inner);
    }

    /**
     * Create a `<header>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<header>` element.
     *
     * @phpstan-param Content $inner
     */
    public function header(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('header', $attrs, $inner);
    }

    /**
     * Create a `<hr>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return \DOMElement The created `<hr>` element.
     */
    public function hr(array $attrs = []): \DOMElement
    {
        return $this->element('hr', $attrs);
    }

    /**
     * Create a `<html>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<html>` element.
     *
     * @phpstan-param Content $inner
     */
    public function html(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('html', $attrs, $inner);
    }

    /**
     * Create an `<i>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<i>` element.
     *
     * @phpstan-param Content $inner
     */
    public function i(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('i', $attrs, $inner);
    }

    /**
     * Create an `<iframe>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<iframe>` element.
     *
     * @phpstan-param Content $inner
     */
    public function iframe(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('iframe', $attrs, $inner);
    }

    /**
     * Create an `<img>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return \DOMElement The created `<img>` element.
     */
    public function img(array $attrs = []): \DOMElement
    {
        return $this->element('img', $attrs);
    }

    /**
     * Create an `<input>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return \DOMElement The created `<input>` element.
     */
    public function input(array $attrs = []): \DOMElement
    {
        return $this->element('input', $attrs);
    }

    /**
     * Create an `<ins>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<ins>` element.
     *
     * @phpstan-param Content $inner
     */
    public function ins(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('ins', $attrs, $inner);
    }

    /**
     * Create a `<kbd>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<kbd>` element.
     *
     * @phpstan-param Content $inner
     */
    public function kbd(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('kbd', $attrs, $inner);
    }

    /**
     * Create a `<label>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<label>` element.
     *
     * @phpstan-param Content $inner
     */
    public function label(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('label', $attrs, $inner);
    }

    /**
     * Create a `<legend>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<legend>` element.
     *
     * @phpstan-param Content $inner
     */
    public function legend(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('legend', $attrs, $inner);
    }

    /**
     * Create a `<li>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<li>` element.
     *
     * @phpstan-param Content $inner
     */
    public function li(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('li', $attrs, $inner);
    }

    /**
     * Create a `<link>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return \DOMElement The created `<link>` element.
     */
    public function link(array $attrs = []): \DOMElement
    {
        return $this->element('link', $attrs);
    }

    /**
     * Create a `<main>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<main>` element.
     *
     * @phpstan-param Content $inner
     */
    public function main(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('main', $attrs, $inner);
    }

    /**
     * Create a `<map>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<map>` element.
     *
     * @phpstan-param Content $inner
     */
    public function map(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('map', $attrs, $inner);
    }

    /**
     * Create a `<mark>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<mark>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mark(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('mark', $attrs, $inner);
    }

    /**
     * Create a `<meta>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return \DOMElement The created `<meta>` element.
     */
    public function meta(array $attrs = []): \DOMElement
    {
        return $this->element('meta', $attrs);
    }

    /**
     * Create a `<meter>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<meter>` element.
     *
     * @phpstan-param Content $inner
     */
    public function meter(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('meter', $attrs, $inner);
    }

    /**
     * Create a `<nav>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<nav>` element.
     *
     * @phpstan-param Content $inner
     */
    public function nav(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('nav', $attrs, $inner);
    }

    /**
     * Create a `<noscript>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<noscript>` element.
     *
     * @phpstan-param Content $inner
     */
    public function noscript(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('noscript', $attrs, $inner);
    }

    /**
     * Create an `<object>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<object>` element.
     *
     * @phpstan-param Content $inner
     */
    public function object(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('object', $attrs, $inner);
    }

    /**
     * Create an `<ol>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<ol>` element.
     *
     * @phpstan-param Content $inner
     */
    public function ol(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('ol', $attrs, $inner);
    }

    /**
     * Create an `<optgroup>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<optgroup>` element.
     *
     * @phpstan-param Content $inner
     */
    public function optgroup(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('optgroup', $attrs, $inner);
    }

    /**
     * Create an `<option>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<option>` element.
     *
     * @phpstan-param Content $inner
     */
    public function option(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('option', $attrs, $inner);
    }

    /**
     * Create an `<output>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<output>` element.
     *
     * @phpstan-param Content $inner
     */
    public function output(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('output', $attrs, $inner);
    }

    /**
     * Create a `<p>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<p>` element.
     *
     * @phpstan-param Content $inner
     */
    public function p(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('p', $attrs, $inner);
    }

    /**
     * Create a `<param>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return \DOMElement The created `<param>` element.
     */
    public function param(array $attrs = []): \DOMElement
    {
        return $this->element('param', $attrs);
    }

    /**
     * Create a `<picture>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<picture>` element.
     *
     * @phpstan-param Content $inner
     */
    public function picture(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('picture', $attrs, $inner);
    }

    /**
     * Create a `<pre>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<pre>` element.
     *
     * @phpstan-param Content $inner
     */
    public function pre(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('pre', $attrs, $inner);
    }

    /**
     * Create a `<progress>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<progress>` element.
     *
     * @phpstan-param Content $inner
     */
    public function progress(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('progress', $attrs, $inner);
    }

    /**
     * Create a `<q>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<q>` element.
     *
     * @phpstan-param Content $inner
     */
    public function q(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('q', $attrs, $inner);
    }

    /**
     * Create a `<rp>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<rp>` element.
     *
     * @phpstan-param Content $inner
     */
    public function rp(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('rp', $attrs, $inner);
    }

    /**
     * Create a `<rt>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<rt>` element.
     *
     * @phpstan-param Content $inner
     */
    public function rt(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('rt', $attrs, $inner);
    }

    /**
     * Create a `<ruby>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<ruby>` element.
     *
     * @phpstan-param Content $inner
     */
    public function ruby(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('ruby', $attrs, $inner);
    }

    /**
     * Create a `<s>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<s>` element.
     *
     * @phpstan-param Content $inner
     */
    public function s(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('s', $attrs, $inner);
    }

    /**
     * Create a `<samp>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<samp>` element.
     *
     * @phpstan-param Content $inner
     */
    public function samp(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('samp', $attrs, $inner);
    }

    /**
     * Create a `<script>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<script>` element.
     *
     * @phpstan-param Content $inner
     */
    public function script(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('script', $attrs, $inner);
    }

    /**
     * Create a `<section>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<section>` element.
     *
     * @phpstan-param Content $inner
     */
    public function section(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('section', $attrs, $inner);
    }

    /**
     * Create a `<select>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<select>` element.
     *
     * @phpstan-param Content $inner
     */
    public function select(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('select', $attrs, $inner);
    }

    /**
     * Create a `<slot>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<slot>` element.
     *
     * @phpstan-param Content $inner
     */
    public function slot(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('slot', $attrs, $inner);
    }

    /**
     * Create a `<small>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<small>` element.
     *
     * @phpstan-param Content $inner
     */
    public function small(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('small', $attrs, $inner);
    }

    /**
     * Create a `<source>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return \DOMElement The created `<source>` element.
     */
    public function source(array $attrs = []): \DOMElement
    {
        return $this->element('source', $attrs);
    }

    /**
     * Create a `<span>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<span>` element.
     *
     * @phpstan-param Content $inner
     */
    public function span(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('span', $attrs, $inner);
    }

    /**
     * Create a `<strong>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<strong>` element.
     *
     * @phpstan-param Content $inner
     */
    public function strong(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('strong', $attrs, $inner);
    }

    /**
     * Create a `<style>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<style>` element.
     *
     * @phpstan-param Content $inner
     */
    public function style(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('style', $attrs, $inner);
    }

    /**
     * Create a `<sub>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<sub>` element.
     *
     * @phpstan-param Content $inner
     */
    public function sub(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('sub', $attrs, $inner);
    }

    /**
     * Create a `<summary>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<summary>` element.
     *
     * @phpstan-param Content $inner
     */
    public function summary(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('summary', $attrs, $inner);
    }

    /**
     * Create a `<sup>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<sup>` element.
     *
     * @phpstan-param Content $inner
     */
    public function sup(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('sup', $attrs, $inner);
    }

    /**
     * Create a `<table>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<table>` element.
     *
     * @phpstan-param Content $inner
     */
    public function table(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('table', $attrs, $inner);
    }

    /**
     * Create a `<tbody>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<tbody>` element.
     *
     * @phpstan-param Content $inner
     */
    public function tbody(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('tbody', $attrs, $inner);
    }

    /**
     * Create a `<td>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<td>` element.
     *
     * @phpstan-param Content $inner
     */
    public function td(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('td', $attrs, $inner);
    }

    /**
     * Create a `<template>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<template>` element.
     *
     * @phpstan-param Content $inner
     */
    public function template(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('template', $attrs, $inner);
    }

    /**
     * Create a `<textarea>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<textarea>` element.
     *
     * @phpstan-param Content $inner
     */
    public function textarea(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('textarea', $attrs, $inner);
    }

    /**
     * Create a `<tfoot>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<tfoot>` element.
     *
     * @phpstan-param Content $inner
     */
    public function tfoot(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('tfoot', $attrs, $inner);
    }

    /**
     * Create a `<th>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<th>` element.
     *
     * @phpstan-param Content $inner
     */
    public function th(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('th', $attrs, $inner);
    }

    /**
     * Create a `<thead>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<thead>` element.
     *
     * @phpstan-param Content $inner
     */
    public function thead(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('thead', $attrs, $inner);
    }

    /**
     * Create a `<time>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<time>` element.
     *
     * @phpstan-param Content $inner
     */
    public function time(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('time', $attrs, $inner);
    }

    /**
     * Create a `<title>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<title>` element.
     *
     * @phpstan-param Content $inner
     */
    public function title(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('title', $attrs, $inner);
    }

    /**
     * Create a `<tr>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<tr>` element.
     *
     * @phpstan-param Content $inner
     */
    public function tr(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('tr', $attrs, $inner);
    }

    /**
     * Create a `<track>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return \DOMElement The created `<track>` element.
     */
    public function track(array $attrs = []): \DOMElement
    {
        return $this->element('track', $attrs);
    }

    /**
     * Create an `<u>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<u>` element.
     *
     * @phpstan-param Content $inner
     */
    public function u(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('u', $attrs, $inner);
    }

    /**
     * Create an `<ul>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<ul>` element.
     *
     * @phpstan-param Content $inner
     */
    public function ul(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('ul', $attrs, $inner);
    }

    /**
     * Create a `<var>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<var>` element.
     *
     * @phpstan-param Content $inner
     */
    public function var(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('var', $attrs, $inner);
    }

    /**
     * Create a `<video>` element.
     *
     * @param array<string,bool|string|null>                               $attrs The attributes.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $inner The inner content.
     *
     * @return \DOMElement The created `<video>` element.
     *
     * @phpstan-param Content $inner
     */
    public function video(array $attrs = [], string|\DOMNode|iterable|\Closure|null $inner = null): \DOMElement
    {
        return $this->element('video', $attrs, $inner);
    }

    /**
     * Create a `<wbr>` element.
     *
     * @param array<string,bool|string|null> $attrs The attributes.
     *
     * @return \DOMElement The created `<wbr>` element.
     */
    public function wbr(array $attrs = []): \DOMElement
    {
        return $this->element('wbr', $attrs);
    }

    #endregion auto generated code

    // @codeCoverageIgnoreEnd
}
