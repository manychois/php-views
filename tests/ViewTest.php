<?php
namespace Manychois\Views\Tests;

use PHPUnit\Framework\TestCase;
use Manychois\Views\View;
use Manychois\Views\ViewModel;

class ViewTest extends TestCase
{
    public function test_render_success()
    {
        $view = new ChildView();
        $model = new ViewModel();
        $model->title = 'Testing';
        ob_start();
        View::render($view, $model);
        $output = ob_get_clean();
        $output = str_replace("\r", '', $output);
        $output = str_replace("\n", '', $output);
        $output = preg_replace('/\\s{2,}/', '', $output);
        $expected = '<!doctype html><html lang="en"><head><meta charset="utf-8" /><title>Testing</title><meta name="description" content="SEO is hard" /></head><body><main><article><h1>Hello World!</h1></article></main><!-- No JavaScript --></body></html>';
        $this->assertSame($expected, $output);
    }

    public function test_render_missingMethod_failed()
    {
        $view = new FailedChildView();
        $model = new ViewModel();
        $model->title = 'Testing';
        ob_start();
        try {
            View::render($view, $model);
            $this->fail("Expected Exception has not been raised.");
        }
        catch (\Exception $ex) {
            $this->assertSame('Method render_head is not defined in the child view Manychois\Views\Tests\FailedChildView.', $ex->getMessage());
        }
        ob_get_clean();
    }

    public function test_render_missingChild_failed()
    {
        $view = new MasterView();
        $model = new ViewModel();
        $model->title = 'Testing';
        ob_start();
        try {
            View::render($view, $model);
            $this->fail("Expected Exception has not been raised.");
        }
        catch (\Exception $ex) {
            $this->assertSame('Child view is undefined for view Manychois\Views\Tests\MasterView.', $ex->getMessage());
        }
        ob_get_clean();
    }
}