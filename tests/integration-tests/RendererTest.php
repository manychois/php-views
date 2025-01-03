<?php

declare(strict_types=1);

namespace Manychois\ViewTests\IntegrationTests;

use Manychois\Views\Builder;
use Manychois\Views\Printer;
use Manychois\Views\Renderer;
use Manychois\Views\ViewData;
use PHPUnit\Framework\TestCase;

class RendererTest extends TestCase
{
    public function testRender(): void
    {
        $renderer = new Renderer(new Builder(), new Printer());
        $viewData = new ViewData([]);
        $html = $renderer->render(SampleViews\FormView::class, $viewData);
        $expected = \file_get_contents(__DIR__ . '/expected.html');
        static::assertSame($expected, $html);
    }
}
