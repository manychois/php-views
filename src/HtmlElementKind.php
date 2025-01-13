<?php

declare(strict_types=1);

namespace Manychois\Views;

/**
 * Represents the kind of an HTML element.
 */
final class HtmlElementKind
{
    public const VOID = [
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
        'source',
        'track',
        'wbr',
    ];
    public const RAWTEXT = [
        'script',
        'style',
        'template',
    ];
    public const RCDATA = [
        'textarea',
        'title',
    ];
}
