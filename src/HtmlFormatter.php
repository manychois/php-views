<?php

declare(strict_types=1);

namespace Manychois\Views;

use Manychois\Simdom\AbstractNode;
use Manychois\Simdom\Element;
use Manychois\Simdom\Internal\AbstractParentNode;
use Manychois\Simdom\Text;

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
     * @param Element $element The element to be formatted.
     * @param int     $tabs    The number of tabs to indent the element.
     */
    public function formatElement(Element $element, int $tabs = 0): void
    {
        $original = $element->childNodeList->toArray();
        $n = \count($original);
        if ($n === 0) {
            return;
        }

        $outerTabs = \str_repeat("\t", \max(0, $tabs));
        $innerTabs = \str_repeat("\t", $tabs + 1);
        if (self::addNlInsideTag($element)) {
            self::insertIndentBefore($original[0], "\n{$innerTabs}");
            self::appendIndent($element, "\n{$outerTabs}");
        }

        foreach ($original as $i => $child) {
            if (!($child instanceof Element)) {
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
     * @param Element $element The element to check.
     *
     * @return bool True if a newline should be added.
     */
    private static function addNlOutsideTag(Element $element): bool
    {
        return \in_array($element->tagName, [
            'body',
            'h1',
            'head',
            'html',
            'p',
            'title',
        ], true);
    }

    /**
     * Whether to add a newline after the opening tag or before the closing tag of the element.
     *
     * @param Element $element The element to check.
     *
     * @return bool True if a newline should be added.
     */
    private static function addNlInsideTag(Element $element): bool
    {
        return \in_array($element->tagName, [
            'body',
            'head',
            'p',
        ], true);
    }

    /**
     * Inserts or merges the indentation before the node.
     *
     * @param AbstractNode $node   The node to insert the indentation before.
     * @param string       $indent The indentation to insert.
     */
    private static function insertIndentBefore(AbstractNode $node, string $indent): void
    {
        if ($node instanceof Text) {
             $replaced = \preg_replace('/^\s+/s', $indent, $indent . $node->data);
             \assert(\is_string($replaced));
             $node->data = $replaced;

            return;
        }

        $before = $node->prevSibling();
        if ($before instanceof Text) {
            $replaced = \preg_replace('/\s+$/s', $indent, $before->data . $indent);
            \assert(\is_string($replaced));
            $before->data = $replaced;
        } else {
            $node->before($indent);
        }
    }

    /**
     * Appends or merges the indentation after the last child of the parent.
     *
     * @param AbstractParentNode $parent The parent node to append the indentation to.
     * @param string             $indent The indentation to append.
     */
    private static function appendIndent(AbstractParentNode $parent, string $indent): void
    {
        $lastChild = $parent->lastChild();
        if ($lastChild instanceof Text) {
            $replaced = \preg_replace('/\s+$/', $indent, $lastChild->data . $indent);
            \assert(\is_string($replaced));
            $lastChild->data = $replaced;
        } else {
            $parent->append($indent);
        }
    }
}
