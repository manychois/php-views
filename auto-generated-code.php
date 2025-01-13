<?php

declare(strict_types=1);

use Manychois\Views\HtmlElementKind;

require_once __DIR__ . '/vendor/autoload.php';

/** @var array<int,string> $tagNames */
$tagNames = [
    'a',
    'abbr',
    'address',
    'area',
    'article',
    'aside',
    'audio',
    'b',
    'base',
    'bdi',
    'bdo',
    'blockquote',
    'body',
    'br',
    'button',
    'canvas',
    'caption',
    'cite',
    'code',
    'col',
    'colgroup',
    'data',
    'datalist',
    'dd',
    'del',
    'details',
    'dfn',
    'dialog',
    'div',
    'dl',
    'dt',
    'em',
    'embed',
    'fieldset',
    'figcaption',
    'figure',
    'footer',
    'form',
    'h1',
    'h2',
    'h3',
    'h4',
    'h5',
    'h6',
    'head',
    'header',
    'hr',
    'html',
    'i',
    'iframe',
    'img',
    'input',
    'ins',
    'kbd',
    'label',
    'legend',
    'li',
    'link',
    'main',
    'map',
    'mark',
    'meta',
    'meter',
    'nav',
    'noscript',
    'object',
    'ol',
    'optgroup',
    'option',
    'output',
    'p',
    'param',
    'picture',
    'pre',
    'progress',
    'q',
    'rp',
    'rt',
    'ruby',
    's',
    'samp',
    'script',
    'section',
    'select',
    'slot',
    'small',
    'source',
    'span',
    'strong',
    'style',
    'sub',
    'summary',
    'sup',
    'table',
    'tbody',
    'td',
    'template',
    'textarea',
    'tfoot',
    'th',
    'thead',
    'time',
    'title',
    'tr',
    'track',
    'u',
    'ul',
    'var',
    'video',
    'wbr',
];

$normalTemplate = <<<'PHP'
/**
 * Create %2$s `<%1$s>` element.
 *
 * @param array<string,bool|string|null>                       $attrs The attributes.
 * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
 *
 * @return Element The created `<%1$s>` element.
 *
 * @phpstan-param Content $inner
 */
public function %1$s(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
{
    return $this->element('%1$s', $attrs, $inner);
}
PHP;

$voidTemplate = <<<'PHP'
/**
 * Create %2$s `<%1$s>` element.
 *
 * @param array<string,bool|string|null> $attrs The attributes.
 *
 * @return Element The created `<%1$s>` element.
 */
public function %1$s(array $attrs = []): Element
{
    return $this->element('%1$s', $attrs);
}
PHP;

$allCode = '';
foreach ($tagNames as $tagName) {
    $isVoid = \in_array($tagName, HtmlElementKind::VOID, true);
    $template = $isVoid ? $voidTemplate : $normalTemplate;
    $article = \in_array($tagName[0], ['a', 'e', 'i', 'o', 'u'], true) ? 'an' : 'a';
    $code = \sprintf($template, $tagName, $article);
    $lines = \explode("\n", $code);
    $lines = \array_map(static fn($line) => $line === '' ? '' : "    {$line}", $lines);
    $code = \implode("\n", $lines);
    $allCode .= $code . "\n\n";
}
$allCode = "\n" . \trim($allCode, "\n") . "\n";

$filePath = __DIR__ . '/src/HtmlTagHelper.php';
$existingCode = \file_get_contents($filePath);
\assert(\is_string($existingCode));
$start = \strpos($existingCode, '#region auto generated code');
\assert(\is_int($start));
$start = \strpos($existingCode, "\n", $start) + 1;
$end = \strpos($existingCode, '#endregion auto generated code', $start);
\assert(\is_int($end));
$end = \strrpos(\substr($existingCode, 0, $end), "\n");
\assert(\is_int($end));

$newCode = \substr_replace($existingCode, $allCode, $start, $end - $start);
\file_put_contents($filePath, $newCode);
