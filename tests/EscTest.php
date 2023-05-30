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
    public function test_attr($expected, $html): void
    {
        $e = new Esc();
        $this->assertSame($expected, $e->attr($html));
    }

    public static function data_attr()
    {
        return [
            ['You &amp; me', 'You & me'],
            ['1 &lt; 2', '1 < 2'],
            ['3 &gt; 0', '3 > 0'],
            ['It&apos;s good', 'It\'s good'],
            ['&quot;quote&quot;', '"quote"'],
        ];
    }

    /**
     * @dataProvider data_html
     */
    public function test_html($expected, $html): void
    {
        $e = new Esc();
        $this->assertSame($expected, $e->html($html));
    }

    public static function data_html()
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
    public function test_js($expected, $html): void
    {
        $e = new Esc();
        $this->assertSame($expected, $e->js($html));
    }

    public static function data_js()
    {
        return [
            ['', ''],
            ['It\\\'s me', "It's me"],
            ['\\"Hello!\\"', '"Hello!"'],
            ['Path \\\\tmp', 'Path \\tmp'],
            ['Line 1\nLine 2', 'Line 1' . "\n" . 'Line 2'],
        ];
    }

    /**
     * @dataProvider data_url
     */
    public function test_url($expected, $html): void
    {
        $e = new Esc();
        $this->assertSame($expected, $e->url($html));
    }

    public static function data_url()
    {
        return [
            ['ice%20cream', 'ice cream'],
            ['m%26m', 'm&m'],
            ['99%25', '99%'],
            ['1%2C2', '1,2'],
        ];
    }
}
