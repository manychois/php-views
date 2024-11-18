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
            $element->setAttr($name, $value);
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
}
