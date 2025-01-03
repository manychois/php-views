<?php

declare(strict_types=1);

namespace Manychois\Views;

/**
 * Pretty-prints HTML.
 */
class Printer
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
     * Prints the entire document.
     *
     * @param \DOMDocument $document The document to print.
     *
     * @return string The document HTML.
     */
    public function print(\DOMDocument $document): string
    {
        $document->normalizeDocument();

        $root = $document->documentElement;
        if ($root !== null) {
            $this->addAfterOpeningTag($root, "\n");
            $this->addBeforeClosingTag($root, "\n");
            foreach ($root->childNodes as $node) {
                if (!($node instanceof \DOMElement)) {
                    continue;
                }

                $this->format($node, 0);
            }
        }

        $html = '';
        foreach ($document->childNodes as $node) {
            if ($node instanceof \DOMDocumentType) {
                $html .= $this->printDoctype($node) . "\n";
            } elseif ($node instanceof \DOMComment) {
                $html .= $this->printComment($node) . "\n";
            } elseif ($node instanceof \DOMElement) {
                $html .= $this->printElement($node) . "\n";
            }
        }

        return $html;
    }

    /**
     * Prints the doctype declaration.
     *
     * @param \DOMDocumentType $doctype The doctype to print.
     *
     * @return string The doctype HTML.
     */
    protected function printDoctype(\DOMDocumentType $doctype): string
    {
        $html = '<!DOCTYPE ';
        $html .= $doctype->name;
        $esc = static fn (string $s): string => \str_replace(['"', '>'], ['', ''], $s);
        if ($doctype->publicId === '') {
            if ($doctype->systemId !== '') {
                $html .= \sprintf(' SYSTEM "%s"', $esc($doctype->systemId));
            }
        } else {
            $html .= \sprintf(' PUBLIC "%s"', $esc($doctype->publicId));
            if ($doctype->systemId !== '') {
                $html .= \sprintf(' "%s"', $esc($doctype->systemId));
            }
        }

        return $html . '>';
    }

    /**
     * Prints a comment.
     *
     * @param \DOMComment $comment The comment to print.
     *
     * @return string The comment HTML.
     */
    protected function printComment(\DOMComment $comment): string
    {
        $esc = static fn (string $s): string => \str_replace('-->', '--&gt;', $s);

        return \sprintf('<!--%s-->', $esc($comment->data));
    }

    /**
     * Prints a text node.
     *
     * @param \DOMText $text The text node to print.
     *
     * @return string The text HTML.
     */
    protected function printText(\DOMText $text): string
    {
        $parentElement = $text->parentNode instanceof \DOMElement ? $text->parentNode : null;
        $tagName = $parentElement?->tagName;
        if (\in_array($tagName, ElementKind::RAWTEXT, true)) {
            return \str_replace('</' . $tagName, '&lt;/' . $tagName, $text->data);
        }

        return Esc::html($text->data);
    }

    /**
     * Prints the opening tag of an element.
     *
     * @param \DOMElement $element The element to print.
     *
     * @return string The opening tag HTML.
     */
    protected function printElementOpeningTag(\DOMElement $element): string
    {
        $esc = static fn (string $s): string => \str_replace('>', '&gt;', $s);
        $html = '<' . $esc($element->tagName);
        foreach ($element->attributes as $attr) {
            \assert($attr instanceof \DOMAttr);
            if ($attr->value === '') {
                $html .= ' ' . $esc($attr->name);
            } else {
                $html .= \sprintf(' %s="%s"', $esc($attr->name), Esc::attr($attr->value));
            }
        }

        return $html . '>';
    }

    /**
     * Prints the closing tag of an element.
     *
     * @param \DOMElement $element The element to print.
     *
     * @return string The closing tag HTML.
     */
    protected function printElementClosingTag(\DOMElement $element): string
    {
        if (\in_array($element->tagName, ElementKind::VOID, true)) {
            return '';
        }

        return '</' . \str_replace('>', '&gt;', $element->tagName) . '>';
    }

    /**
     * Prints an element and its children.
     *
     * @param \DOMElement $element The element to print.
     *
     * @return string The element HTML.
     */
    protected function printElement(\DOMElement $element): string
    {
        $html = $this->printElementOpeningTag($element);
        foreach ($element->childNodes as $node) {
            if ($node instanceof \DOMElement) {
                $html .= $this->printElement($node);
            } elseif ($node instanceof \DOMText) {
                $html .= $this->printText($node);
            } elseif ($node instanceof \DOMComment) {
                $html .= $this->printComment($node);
            }
        }

        return $html . $this->printElementClosingTag($element);
    }

    /**
     * Determines if an element is an inline block element.
     * An inline block will have indents before its opening tag and after its closing tag.
     *
     * @param \DOMElement $element The element to check.
     *
     * @return bool `true` if the element is an inline block element, `false` otherwise.
     */
    protected function isInlineBlockElement(\DOMElement $element): bool
    {
        return \in_array($element->tagName, [
            'a',
            'button',
            'h1',
            'h2',
            'h3',
            'h4',
            'h5',
            'h6',
            'label',
            'li',
            'progress',
            'title',
        ], true);
    }

    /**
     * Determines if an element is an inline element.
     * An inline element will have no indents applied.
     *
     * @param \DOMElement $element The element to check.
     *
     * @return bool `true` if the element is an inline element, `false` otherwise.
     */
    protected function isInlineElement(\DOMElement $element): bool
    {
        return \in_array($element->tagName, [
            'a',
            'abbr',
            'acronym',
            'b',
            'bdi',
            'bdo',
            'big',
            'cite',
            'code',
            'data',
            'dfn',
            'em',
            'i',
            'kbd',
            'map',
            'mark',
            'meter',
            'output',
            // not inline, but we treat it as such
            'pre',
            'q',
            'ruby',
            's',
            'samp',
            'small',
            'span',
            'strong',
            'sub',
            'sup',
            'time',
            'tt',
            'u',
            'var',
            'wbr',
        ], true);
    }

    /**
     * Formats an element and its children by injecting newlines and indentation.
     *
     * @param \DOMElement $element The element to format.
     * @param int         $level   The current indentation level.
     */
    protected function format(\DOMElement $element, int $level): void
    {
        if ($this->isInlineElement($element)) {
            // no formatting
        } elseif ($this->isInlineBlockElement($element)) {
            $spacing = \str_repeat($this->tab, $level);
            $this->addBeforeOpeningTag($element, "\n" . $spacing);
            $this->addAfterClosingTag($element, "\n");
        } else {
            $spacing = \str_repeat($this->tab, $level);
            $this->addBeforeOpeningTag($element, "\n" . $spacing);
            $this->addAfterOpeningTag($element, "\n" . $spacing . $this->tab);
            $this->addBeforeClosingTag($element, "\n" . $spacing);
            $this->addAfterClosingTag($element, "\n");
        }

        foreach ($element->childNodes as $node) {
            if (!($node instanceof \DOMElement)) {
                continue;
            }

            $this->format($node, $level + 1);
        }
    }

    /**
     * Adds spacing after the opening tag of an element.
     *
     * @param \DOMElement $element The element to add spacing to.
     * @param string      $spacing The spacing to add.
     */
    protected function addAfterOpeningTag(\DOMElement $element, string $spacing): void
    {
        $firstChild = $element->firstChild;
        if ($firstChild === null) {
            return;
        }
        if ($firstChild instanceof \DOMText) {
            $firstChild->data = self::mergeStr($spacing, $firstChild->data);
        } else {
            $doc = $element->ownerDocument;
            \assert($doc instanceof \DOMDocument);
            $element->insertBefore($doc->createTextNode($spacing), $firstChild);
        }
    }

    /**
     * Adds spacing before the opening tag of an element.
     *
     * @param \DOMElement $element The element to add spacing to.
     * @param string      $spacing The spacing to add.
     */
    protected function addBeforeOpeningTag(\DOMElement $element, string $spacing): void
    {
        $parent = $element->parentNode;
        \assert($parent !== null);
        $before = $element->previousSibling;
        $doc = $element->ownerDocument;
        \assert($doc instanceof \DOMDocument);
        if ($before === null) {
            $parent->insertBefore($doc->createTextNode($spacing), $element);
        } else {
            if ($before instanceof \DOMText) {
                $before->data = self::mergeStr($before->data, $spacing);
            } else {
                $parent->insertBefore($doc->createTextNode($spacing), $element);
            }
        }
    }

    /**
     * Adds spacing after the closing tag of an element.
     *
     * @param \DOMElement $element The element to add spacing to.
     * @param string      $spacing The spacing to add.
     */
    protected function addAfterClosingTag(\DOMElement $element, string $spacing): void
    {
        $next = $element->nextSibling;
        $parent = $element->parentNode;
        \assert($parent !== null);
        $doc = $element->ownerDocument;
        \assert($doc instanceof \DOMDocument);
        if ($next === null) {
            $parent->appendChild($doc->createTextNode($spacing));
        } else {
            if ($next instanceof \DOMText) {
                $next->data = self::mergeStr($spacing, $next->data);
            } else {
                $parent->insertBefore($doc->createTextNode($spacing), $next);
            }
        }
    }

    /**
     * Adds spacing before the closing tag of an element.
     *
     * @param \DOMElement $element The element to add spacing to.
     * @param string      $spacing The spacing to add.
     */
    protected function addBeforeClosingTag(\DOMElement $element, string $spacing): void
    {
        $lastChild = $element->lastChild;
        if ($lastChild === null) {
            return;
        }
        if ($lastChild instanceof \DOMText) {
            $lastChild->data = self::mergeStr($lastChild->data, $spacing);
        } else {
            $doc = $element->ownerDocument;
            \assert($doc instanceof \DOMDocument);
            $element->appendChild($doc->createTextNode($spacing));
        }
    }

    /**
     * Merges two strings by removing the common suffix of the first string and the common prefix of the second string.
     *
     * @param string $left  The first string.
     * @param string $right The second string.
     *
     * @return string The merged string.
     */
    private static function mergeStr(string $left, string $right): string
    {
        $len = \min(\strlen($left), \strlen($right));
        for ($i = $len; $i > 0; --$i) {
            if (\substr($left, -$i) === \substr($right, 0, $i)) {
                return $left . \substr($right, $i);
            }
        }

        return $left . $right;
    }
}
