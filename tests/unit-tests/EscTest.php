<?php

declare(strict_types=1);

namespace Manychois\ViewTests\UnitTests;

use Manychois\Views\Esc;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class EscTest extends TestCase
{
    /**
     * @return array<array<string|bool>>
     */
    public static function provideAttr(): array
    {
        return [
            ['You &amp; me', 'You & me', false],
            ['1 &lt; 2', '1 < 2', false],
            ['3 &gt; 0', '3 > 0', false],
            ['It&apos;s good', 'It\'s good', false],
            ['&quot;quote&quot;', '"quote"', false],
            ['a&#32;b&gt;c', 'a b>c', true],
        ];
    }

    /**
     * @return array<array<string>>
     */
    public static function provideHtml(): array
    {
        return [
            ['You &amp; me', 'You & me'],
            ['1 &lt; 2', '1 < 2'],
            ['3 &gt; 0', '3 > 0'],
            ['It\'s good', 'It\'s good'],
            ['"quote"', '"quote"'],
        ];
    }

    /**
     * @return array<array<string|bool>>
     */
    public static function provideJs(): array
    {
        return [
            ['', '', false],
            ['It\\\'s me', "It's me", false],
            ['\\"Hello!\\"', '"Hello!"', false],
            ['Path \\\\tmp', 'Path \\tmp', false],
            ['Line 1\nLine 2', 'Line 1' . "\n" . 'Line 2', false],
            ["a\\`\nb", "a`\nb", true],
        ];
    }

    /**
     * @return array<array<string>>
     */
    public static function provideUrl(): array
    {
        return [
            ['ice%20cream', 'ice cream'],
            ['m%26m', 'm&m'],
            ['99%25', '99%'],
            ['1%2C2', '1,2'],
        ];
    }

    #[DataProvider('provideAttr')]
    public function testAttr(string $expected, string $html, bool $unquoted): void
    {
        static::assertSame($expected, Esc::attr($html, $unquoted));
    }

    public function testCss(): void
    {
        static::assertSame('a\\\\b', Esc::css('a\b'));
    }

    #[DataProvider('provideHtml')]
    public function testHtml(string $expected, string $html): void
    {
        static::assertSame($expected, Esc::html($html));
    }

    #[DataProvider('provideJs')]
    public function testJs(string $expected, string $text, bool $templateMode): void
    {
        static::assertSame($expected, Esc::js($text, $templateMode));
    }

    #[DataProvider('provideUrl')]
    public function testUrl(string $expected, string $text): void
    {
        static::assertSame($expected, Esc::url($text));
    }
}
