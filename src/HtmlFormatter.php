<?php

declare(strict_types=1);

namespace Manychois\Views;

/**
 * Pretty-prints HTML.
 */
class HtmlFormatter
{
    public readonly string $tab;

    /**
     * Creates a new HTML formatter.
     *
     * @param string $tab The string to use for indentation.
     */
    public function __construct(string $tab = '  ')
    {
        $this->tab = $tab;
    }

    /**
     * Injects newlines and indentation into the HTML for better readability.
     *
     * @param \DOMElement $element The element to be formatted.
     * @param int         $tabs    The number of tabs to indent the element.
     */
    public function formatElement(\DOMElement $element, int $tabs = 0): void
    {
        $original = \iterator_to_array($element->childNodes);
        $n = \count($original);
        if ($n === 0) {
            return;
        }

        $outerTabs = \str_repeat($this->tab, \max(0, $tabs));
        $innerTabs = \str_repeat($this->tab, $tabs + 1);
        if (self::addNlInsideTag($element)) {
            self::insertIndentBefore($original[0], "\n{$innerTabs}");
            self::appendIndent($element, "\n{$outerTabs}");
        }

        foreach ($original as $i => $child) {
            if (!($child instanceof \DOMElement)) {
                continue;
            }

            if (self::addNlOutsideTag($child)) {
                self::insertIndentBefore($child, "\n{$innerTabs}");
                $next = $original[$i + 1] ?? null;
                if ($next === null) {
                    self::appendIndent($element, "\n{$outerTabs}");
                } else {
                    self::insertIndentBefore($next, "\n{$innerTabs}");
                }
            }
            $this->formatElement($child, $tabs + 1);
        }
    }

    /**
     * Whether to add a newline before the opening and closing tag of the element.
     *
     * @param \DOMElement $element The element to check.
     *
     * @return bool True if a newline should be added.
     */
    private static function addNlOutsideTag(\DOMElement $element): bool
    {
        return \in_array($element->tagName, [
            'body',
            'h1',
            'head',
            'html',
            'link',
            'meta',
            'p',
            'script',
            'title',
        ], true);
    }

    /**
     * Whether to add a newline after the opening tag or before the closing tag of the element.
     *
     * @param \DOMElement $element The element to check.
     *
     * @return bool True if a newline should be added.
     */
    private static function addNlInsideTag(\DOMElement $element): bool
    {
        return \in_array($element->tagName, [
            'body',
            'head',
            'p',
            'script',
        ], true);
    }

    /**
     * Inserts or merges the indentation before the node.
     *
     * @param \DOMNode $node   The node to insert the indentation before.
     * @param string   $indent The indentation to insert.
     */
    private static function insertIndentBefore(\DOMNode $node, string $indent): void
    {
        if ($node instanceof \DOMText) {
             $replaced = \preg_replace('/^\s+/s', $indent, $indent . $node->data);
             \assert(\is_string($replaced));
             $node->data = $replaced;

            return;
        }

        $before = $node->previousSibling;
        if ($before instanceof \DOMText) {
            $replaced = \preg_replace('/\s+$/s', $indent, $before->data . $indent);
            \assert(\is_string($replaced));
            $before->data = $replaced;
        } else {
            \assert($node->ownerDocument !== null);
            $indent = $node->ownerDocument->createTextNode($indent);
            \assert($node->parentNode !== null && $indent !== false);
            $node->parentNode->insertBefore($indent, $node);
        }
    }

    /**
     * Appends or merges the indentation after the last child of the parent.
     *
     * @param \DOMNode $parent The parent node to append the indentation to.
     * @param string   $indent The indentation to append.
     */
    private static function appendIndent(\DOMNode $parent, string $indent): void
    {
        $lastChild = $parent->lastChild;
        if ($lastChild instanceof \DOMText) {
            $replaced = \preg_replace('/\s+$/', $indent, $lastChild->data . $indent);
            \assert(\is_string($replaced));
            $lastChild->data = $replaced;
        } else {
            \assert($parent->ownerDocument !== null);
            $indent = $parent->ownerDocument->createTextNode($indent);
            $parent->appendChild($indent);
        }
    }
}
