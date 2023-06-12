<?php

declare(strict_types=1);

namespace Manychois\Views\Tests;

use Manychois\Views\Esc;
use PHPUnit\Framework\TestCase;

class EscTest extends TestCase
{
    /**
     * @dataProvider data_attr
     */
    public function test_attr(string $expected, string $html, bool $unquoted): void
    {
        $e = new Esc();
        $this->assertSame($expected, $e->attr($html, $unquoted));
    }

    /**
     * @return array<array<string|bool>>
     */
    public static function data_attr(): array
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

    public function test_css(): void
    {
        $e = new Esc();
        $this->assertSame('a\\\\b', $e->css('a\b'));
    }

    /**
     * @dataProvider data_html
     */
    public function test_html(string $expected, string $html): void
    {
        $e = new Esc();
        $this->assertSame($expected, $e->html($html));
    }

    /**
     * @return array<array<string>>
     */
    public static function data_html(): array
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
     * @dataProvider data_js
     */
    public function test_js(string $expected, string $text, bool $templateMode): void
    {
        $e = new Esc();
        $this->assertSame($expected, $e->js($text, $templateMode));
    }

    /**
     * @return array<array<string|bool>>
     */
    public static function data_js(): array
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
     * @dataProvider data_url
     */
    public function test_url(string $expected, string $text): void
    {
        $e = new Esc();
        $this->assertSame($expected, $e->url($text));
    }

    /**
     * @return array<array<string>>
     */
    public static function data_url(): array
    {
        return [
            ['ice%20cream', 'ice cream'],
            ['m%26m', 'm&m'],
            ['99%25', '99%'],
            ['1%2C2', '1,2'],
        ];
    }
}
