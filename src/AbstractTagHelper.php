<?php

declare(strict_types=1);

namespace Manychois\Views;

use Dom\Element;
use Dom\HTMLDocument;
use Dom\Node;
use Dom\Text;

/**
 * Helper class for creating nodes.
 *
 * @phpstan-type Content string|Node|iterable<string|Node|\Closure|null>|\Closure|null
 */
abstract class AbstractTagHelper
{
    public readonly HTMLDocument $ownerDocument;

    /**
     * Initializes a new instance of a tag helper.
     *
     * @param HTMLDocument $ownerDocument The owner document.
     */
    public function __construct(HTMLDocument $ownerDocument)
    {
        $this->ownerDocument = $ownerDocument;
    }

    /**
     * Appends child node(s) to a parent node.
     *
     * @param HTMLDocument                      $doc    The owner document.
     * @param Node                              $parent The parent node.
     * @param string|Node|iterable|Closure|null $inner  The child node(s).
     *
     * @phpstan-param Content $inner
     */
    public static function append(HTMLDocument $doc, Node $parent, string|Node|iterable|\Closure|null $inner): void
    {
        if ($inner === null) {
            return;
        }

        if (\is_string($inner)) {
            if ($parent->lastChild instanceof Text) {
                $parent->lastChild->data .= $inner;

                return;
            }

            $inner = $doc->createTextNode($inner);
            $parent->appendChild($inner);

            return;
        }

        if ($inner instanceof Node) {
            $parent->appendChild($inner);

            return;
        }

        if (\is_iterable($inner)) {
            foreach ($inner as $child) {
                self::append($doc, $parent, $child);
            }

            return;
        }

        /**
         * @var string|Node|iterable<string|Node|\Closure|null>|\Closure|null $result
         */
        $result = $inner($doc);
        self::append($doc, $parent, $result);
    }

    /**
     * Parses an HTML string and returns the resulting node.
     *
     * @param HTMLDocument $doc     The owner document.
     * @param string       $context Inside which tag the HTML content is supposed to be.
     * @param string       $html    The HTML content.
     *
     * @return Node The resulting node.
     */
    public static function parsePartial(HTMLDocument $doc, string $context, string $html): Node
    {
        $parent = $doc->createElement($context);
        $parent->innerHTML = $html;
        if ($parent->childNodes->length === 1) {
            $child = $parent->firstChild;
            \assert($child !== null);
            $parent->removeChild($child);

            return $child;
        }

        $fragment = $doc->createDocumentFragment();
        foreach ($parent->childNodes as $child) {
            $fragment->appendChild($child);
        }

        return $fragment;
    }

    /**
     * Create an element in the specified namespace.
     *
     * @param string|null                                          $namespaceUri The namespace URI.
     * @param string                                               $tag          The tag name.
     * @param array<string,bool|string|null>                       $attrs        The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner        The inner content.
     *
     * @return Element The created element.
     *
     * @phpstan-param Content $inner
     */
    protected function elementNs(
        ?string $namespaceUri,
        string $tag,
        array $attrs = [],
        string|Node|iterable|\Closure|null $inner = null
    ): Element {
        if ($namespaceUri === null) {
            $element = $this->ownerDocument->createElement($tag);
        } else {
            $element = $this->ownerDocument->createElementNS($namespaceUri, $tag);
        }
        foreach ($attrs as $name => $value) {
            if ($value === null || $value === false) {
                continue;
            }
            if ($value === true) {
                $value = '';
            }
            $element->setAttribute($name, $value);
        }

        self::append($this->ownerDocument, $element, $inner);

        return $element;
    }
}
