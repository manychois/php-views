<?php

declare(strict_types=1);

namespace Manychois\ViewTests\UnitTests;

use Dom\HTMLDocument;
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
        $doc = HTMLDocument::createEmpty();
        $html = new HtmlTagHelper($doc);
        $comment = $html->comment('This is a comment.');
        static::assertSame('<!--This is a comment.-->', $doc->saveHtml($comment));

        $comment = $html->comment();
        static::assertSame('<!---->', $doc->saveHtml($comment));

        $comment = $html->comment(['a', 'b', null, 'c']);
        static::assertSame('<!--abc-->', $doc->saveHtml($comment));
    }

    #[DataProvider('provideCommentInvalidContent')]
    public function testCommentInvalidContent(mixed $inner, string $errMsg): void
    {
        $doc = HTMLDocument::createEmpty();
        $html = new HtmlTagHelper($doc);
        $this->expectException(\TypeError::class);
        $this->expectExceptionMessage($errMsg);
        // @phpstan-ignore argument.type
        $html->comment($inner);
    }

    public function testElement(): void
    {
        $doc = HTMLDocument::createEmpty();
        $html = new HtmlTagHelper($doc);
        $element = $html->element('div');
        static::assertSame('<div></div>', $doc->saveHtml($element));

        $element = $html->element('div', [
            'class' => 'a',
            'data-a' => false,
            'data-b' => true,
            'data-c' => '123',
            'id' => null,
        ]);
        static::assertSame('<div class="a" data-b="" data-c="123"></div>', $doc->saveHtml($element));

        $element = $html->element('div', ['class' => 'container'], 'A & B');
        static::assertSame('<div class="container">A &amp; B</div>', $doc->saveHtml($element));

        $element = $html->element('a', [], [
            $html->element('b', [], 'c'),
        ]);
        static::assertSame('<a><b>c</b></a>', $doc->saveHtml($element));
    }

    public function testElementInvalidContent(): void
    {
        $doc = HTMLDocument::createEmpty();
        $html = new HtmlTagHelper($doc);
        $this->expectException(\TypeError::class);
        $this->expectExceptionMessage('Invalid type: int.');
        // @phpstan-ignore argument.type
        $html->element('div', [], static fn () => 123);
    }
}
