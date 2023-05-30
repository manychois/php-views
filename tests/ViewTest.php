<?php

declare(strict_types=1);

namespace Manychois\Views\Tests;

use Manychois\Views\View;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    public function test_render_ok(): void
    {
        $model = new ViewModel();
        $model->title = 'Testing';
        $output = View::render(ChildViewOne::class, $model);
        $output = str_replace("\r", '', $output);
        $output = str_replace("\n", '', $output);
        $output = preg_replace('/\\s{2,}/', '', $output);
        $expected = '<!doctype html><html lang="en"><head><meta charset="utf-8" /><title>Testing</title><meta name="description" content="SEO is hard" /></head><body><main><article><h1>Hello World!</h1></article></main><!-- No JavaScript --></body></html>';
        $this->assertSame($expected, $output);
    }

    public function test_render_missingRegion_ok(): void
    {
        $model = new ViewModel();
        $model->title = 'Testing';
        $output = View::render(ChildViewTwo::class, $model);
        $output = str_replace("\r", '', $output);
        $output = str_replace("\n", '', $output);
        $output = preg_replace('/\\s{2,}/', '', $output);
        $expected = '<!doctype html><html lang="en"><head><meta charset="utf-8" /><title>Testing</title></head><body><main><article><h1>Hello World!</h1></article></main><!-- No JavaScript --></body></html>';
        $this->assertSame($expected, $output);
    }

    public function test_render_missingChild_ok(): void
    {
        $model = new ViewModel();
        $model->title = 'Testing';
        $output = View::render(MasterViewOne::class, $model);
        $output = str_replace("\r", '', $output);
        $output = str_replace("\n", '', $output);
        $output = preg_replace('/\\s{2,}/', '', $output);
        $expected = '<!doctype html><html lang="en"><head><meta charset="utf-8" /><title>Testing</title></head><body><main>No content</main><!-- No JavaScript --></body></html>';
        $this->assertSame($expected, $output);
    }

    public function test_render_missingChild_ok_2(): void
    {
        $model = new ViewModel();
        $model->title = 'Testing';
        $output = View::render(MasterViewTwo::class, $model);
        $output = str_replace("\r", '', $output);
        $output = str_replace("\n", '', $output);
        $output = preg_replace('/\\s{2,}/', '', $output);
        $regex = preg_quote('<!doctype html><html lang="en"><head><meta charset="utf-8" /><title>Testing</title></head><body><div id="id-000">Master Div</div></body></html>', '/');
        $regex = strtr($regex, ['000' => '(\d+)']);
        $pregMatch = preg_match("/$regex/", $output, $matches);
        $this->assertSame(1, $pregMatch);
    }

    public function test_placeholder_and_id(): void
    {
        $model = new ViewModel();
        $model->title = 'Original';
        $output = View::render(ChildViewThree::class, $model);
        $output = str_replace("\r", '', $output);
        $output = str_replace("\n", '', $output);
        $output = preg_replace('/\\s{2,}/', '', $output);
        $regex = preg_quote('<!doctype html><html lang="en"><head><meta charset="utf-8" /><title>Modified</title></head><body><div id="id-000">Child Div</div><div id="id-000">Master Div</div></body></html>', '/');
        $regex = strtr($regex, ['000' => '(\d+)']);
        $pregMatch = preg_match("/$regex/", $output, $matches);
        $this->assertSame(1, $pregMatch);
        $this->assertTrue($matches[1] !== $matches[2]);
    }
}
