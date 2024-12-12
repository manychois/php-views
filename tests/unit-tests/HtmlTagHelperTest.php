<?php

declare(strict_types=1);

namespace Manychois\ViewTests\UnitTests;

use DOMDocument;
use Manychois\Views\HtmlTagHelper;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class HtmlTagHelperTest extends TestCase
{
    public static function provideCommentInvalidContent(): \Generator
    {
        yield [[123], 'Invalid type: int.'];
        yield [static fn () => 123, 'Invalid type: int.'];
    }

    public function testComment(): void
    {
        $doc = new DOMDocument();
        $html = new HtmlTagHelper($doc);
        $comment = $html->comment('This is a comment.');
        static::assertSame('<!--This is a comment.-->', $doc->saveHTML($comment));

        $comment = $html->comment();
        static::assertSame('<!---->', $doc->saveHTML($comment));

        $comment = $html->comment(['a', 'b', null, 'c']);
        static::assertSame('<!--abc-->', $doc->saveHTML($comment));
    }

    #[DataProvider('provideCommentInvalidContent')]
    public function testCommentInvalidContent(mixed $inner, string $errMsg): void
    {
        $doc = new DOMDocument();
        $html = new HtmlTagHelper($doc);
        $this->expectException(\TypeError::class);
        $this->expectExceptionMessage($errMsg);
        // @phpstan-ignore argument.type
        $html->comment($inner);
    }

    public function testElement(): void
    {
        $doc = new DOMDocument();
        $html = new HtmlTagHelper($doc);
        $element = $html->element('div');
        static::assertSame('<div></div>', $doc->saveHTML($element));

        $element = $html->element('div', [
            'class' => 'a',
            'data-a' => false,
            'data-b' => true,
            'data-c' => '123',
            'id' => null,
        ]);
        static::assertSame('<div class="a" data-b="" data-c="123"></div>', $doc->saveHTML($element));

        $element = $html->element('div', ['class' => 'container'], 'A & B');
        static::assertSame('<div class="container">A &amp; B</div>', $doc->saveHTML($element));

        $element = $html->element('a', [], [
            $html->element('b', [], 'c'),
        ]);
        static::assertSame('<a><b>c</b></a>', $doc->saveHTML($element));
    }

    public function testElementInvalidContent(): void
    {
        $doc = new DOMDocument();
        $html = new HtmlTagHelper($doc);
        $this->expectException(\TypeError::class);
        $this->expectExceptionMessage('Invalid type: int.');
        // @phpstan-ignore argument.type
        $html->element('div', [], static fn () => 123);
    }
}
