<?php

declare(strict_types=1);

namespace Manychois\Views;

/**
 * A helper class to generate HTML tags.
 */
class HtmlTag
{
    private const VOID_ELEMENTS = [
        'area',
        'base',
        'br',
        'col',
        'embed',
        'hr',
        'img',
        'input',
        'link',
        'meta',
        'param',
        'source',
        'track',
        'wbr',
    ];

    /**
     * Tag name.
     */
    public readonly string $name;

    /**
     * @var array<string,string|null>
     */
    public array $attrs = [];

    /**
     * @var array<string|HtmlTag>
     */
    public array $children = [];

    /**
     * Create a new Html tag.
     *
     * @param string $name Tag name. Must be a valid HTML tag name.
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Returns the HTML of this tag based on the render mode.
     *
     * @param HtmlTagRenderMode $mode How the tag is rendered.
     */
    public function render(HtmlTagRenderMode $mode = HtmlTagRenderMode::All): string
    {
        return match ($mode) {
            HtmlTagRenderMode::All => $this->renderAll(),
            HtmlTagRenderMode::OpenTag => $this->renderOpenTag(),
            HtmlTagRenderMode::AttrOnly => $this->renderAttrs(),
        };
    }

    /**
     * Returns the outer HTML of this tag.
     */
    private function renderAll(): string
    {
        $name = $this->name;
        if ($name === 'script' || $name === 'style') {
            return $this->renderRawTextTag();
        }
        if (in_array($name, self::VOID_ELEMENTS, true)) {
            return $this->renderOpenTag();
        }
        return $this->renderNormalTag();
    }

    /**
     * Returns the outer HTML of tag like <script> or <style>.
     */
    private function renderRawTextTag(): string
    {
        $html = $this->renderOpenTag();
        foreach ($this->children as $child) {
            if (!is_string($child)) {
                continue;
            }

            $html .= $child;
        }
        return $html . '</' . $this->name . '>';
    }

    /**
     * Returns the outer HTML of a normal tag.
     */
    private function renderNormalTag(): string
    {
        $html = $this->renderOpenTag();
        $e = new Esc();
        foreach ($this->children as $child) {
            if ($child instanceof self) {
                $html .= $child->renderAll();
            } elseif (is_string($child)) {
                $html .= $e->html($child);
            }
        }
        return $html . '</' . $this->name . '>';
    }

    /**
     * Returns the opening tag HTML of this tag.
     */
    private function renderOpenTag(): string
    {
        $html = '<' . $this->name;
        $attrs = $this->renderAttrs();
        if ($attrs) {
            $html .= ' ' . $attrs;
        }
        $html .= '>';
        return $html;
    }

    /**
     * Returns the attributes part of this tag.
     */
    private function renderAttrs(): string
    {
        $e = new Esc();
        $attrs = [];
        foreach ($this->attrs as $key => $value) {
            $attrs[] = $value === null
                ? $key
                : $key . '="' . $e->attr($value) . '"';
        }
        return implode(' ', $attrs);
    }
}
