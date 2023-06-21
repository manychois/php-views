<?php

declare(strict_types=1);

namespace Manychois\Views;

/**
 * Defines how an HTML tag is rendered.
 */
enum HtmlTagRenderMode: int
{
    case All = 0;
    case OpenTag = 1;
    case AttrOnly = 2;
}
